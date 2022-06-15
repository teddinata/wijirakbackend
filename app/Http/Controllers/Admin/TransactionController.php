<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Payments;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //data user model by id
        // $user = Auth::user();

        // transaction count
        $transaction = Transaction::all()->count();

        // show transaction
        $transaction_detail = TransactionDetail::with(['transaction.user',
                'product.galleries'])->get();
        // dd($transaction_detail);

        // count transactions sum price
        $total = Transaction::with(['transaction.user', 'product.galleries'])
                ->sum('total_price');
        // $payment = Payments::all();
        $data = Payments::where('transactions_id', $request->id)->get();


        // profile
        return view('pages.transactions.index', [
            // 'user' => $user,
            'transaction' => $transaction,
            'transaction_detail' => $transaction_detail,
            'total' => $total,
            'data' => $data,
            // 'payment' => $payment,
        ]);

        // $items = Transaction::all();

        // return view('pages.transactions.index')->with([
        //     'items' =>$items
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = TransactionDetail::with(['transaction.user','product.galleries'])
            ->findOrFail($id);
            // dd($item->product);

        return view ('pages.transactions.show', [
            'item' => $item
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Transaction::findOrFail($id);

        return view ('pages.transactions.edit')->with([
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Transaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);
        $item->delete();


        return redirect()->route('transactions.index');
    }

    public function setStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);

        $item = Transaction::findOrFail($id);
        // dd($item);
        $item->status = $request->status;

        $item->save();

        return redirect()->route('transactions.index');
    }
}
