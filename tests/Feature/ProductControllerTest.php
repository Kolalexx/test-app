<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->categories = [
            Category::create(['name' => 'легкий']),
            Category::create(['name' => 'хрупкий']),
            Category::create(['name' => 'тяжелый'])
        ];

        $this->product = Product::create([
            'name' => 'Тестовый товар',
            'category_id' => $this->categories[0]->id,
            'price' => 1000.50,
            'description' => 'Тестовое описание'
        ]);
    }

    public function test_index()
    {
        $response = $this->get('/products');
        $response->assertStatus(200)
            ->assertViewHas('products');
    }

    public function test_create()
    {
        $response = $this->get('/products/create');
        $response->assertStatus(200)
            ->assertViewHas('categories');
    }

    public function test_store()
    {
        $response = $this->post('/products', [
            'name' => 'Новый товар',
            'category_id' => $this->categories[1]->id,
            'price' => 2000.75,
            'description' => 'Описание нового товара'
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Новый товар']);
    }

    public function test_show()
    {
        $response = $this->get("/products/{$this->product->id}");
        $response->assertStatus(200)
            ->assertViewHas('product');
    }

    public function test_edit()
    {
        $response = $this->get("/products/{$this->product->id}/edit");
        $response->assertStatus(200)
            ->assertViewHas(['product', 'categories']);
    }

    public function test_update()
    {
        $response = $this->put("/products/{$this->product->id}", [
            'name' => 'Обновленный товар',
            'category_id' => $this->categories[2]->id,
            'price' => 1500.25,
            'description' => 'Новое описание'
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Обновленный товар']);
    }

    public function test_destroy()
    {
        $response = $this->delete("/products/{$this->product->id}");
        $response->assertRedirect('/products');
        $this->assertDatabaseMissing('products', ['id' => $this->product->id]);
    }
}
