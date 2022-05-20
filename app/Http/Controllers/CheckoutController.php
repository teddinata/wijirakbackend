<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use App\Http\Requests\CheckoutRequest;

use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $item = Cart::with(['product'])
                ->where('users_id', auth()->user()->id)
                ->get();
        return view('pages.frontend.checkout', [
            'item' => $item,
        ]);

    }

    public function process(CheckoutRequest $request, $id)
    {
        $data = $request->all();

        // dd($data);

        $cart = Cart::with(['product'])
                ->where('users_id', auth()->user()->id)->get();

        // Add to Transaction data
        $data['users_id'] = Auth::user()->id;
        $data['total_price'] = $cart->sum('product.price');
        $data['travel_transactions_id'] = $id;

        $code = 'STORE-' . mt_rand(000,999);

        //  Transaction Create
        // $transaction = Transaction::create($data);
        $transaction  = Transaction::create([
            'users_id' => Auth::user()->id,
            'total_price' => $cart->product->price  * $cart['quantity'],
            'status' => 'PENDING',
            'code' => $code,
        ]);

        // create transaction details
        foreach ($cart as $cart) {
            $trx = 'INV-' . mt_rand(000,999);
            $items[] = TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'users_id' => $cart->users_id,
                'products_id' => $cart->products_id,
                'code' => $trx
        ]);
        }

        //Delete cart Data
        Cart::where('users_id', Auth::user()->id)->delete();

        // save transaction
        $transaction->save();
        dd($transaction);

        return redirect()->route('success', $id);

    }

    public function success(Request $request, $id)
    {
        $transaction = Transaction::findOrfail($id);
        $transaction->save();
        return view('pages.frontend.success');
    }
}
