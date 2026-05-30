<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Module;
use Tests\TestCase;
use App\Models\MigrationNote;
use App\Models\MigrationStep;

class ModuleApitTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase; // Reset database before each test

    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_it_can_list_all_modules(): void
    {
        
    Module::factory()->count(3)->create();

        $response = $this->getJson('/api/modules');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
        
    }

    public function test_it_can_create_a_module(): void
    {
        $data = [
            'name' => 'User Authentication',
            'description' => 'Migrate auth from CodeIgniter to Laravel',
            'priority' => 'critical',
        ];

        $response = $this->postJson('/api/modules', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'User Authentication']);

        $this->assertDatabaseHas('modules', ['name' => 'User Authentication']);
    }

    
    public function test_it_validates_required_fields(): void
    {
        $response = $this->postJson('/api/modules', []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }

    public function test_it_can_show_a_module_with_relationships(): void
    {
        $module = Module::factory()->create();
        MigrationNote::factory()->count(2)->create(['module_id' => $module->id]);
        MigrationStep::factory()->count(3)->create(['module_id' => $module->id]);

        $response = $this->getJson("/api/modules/{$module->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => $module->name])
                 ->assertJsonCount(2, 'notes')
                 ->assertJsonCount(3, 'steps');
    }
}
