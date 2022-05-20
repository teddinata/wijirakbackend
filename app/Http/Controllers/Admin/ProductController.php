<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Cviebrock\EloquentSluggable\Sluggable;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Category;
use App\Http\Requests\ProductRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
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
    public function index()
    {
        $items = Product::with([
            'categories'
        ])->get();
        $categories = Category::all();

        return view ('pages.products.index')->with([
            'items' => $items,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view ('pages.products.create')->with([
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        $data['slug'] = SlugService::createSlug(Product::class, 'slug', $request->name);

        Product::create($data);
        return redirect()->route('products.index');
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
        $item = Product::findOrFail($id);
        $categories = Category::all();
         return view ('pages.products.edit')->with([
             'item' => $item,
             'categories' => $categories
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);
        $item->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        ProductGallery::where('products_id', $id)->delete();

        return redirect()->route('products.index');
    }

    public function gallery (Request $request, $id)
    {
        $product =Product::findOrFail($id);
        $items = ProductGallery::with('product')
            ->where('products_id', $id)
            ->get();

        return view ('pages.products.gallery')->with([
            'product' => $product,
            'items' => $items
        ]);
    }

    public function checkSlug (Request $request)
    {
        $slug = SlugService::createSlug(Product::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
