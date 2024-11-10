<?php

namespace Database\Factories;

use App\Models\Comune;
use Database\Seeders\CfPiRandom;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ListinoBrtEuropa>
 */
class ListinoBrtEuropaFactory extends Factory
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
     'gruppo_a'=>null,
     'gruppo_b'=>null,
     'gruppo_c'=>null,
     'gruppo_d'=>null,

        ];
    }
}
