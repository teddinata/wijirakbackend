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
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function process(CheckoutRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::transaction(function () use ($validated) {
                $cartItems = Cart::with(['product'])
                    ->where('users_id', Auth::id())
                    ->get();

                $totalPrice = $cartItems->sum(function ($item) {
                    return $item->quantity * $item->product->price;
                });

                $ppn = 0.11 * $totalPrice;
                $totalPrice += $ppn;

                // Add to Transaction data
                $transaction  = Transaction::create([
                    'users_id' => Auth::id(),
                    'penerima' => $validated['penerima'],
                    'phone' => $validated['phone'],
                    'province' => $validated['province'],
                    'city' => $validated['city'],
                    'address' => $validated['address'],
                    'shipping_notes' => $validated['shipping_notes'] ?? null,
                    'postcode' => $validated['postcode'],
                    'total_price' => $totalPrice,
                    'status' => 'PENDING',
                    'code' => 'STORE-' . mt_rand(000,999),
                ]);

                // create transaction details
                foreach ($cartItems as $item) {
                    $trx = 'INV-' . mt_rand(000,999);

                    TransactionDetail::create([
                        'transactions_id' => $transaction->id,
                        'users_id' => Auth::id(),
                        'products_id' => $item->products_id,
                        'code' => $trx
                    ]);
                }

                //Delete cart Data
                Cart::where('users_id', Auth::id())->delete();
            });
        } catch (Exception $e) {
            throw $e;
        }

        return redirect()->route('success');
    }

    public function success(Request $request)
    {
        // $transaction = Transaction::findOrfail($id);
        // $transaction->save();
        return view('pages.frontend.success');
    }
}
