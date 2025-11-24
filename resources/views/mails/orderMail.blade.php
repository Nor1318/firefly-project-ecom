<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>

<body>
    <h2>Order Confirmation</h2>

    <p>Hi {{ $order->user->name }},</p>
    <p>Thank you for your order!</p>

    <h3>Order Details</h3>
    <p><strong>Order Number:</strong> #{{$order->id}}</p>
    <p><strong>Order Date:</strong> {{$order->created_at->format('F d, Y')}}</p>

    <h4>Items:</h4>
    @if($order->orderItems && count($order->orderItems) > 0)
    @foreach($order->orderItems as $item)
    <p>Rs {{$item->amount_per_item * $item->quantity}}</p>
    @endforeach
    @else
    <p>No items found</p>
    @endif

    <p><strong>Total:Rs {{$order->orderItems->sum(function($item) {return $item->amount_per_item * $item->quantity;}) }}</strong></p>

    <p>Thank you!</p>
</body>

</html>