<?php

namespace Database\Factories;

use App\Models\MigrationStep;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MigrationStep>
 */
class MigrationStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'module_id'=>Module::factory(),
            'step_number' => fake()->numberBetween(1, 10),
            'description' => fake()->sentence(),
            'is_completed' => fake()->boolean(50)
        ];
    }
}
