<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
    // Listar todas las órdenes
    public function index()
    {
        $orders = Order::with('products')->get();
        return response()->json($orders, 200);
    }

    // Crear una nueva orden
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'customer_name' => $validatedData['customer_name'],
            'customer_email' => $validatedData['customer_email'],
        ]);

        // Asociar productos a la orden
        foreach ($validatedData['products'] as $product) {
            $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        return response()->json($order->load('products'), 201);
    }

    // Mostrar una orden específica
    public function show(Order $order)
    {
        return response()->json($order->load('products'), 200);
    }

    // Actualizar una orden
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'customer_name' => 'sometimes|required|string|max:255',
            'customer_email' => 'sometimes|required|email',
            'products' => 'sometimes|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order->update([
            'customer_name' => $validatedData['customer_name'] ?? $order->customer_name,
            'customer_email' => $validatedData['customer_email'] ?? $order->customer_email,
        ]);

        if (isset($validatedData['products'])) {
            $order->products()->detach();
            foreach ($validatedData['products'] as $product) {
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }
        }

        return response()->json($order->load('products'), 200);
    }

    // Eliminar una orden
    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();
        return response()->json(null, 204);
    }
}
