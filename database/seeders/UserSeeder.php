<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::firstOrCreate(['name' => 'Quản Trị']);
        $roleEditor = Role::firstOrCreate(['name' => 'Quản Lý']);
        $roleSeller = Role::firstOrCreate(['name' => 'Nhân Viên']);
        $roleUser = Role::firstOrCreate(['name' => 'Người Dùng']);
        $permissionAll = Permission::firstOrCreate(['name' => 'Mọi Quyền']);
        $permissionProduct = Permission::firstOrCreate(['name' => 'Sản Phẩm']);
        $permissionPos = Permission::firstOrCreate(['name' => 'POS']);
        $permissionBrand = Permission::firstOrCreate(['name' => 'Thương Hiệu']);
        $permissionCategory = Permission::firstOrCreate(['name' => 'Danh Mục']);
        $permissionNone = Permission::firstOrCreate(['name' => 'Không Quyền']);


        DB::table('users')->truncate();
        $admin = User::create([
            'full_name' => 'Nguyễn Văn A',
            'email' => 'admin@sample.com',
            'birthday' => '1999-01-01',
            'address' => null,
            'avatar' => null,
            'phone' => null,
            'password' => Hash::make('admin-password'),
            'email_verification_code' => null,
            'email_verified_at' => new \dateTime,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        $admin->assignRole($roleAdmin);
        $admin->givePermissionTo($permissionAll);

        $editor = User::create([
            'full_name' => 'Nguyễn Văn B',
            'email' => 'editor@sample.com',
            'birthday' => '1999-01-01',
            'address' => null,
            'avatar' => null,
            'phone' => null,
            'password' => Hash::make('editor-password'),
            'email_verification_code' => null,
            'email_verified_at' => new \dateTime,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        $editor->assignRole($roleEditor);
        $editor->givePermissionTo('POS', 'Sản Phẩm', 'Thương Hiệu', 'Danh Mục');

        $seller = User::create([
            'full_name' => 'Nguyễn Văn C',
            'email' => 'seller@sample.com',
            'birthday' => '1999-01-01',
            'address' => null,
            'avatar' => null,
            'phone' => null,
            'password' => Hash::make('seller-password'),
            'email_verification_code' => null,
            'email_verified_at' => new \dateTime,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        $seller->assignRole($roleSeller);
        $seller->givePermissionTo('POS', 'Sản Phẩm');

        $user1 = User::create([
            'full_name' => 'Nguyễn Văn D',
            'email' => 'user@sample.com',
            'birthday' => '1999-01-01',
            'address' => null,
            'avatar' => null,
            'phone' => null,
            'password' => Hash::make('user-password'),
            'email_verification_code' => null,
            'email_verified_at' => new \dateTime,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        $user1->assignRole($roleUser);
        $user1->givePermissionTo($permissionNone);

        $user2 = User::create([
            'full_name' => 'Nguyễn Mạnh Tâm',
            'email' => 'posprojectcowellteam3@gmail.com',
            'birthday' => '1999-01-01',
            'address' => null,
            'avatar' => null,
            'phone' => null,
            'password' => Hash::make('123456'),
            'email_verification_code' => 'Ly3WfLol5KkYyHCtjQuy7CznS2gXeBI5bVJV1FH3',
            'email_verified_at' => '2021-09-04 07:17:19',
            'created_at' => '2021-09-04 07:16:44',
            'updated_at' => '2021-09-04 07:17:19',
        ]);
        $user2->assignRole($roleUser);
        $user2->givePermissionTo($permissionNone);

    }
}
