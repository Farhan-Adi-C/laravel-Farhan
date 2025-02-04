<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Hobby;
use App\Models\Phone;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory(1)->create();        
        $siswa = Siswa::factory(1)->create();
        $phone = Phone::factory(1)->create();
        $hobby = Hobby::factory(1)->create();
        $blog = Blog::factory(1)->create();        
    }
}
