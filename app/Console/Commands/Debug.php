<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class Debug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // Storage::put("public/images/profile/contoh.txt", "Hello World");

        // $file = asset('storage/images/profile/contoh.txt');
        // $output = strpos($file, 'images');
        // $substr = substr($file, $output);
        // Storage::delete("public/".$substr);
        // var_dump("public/".$substr);
    }
}
