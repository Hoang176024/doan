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
        $roleAdmin = Role::firstOrCreate(['name' => 'Owner']);
        $roleEditor = Role::firstOrCreate(['name' => 'Manager']);
        $roleSeller = Role::firstOrCreate(['name' => 'Seller']);
        $roleUser = Role::firstOrCreate(['name' => 'None']);
        $permissionNone = Permission::firstOrCreate(['name' => 'No permits']);


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
        $admin->givePermissionTo($permissionNone);

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
        $editor->givePermissionTo($permissionNone);

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
        $seller->givePermissionTo($permissionNone);

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

    }
}
