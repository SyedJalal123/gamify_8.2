<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'      => 'Admin',
                'email'     => 'admin@admin.com',
                'password'  => bcrypt('admin123'),
                'role'      => 'admin'
            ],
            [
                'name'      => 'Vendor',
                'email'     => 'vendor@vendor.com',
                'password'  => bcrypt('vendor123'),
                'role'      => 'vendor'
            ],
            [
                'name'      => 'Customer',
                'email'     => 'customer@customer.com',
                'password'  => bcrypt('customer123'),
                'role'      => 'customer'
            ],
        ]);
    }
}
