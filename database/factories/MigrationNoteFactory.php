<?php

namespace Database\Factories;

use App\Models\MigrationNote;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MigrationNote>
 */
class MigrationNoteFactory extends Factory
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
            'type'=>fake()->randomElement(['analysis','decision','issue','progress']),
            'content'=>fake()->paragraph(),
            'author'=>fake()->name()
        ];
    }
}
