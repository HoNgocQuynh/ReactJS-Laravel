<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartList()
    {
        $cartItems = \Cart::getContent();
        dd($cartItems);
        //return view('welcome', compact('cartItems'));
        return response()->json(['data' => $cartItems, 'status' =>200]);
    }


    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        \Cart::add([
            'id' => $product->id,
            'name' => $product->productName,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product->image,
            )
        ]);

        return response()->json(['status' => 200, 'message'=> 'Successfully Added Item']);
    }

    public function updateCart(Request $request)
    {
        \Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        \Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        \Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }
}
