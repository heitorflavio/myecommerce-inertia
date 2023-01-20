<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pagseguro>
 */
class PagseguroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'token' => "73df6d86-0b20-44f8-bfb6-5a1714f8f192fce5fbd243ed957c34eb80c856a2847908a8-704f-4913-9a9a-bcee2ca35fc0",
            'email' => "heitorflavio.r@outlook.com"
        ];
    }
}
