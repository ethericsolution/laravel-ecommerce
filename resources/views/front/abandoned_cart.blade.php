<!-- resources/views/front/abandoned_cart.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Abandoned Cart Reminder</title>
</head>
<body>
    <h2>Hello {{ $user->name ?? 'Customer' }},</h2>

    <p>We noticed you left some items in your cart but didn’t complete your purchase.</p>

    <p><a href="{{ url('/cart') }}">Return to Cart</a></p>

    <p>Thanks,<br>Our Shop</p>
</body>
</html>
