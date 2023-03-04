<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\BaseTest;
use Tests\TestCase;

class QuotationControllerTest extends BaseTest
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

        $response = $this->get(route('admin.quotations.index'));

        $response->assertStatus(200);

        $response->assertSee('<h3 class="card-title" style="margin-top: 5px;">Bảng giá Sản phẩm</h3>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.quotations.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_put_edit_success()
    {
        $product = Product::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.quotations.edit.update', $product->id), [
            'sale' => $this->faker->numberBetween(0,90),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(200);

        $response->assertJson(['success' => 'Data is successfully updated']);
    }

    // public function test_put_edit_fail_if_empty()
    // {
    //     $product = Product::factory()->create();
    //     $this->be($this->user);
    //     $response =  $this->put(route('admin.quotations.edit.update', $product->id), ['sale' => '']);

    //     $response->assertStatus(200);

    //     // $response->assertSessionHasErrors();
    //     // $response = $this->json('PUT', 'quotations/edit', [
    //     //     'sale' => $product->sale,
    //     // ]);
    //     $response->assertJsonValidationErrors('sale');
    // }
}
