<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
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
            'name' => 'Телевизор',
            'category_id' => $this->categories[1]->id,
            'price' => 50000.00
        ]);

        $this->order = Order::create([
            'customer_name' => 'Иван Иванов',
            'product_id' => $this->product->id,
            'quantity' => 2
        ]);
    }

    public function test_index()
    {
        $response = $this->get('/orders');
        $response->assertStatus(200)
            ->assertViewHas('orders');
    }

    public function test_create()
    {
        $response = $this->get('/orders/create');
        $response->assertStatus(200)
            ->assertViewHas('products');
    }

    public function test_store()
    {
        $response = $this->post('/orders', [
            'customer_name' => 'Петр Петров',
            'product_id' => $this->product->id,
            'quantity' => 1,
            'comment' => 'Тестовый заказ'
        ]);

        $response->assertRedirect('/orders');
        $this->assertDatabaseHas('orders', ['customer_name' => 'Петр Петров']);
    }

    public function test_show()
    {
        $response = $this->get("/orders/{$this->order->id}");
        $response->assertStatus(200)
            ->assertViewHas('order');
    }

    public function test_complete()
    {
        $response = $this->patch("/orders/{$this->order->id}/complete");
        $response->assertRedirect();
        $this->assertEquals('completed', $this->order->fresh()->status);
    }
}
