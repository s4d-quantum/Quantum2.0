<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier', 'imeiProduct')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        // Return a view to create a new purchase
    }

    public function store(Request $request)
    {
        // Validate and save a new purchase
    }

    public function show($id)
    {
        $purchase = Purchase::with('supplier', 'imeiProduct')->findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }

    public function edit($id)
    {
        // Return a view to edit an existing purchase
    }

    public function update(Request $request, $id)
    {
        // Validate and update an existing purchase
    }

    public function destroy($id)
    {
        // Delete an existing purchase
    }
}
