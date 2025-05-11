<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeCategoryGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attribute_category_game')->insert([
            
            ['attribute_id' => 1, 'category_game_id' => 1], // Server -> World of Warcraft
            ['attribute_id' => 1, 'category_game_id' => 2], // Server -> League of Legends
            ['attribute_id' => 1, 'category_game_id' => 4], // Server -> Counter-Strike 2
            ['attribute_id' => 1, 'category_game_id' => 5], // Server -> Call of Duty: Warzone

            ['attribute_id' => 2, 'category_game_id' => 1], // Rank -> World of Warcraft
            ['attribute_id' => 2, 'category_game_id' => 2], // Rank -> League of Legends
            ['attribute_id' => 2, 'category_game_id' => 4], // Rank -> Counter-Strike 2
            ['attribute_id' => 2, 'category_game_id' => 5], // Rank -> Call of Duty: Warzone
            
            ['attribute_id' => 3, 'category_game_id' => 1], // Level -> World of Warcraft
            ['attribute_id' => 3, 'category_game_id' => 2], // Level -> League of Legends
            ['attribute_id' => 3, 'category_game_id' => 4], // Level -> Counter-Strike 2
            ['attribute_id' => 3, 'category_game_id' => 5], // Level -> Call of Duty: Warzone

            ['attribute_id' => 6, 'category_game_id' => 3], // V-Buks -> Fortnite
        ]);
    }
}
