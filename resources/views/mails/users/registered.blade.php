<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
        }

        p {
            margin-bottom: 15px;
        }

        .footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Welcome to Our Website!</h2>

        <p>Hello {{ $user->name }},</p>

        <p>Thank you for registering with us. We are excited to have you on board.</p>

        <p>If you have any questions or need assistance, feel free to contact us.</p>

        <div class="footer">
            <p>Best regards,<br>
                Your Expense Tracker Team</p>
        </div>
    </div>
</body>

</html>
