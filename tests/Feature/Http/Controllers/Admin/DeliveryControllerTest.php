<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Tests\Feature\BaseTest;


class DeliveryControllerTest extends BaseTest
{
    public function setUp(): void
    {
        parent::setUp();
        $this->seed(UserSeeder::class);
        $this->user = User::find(1);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_success()
    {
        $this->be($this->user);
        $response = $this->get(route('admin.deliveries.index'));
        $response->assertStatus(200);
        $response->assertSee('<h1>Quản Lý Thông Tin Vận Chuyển</h1>', false);

    }

    public function test_store_success()
    {
        $this->be($this->user);
        $response = $this->post(route('admin.deliveries.store'), [
            'province_id' => '1',
            'district_id' => '1',
            'ward_id' => '1',
            'fee' => 20000
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.deliveries.index'));
    }
}
