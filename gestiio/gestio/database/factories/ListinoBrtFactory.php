<?php

namespace Database\Factories;

use App\Models\Comune;
use Database\Seeders\CfPiRandom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListinoBrt>
 */
class ListinoBrtFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
                 'da_peso'=>null,
     'a_peso'=>null,
     'home_delivery'=>null,
     'brt_fermopoint'=>null,
     'al_kg'=>null,

        ];
    }
}
