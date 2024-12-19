<?php

namespace App\Http\Controllers;

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
    public function cart()
    {
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
}
