<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
</head>

<body>
    <h1>Order Id:{{Session::get('order_id')}}</h1>
    <h1>Total Price:{{Session::get('totalPrice')}}</h1>
    <button><a href="/processPayment">Pay now</a></button>
</body>

</html>