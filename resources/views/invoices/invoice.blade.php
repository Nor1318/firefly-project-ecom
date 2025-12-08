<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 3px solid #8b5cf6;
            padding-bottom: 20px;
        }
        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .header-right {
            display: table-cell;
            width: 50%;
            text-align: right;
            vertical-align: top;
        }
        .company-name {
            font-size: 28px;
            font-weight: bold;
            color: #8b5cf6;
            margin-bottom: 5px;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .invoice-details {
            font-size: 12px;
            color: #666;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #8b5cf6;
            margin-bottom: 15px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 8px;
        }
        .info-grid {
            display: table;
            width: 100%;
        }
        .info-column {
            display: table-cell;
            width: 50%;
            padding: 10px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
        }
        .info-label {
            font-weight: bold;
            color: #666;
            font-size: 12px;
            margin-bottom: 5px;
        }
        .info-value {
            color: #333;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        thead {
            background: #8b5cf6;
            color: white;
        }
        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            font-size: 13px;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px;
        }
        tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-section {
            background: #f9fafb;
            padding: 20px;
            border: 2px solid #8b5cf6;
            margin-top: 20px;
        }
        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        .total-label {
            display: table-cell;
            text-align: right;
            padding-right: 20px;
            font-size: 14px;
            color: #666;
        }
        .total-value {
            display: table-cell;
            text-align: right;
            font-size: 14px;
            font-weight: bold;
            width: 150px;
        }
        .grand-total {
            border-top: 2px solid #8b5cf6;
            padding-top: 10px;
            margin-top: 10px;
        }
        .grand-total .total-label {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
        .grand-total .total-value {
            font-size: 22px;
            color: #8b5cf6;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .status-processing {
            background: #dbeafe;
            color: #1e40af;
        }
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="container">
        {{-- Header --}}
        <div class="header">
            <div class="header-left">
                <div class="company-name">Your Store</div>
                <div style="font-size: 12px; color: #666;">
                    123 Business Street<br>
                    City, State 12345<br>
                    Email: contact@yourstore.com<br>
                    Phone: (123) 456-7890
                </div>
            </div>
            <div class="header-right">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-details">
                    <strong>Invoice #:</strong> {{ $order->id }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}<br>
                    <strong>Status:</strong> 
                    <span class="status-badge status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Customer & Shipping Info --}}
        <div class="info-grid">
            <div class="info-column">
                <div class="info-label">BILL TO:</div>
                <div class="info-value">
                    <strong>{{ $order->user->name }}</strong><br>
                    {{ $order->user->email }}
                </div>
            </div>
            <div class="info-column">
                <div class="info-label">SHIP TO:</div>
                <div class="info-value">
                    <strong>{{ $order->address->full_name }}</strong><br>
                    {{ $order->address->address }}<br>
                    {{ $order->address->city }}, {{ $order->address->state }} {{ $order->address->zip_code }}<br>
                    Phone: {{ $order->address->phone }}
                </div>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="section">
            <div class="section-title">Order Items</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 50%;">Product</th>
                        <th class="text-center" style="width: 15%;">Quantity</th>
                        <th class="text-right" style="width: 17.5%;">Unit Price</th>
                        <th class="text-right" style="width: 17.5%;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>
                            <strong>{{ $item->product ? $item->product->name : 'Product Deleted' }}</strong>
                        </td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td class="text-right">Rs {{ number_format($item->price, 2) }}</td>
                        <td class="text-right">Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="total-section">
            <div class="total-row grand-total">
                <div class="total-label">TOTAL AMOUNT:</div>
                <div class="total-value">Rs {{ number_format($order->total_amount, 2) }}</div>
            </div>
        </div>

        {{-- Payment Info --}}
        @if($order->payment)
        <div class="section">
            <div class="section-title">Payment Information</div>
            <div style="background: #f9fafb; padding: 15px; border: 1px solid #e5e7eb;">
                <strong>Payment Method:</strong> {{ ucfirst($order->payment->payment_method) }}<br>
                <strong>Payment Status:</strong> {{ ucfirst($order->payment->payment_status) }}<br>
                <strong>Transaction ID:</strong> {{ $order->payment->transaction_id ?? 'N/A' }}
            </div>
        </div>
        @endif

        {{-- Footer --}}
        <div class="footer">
            <strong>Thank you for your business!</strong><br>
            For questions about this invoice, please contact us at contact@yourstore.com
        </div>
    </div>
</body>
</html>
