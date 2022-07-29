<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(5, false),
            'stok' => 50,
            'jumlah' => 50,
            'sinopsis' => implode($this->faker->paragraphs(mt_rand(5, 8))),
            'excerpt' => $this->faker->paragraph(),
            'penerbit' => $this->faker->company(),
            'pengarang' => $this->faker->name(),
            'halaman' => $this->faker->randomNumber(4, false),
            'tahunRilis' => $this->faker->year(),
        ];
    }
}
