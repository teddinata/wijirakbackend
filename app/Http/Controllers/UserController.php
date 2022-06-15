<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\PaymentInformation;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //data user model by id
        $user = Auth::user();

        // transaction count
        $transaction = Transaction::where('users_id', $user->id)->count();

        // show transaction
        $transaction_detail = TransactionDetail::with(['transaction.user', 'product.galleries'])
                ->where('users_id', $user->id)->get();

        // count transactions sum price
        $total = Transaction::with(['transaction.user', 'product.galleries'])
                ->where('users_id', $user->id)->sum('total_price');

        // profile
        return view('pages.frontend.profile', [
            'user' => $user,
            'transaction' => $transaction,
            'transaction_detail' => $transaction_detail,
            'total' => $total,
        ]);
    }

    public function buktiBayar($id)
    {
        $user = Auth::user();
        $transaction = Transaction::findOrfail($id);

        return view('pages.frontend.bukti-bayar', [
            'id' => $id,
            'transaction' => $transaction,
        ]);
        // return view('pages.frontend.bukti-bayar');
    }

    public function storeBuktiBayar(Request $request, $id)
    {
        // return $request->all();
        $user = Auth::user();
        $this->validate($request, [
            'transactions_id' => 'integer|exists:transactions,id',
            'penerima' => 'required',
            'foto' => 'required',
            'bank_pengirim' => 'required',
            'nama_pengirim' => 'required',
            'rekening_pengirim' => 'required',
            'tanggal_transfer' => 'required',
            'total_transfer' => 'required',
        ]);
        $payment = Payments::create([
            'transactions_id' => $request->id,
            'penerima' => $request->penerima,
            'foto' => $request->foto,
            'bank_pengirim' => $request->bank_pengirim,
            'nama_pengirim' => $request->nama_pengirim,
            'rekening_pengirim' => $request->rekening_pengirim,
            'tanggal_transfer' => $request->tanggal_transfer,
            'total_transfer' => $request->total_transfer,
            // upload foto bukti-bayar
            'foto' => $request->file('foto')->store('bukti-bayar', 'public'),
            // $payment['foto'] = $request->file('foto')->store(
            //     'assets/product', 'public'
            // );
        ]);
        // if($request->hasFile('foto')) {
        //     $file = $request->file('foto');
        //     // get filename use date and user name
        //     $filename = date('YmdHis') . '-' . $user->first_name . '.' . $file->getClientOriginalExtension();
        //     // $filename = time() . '.' . $file->getClientOriginalName();
        //     $file->move('images/', $filename);
        //     $payment->foto = $filename;
        //     // $request->file('foto')->move('images/',$request->file('foto')->getClientOriginalName());
        //     // $foto = $request->file('foto')->getClientOriginalName();
        //     $payment->save();
        // }
        Alert::success('Bukti bayar berhasil dikirim!', 'Success');
        return redirect()->route('profile');
        // sweet alert

        // $payment = new PaymentInformation;
        // $payment->transactions_id = $id;
        // $payment->penerima = $request->penerima;
        // $payment->foto = $request->foto;
        // $payment->bank_pengirim = $request->bank_pengirim;
        // $payment->nama_pengirim = $request->nama_pengirim;
        // $payment->rekening_pengirim = $request->rekening_pengirim;
        // $payment->tanggal_transfer = $request->tanggal_transfer;
        // $payment->total_transfer = $request->total_transfer;
        // $payment->users_id = $user->id;
        // if($payment->hasFile('foto')){
        //     $file = $request->file('foto');
        //     $name = $file->getClientOriginalName();
        //     $file->move('images/', $name);
        //     $payment->foto = $name;
        // }
        // $payment->save();

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
