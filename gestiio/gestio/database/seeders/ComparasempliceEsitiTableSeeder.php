<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ComparasempliceEsitiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comparasemplice_esiti')->delete();
        
        \DB::table('comparasemplice_esiti')->insert(array (
            0 => 
            array (
                'attivo' => 1,
                'chiedi_motivo' => 0,
                'colore_hex' => '#000000',
                'created_at' => '2023-07-30 18:21:34',
                'esito_finale' => 'in-lavorazione',
                'id' => 'in-gestione',
                'nome' => 'In Gestione',
                'notifica_mail' => 0,
                'notifica_whatsapp' => 0,
                'updated_at' => '2023-07-30 18:21:34',
            ),
            1 => 
            array (
                'attivo' => 1,
                'chiedi_motivo' => 0,
                'colore_hex' => '#000000',
                'created_at' => '2023-07-30 18:21:55',
                'esito_finale' => 'ko',
                'id' => 'ko',
                'nome' => 'Ko',
                'notifica_mail' => 0,
                'notifica_whatsapp' => 0,
                'updated_at' => '2023-07-30 18:21:55',
            ),
            2 => 
            array (
                'attivo' => 1,
                'chiedi_motivo' => 0,
                'colore_hex' => '#669c35',
                'created_at' => '2023-07-30 18:21:46',
                'esito_finale' => 'ok',
                'id' => 'ok',
                'nome' => 'Ok',
                'notifica_mail' => 0,
                'notifica_whatsapp' => 0,
                'updated_at' => '2023-07-30 18:21:46',
            ),
        ));
        
        
    }
}