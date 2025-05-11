<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryGameAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map of category_game_id => attribute_ids
        $data = [
            // World of Warcraft - Currency
            1 => [1, 2, 3], // Region, Server, Faction

            // World of Warcraft - Accounts
            2 => [4], // Region

            // League of Legends - Accounts
            3 => [5, 6, 7], // Current Rank, Blue Essence, Servers

            // Fortnite - Accounts
            4 => [8, 9], // Account Type, Device

            // Counter-Strike 2 - Accounts
            5 => [10], // Device (Unrated)

            // Call of Duty - Accounts
            6 => [11, 12], // Device (Platform) + Game

            // League of Legends - Top Up
            7 => [13, 14], // Riot Points, Region

            // Fortnite - Top Up
            8 => [15], // V-Bucks

            // Call of Duty - Top Up
            9 => [16], // CoD Points

            // World of Warcraft - Items
            10 => [17, 18], // Item Type, Region

            // Fortnite - Items
            11 => [19, 20], // Item Type, Device

            // Call of Duty - Items
            12 => [21], // Device
        ];

        foreach ($data as $categoryGameId => $attributeIds) {
            foreach ($attributeIds as $attributeId) {
                DB::table('category_game_attribute')->insert([
                    'category_game_id' => $categoryGameId,
                    'attribute_id' => $attributeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
