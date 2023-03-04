<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Supplier;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\BaseTest;
use Tests\TestCase;

class SupplierControllerTest extends BaseTest
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

        $response = $this->get(route('admin.suppliers.index'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Nhà cung cấp</h1>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.suppliers.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.suppliers.create'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Quản lý Nhà cung cấp</h1>', false);
    }

    public function test_post_create_success()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.suppliers.store'), [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->numerify('0##########'),
            'email' => $this->faker->unique()->safeEmail(),
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.suppliers.index'));
    }

    public function test_post_create_fail_if_empty_name()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.suppliers.store'), [
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }

    public function test_edit()
    {
        $supplier = Supplier::factory()->create();
        $this->be($this->user);

        $response = $this->get(route('admin.suppliers.edit', $supplier->id));

        $response->assertStatus(200);

        $response->assertSee('<li class="breadcrumb-item"><a href="#">Home</a></li>', false);
    }
    public function test_put_edit_success()
    {
        $supplier = Supplier::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.suppliers.edit.update', $supplier->id), [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->numerify('0##########'),
            'email' => $this->faker->unique()->safeEmail(),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.suppliers.index'));
    }
    public function test_put_edit_fail_if_empty()
    {
        $supplier = Supplier::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.suppliers.edit.update', $supplier->id), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
}
