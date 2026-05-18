<?php

namespace App\Http\Controllers\Auth;

use App\Mail\PasswordResetOtpMail;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset OTP request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset OTP request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $email = $request->string('email')->lower()->toString();
        $otp = (string) random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($otp),
                'created_at' => now(),
            ]
        );

        Mail::to(User::where('email', $email)->firstOrFail())->send(
            new PasswordResetOtpMail($otp)
        );

        return redirect()->route('password.reset')
            ->withInput(['email' => $email])
            ->with('status', 'We sent a 6-digit OTP to your email. It expires in 10 minutes.');
    }
}
