<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryGameData = [
            // Currency
                [
                    'category_id' => 1, 'game_id' => 1, 'title' => 'Gold', 
                    'feature_image' => 'uploads/games/wow-gold.webp', 
                    'currency_type' => 'k', 'delivery_type' => 'character name'
                ], // World of Warcraft
            // Currency
             
            // Accounts
                ['category_id' => 2, 'game_id' => 1, 'title' => 'Accounts', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // World of Warcraft
                ['category_id' => 2, 'game_id' => 2, 'title' => 'Accounts', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // League of Legends
                ['category_id' => 2, 'game_id' => 3, 'title' => 'Accounts', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // Fortnite
                ['category_id' => 2, 'game_id' => 4, 'title' => 'Accounts', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // Counter-Strike 2
                ['category_id' => 2, 'game_id' => 5, 'title' => 'Accounts', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // Call of duty
            // Accounts
            
            // Top Up
                [
                    'category_id' => 3, 'game_id' => 2, 'title' => 'Riot Points', 
                    'feature_image' => 'uploads/games/riot-points.webp', 'currency_type' => '', 'delivery_type' => ''
                ], // League of Legends
                [
                    'category_id' => 3, 'game_id' => 3, 'title' => 'V-Bucks', 
                    'feature_image' => 'uploads/games/v-bucks.png', 'currency_type' => '', 'delivery_type' => ''
                ], // Fortnite
                [
                    'category_id' => 3, 'game_id' => 5, 'title' => 'CoD Points', 
                    'feature_image' => 'uploads/games/CallofDuty-2.png', 'currency_type' => '', 'delivery_type' => ''
                ], // Call of duty
            // Top Up

            // Items
                ['category_id' => 4, 'game_id' => 1, 'title' => 'Items', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => 'username'], // World of Warcraft
                ['category_id' => 4, 'game_id' => 3, 'title' => 'Items', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => 'username'], // Fortnite
                ['category_id' => 4, 'game_id' => 5, 'title' => 'Items', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => 'username'], // Call of duty
            // Items


            // Items
                ['category_id' => 5, 'game_id' => 1, 'title' => 'Boosting', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // World of Warcraft
                ['category_id' => 5, 'game_id' => 5, 'title' => 'Boosting', 'feature_image' => '', 'currency_type' => '', 'delivery_type' => ''], // World of Warcraft
            // Items
        ];

        DB::table('category_game')->insert($categoryGameData);
    }
}



