<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class scanModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan-models';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('clear-compiled');
        $this->call('ide-helper:generate');
        $this->call('ide-helper:models', ['--nowrite' => true]);
        return 0;
    }
}
