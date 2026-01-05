<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'middlename' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
            'terms_cond' => true,
            'phone_no' => $this->faker->numerify('##########'), // 10-digit number
            'registration_status' => 'started',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
