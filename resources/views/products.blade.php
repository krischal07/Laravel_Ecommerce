    <!-- Nav End -->

    @extends('layouts.master');




    <!-- Products Start -->
    @section('content')
    <div id="products">
        <div class="container">
            <div class="section-header">
                <h2>Get Your Products</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra at massa sit amet ultricies
                </p>
            </div>
            <div class="row align-items-center">
                @foreach($products as $product)
                <div class="col-md-3">
                    <div class="product-single">
                        <div class="product-img">
                            <img src="img/product-1.png" alt="Product Image">
                        </div>
                        <div class="product-content">
                            <h2>{{$product->name}}</h2>
                            <h3>{{$product->price}}</h3>
                            <a class="btn" href="#">Buy Now</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
    @endsection('content')