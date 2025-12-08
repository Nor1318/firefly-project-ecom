<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            background: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-top: none;
        }
        .invoice-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        .invoice-details h2 {
            color: #8b5cf6;
            margin-top: 0;
            font-size: 20px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #666;
        }
        .detail-value {
            color: #333;
        }
        .total-amount {
            background: #8b5cf6;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
        .total-amount .amount {
            font-size: 32px;
            font-weight: bold;
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            background: #8b5cf6;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin: 20px 0;
        }
        .button:hover {
            background: #7c3aed;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 14px;
            border-top: 1px solid #e5e7eb;
            margin-top: 30px;
        }
        .items-list {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #e5e7eb;
        }
        .item {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .item:last-child {
            border-bottom: none;
        }
        .item-name {
            font-weight: bold;
            color: #333;
        }
        .item-details {
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📄 Invoice Ready</h1>
        <p style="margin: 10px 0 0 0;">Order #{{ $order->id }}</p>
    </div>
    
    <div class="content">
        <p>Hello <strong>{{ $order->user->name }}</strong>,</p>
        
        <p>Thank you for your order! Your invoice is ready and attached to this email.</p>
        
        <div class="invoice-details">
            <h2>Order Summary</h2>
            <div class="detail-row">
                <span class="detail-label">Order ID:</span>
                <span class="detail-value">#{{ $order->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Order Date:</span>
                <span class="detail-value">{{ $order->created_at->format('M d, Y h:i A') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status:</span>
                <span class="detail-value" style="color: 
                    @if($order->status == 'completed') #059669
                    @elseif($order->status == 'pending') #d97706
                    @elseif($order->status == 'processing') #2563eb
                    @else #666
                    @endif; font-weight: bold;">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <div class="items-list">
            <h2 style="color: #8b5cf6; margin-top: 0;">Order Items</h2>
            @foreach($order->orderItems as $item)
            <div class="item">
                <div class="item-name">{{ $item->product ? $item->product->name : 'Product Deleted' }}</div>
                <div class="item-details">
                    Quantity: {{ $item->quantity }} × Rs {{ number_format($item->price, 2) }} = 
                    <strong>Rs {{ number_format($item->price * $item->quantity, 2) }}</strong>
                </div>
            </div>
            @endforeach
        </div>

        <div class="total-amount">
            <div style="font-size: 16px;">Total Amount</div>
            <div class="amount">Rs {{ number_format($order->total_amount, 2) }}</div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb;">
            <h3 style="color: #8b5cf6; margin-top: 0;">Shipping Address</h3>
            <p style="margin: 0; line-height: 1.8;">
                <strong>{{ $order->address->full_name }}</strong><br>
                {{ $order->address->address }}<br>
                {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                Phone: {{ $order->address->phone }}
            </p>
        </div>

        <p style="margin-top: 30px; color: #666; font-size: 14px;">
            The invoice PDF is attached to this email. You can save it for your records.
        </p>
    </div>

    <div class="footer">
        <p><strong>Thank you for shopping with us!</strong></p>
        <p>If you have any questions, please contact us at contact@yourstore.com</p>
        <p style="margin-top: 20px; font-size: 12px; color: #999;">
            This is an automated email. Please do not reply to this message.
        </p>
    </div>
</body>
</html>
