<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DbReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reset';

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

        if (env('APP_ENV') == 'local') {
            $this->call('migrate:fresh');
            $this->call('scan-models');
            $this->call('db:seed');
            $this->call('snapshot:create', ['name' => 'dump']);
        }

        return 0;
    }
}
