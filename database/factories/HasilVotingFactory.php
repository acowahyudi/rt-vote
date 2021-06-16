<?php

namespace Database\Factories;

use App\Models\HasilVoting;
use Illuminate\Database\Eloquent\Factories\Factory;

class HasilVotingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HasilVoting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'periode_id' => $this->faker->randomDigitNotNull,
        'penduduk_id' => $this->faker->randomDigitNotNull,
        'kandidat_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
