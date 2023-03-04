<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Feature\BaseTest;

class CategoryControllerTest extends BaseTest
{
    public function setUp():void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->user = User::find(1);
        
    }
    public function test_index_success()
    {
        $this->be($this->user);
        
        $response = $this->get(route('admin.categories.index'));
        
        $response->assertStatus(200);
        
        $response->assertSee(' <h3 class="card-title">Thông Tin Danh Mục</h3>', false);
        
        
    }
    public function test_index_fail()
    {
        $response = $this->get(route('admin.categories.index'));
        
        $response->assertStatus(302);
        
        $response->assertRedirect(route('login'));
        
    }
    public function test_create()
    {
        $this->be($this->user);
        
        $response = $this->get(route('admin.categories.create'));
        
        $response->assertStatus(200);
        $response->assertSee(' <h1>Thêm Mới Danh Mục</h1>', false);
        
        
    }
    
    public function test_post_create_success()
    {
        $this->be($this->user);
        
        $response =  $this->post(route('admin.categories.store'), [
            'name' => $this->faker->text(120),
            'parent_id'=>$this->faker->numberBetween(1,10),
            'description' => $this->faker->text(500)
            
        ]);
        
        $response->assertSessionHasNoErrors();
        
        $response->assertStatus(302);
        
        $response->assertRedirect(route('admin.categories.index'));
    }
    public function test_post_create_fail()
    {
        $this->be($this->user);
        
        $response =  $this->post(route('admin.categories.store'), [
        ]);
        
        $response->assertStatus(302);
        
        $response->assertSessionHasErrors();
        
        
    }
}
