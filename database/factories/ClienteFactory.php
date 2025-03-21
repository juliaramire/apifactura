<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'ruc' => $this->faker->unique()->numerify('########-#'), // Genera un RUC ficticio
            'email' => $this->faker->unique()->safeEmail,
            'razon_social' => $this->faker->company,
            'fecha_nacimiento' => $this->faker->date('Y-m-d'),
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->phoneNumber,
        ];
    }
}
