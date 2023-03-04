<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Admin\Brand;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\Feature\BaseTest;

class BrandControllerTest extends BaseTest
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

        $response = $this->get(route('admin.brands.index'));

        $response->assertStatus(200);

        $response->assertSee('<h1 class="m-0">Bảng Thương hiệu</h1>', false);

    }

    public function test_index_fail()
    {
        $response = $this->get(route('admin.brands.index'));

        $response->assertStatus(302);

        $response->assertRedirect(route('login'));
    }

    public function test_create()
    {
        $this->be($this->user);

        $response = $this->get(route('admin.brands.create'));

        $response->assertStatus(200);

        $response->assertSee('<h1>Thêm thương hiệu</h1>', false);
    }

    public function test_post_create_success()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.brands.store'), [
            'name' => $this->faker->text(10),
        ]);

        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.brands.index'));
    }

    public function test_post_create_fail_if_empty_name()
    {
        $this->be($this->user);

        $response =  $this->post(route('admin.brands.store'), [
        ]);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }

    public function test_edit()
    {
        $brand = Brand::factory()->create();
        $this->be($this->user);

        $response = $this->get(route('admin.brands.edit', $brand->id));

        $response->assertStatus(200);

        $response->assertSee('<h1>Sửa thương hiệu</h1>', false);
    }
    public function test_put_edit_success()
    {
        $brand = Brand::factory()->create();

        $this->be($this->user);

        $response =  $this->put(route('admin.brands.update', $brand->id), [
            'name' => $this->faker->text(10),
        ]);
        $response->assertSessionHasNoErrors();

        $response->assertStatus(302);

        $response->assertRedirect(route('admin.brands.index'));
    }
    public function test_put_edit_fail_if_empty()
    {
        $brand = Brand::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.brands.update', $brand->id), []);

        $response->assertStatus(302);

        $response->assertSessionHasErrors();
    }
    
}
