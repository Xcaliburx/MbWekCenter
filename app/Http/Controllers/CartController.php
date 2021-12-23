<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Auth;
use DB;

class CartController extends Controller
{
    //
    public function add(Request $request, $id){
        $userId = Auth::user()->id;

        $product = Product::where('id', $id)->first();

        $request->validate([
            'quantity' => 'required|gte:1|lte:'.$product->stock
        ]);

        $qty = $request->input('quantity');

        $subTotal = $qty * $product->price;

        Cart::create([
            'userId' => $userId,
            'productId' => $id,
            'quantity' => $qty,
            'subTotal' => $subTotal
        ]);

        Product::where('id', $id)->update([
            'stock' => ($product->stock - $qty)
        ]);

        return redirect('/user/cart')->with('success', 'Insert Product to Cart Success');
    }

    public function view(){
        $userId = Auth::user()->id;

        $carts = DB::table('carts')
                 ->join('products', 'carts.productId', '=', 'products.id')
                 ->select('carts.id', 'products.title', 'products.price', 'carts.quantity', 'carts.subTotal')
                 ->where('carts.userId', $userId)
                 ->get();

        $grandTotal = 0;
        foreach($carts as $cart){
            $grandTotal += $cart->subTotal;
        }

        $data = [
            'carts' => $carts,
            'total' => $grandTotal
        ];

        return view('cart', $data);
    }

    public function delete($id){
        $cart = Cart::where('id', $id)->first();
        
        $product = Product::where('id', $cart->productId)->first();

        Product::where('id', $cart->productId)->update([
            'stock' => ($product->stock + $cart->quantity)
        ]);

        Cart::where('id', $id)->delete();

        return back()->with('success', 'Delete Product from Cart Success');
    }
}
