<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room; // Pastikan baris ini ada agar Laravel mengenali model Room

class RoomSeeder extends Seeder
{
    public function run()
    {
        Room::insert([
            ['name' => 'Toba Indah', 'location' => 'Danau Toba', 'price' => 200000],
            ['name' => 'Toba Murah', 'location' => 'Danau Toba', 'price' => 150000],
            ['name' => 'Samosir View', 'location' => 'Samosir', 'price' => 250000],
            ['name' => 'Berastagi Villa', 'location' => 'Berastagi', 'price' => 300000],
        ]);
    }
}