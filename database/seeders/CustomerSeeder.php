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
                'name' => 'John Doe',
                'phone' => '1234567890',
                'email' => 'john.doe@gmail.com',
                'note' => 'Regular customer',
                'address' => '123 Main St, Anytown USA',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Jane Doe',
                'phone' => '0987654321',
                'email' => 'jane.doe@gmail.com',
                'note' => 'Regular customer',
                'address' => '456 Oak Ave, Anytown USA',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Bob Smith',
                'phone' => '5551234567',
                'email' => 'bob.smith@gmail.com',
                'note' => 'VIP customer',
                'address' => '789 Maple Rd, Anytown USA',
                'customer_group_id'=> 2,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Samantha Johnson',
                'phone' => '5559876543',
                'email' => 'samantha.johnson@gmail.com',
                'note' => 'Regular customer',
                'address' => '321 Elm St, Anytown USA',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'David Lee',
                'phone' => '5555555555',
                'email' => 'david.lee@gmail.com',
                'note' => 'New customer',
                'address' => '567 Cherry Ln, Anytown USA',
                'customer_group_id'=> 3,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Alexandra Davis',
                'phone' => '5551112222',
                'email' => 'alexandra.davis@gmail.com',
                'note' => 'Regular customer',
                'address' => '234 Pine St, Anytown USA',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Michael Williams',
                'phone' => '5554443333',
                'email' => 'michael.williams@gmail.com',
                'note' => 'VIP customer',
                'address' => '890 Oakwood Dr, Anytown USA',
                'customer_group_id'=> 2,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'Emily Brown',
                'phone' => '5556667777',
                'email' => 'emily.brown@gmail.com',
                'note' => 'Regular customer',
                'address' => '456 Birch Ave, Anytown USA',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'SerenaWilliams',
                'phone' => '0765482935',
                'email' => 'serena.williams@gmail.com',
                'note' => 'Tennis player',
                'address' => 'Miami',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'LionelRitchie',
                'phone' => '0897437823',
                'email' => 'lionel.richie@gmail.com',
                'note' => 'Singer',
                'address' => 'Los Angeles',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'CristianoRonaldo',
                'phone' => '0645829301',
                'email' => 'cristiano.ronaldo@gmail.com',
                'note' => 'Footballer',
                'address' => 'Madrid',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'NaomiOsaka',
                'phone' => '0783928364',
                'email' => 'naomi.osaka@gmail.com',
                'note' => 'Tennis player',
                'address' => 'Tokyo',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
            [
                'name' => 'TomBrady',
                'phone' => '0675429185',
                'email' => 'tom.brady@gmail.com',
                'note' => 'American football player',
                'address' => 'Boston',
                'customer_group_id'=> 1,
                'created_at' => new \dateTime,
                'updated_at' => new \dateTime,
            ],
        ]);
    }
}
