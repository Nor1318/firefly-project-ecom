<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Kina</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: none;
            width: 100% !important;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background-color: #9333ea;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .welcome-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            color: #9ca3af;
            font-size: 12px;
            margin: 0;
        }
        .btn {
            display: inline-block;
            background-color: #9333ea;
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Kina</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="welcome-icon">👋</div>
            <h2 style="color: #111827; margin-top: 0;">Welcome to Kina!</h2>
            <p style="color: #4b5563; line-height: 1.5; font-size: 16px;">Hi {{ $user->name }},</p>
            <p style="color: #4b5563; line-height: 1.5;">We're thrilled to have you on board. Kina is your one-stop shop for all your baby needs.</p>
            <p style="color: #4b5563; line-height: 1.5;">Feel free to browse our latest collection and find the perfect items for your little one.</p>
            
            <div style="margin-top: 30px;">
                <a href="{{ route('home') }}" class="btn">Start Shopping</a>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Kina. All rights reserved.</p>
            <p style="margin-top: 10px;">If you have any questions, please reply to this email.</p>
        </div>
    </div>
</body>
</html>