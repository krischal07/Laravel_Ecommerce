<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="nav">
        <div class="container-fluid">
            <div id="logo" class="pull-left">
                <a href="index.html"><img src="img/logo.png" alt="Logo" /></a>
            </div>

            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="./">Home</a></li>
                    <li><a href="{{ url('/products') }}">Products</a></li>
                    <li><a href="{{url('/about')}}">About</a></li>
                    <li><a href="#testimonials">Reviews</a></li>
                    <li><a href="{{url('/cart')}}">Cart</a></li>

                </ul>
            </nav>
        </div>
    </div>
</body>

</html>