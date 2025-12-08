<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
        }
        .order-info {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .order-info p {
            margin: 5px 0;
            color: #4b5563;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .table th {
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #e5e7eb;
            color: #374151;
            font-size: 14px;
        }
        .table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            color: #4b5563;
            font-size: 14px;
        }
        .total-row td {
            border-bottom: none;
            font-weight: bold;
            color: #111827;
            font-size: 16px;
            padding-top: 20px;
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
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
            background-color: #f3e8ff;
            color: #9333ea;
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
            <h2 style="color: #111827; margin-top: 0;">Order Confirmation</h2>
            <p style="color: #4b5563; line-height: 1.5;">Hi {{ $order->user->name }},</p>
            <p style="color: #4b5563; line-height: 1.5;">Thank you for your order! We've received it and will begin processing it right away.</p>

            <!-- Order Info -->
            <div class="order-info">
                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
                <p><strong>Status:</strong> <span class="status-badge">{{ ucfirst($order->status) }}</span></p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            </div>

            <!-- Order Items -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: center;">Qty</th>
                        <th style="text-align: right;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <div style="font-weight: 500; color: #111827;">{{ $item->product->name }}</div>
                        </td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">Rs {{ number_format($item->unit_amount * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="2" style="text-align: right;">Total Amount:</td>
                        <td style="text-align: right; color: #9333ea;">Rs {{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Shipping Address -->
            <div style="margin-top: 30px;">
                <h3 style="color: #111827; font-size: 16px; margin-bottom: 10px;">Shipping Address</h3>
                <p style="color: #4b5563; margin: 0; line-height: 1.5;">
                    {{ $order->address->first_name }} {{ $order->address->last_name }}<br>
                    {{ $order->address->street_address }}<br>
                    {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                    {{ $order->address->phone }}
                </p>
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('orders.show', $order->id) }}" class="btn">View Order Details</a>
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