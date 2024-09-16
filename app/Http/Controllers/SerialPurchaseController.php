<?php

namespace App\Http\Controllers;

use App\Models\SerialPurchase;
use Illuminate\Http\Request;

class SerialPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serialPurchases = SerialPurchase::with('supplier', 'serialProduct')->get();
        return view('serial_purchases.index', compact('serialPurchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('serial_purchases.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'purchase_id' => 'required|unique:tbl_serial_purchases,purchase_id',
            'item_code' => 'required',
            'date' => 'required|date',
            'supplier_id' => 'required|exists:tbl_suppliers,supplier_id',
            // Add other validation rules as needed
        ]);

        SerialPurchase::create($validatedData);

        return redirect()->route('serial-purchases.index')->with('success', 'Serial Purchase created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SerialPurchase $serialPurchase)
    {
        return view('serial_purchases.show', compact('serialPurchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SerialPurchase $serialPurchase)
    {
        return view('serial_purchases.edit', compact('serialPurchase'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SerialPurchase $serialPurchase)
    {
        $validatedData = $request->validate([
            'purchase_id' => 'required|unique:tbl_serial_purchases,purchase_id,' . $serialPurchase->id,
            'item_code' => 'required',
            'date' => 'required|date',
            'supplier_id' => 'required|exists:tbl_suppliers,supplier_id',
            // Add other validation rules as needed
        ]);

        $serialPurchase->update($validatedData);

        return redirect()->route('serial-purchases.index')->with('success', 'Serial Purchase updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SerialPurchase $serialPurchase)
    {
        $serialPurchase->delete();

        return redirect()->route('serial-purchases.index')->with('success', 'Serial Purchase deleted successfully.');
    }
}
