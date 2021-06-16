<?php

namespace Database\Factories;

use App\Models\Periode;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Periode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tahun_mulai' => $this->faker->word,
        'tahun_selesai' => $this->faker->word,
        'mulai_vote' => $this->faker->word,
        'selesai_vote' => $this->faker->word,
        'keterangan' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
