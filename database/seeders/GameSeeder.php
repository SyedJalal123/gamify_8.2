<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run()
    {
        $games = [
            [
                'name' => 'World of Warcraft',
                'image'=> 'uploads/games/1.webp',
            ],
            [
                'name' => 'League of Legends',
                'image'=> 'uploads/games/2.webp',
            ],
            [
                'name' => 'Fortnite',
                'image'=> 'uploads/games/3.webp',
            ],
            [
                'name' => 'Counter-Strike 2',
                'image'=> 'uploads/games/4.webp',
            ],
            [
                'name' => 'Call of Duty: Warzone',
                'image'=> 'uploads/games/5.webp',
            ]

        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}