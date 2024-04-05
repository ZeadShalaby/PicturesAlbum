<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'firstname' => Str::limit(fake()->name(), 7),
            'lastname' => Str::limit(fake()->name(), 7),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'user', //? password
            'photo' => 'male.png',
            'gender' => 'male'
        ];
    }


    // todo return profileimage gender male 
    public function male()
    {
        return $this->state(function (array $attributes) {
            $img = array("male.png","male1.png","male2.png","male3.png","male4.png","male5.png","male6.png","male7.png","male8.png","male9.png");
            $increment = random_int(0,9);
            return [  
                'photo' => $img[$increment],
                'gender' => 'male'
            ];
        });
    }

    // todo return profileimage gender female 
    public function female()
    {
        return $this->state(function (array $attributes) {
            $img = array("female.png","female1.png","female2.png","female3.png","female4.png","female5.png","female6.png","female7.png","female8.png","female9.png");
            $increment = random_int(0,9);
            return [  
                'photo' => $img[$increment],
                'gender' => 'female'
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
