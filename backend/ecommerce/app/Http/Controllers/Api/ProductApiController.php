<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{

    // Listar todos los productos
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    // Crear un nuevo producto
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    // Mostrar un producto específico
    public function show(Product $product)
    {
        return response()->json($product, 200);
    }

    // Actualizar un producto
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product->update($validatedData);
        return response()->json($product, 200);
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
