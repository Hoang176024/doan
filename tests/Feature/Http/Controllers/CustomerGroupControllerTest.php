<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\CustomerGroup;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\Feature\BaseTest;

class CustomerGroupControllerTest extends BaseTest
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

        $response = $this->get(route('admin.customerGroups.index'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Bảng nhóm khách hàng</h1>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.customerGroups.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.customerGroups.create'));

        $response->assertStatus(200);

        $response->assertSee('<h1>Tạo mới nhóm khách hàng</h1>', false);
    }

    public function test_post_create_success()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.customerGroups.store'), [
            'name' => $this->faker->text(10),
            'description' => $this->faker->text(10),
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.customerGroups.index'));
    }

    public function test_post_create_fail_if_empty_name()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.customerGroups.store'), [
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
    public function test_edit()
    {
        $cusG = CustomerGroup::factory()->create();
        $this->be($this->user);

        $response = $this->get(route('admin.customerGroups.edit', $cusG->id));

        $response->assertStatus(200);

        $response->assertSee('<h1>Sửa nhóm khách hàng</h1>', false);
    }
    public function test_put_edit_success()
    {
        $cusG = CustomerGroup::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.customerGroups.update', $cusG->id), [
            'name' => $this->faker->text(10),
            'description' => $this->faker->text(10),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.customerGroups.index'));
    }
    public function test_put_edit_fail_if_empty()
    {
        $cusG = CustomerGroup::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.customerGroups.update', $cusG->id), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
}
