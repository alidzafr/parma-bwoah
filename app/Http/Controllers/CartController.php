<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $myCart = $user->cart()->with('product')->get();
        
        return view('front.cart', ['myCart' => $myCart]);
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

    public function store($productid)
    {
        $user = Auth::user();

        $existingCartItem = Cart::where('user_id', $user)->where('product_id', $productid)->first();

        if ($existingCartItem) {
            return redirect()->route('cart.index');
        }

        DB::beginTransaction();

        try {
            $cart = Cart::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $productid
            ]);

            $cart->save();
            DB::commit();

            return redirect()->route('cart.index');
        } catch (\Exception $e) {
            DB::rollBack();

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::findorFail($id);

        try {
            $cart->delete();
            return redirect()->route('cart.index');
        } catch (\Exception $e) {
            DB::rollBack();

            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()],
            ]);
            throw $error;
        }
    }
}
