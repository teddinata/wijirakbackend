<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;

class CartController extends Controller
{
    public function cartAdd(Request $request, $id)
    {
        $item = Cart::where('products_id', $id)
                ->where('users_id', auth()->user()->id)
                ->first();
        if ($item) {
            $item->increment('quantity');
            $item = $item->first();

            // if (isset($item[$id])) {
            //     $item[$id]->increment('quantity');
            //     $item = $item->first();

            // sum price * quantity
            // $price = $item->first()->products->price * $item->first()->quantity;

        } else {
            Cart::create([
                'users_id'       => auth()->user()->id,
                'products_id'    => $id,
                'quantity'       => 1,
                // 'price'          => $item->product->price,
            ]);
        }

        // Cart::create([
        //     'users_id'      => auth()->user()->id,
        //     'products_id'   => $id,
        //     // 'quantity'      => 1,
        // ]);

        return redirect('cart');
    }

    public function decrementCart(Request $request, $id)
    {
        $item = Cart::where('products_id', $id)
                ->where('users_id', auth()->user()->id)
                ->first();
        if ($item) {
            $item->decrement('quantity');
            $item = $item->first();

            // if (isset($item[$id])) {
            //     $item[$id]->increment('quantity');
            //     $item = $item->first();

            // sum price * quantity
            // $price = $item->first()->products->price * $item->first()->quantity;

        } else {
            Cart::create([
                'users_id'       => auth()->user()->id,
                'products_id'    => $id,
                'quantity'       => 1,
                // 'price'          => $item->product->price,
            ]);
        }

        return redirect('cart');
    }

    public function update_cart(Request $request)
    {
        $cart = Cart::where('products_id', $request->id)
        ->where('users_id', auth()->user()->id)
        ->get();
        foreach ($cart as $item) {
            $item->quantity = $request->quantity[$item->id];
            $item->save();
        }
        return redirect('cart');
    }
    // {
    //     // if ($request->id && $request->quantity) {
    //     //     $cart = Cart::where('products_id', $request->id)
    //     //             ->where('users_id', auth()->user()->id)
    //     //             ->first();
    //     //     $cart->quantity = $request->quantity;
    //     //     $data = ['quantity' => $quantity];
    //     //     $cart->update($data);
    //     // }

    //     $this->validate($request, [ 'quantity' => 'required' ]); // 'value' => 'required', ]);
    //     $cart = Cart::where('products_id', $request->id)
    //             ->where('users_id', auth()->user()->id)
    //             ->update->quantity = $request->quantity;


    //     // $item = Cart::where('products_id', $request->id)
    //     //         ->where('users_id', auth()->user()->id)
    //     //         ->first();
    //     // $cart = [
    //     //     'quantity' => $request->quantity,
    //     // ];
    //     // $item->update($cart);



    //     // if ($request->id && $request->quantity) {
    //     //     $cart = Cart::where('products_id', $id)
    //     //             ->where('users_id', auth()->user()->id)
    //     //             ->first();
    //     //     $cart[$request->id]['quantity'] = $request->quantity;
    //     //     $cart->save();
    //     // }

    //     // $itemdetail = Cart::where('products_id', $request->id)
    //     //             ->where('users_id', auth()->user()->id)
    //     //             ->first();
    //     // $param = $request->param;

    //     // if ($param == 'tambah') {
    //     //     // update detail cart
    //     //     $qty = 1;
    //     //     $itemdetail->update([
    //     //         'quantity' => $quantity,
    //     //     ]);
    //     //     // update total cart
    //     //     $total = $itemdetail->quantity * $itemdetail->products->price;
    //     //     return back()->with('success', 'Item berhasil diupdate');
    //     // }

    //     return redirect('cart');
    // }

    public function cartDelete(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();

        return redirect('cart');
    }

    public function cart(Request $request)
    {
        $carts = Cart::with(['product.galleries'])
                ->where('users_id', auth()->user()->id)
                ->get();
        return view('pages.frontend.cart', [
            'carts' => $carts,
        ]);
    }

    public function cartHeader(Request $request)
    {
        $cartHeader = Cart::with(['product.galleries'])
                ->where('users_id', auth()->user()->id)->get();
        return view('includes.frontend.navbar-frontend', [
            'cartHeader' => $cartHeader,
        ]);
    }


}
