<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Admin\Tax;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\Feature\BaseTest;

class TaxControllerTest extends BaseTest
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

        $response = $this->get(route('admin.taxes.index'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Bảng thuế</h1>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.taxes.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.taxes.create'));

        $response->assertStatus(200);

        $response->assertSee('<h1>Create Tax</h1>', false);
    }

    public function test_post_create_success()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.taxes.store'), [
            'name' => $this->faker->text(10),
            'rate' => $this->faker->numberBetween(0, 100),
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.taxes.index'));
    }

    public function test_post_create_fail_if_empty_name()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.taxes.store'), [
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
    public function test_edit()
    {
        $tax = Tax::factory()->create();
        $this->be($this->user);

        $response = $this->get(route('admin.taxes.edit', $tax->id));

        $response->assertStatus(200);

        $response->assertSee('<h1>Sửa thuế</h1>', false);
    }
    public function test_put_edit_success()
    {
        $tax = Tax::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.taxes.update', $tax->id), [
            'name' => $this->faker->text(10),
            'rate' => $this->faker->numberBetween(0, 100),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.taxes.index'));
    }
    public function test_put_edit_fail_if_empty()
    {
        $tax = Tax::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.taxes.update', $tax->id), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
}
