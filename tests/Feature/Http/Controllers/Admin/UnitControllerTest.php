<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\Feature\BaseTest;
use App\Models\User;
use Database\Seeders\UnitSeeder;
use Database\Seeders\UserSeeder;
use App\Models\Unit;

class UnitControllerTest extends BaseTest
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
        
        $response = $this->get(route('admin.units.index'));
        
        $response->assertStatus(200);
        
         $response->assertSee('<h1 class="m-0">Bảng Đơn Vị</h1>', false);
        
        
//         $response->assertSee('table-responsive');
//         $response->assertSee('table-responsive');
    }
    public function test_index_fail()
    {
        $response = $this->get(route('admin.units.index'));
        
        $response->assertStatus(302);
        
        $response->assertRedirect(route('login'));
        
    }
    public function test_create()
    {
        $this->be($this->user);
        
        $response = $this->get(route('admin.units.create'));
        
        $response->assertStatus(200);
        $response->assertSee(' <h1 class="m-0">Tạo Mới</h1>', false);
        
        
    }
    
    public function test_post_create_success()
    {
        $this->be($this->user);
        
        $response =  $this->post(route('admin.units.store'), [
            'unit_code'=>$this->faker->numerify('###'),
            'unit_name'=> $this->faker->name(120),
            
        ]);
        
        $response->assertSessionHasNoErrors();
        
        $response->assertStatus(302);
        
        $response->assertRedirect(route('admin.units.index'));
    }
    public function test_post_create_fail()
    {
        $this->be($this->user);
        
        $response =  $this->post(route('admin.units.store'), [
        ]);
        
        $response->assertStatus(302);
        
        $response->assertSessionHasErrors();
        
        
    }
    public function test_put_edit_success()
    {
        $unit = Unit::factory()->create();
        
        $this->be($this->user);
        
        $response =  $this->put(route('admin.units.edit.update', $unit->id), [
            'unit_code'=>$this->faker->numerify('###'),
            'unit_name'=> $this->faker->name(120),
        ]);
        $response->assertSessionHasNoErrors();
        
        $response->assertStatus(302);
        
        $response->assertRedirect(route('admin.units.index'));
    }
    
    public function test_put_edit_fail_if_empty()
    {
        $unit = Unit::factory()->create();
        $this->be($this->user);
        $response =  $this->put(route('admin.units.edit.update', $unit->id), []);
        
        $response->assertStatus(302);
        
        $response->assertSessionHasErrors();
    } 
   
    
}
