<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo'        => $this->faker->sentence(5), //5 PALABRAS AUTOMATICAS
            'descripcion'   => $this->faker->sentence(20), //20 PALABRAS AUTOMATICAS
            'imagen'        => $this->faker->uuid() . '.jpg', //UUID RAMDOM
            'user_id'       => $this->faker->randomElement([8, 9, 10]), //ELEJI UN ELEMENTO DEL ARRAY DE FORMA RAMDOM
        ];
    }
}
