<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map of service_id => attribute_ids
        $data = [
            
            // World of Warcraft
            1 => [4, 22, 23, 24],       // Power Leveling
            2 => [4, 22, 25, 26],       // Raids
            3 => [4, 22, 27, 26],       // Heroic and Mythic Dungeons
            4 => [4, 22],               // Custom Request

            // Call of Duty
            5 => [21, 28, 29, 30],      // Rank boost
            6 => [21, 28, 31],          // Camo Service
            7 => [21, 28, 32, 33],      // Power Leveling
            8 => [21, 28],              // Custom Request
        ];

        foreach ($data as $serviceId => $attributeIds) {
            foreach ($attributeIds as $attributeId) {
                DB::table('service_attributes')->insert([
                    'service_id' => $serviceId,
                    'attribute_id' => $attributeId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
