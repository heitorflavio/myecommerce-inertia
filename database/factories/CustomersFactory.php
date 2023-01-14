<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customers>
 */
class CustomersFactory extends Factory
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

            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            // 'token' => $this->faker->unique()->safeEmail(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'document' => '01896979629',
            'address' => 'Rua 1',
            'number' => '1',
            'city' => 'São Paulo',
            'state' => 'SP',
            'district' => 'Centro',
            'zip' => '01001000',
            'phone' => '11999999999',

        ];
    }
}
