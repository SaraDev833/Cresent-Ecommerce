<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        p {
            color: #555;
        }

        a.button {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 20px;
            background-color: crimson;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a.button:hover {
            background-color: rgb(111, 26, 26);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Password Reset Request</h1>
        <p>Hello,</p>
        <p>We received a request to reset your password. Click the button below to reset it:</p>
        <a href="{{ route('new.pass.request', $token) }}" class="button">Reset Password</a>
        <p>If you did not request a password reset, please ignore this email.</p>
        <p>Thank you for using our application!</p>
        <p>Best regards,<br><b>Cresent</b></p>
    </div>
</body>

</html>
