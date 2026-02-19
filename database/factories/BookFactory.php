<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string>
     */
    public function definition(): array
    {
        $model = \App\Models\Book::class;

        return [
            'titulo' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'isbn' => $this->faker->unique()->isbn13(),
            'copias_totales' => $this->faker->numberBetween(1, 10),
            'copias_disponibles' => $this->faker->numberBetween(1, 10),
            'estado' => $this->faker->boolean(),
        ];
    }
}
