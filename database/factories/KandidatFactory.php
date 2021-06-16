<?php

namespace Database\Factories;

use App\Models\Kandidat;
use Illuminate\Database\Eloquent\Factories\Factory;

class KandidatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kandidat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_calon' => $this->faker->randomDigitNotNull,
        'nama' => $this->faker->word,
        'tgl_lahir' => $this->faker->word,
        'tempat_lahir' => $this->faker->word,
        'jenis_kelamin' => $this->faker->word,
        'agama' => $this->faker->word,
        'foto' => $this->faker->word,
        'visi' => $this->faker->text,
        'tingkat_pendidikan_id' => $this->faker->randomDigitNotNull,
        'periode_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
