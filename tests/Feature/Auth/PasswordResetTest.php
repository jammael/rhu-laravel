<?php

use App\Mail\PasswordResetOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

test('reset password OTP request screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

test('reset password OTP can be requested', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Mail::assertSent(PasswordResetOtpMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email)
            && strlen($mail->otp) === 6;
    });
});

test('reset password OTP request does not reveal unknown emails', function () {
    Mail::fake();

    $response = $this->post('/forgot-password', ['email' => 'missing@example.com']);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('password.reset'));

    Mail::assertNothingSent();
});

test('reset password screen can be rendered', function () {
    $response = $this->get('/reset-password');

    $response->assertStatus(200);
});

test('password can be reset with valid OTP', function () {
    Mail::fake();

    $user = User::factory()->create();
    $otp = null;

    $this->post('/forgot-password', ['email' => $user->email]);

    Mail::assertSent(PasswordResetOtpMail::class, function ($mail) use (&$otp) {
        $otp = $mail->otp;

        return true;
    });

    $response = $this->post('/reset-password', [
        'email' => $user->email,
        'otp' => $otp,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('password.success'));
});

test('password cannot be reset with invalid OTP', function () {
    Mail::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    $response = $this->post('/reset-password', [
        'email' => $user->email,
        'otp' => '000000',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasErrors('otp');
});
