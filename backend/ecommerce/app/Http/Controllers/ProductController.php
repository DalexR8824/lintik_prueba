<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Listar todos los productos
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        // Validar los datos del producto
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        // Crear el producto
        $product = Product::create($validated);

        return response()->json($product, 201);
    }
}

