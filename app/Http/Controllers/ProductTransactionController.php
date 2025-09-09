<?php

namespace App\Http\Controllers;

use App\Models\Product_transaction;
use App\Http\Controllers\Controller;
use App\Models\ProductTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->HasRole('buyer')) {
            $product_transactions = $user->product_transactions()->orderBy('id', 'DESC')->get();
        } else {
            $product_transactions = ProductTransaction::orderBy('id', 'DESC')->get();
        }
        return view('admin/transaction/index', ['product_transactions' => $product_transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product_transaction $product_transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product_transaction $product_transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product_transaction $product_transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_transaction $product_transaction)
    {
        //
    }
}
