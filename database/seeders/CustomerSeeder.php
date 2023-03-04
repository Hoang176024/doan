<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->truncate();
        DB::table('customers')->insert([
            [
                'name' => 'LeoMessi',
                'phone' => '0234748953',
                'email' => 'm10@gmail.com',
                'note' => 'Cầu thủ',
                'address' => 'Paris',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Ronaldo',
                'phone' => '0234744367',
                'email' => 'cr7@gmail.com',
                'note' => 'Cầu thủ',
                'address' => 'Manchester',
                'customer_group_id'=> 2,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Justin Bieber',
                'phone' => '0234745892',
                'email' => 'jb@gmail.com',
                'note' => 'Ca sĩ',
                'address' => 'Montreal',
                'customer_group_id'=> 3,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Bích Phương',
                'phone' => '0357248953',
                'email' => 'bphuong@gmail.com',
                'note' => 'Ca sĩ',
                'address' => 'Cần Thơ',
                'customer_group_id'=> 3,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Hòa Minzy',
                'phone' => '0357248953',
                'email' => 'mtp@gmail.com',
                'note' => 'Ca sĩ',
                'address' => 'Bắc Ninh',
                'customer_group_id'=> 3,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Tự Long',
                'phone' => '0326348953',
                'email' => 'tulong@gmail.com',
                'note' => 'Nghệ sĩ hài',
                'address' => 'Bắc Ninh',
                'customer_group_id'=> 6,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Sơn Tùng MTP',
                'phone' => '0357224753',
                'email' => 'mtp@gmail.com',
                'note' => 'Ca sĩ',
                'address' => 'VietNam',
                'customer_group_id'=> 5,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Công Phượng',
                'phone' => '0357248343',
                'email' => 'ncp@gmail.com',
                'note' => 'Cầu thủ',
                'address' => 'Việt Nam',
                'customer_group_id'=> 3,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Hồng Đăng',
                'phone' => '0537848953',
                'email' => 'dang@gmail.com',
                'note' => 'Diễn viên',
                'address' => 'Nam Định',
                'customer_group_id'=> 6,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Ngọc Trinh',
                'phone' => '0334148953',
                'email' => 'ngoctrinh@gmail.com',
                'note' => 'Người mẫu',
                'address' => 'Trà Vinh',
                'customer_group_id'=> 4,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Nguyễn Xuân Phúc',
                'phone' => '0357938953',
                'email' => 'nxp@gmail.com',
                'note' => 'Chủ tịch nước',
                'address' => 'Bình Định',
                'customer_group_id'=> 2,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
        ]);
    }
}
