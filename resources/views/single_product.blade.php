@extends('layouts.master')
@section('content')

<!-- Products Start -->
<div id="products">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                @foreach($errors->all() as $error)
                <h2>{{$error}}</h2>
                @endforeach
                <div class="product-single">
                    <div class="product-img">
                        <img src="{{asset('img/'.$products->image)}}" alt="Product Image">
                    </div>
                    <div class="product-content">
                        <h2>{{$products->name}}</h2>
                        <h3>{{$products->price}}</h3>
                        <!-- <a class="btn" href="#">Buy Now</a> -->
                    </div>
                    <form action="{{route('add_to_cart')}}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$products->id}}" />
                        <input type="hidden" name="name" value="{{$products->name}}" />
                        <input type="hidden" name="price" value="{{$products->price}}" />
                        <input type="hidden" name="sale_price" value="{{$products->sale_price}}" />
                        <input type="hidden" name="image" value="{{$products->image}}" />
                        <input type="hidden" name="quantity" value="1" />
                        <input type="submit" value="Add to cart" class="btn" />
                    </form>
                </div>
            </div>

        </div>

    </div>
</div>


@endsection