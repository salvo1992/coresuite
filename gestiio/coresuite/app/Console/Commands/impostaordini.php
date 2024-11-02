<?php

namespace App\Console\Commands;

use App\Models\ContrattoTelefonia;
use Illuminate\Console\Command;

class impostaordini extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'impostaordini';

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
        \Log::debug('impostaordini');
        foreach (ContrattoTelefonia::withoutGlobalScope('filtroOperatore')->get() as $record) {
            \Log::debug($record->id);
            $record->updated_at = now();
            $record->save();
        }

        return Command::SUCCESS;
    }
}
