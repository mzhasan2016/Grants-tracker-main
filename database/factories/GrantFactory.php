<?php

namespace Database\Factories;

use App\Models\Grant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class GrantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization' => $this->faker->company,
            'applied_amount' => 900,
            'description' => $this->faker->realText($this->faker->numberBetween(10,20)),
            'notes' => $this->faker->realText($this->faker->numberBetween(10,20)),
            'contact_person' => $this->faker->name,
            'website' => 'example.com',
            'phone_number' => $this->faker->phoneNumber,
            'email_address' =>  $this->faker->email,
            'status' => 'application',
            'decision_date' => $this->faker->date,
            'submitted_date' => $this->faker->date
        ];
    }
}
