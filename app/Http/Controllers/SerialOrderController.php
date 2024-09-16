<?php

namespace App\Http\Controllers;

use App\Models\SerialOrder;
use Illuminate\Http\Request;

class SerialOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $serialOrders = SerialOrder::with('customer', 'serialProduct')->get();
        return view('serial_orders.index', compact('serialOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('serial_orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|unique:tbl_serial_orders,order_id',
            'item_code' => 'required',
            'customer_id' => 'required|exists:tbl_customers,customer_id',
            'date' => 'required|date',
            // Add other validation rules as needed
        ]);

        SerialOrder::create($validatedData);

        return redirect()->route('serial-orders.index')->with('success', 'Serial Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SerialOrder $serialOrder)
    {
        return view('serial_orders.show', compact('serialOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SerialOrder $serialOrder)
    {
        return view('serial_orders.edit', compact('serialOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SerialOrder $serialOrder)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|unique:tbl_serial_orders,order_id,' . $serialOrder->id,
            'item_code' => 'required',
            'customer_id' => 'required|exists:tbl_customers,customer_id',
            'date' => 'required|date',
            // Add other validation rules as needed
        ]);

        $serialOrder->update($validatedData);

        return redirect()->route('serial-orders.index')->with('success', 'Serial Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SerialOrder $serialOrder)
    {
        $serialOrder->delete();

        return redirect()->route('serial-orders.index')->with('success', 'Serial Order deleted successfully.');
    }
}
