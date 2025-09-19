<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PurchasedProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Illuminate\Validation\ValidationException;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->HasRole('buyer')) {
            $invoices = $user->invoices()->orderBy('id', 'DESC')->get();
        } else {
            $invoices = Invoice::orderBy('id', 'DESC')->get();
        }
        return view('admin/transaction/index', ['invoices' => $invoices]);
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
        $user = Auth::user();
        // Save Invoice
        $validated = $request->validate([
            'address' => 'required|max:50|string',
            'city' => 'required|max:25|string',
            'post_code' => 'required|integer',
            'phone_number' => 'required|integer',
            'notes' => 'required|string|max:65535',
            'proof' => 'required|image|mimes:png,jpg,svg'
        ]);

        DB::beginTransaction();

        try {
            $subTotalCents = 0;
            $deliveryFeeCents = 10000 * 100;

            $cartItems = $user->carts;

            foreach ($cartItems as $item) {
                $subTotalCents += $item->product->price * 100;
            }

            // Hitungan bill
            $taxCents = (int)round(11 * $subTotalCents / 100);
            $insuranceCents = (int)round(23 * $subTotalCents / 100);
            $grandTotalCents = $subTotalCents + $taxCents + $insuranceCents + $deliveryFeeCents;

            $granTotal = $grandTotalCents / 100;

            $validated['user_id'] = $user->id;
            $validated['total_amount'] = $granTotal;
            $validated['is_paid'] = false;

            // Upload bukti pembayaran
            if ($request->hasFile('proof')) {
                $proof_payment_path = $request->file('proof')->store('proof_payment', 'public');
                $validated['proof'] = $proof_payment_path;
            }

            $newTransaction = Invoice::create($validated);

            //Save PurchasedProduct 
            foreach ($cartItems as $item) {
                $newTransaction->purchasedProducts()->create([
                    'product_id' => $item->product['id'],
                    'price' => $item->product['price'],
                    'quantity' => 1
                ]);

                // Hapus dari keranjang
                $item->delete();
            }
            DB::commit();

            return redirect()->route('order.index');
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
    public function show($id)
    {
        $invoice = Invoice::findorFail($id);
        // $invoice['total_amount'] = Number::format($invoice['total_amount']);
        // dd($invoice);
        return view('admin/transaction/detail', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        $invoice = Invoice::findorFail($id);
        $invoice->update([
            'is_paid' => true
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
