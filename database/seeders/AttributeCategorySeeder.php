<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attribute_category')->insert([

            ['attribute_id' => 4, 'category_id' => 1], // Delivery Speed -> Currency
            ['attribute_id' => 4, 'category_id' => 2], // Delivery Speed -> Accounts
            ['attribute_id' => 4, 'category_id' => 4], // Delivery Speed -> Items
            ['attribute_id' => 4, 'category_id' => 5], // Delivery Speed -> Boosting

            ['attribute_id' => 5, 'category_id' => 1], // Warranty Period -> Currency
            ['attribute_id' => 5, 'category_id' => 2], // Warranty Period -> Accounts
            ['attribute_id' => 5, 'category_id' => 4], // Warranty Period -> Items
            ['attribute_id' => 5, 'category_id' => 5], // Warranty Period -> Boosting

        ]);
    }
}
