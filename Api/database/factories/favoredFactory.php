<?php

namespace Database\Factories;

use App\Models\Favored;
use Illuminate\Database\Eloquent\Factories\Factory;

class favoredFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favored::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->firstName,
            'document'      => '27084098000169',
            'email'         => $this->faker->email,
            'bank'          => '237',
            'agency'        => '0814',
            'agencyDigit'   => '0',
            'account'       => '01002713',
            'accountDigit'  => '9',
            'accountType'   => 'CONTA_CORRENTE',
            'valid'         => true
        ];
    }
}
