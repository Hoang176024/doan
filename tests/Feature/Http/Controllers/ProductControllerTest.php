<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\Feature\BaseTest;

class ProductControllerTest extends BaseTest
{
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->user = User::find(1);
    }
    public function tearDown():void
    {
        parent::tearDown();
        $this->user = null;
    }

    public function test_index_success()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);

        $response->assertSee('<h1>Quản Lý Thông Tin Sản Phẩm</h1>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.products.create'));

        $response->assertStatus(200);

        $response->assertSee('<h1>Thêm Mới Sản Phẩm</h1>', false);
    }

    public function test_post_create_success()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.products.store'), [
            'name' => $this->faker->text(10),
            'price_in' => $this->faker->numberBetween(2000, 10000),
            'price_out' => $this->faker->numberBetween(10000, 20000),
            'quantity' => $this->faker->numberBetween(20, 50),
            "quantity_alert" => $this->faker->numberBetween(10, 20),
            "supplier_id" => $this->faker->numberBetween(1, 10),
            'brand_id' => $this->faker->numberBetween(1, 10),
            'unit_id' => $this->faker->numberBetween(1, 10),
            'barcode' => $this->faker->numberBetween(1000000000000, 9999999999999),
            'category_id' => $this->faker->numberBetween(1, 20),
            'created_by' => $this->faker->numberBetween(1, 3),
            'description' => $this->faker->text(300),
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.products.index'));
    }

    public function test_post_create_fail_if_empty_name()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.products.store'), [
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }

    public function test_edit()
    {
        $product = Product::factory()->create();
        $this->be($this->user);

        $response = $this->get(route('admin.products.edit', $product->id));

        $response->assertStatus(200);

        $response->assertSee('<h1>Cập Nhật Sản Phẩm</h1>', false);
    }
    public function test_put_edit_success()
    {
        $product = Product::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.products.edit.update', $product->id), [
            'name' => $this->faker->text(10),
            'price_in' => $this->faker->numberBetween(2000, 10000),
            'price_out' => $this->faker->numberBetween(10000, 20000),
            'quantity' => $this->faker->numberBetween(20, 50),
            "quantity_alert" => $this->faker->numberBetween(10, 20),
            "supplier_id" => $this->faker->numberBetween(1, 10),
            'brand_id' => $this->faker->numberBetween(1, 10),
            'unit_id' => $this->faker->numberBetween(1, 10),
            'barcode' => $this->faker->numberBetween(1000000000000, 9999999999999),
            'category_id' => $this->faker->numberBetween(1, 20),
            'created_by' => $this->faker->numberBetween(1, 3),
            'description' => $this->faker->text(300),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.products.index'));
    }
    public function test_put_edit_fail_if_empty()
    {
        $product = Product::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.products.edit.update', $product->id), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
}
