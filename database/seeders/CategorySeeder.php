<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Gold'],
            ['name' => 'Accounts'],
            ['name' => 'Top Up'],
            ['name' => 'Items'],
            ['name' => 'Boosting'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}