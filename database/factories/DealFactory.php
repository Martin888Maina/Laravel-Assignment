<?php

namespace Database\Factories;
use App\Models\Organization;
use App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->randomFloat(2, 0, 10000),
            'probability' => $this->faker->randomFloat(2, 0, 100),
            'expected_close_date' => $this->faker->date(),
            'notes' => $this->faker->sentence(),
            'organization_id' => function () {
                return Organization::factory()->create()->id;
            },
            'contact_id' => function () {
                return Contact::factory()->create()->id;
            },
        ];
    }
}
