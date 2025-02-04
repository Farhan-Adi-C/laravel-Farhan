<?php

namespace Database\Seeders;

use App\Models\Hobby;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HobbySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobby = Hobby::factory(1)->create();
    }
}
