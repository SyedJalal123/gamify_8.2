<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seller Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-size: 20px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            text-align: center;
            color: #333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
        }
        .status {
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            padding: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Seller Verification</div>
        <div class="content">
            <h2>Hello, {{ $sellerData['name'] }} 👋</h2>
            <p>We are pleased to inform you that your seller account verification is currently <span class="status">{{ $sellerData['status'] }}</span>.</p>
            <p><strong>Email:</strong> {{ $sellerData['email'] }}</p>
            <p>We appreciate your patience during this process. If any additional information is required, we will reach out to you.</p>
            <p>Thank you for choosing our platform!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Gamify | All rights reserved.
        </div>
    </div>
</body>
</html>
