<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('attributes')->insert([
            // // Currency
            //     // World of Warcraft 
            //     [
            //         'name' => 'Region',
            //         'type' => 'select',
            //         'options' => json_encode(['NA', 'EU']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Server',
            //         'type' => 'select',
            //         'options' => json_encode(['Aegwynn', 'Aerie Peak', 'Andorhal', 'Galakrond', 'Gallywix', 'Garithos', 'Garona', 'Garona', 'Ghostlands']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Faction',
            //         'type' => 'select',
            //         'options' => json_encode(['Horde', 'Alliance']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            // // Currency

            // // Accounts
            //     // World of Warcraft 
            //     [
            //         'name' => 'Region',
            //         'type' => 'select',
            //         'options' => json_encode(['NA', 'EU']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // League of Legends
            //     [
            //         'name' => 'Current Rank',
            //         'type' => 'select',
            //         'options' => json_encode(['Iron', 'Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond', 'Master', 'Grandmaster', 'Challenger']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Blue Essence',
            //         'type' => 'select',
            //         'options' => json_encode(['0-19K BE', '20-40K BE', '41-60K BE', '61-80K BE', '81-100K BE', '100K+ BE', 'Other']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Servers',
            //         'type' => 'select',
            //         'options' => json_encode(['Brazil', 'Europe Nordic & East', 'Europe West', 'Latin America North', 'Latin America South', 'North America', 'Southeast Asia', 'Oceania', 'Russia']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Fortnite
            //     [
            //         'name' => 'Account Type',
            //         'type' => 'select',
            //         'options' => json_encode(['OG Account', 'Orignal Email', 'Other', 'Save The World', 'Stacked']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Device',
            //         'type' => 'select',
            //         'options' => json_encode(['PC', 'PlayStation', 'Xbox', 'Andriod', 'iOS', 'Switch']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Counter-Strike 2
            //     [
            //         'name' => 'Device',
            //         'type' => 'select',
            //         'options' => json_encode(['Unrated', '0-4,999', '5,000,9,999', '10,000-14,999', '15,000,19,999', 'Other']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Call of Duty
            //     [
            //         'name' => 'Device',
            //         'type' => 'select',
            //         'options' => json_encode(['PlayStation', 'Xbox', 'Steam', 'BattleNet']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Game',
            //         'type' => 'select',
            //         'options' => json_encode(['Modern Warfare II', 'Warzone 4', 'Vanguard', 'Cold War', 'Modern Warfare I', 'Black Ops 6', 'Other']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            // // Accounts

            // // Top Up
            //     // League of Legends
            //     [
            //         'name' => 'Riot Points',
            //         'type' => 'select',
            //         'options' => json_encode(['150', '475', '500', '575', '1000', '1240']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '1',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Region',
            //         'type' => 'select',
            //         'options' => json_encode(['EU', 'NA', 'Malaysia', 'Singapore', 'Hong Kong', 'Middle East']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Fortnite
            //     [
            //         'name' => 'V-Bucks',
            //         'type' => 'select',
            //         'options' => json_encode(['1000', '2800', '5000', '10000']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '1',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Call of Duty
            //     [
            //         'name' => 'CoD Points',
            //         'type' => 'select',
            //         'options' => json_encode(['200 CP', '500 CP', '1100 CP', '2400 CP', '5000 CP', '9500 CP']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '1',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            // // Top Up

            // // Items
            //     // World of Warcraft
            //     [
            //         'name' => 'Item type',
            //         'type' => 'select',
            //         'options' => json_encode(['Armor', 'Weapons', 'Other']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Region',
            //         'type' => 'select',
            //         'options' => json_encode(['NA', 'EU']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Fortnite
            //     [
            //         'name' => 'Item type',
            //         'type' => 'select',
            //         'options' => json_encode(['Materials', 'Skins', 'Traps', 'Weapons', 'Other']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     [
            //         'name' => 'Device',
            //         'type' => 'select',
            //         'options' => json_encode(['PC', 'PlayStation', 'Xbox', 'Andriod', 'iOS', 'Switch']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            //     // Call of duty
            //     [
            //         'name' => 'Device',
            //         'type' => 'select',
            //         'options' => json_encode(['PC','PlayStation', 'Xbox']),
            //         'applies_to' => '1',
            //         'required' => '1',
            //         'topup' => '0',
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ],
            // // Items


            // Boosting
                // World of Warcraft
                    // Power Leveling
                        [ 
                            'name' => 'Server',
                            'type' => 'text',
                            'options' => json_encode(['e.g. Argent Dawn']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],[
                            'name' => 'current level',
                            'type' => 'text',
                            'options' => json_encode(['e.g. 45']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],[
                            'name' => 'desired level',
                            'type' => 'text',
                            'options' => json_encode(['e.g. 120']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    // Raids
                        ,[ 
                            'name' => 'desired Raid',
                            'type' => 'text',
                            'options' => json_encode(["e.g. Ny'alotha Heroic"]),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],[
                            'name' => 'character information',
                            'type' => 'text',
                            'options' => json_encode(['e.g. ORC Hunter, LVL60...']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    // Heroic and Mythic Dungeons
                        ,[ 
                            'name' => 'desired dungeon',
                            'type' => 'text',
                            'options' => json_encode(['e.g. The Battle for Darkshore']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],
                // Call of duty
                    // Rank Boost
                        [ 
                            'name' => 'game',
                            'type' => 'select',
                            'options' => json_encode(['MW3','Black Ops 6', 'Warzone']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],[
                            'name' => 'current rank',
                            'type' => 'text',
                            'options' => json_encode(['e.g. Bronze']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ],[
                            'name' => 'desired rank',
                            'type' => 'text',
                            'options' => json_encode(['e.g. Diamond']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    // Camo Service
                        ,[ 
                            'name' => 'desired camos',
                            'type' => 'text',
                            'options' => json_encode(['e.g. Gold & Platinum']),
                            'applies_to' => '1',
                            'required' => '1',
                            'topup' => '0',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    // Power Leveling
                    ,[ 
                        'name' => 'current level',
                        'type' => 'text',
                        'options' => json_encode(['e.g. 15']),
                        'applies_to' => '1',
                        'required' => '1',
                        'topup' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],[
                        'name' => 'desired level',
                        'type' => 'text',
                        'options' => json_encode(['e.g. 55']),
                        'applies_to' => '1',
                        'required' => '1',
                        'topup' => '0',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
            // Boosting
        ]);
    }
}
