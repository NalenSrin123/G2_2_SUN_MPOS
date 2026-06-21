<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Get all orders
    public function index()
    {
        $orders = Order::with('table')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Orders retrieved successfully',
            'data' => $orders
        ]);
    }

    // Get single order
    public function show($id)
    {
        $order = Order::with('table', 'orderItems')->findOrFail($id);

        return response()->json([
            'status' => 200,
            'message' => 'Order retrieved successfully',
            'data' => $order
        ]);
    }

    // Create order
    public function store(Request $request)
    {
        $data = $request->validate([
            'table_number' => 'required|integer',
            'total_price' => 'required|numeric',
            't_id' => 'required|exists:table_name,t_id'
        ]);

        $order = Order::create($data);

        return response()->json([
            'status' => 201,
            'message' => 'Order created successfully',
            'data' => $order
        ]);
    }

    // Update order
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $data = $request->validate([
            'table_number' => 'required|integer',
            'total_price' => 'required|numeric',
            't_id' => 'required|exists:table_name,t_id'
        ]);

        $order->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Order updated successfully',
            'data' => $order
        ]);
    }

    // Delete order
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Order deleted successfully',
            'data' => null
        ]);
    }
}
