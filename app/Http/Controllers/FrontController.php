<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class FrontController extends Controller
{
    public function index() {
        $products = Product::with('category')->orderBy('id', 'DESC')->take(6)->get();
        $categories = Category::all();

        return view('front.index', [
            'products' => $products,
            'categories' => $categories
        ]); 
    }

    public function detail(Product $product) {
        return view('front.detail', ['product' => $product]);
    }
}
