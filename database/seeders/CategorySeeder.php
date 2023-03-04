<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        Category::create([
            'name' => 'Bánh Kẹo',
            'parent_id' => 0,
            'description' => 'Bánh Kẹo',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Nước Giải Khát',
            'parent_id' => 0,
            'description' => 'Nước Giải Khát',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Nước Tăng Lực',
            'parent_id' => 2,
            'description' => 'Nước Tăng Lực',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Nước Ngọt',
            'parent_id' => 2,
            'description' => 'Nước Ngọt',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Bánh',
            'parent_id' => 1,
            'description' => 'Bánh',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Kẹo',
            'parent_id' => 2,
            'description' => 'Kẹo',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Đồ Điện Tử',
            'parent_id' => 0,
            'description' => 'Đồ Điện Tử',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Điện Thoại',
            'parent_id' => 7,
            'description' => 'Điện Thoại',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Máy Tính Bảng',
            'parent_id' => 7,
            'description' => 'Máy Tính Bảng',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Đồ Gia Dụng',
            'parent_id' => 0,
            'description' => 'Đồ Gia Dụng',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Nồi Cơm',
            'parent_id' => 10,
            'description' => 'Nồi Cơm',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Chảo Rán',
            'parent_id' => 10,
            'description' => 'Chảo Rán',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Gia Vị',
            'parent_id' => 0,
            'description' => 'Gia Vị',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Dầu Ăn',
            'parent_id' => 13,
            'description' => 'Dầu Ăn',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Category::create([
            'name' => 'Nước Chấm',
            'parent_id' => 13,
            'description' => 'Nước Chấm',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
    }
}
