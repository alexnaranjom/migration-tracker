<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Module;
use Tests\TestCase;

class ModuleApitTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function it_can_list_all_modules(): void
    {
        Module::factory()->count(3)->create();

        $response = $this->getJson('/api/modules');

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'User Authentication']);
        
    }
}
