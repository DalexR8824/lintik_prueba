<?php

// app/Http/Controllers/OrderController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Listar todos los pedidos
        $orders = Order::all();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        // Validar los datos del pedido
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
        ]);

        // Crear el pedido
        $order = Order::create($validated);

        return response()->json($order, 201);
    }
}

