<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', [
            'email' => old('email', $request->email ?? session()->getOldInput('email')),
        ]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $email = $request->string('email')->lower()->toString();
        $resetToken = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (! $resetToken) {
            throw ValidationException::withMessages([
                'email' => 'Please request a new OTP before resetting your password.',
            ]);
        }

        if (now()->diffInMinutes($resetToken->created_at) > 10) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            throw ValidationException::withMessages([
                'otp' => 'This OTP has expired. Please request a new one.',
            ]);
        }

        if (! Hash::check($request->otp, $resetToken->token)) {
            throw ValidationException::withMessages([
                'otp' => 'The OTP you entered is invalid.',
            ]);
        }

        $user = User::where('email', $email)->firstOrFail();

        $user->forceFill([
            'password' => Hash::make($request->password),
            'remember_token' => Str::random(60),
        ])->save();

        DB::table('password_reset_tokens')->where('email', $email)->delete();

        event(new PasswordReset($user));

        return redirect()->route('login')->with('status', 'Your password has been reset. You can now log in.');
    }
}
