<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
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
        // $income = Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total');
        $sales = Transaction::count();
        $items = Transaction::orderBy('id', 'DESC')->take(5)->get();
        // $pie = [
        //     'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
        //     'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
        //     'success' => Transaction::where('transaction_status', 'SUCCESS')->count()
        // ];

        return view ('pages.admin.dashboard')->with([
            // 'income' => $income,
            'sales' => $sales,
            'items' => $items,
            // 'pie' => $pie
        ]);
    }
}
