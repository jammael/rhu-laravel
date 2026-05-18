<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password Reset OTP</title>
</head>
<body style="font-family: Arial, sans-serif; color: #111827; line-height: 1.5;">
    <h2 style="margin-bottom: 12px;">NutriCare password reset</h2>

    <p>You requested to reset your NutriCare account password.</p>

    <p style="font-size: 28px; font-weight: bold; letter-spacing: 8px; margin: 24px 0;">
        {{ $otp }}
    </p>

    <p>This OTP expires in 10 minutes. If you did not request a password reset, you can ignore this email.</p>
</body>
</html>
