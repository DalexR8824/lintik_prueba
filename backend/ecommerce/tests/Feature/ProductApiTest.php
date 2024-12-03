<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;

class ProductApiTest extends TestCase
{
    use RefreshDatabase; // Esto garantiza que la base de datos se reinicie entre cada prueba

    /**
     * Test de creación de un producto (POST)
     *
     * @return void
     */
    public function test_can_create_product()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'price' => '100',
            'stock' => 10,
        ]);

        // Verifica que la respuesta tenga un estado 201 (Creado)
        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'name' => 'Test Product',
                     'price' => '100',
                     'stock' => 10,
                 ]);
    }

    /**
     * Test para obtener todos los productos (GET)
     *
     * @return void
     */
    public function test_can_get_all_products()
    {
        // Creamos productos manualmente sin fábricas
        Product::create([
            'name' => 'Product 1',
            'price' => 100,
            'stock' => 10,
        ]);

        Product::create([
            'name' => 'Product 2',
            'price' => 200,
            'stock' => 20,
        ]);

        $response = $this->getJson('/api/products');

        // Verifica que la respuesta tenga un estado 200 y contenga 2 productos
        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }

    /**
     * Test para obtener un solo producto (GET por ID)
     *
     * @return void
     */
    public function test_can_get_single_product()
    {
        // Creamos un producto manualmente
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 100,
            'stock' => 10
        ]);

        $response = $this->getJson("/api/products/{$product->id}");

        // Verifica que la respuesta tenga un estado 200 y contenga los datos del producto
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => 'Test Product',
                     'price' => '100.00',
                     'stock' => 10,
                 ]);
    }

    /**
     * Test de actualización de un producto (PUT)
     *
     * @return void
     */
    public function test_can_update_product()
    {
        // Creamos un producto manualmente
        $product = Product::create([
            'name' => 'Old Product',
            'price' => 50,
            'stock' => 5
        ]);

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Updated Product',
            'price' => 150,
            'stock' => 20,
        ]);

        // Verifica que la respuesta tenga un estado 200 y contenga los datos actualizados
        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'name' => 'Updated Product',
                     'price' => 150,
                     'stock' => 20,
                 ]);
    }

    /**
     * Test de eliminación de un producto (DELETE)
     *
     * @return void
     */
    public function test_can_delete_product()
    {
        // Creamos un producto manualmente
        $product = Product::create([
            'name' => 'Test Product to Delete',
            'price' => '200',
            'stock' => 50
        ]);

        $response = $this->deleteJson("/api/products/{$product->id}");

        // Verifica que la respuesta tenga un estado 200
        $response->assertStatus(204);

        // Verifica que el producto haya sido eliminado de la base de datos
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
