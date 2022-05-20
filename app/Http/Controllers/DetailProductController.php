<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class DetailProductController extends Controller
{
    public function index(Request $request, $slug)
    {
        $products = Product::with(['galleries', 'categories'])
                        ->where('slug', $slug)
                        ->first();
        $recommendations = Product::with(['galleries', 'categories'])->inRandomOrder()->limit(4)->get();

        return view('pages.frontend.detail-product', [
            'products' => $products,
            'recommendations' => $recommendations,
        ]);
    }
}
