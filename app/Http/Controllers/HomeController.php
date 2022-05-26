<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Category;


class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::all();
        $pilihan = Category::where('name', '=', 'Rak Barang')->first();
        $products = Product::with(['galleries'])->get();
        return view('pages.frontend.index')->with([
            'categories' => $categories,
            'pilihan' => $pilihan,
            'products' => $products,
        ]);
    }

    public function contact()
    {
        return view('pages.frontend.contact');
    }
}
