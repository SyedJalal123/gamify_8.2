<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            13 => [ // World of Warcraft Boosting
                'Power Leveling',
                'Raids',
                'Heroic and Mythic Dungeons',
                'Custom Request',
            ],
            14 => [ // Call of Duty: Warzone Boosting
                'Rank boost',
                'Camo Service',
                'Power Leveling',
                'Custom Request',
            ],
        ];

        foreach ($services as $categoryGameId => $serviceNames) {
            foreach ($serviceNames as $name) {
                Service::create([
                    'name' => $name,
                    'category_game_id' => $categoryGameId,
                ]);
            }
        }
    }
}
