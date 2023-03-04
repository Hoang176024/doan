<?php

namespace Database\Seeders;

use App\Models\CustomerGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_groups')->truncate();
        DB::table('customer_groups')->insert([
            [
                'name' => 'Bạc',
                'description'=> 'Điểm tiêu dùng > 1500',
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Vàng',
                'description'=> 'Điểm tiêu dùng > 1800',
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Bạch kim',
                'description'=> 'Điểm tiêu dùng > 2000',
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Premium',
                'description'=> 'Điểm tiêu dùng > 2000, đóng phí hội viên',
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'VIP',
                'description'=> 'Khách hàng nhiều đóng góp',
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Chuẩn',
                'description'=> 'Người tiêu dùng thông thường',
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
        ]);
    }
}
