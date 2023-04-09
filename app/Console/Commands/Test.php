<?php

namespace App\Console\Commands;

use App\Models\Spend;
use Illuminate\Console\Command;

class Test extends Command
{
    protected $signature = 'app:test';

    protected $description = 'Command description';

    public function handle()
    {
        $spend = Spend::first();
        dd($spend->getTags());
    }
}
