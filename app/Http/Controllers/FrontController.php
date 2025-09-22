<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();

        return view('front.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function detail(Product $product)
    {
        return view('front.detail', ['product' => $product]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();

        // dd($products);
        return view('front.search', [
            'products' => $products,
            'keyword' => $keyword
        ]);
    }

    public function findCategory(Category $category)
    {
        $categoryId = $category->id;
        $products = Product::where('category_id', $categoryId)->with('category')->get();

        return view('front.category', [
            'products' => $products,
            'category' => $category->name
        ]);
    }
}
