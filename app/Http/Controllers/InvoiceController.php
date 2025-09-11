<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::findorFail($id);
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
