<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use App\Models\Cart;
use Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    //
    public function checkout(){
        $userId = Auth::user()->id;

        $header = TransactionHeader::create([
            'userId' => $userId,
            'dateOrder' => Carbon::now()
        ]);

        $carts = Cart::where('userId', $userId)->get();

        foreach($carts as $cart){
            TransactionDetail::create([
                'transactionHeaderId' => $header->id,
                'productId' => $cart->productId,
                'quantity' => $cart->quantity,
                'subTotal' => $cart->subTotal
            ]);
        }

        Cart::where('userId', $userId)->delete();

        return back()->with('success', 'Success Checkout');
    }
}
