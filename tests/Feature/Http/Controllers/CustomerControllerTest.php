<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\BaseTest;
use Tests\TestCase;

class CustomerControllerTest extends BaseTest
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

        $response = $this->get(route('admin.customers.index'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Khách Hàng</h1>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.customers.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.customers.create'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Quản lý Khách hàng</h1>', false);
    }

    public function test_post_create_success()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.customers.store'), [
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('0##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'note' => $this->faker->text(200),
            'address' => $this->faker->address(),
            'customer_group_id'=>$this->faker->numberBetween(1,6),
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.customers.index'));
    }

    public function test_post_create_fail_if_empty_name()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.customers.store'), [
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }

    public function test_edit()
    {
        $customer = Customer::factory()->create();
        $this->be($this->user);

        $response = $this->get(route('admin.customers.edit', $customer->id));

        $response->assertStatus(200);

        $response->assertSee('<label for="customer_group_id" class="col-sm-2 col-form-label">Nhóm KH</label>', false);
    }
    public function test_put_edit_success()
    {
        $customer = Customer::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.customers.edit.update', $customer->id), [
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('0##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'note' => $this->faker->text(200),
            'address' => $this->faker->address(),
            'customer_group_id'=>$this->faker->numberBetween(1,6),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.customers.index'));
    }
    public function test_put_edit_fail_if_empty()
    {
        $customer = Customer::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.customers.edit.update', $customer->id), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }

    public function test_delete_success()
    {
        $customer = Customer::factory()->create();

        $this->be($this->user);

        $response = $this->delete(route('admin.customers.delete', $customer->id));

        $response->assertStatus(405);   

        $response->assertRedirect(route('admin.customers.index'));
    }
}
