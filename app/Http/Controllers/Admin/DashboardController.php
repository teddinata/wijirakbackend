<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    public function index()
    {
        $income = Transaction::where('status', 'SUCCESS')->sum('total_price');
        $sales = Transaction::count();
        $items = TransactionDetail::with('transaction.user','product')
                ->orderBy('id', 'DESC')->take(5)->get();
        $pie = [
            'pending' => Transaction::where('status', 'PENDING')->count(),
            'failed' => Transaction::where('status', 'FAILED')->count(),
            'success' => Transaction::where('status', 'SUCCESS')->count()
        ];

        return view ('pages.admin.dashboard')->with([
            'income' => $income,
            'sales' => $sales,
            'items' => $items,
            'pie' => $pie
        ]);
    }
}
