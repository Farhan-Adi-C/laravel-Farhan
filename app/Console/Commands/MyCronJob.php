<?php

namespace App\Console\Commands;

use App\Models\Hobby;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class MyCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:hobby';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        
        Hobby::create([
            'hobby' => Str::random(8),
            'created_at' => now()
        ]);
       

    }
}
