<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionHeader;
use App\Models\TransactionDetail;
use App\Models\Cart;
use Auth;
use Carbon\Carbon;
use DB;

class TransactionController extends Controller
{
    //
    public function checkout(){
        $userId = Auth::user()->id;

        $carts = Cart::where('userId', $userId)->get();

        if(count($carts) == 0){
            return back()->with('failed', 'Add Item to cart first');
        }
        else{
            $header = TransactionHeader::create([
                'userId' => $userId,
                'dateOrder' => Carbon::now()
            ]);
    
            foreach($carts as $cart){
                TransactionDetail::create([
                    'transactionHeaderId' => $header->id,
                    'productId' => $cart->productId,
                    'quantity' => $cart->quantity,
                    'subTotal' => $cart->subTotal
                ]);
            }
    
            Cart::where('userId', $userId)->delete();
    
            return redirect('/user/transaction')->with('success', 'Success Checkout');
        }
    }

    public function view(){
        $userId = Auth::user()->id;

        $transactions = TransactionHeader::where('userId', $userId)->get();

        return view('transaction.header', ['transactions' => $transactions]);
    }

    public function detail($id){
        $transactions = DB::table('transaction_details')
        ->join('products', 'transaction_details.productId', '=', 'products.id')
        ->where('transaction_details.transactionHeaderId', $id)
        ->get();

        $grandTotal = 0;
        foreach($transactions as $transaction){
            $grandTotal += $transaction->subTotal;
        }

        $data = [
            'transactions' => $transactions,
            'total' => $grandTotal
        ];

        return view('transaction.detail', $data);
    }
}
