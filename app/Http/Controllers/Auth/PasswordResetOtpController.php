<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetOtpController extends Controller
{
    private const OTP_EXPIRY_MINUTES = 10;
    private const MAX_OTP_ATTEMPTS = 5;

    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = $request->string('email')->lower()->toString();
        $user = User::where('email', $email)->first();
        $message = 'If that email exists in NutriCare, we sent a 6-digit OTP. It expires in 10 minutes.';

        if (! $user) {
            return redirect()->route('password.reset')
                ->withInput(['email' => $email])
                ->with('status', $message);
        }

        $otp = (string) random_int(100000, 999999);

        DB::table('password_reset_otps')->updateOrInsert(
            ['email' => $email],
            [
                'otp_hash' => Hash::make($otp),
                'expires_at' => now()->addMinutes(self::OTP_EXPIRY_MINUTES),
                'attempts' => 0,
                'used_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        Mail::to($user)->send(new PasswordResetOtpMail($otp));

        return redirect()->route('password.reset')
            ->withInput(['email' => $email])
            ->with('status', $message);
    }

    public function resetForm(Request $request): View
    {
        return view('auth.reset-password', [
            'email' => old('email', $request->email ?? session()->getOldInput('email')),
        ]);
    }

    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->string('email')->lower()->toString();
        $otpRecord = DB::table('password_reset_otps')
            ->where('email', $email)
            ->whereNull('used_at')
            ->first();

        if (! $otpRecord) {
            throw ValidationException::withMessages([
                'email' => 'Please request a new OTP before resetting your password.',
            ]);
        }

        if (now()->greaterThan(Carbon::parse($otpRecord->expires_at))) {
            DB::table('password_reset_otps')->where('email', $email)->delete();

            throw ValidationException::withMessages([
                'otp' => 'This OTP has expired. Please request a new one.',
            ]);
        }

        if ($otpRecord->attempts >= self::MAX_OTP_ATTEMPTS) {
            DB::table('password_reset_otps')->where('email', $email)->delete();

            throw ValidationException::withMessages([
                'otp' => 'Too many incorrect attempts. Please request a new OTP.',
            ]);
        }

        if (! Hash::check($request->otp, $otpRecord->otp_hash)) {
            DB::table('password_reset_otps')
                ->where('email', $email)
                ->increment('attempts');

            throw ValidationException::withMessages([
                'otp' => 'The OTP you entered is invalid.',
            ]);
        }

        $user = User::where('email', $email)->firstOrFail();

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        DB::table('password_reset_otps')->where('email', $email)->update([
            'used_at' => now(),
            'updated_at' => now(),
        ]);

        event(new PasswordReset($user));

        return redirect()->route('login')->with('status', 'Your password has been reset. You can now log in.');
    }
}
