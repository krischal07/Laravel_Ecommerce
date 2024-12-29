<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Products;
use Illuminate\Http\Request;

use function Laravel\Prompts\alert;

class FrontEndController extends Controller
{
    //
    public function index()
    {
        $products = Products::all();
        return view('index', ['products' => $products]);
    }

    public function about()
    {
        return view('about');
    }

    public function products()
    {
        $products = Products::all();
        return view('products', ['products' => $products]);
    }

    public function single_product($id)
    {
        $products = Products::find($id);
        return view('single_product', ['products' => $products]);
    }
    public function checkout()
    {
        return view('checkout');
    }
    public function cart(Request $request)
    {
        $this->calculateTotal($request);
        return view('cart');
    }
    public function add_to_cart(Request $request)
    {
        // dd('Here');
        // dd($request->all());

        // if session exist
        if ($request->session()->has('cart')) {

            $cart = $request->session()->get('cart');
            $product_ids = array_column($cart, 'id');

            if (!in_array($request->id, $product_ids)) {

                $id = $request->id;
                $name = $request->name;
                $image = $request->image;
                $quantity = $request->quantity;
                ($request->sale_price != null) ? $price = $request->sale_price : $price = $request->price;

                $product_array = array(
                    'id' => $id,
                    'name' => $name,
                    'image' => $image,
                    'quantity' => $quantity,
                    'price' => $price,
                    // 'log' => 'this',
                );
                $cart[$request->id] = $product_array;
                $request->session()->put('cart', $cart);

                if ($request->session()->has('cart')) {

                    $this->calculateTotal($request);
                }

                return view('cart');
            } else {
                return redirect()->back()->withErrors(['message' => "Product already added to cart"]);
            }
        }
        // if session doesnt exist
        else {
            $id = $request->id;
            $name = $request->name;
            $image = $request->image;
            $quantity = $request->quantity;
            ($request->sale_price != null) ? $price = $request->sale_price : $price = $request->price;

            $product_array = array(
                'id' => $id,
                'name' => $name,
                'image' => $image,
                'quantity' => $quantity,
                'price' => $price,
                // 'log' => 'this',
            );
            // dd($product_array);
            $cart[$request->id] = $product_array;
            $request->session()->put('cart', $cart);

            return view('cart');
        }
    }
    public function calculateTotal($request)
    {
        $cart = $request->session()->get('cart');
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        // return $totalPrice;
        $request->session()->put('totalPrice', $totalPrice);
    }

    public function remove_from_cart(Request $request)
    {
        $cart = $request->session()->get('cart');
        $id_to_delete = $request->id;
        unset($cart[$id_to_delete]);
        $request->session()->put('cart', $cart);
        // return view('cart');
        return redirect('/cart')->withErrors(['message' => "Product removed"]);;
        // dd($cart);

        // dd($id_to_delete);
        // echo "here";
    }

    public function edit_quantity(Request $request)
    {
        // $subtotal = $request->
        // $cart = $request->session()->get('cart');
        // dd($cart);
        // dd($request->all());

        // echo ($request->quantity);

        $cart = $request->session()->get('cart');
        foreach ($cart as $c) {

            $subtotal = $request->quantity * $c['price'];
            // dd($c);
            echo ($request->quantity) . "</br>";
            echo ("price" . $c['price']) . "</br>";
            echo ($subtotal) . "</br>";
            // echo ("price" . $c['price']);

            // echo ($subtotal);
            // array_dump($c);
        }


        // echo ($subtotal);
        // dd($cart);

        // echo ($request->total);
    }

    public function place_order(Request $request)
    {
        // dd($request->all());
        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->city = $request->city;
        $order->cost = $request->session()->get('totalPrice');
        $order->status = "not paid";
        $order->date = date('y-m-d');
        $order->save();

        $cart = $request->session()->get('cart');
        foreach ($cart as $item) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_name = $item['name'];
            $order_item->product_id = $item['id'];
            $order_item->product_price = $item['price'];
            $order_item->product_quantity = $item['quantity'];
            $order_item->product_image = $item['image'];
            $order_item->order_date = date("y-m-d");

            $order_item->save();
        }
        $request->session()->put('order_id', $order->id);
        return view('payment');
    }
}
