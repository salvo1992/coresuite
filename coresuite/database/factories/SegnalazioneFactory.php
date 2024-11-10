<?php

namespace Database\Factories;

use App\Models\Comune;
use Database\Seeders\CfPiRandom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Segnalazione>
 */
class SegnalazioneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                 'agente_id'=>null,
     'esito_id'=>null,
     'nome_azienda'=>null,
     'partita_iva'=>CfPiRandom::getPartitaIva(),
     'indirizzo'=>$this->faker->streetName(),
     'citta'=>Comune::inRandomOrder()->first()->id,
     'cap'=>rand(11111,55555),
     'telefono'=>$this->faker->phoneNumber(),
     'nome_referente'=>null,
     'cognome_referente'=>null,
     'email_referente'=>null,
     'fatturato'=>null,
     'settore'=>null,
     'provincia'=>null,
     'forma_giuridica'=>null,

        ];
    }
}
