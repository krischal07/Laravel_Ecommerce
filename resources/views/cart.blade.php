@extends('layouts.master');
@section('content');
<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="container">



        <section class="cart container mt-2 my-3 py-5">
            <div class="container mt-2">
                <h4>Your Cart</h4>
            </div>

            <table class="pt-5">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php
                $totalPrice = 0;
                $subTotal = 0;
                ?>

                @if(Session::has('cart'))
                @foreach(Session::get('cart') as $product)
                @php
                $subTotal = $product['price'] * $product['quantity'];
                $totalPrice += $subTotal;
                @endphp
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="{{asset('img/'.$product['image'])}}" alt="Product Image">
                            <div>
                                <p>{{$product["name"]}}</p>
                                <small><span>$</span>{{$product['price']}}</small>
                                <br>
                                <form action="{{route('remove_from_cart') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product['id']}}">

                                    <input type="submit" name="remove_btn" class="remove-btn" value="remove">
                                </form>
                            </div>
                        </div>
                    </td>

                    <td>
                        <form action="{{route('edit_quantity')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product['id'] }}">
                            <input type="number" name="quantity" value="{{$product['quantity']}}">
                            <input type="submit" value="edit" class="edit-btn">
                        </form>
                    </td>




                    <td>
                        <span class="product-price">{{{$subTotal}}}</span>
                    </td>
                </tr>

                @endforeach
            </table>


            <div class="cart-total">
                <table>

                    <tr>
                        <td>Total</td>
                        @if(Session::has('totalPrice'))
                        <td>Rs {{Session::get('totalPrice')}}</td>
                        @endif
                    </tr>

                </table>
            </div>
            @endif


            <div class="checkout-container">

                <form action="{{route('checkout')}}" method="GET">
                    <input type="submit" class="btn checkout-btn" value="Checkout" name="">
                </form>


            </div>





        </section>



    </div>
</div>



@endsection('content');