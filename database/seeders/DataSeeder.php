<?php

namespace Database\Seeders;

use App\Models\Phone;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = Siswa::factory(5)->create();

        $siswa->each(function ($siswa){
            Phone::factory(5)->create([
                'siswa_id' => $siswa->id
            ]);
        });
        
    }
}
