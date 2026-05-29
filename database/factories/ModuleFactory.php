<?php

namespace Database\Factories;

use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     * This generates random data for testing.
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->sentence(3),
            'description'=>fake()->paragraph(),
            'legacy_framework'=>'CodeIgnitier',
            'target_framework'=>'Laravel',
            'status'=>fake()->randomElement(['not_started','analyzing','in_progress','testing','completed']),
            'priority'=>fake()->randomElement(['low','medium','high','critical']),
            'estimated_hours'=>fake()->numberBetween(8,120),
            'actual_hours'=>fake()->optional()->numberBetween(8,150),
            'assigned_to'=>fake()->optional()->name()
        ];
    }
}
