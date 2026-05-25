<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\MigrationNote;
use App\Models\MigrationStep;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'name'=> 'user assignation & RBAC',
                'description'=> 'Migrate CI session-based auth to Laravel Sanctum with role-based access control. Includes login, registration, password reset, and permission middleware.',
                'status' => 'completed',
                'priority' => 'critical',
                'estimated_hours' => 40,
                'actual_hours' => 52,
                'assigned_to' => 'Alex Naranjo'
            ],
            [
                'name'=> 'Session Management',
                'description'=> 'Replace CI session library with Laravel session handling. Migrate session data storage from files to database driver.',
                'status' => 'completed',
                'priority' => 'critical',
                'estimated_hours' => 16,
                'actual_hours' => 12,
                'assigned_to' => 'Alex Naranjo'
            ],
            [
                'name'=> 'Reporting Dashboard',
                'description'=> 'Rebuild reporting module using Eloquent queries and Laravel Collections. Replace raw SQL queries with Query Builder and scopes.',
                'status' => 'in_progress',
                'priority' => 'high',
                'estimated_hours' => 48,
                'actual_hours' => null,
                'assigned_to' => 'Alex Naranjo'
            ],
            [
                'name'=> 'File Upload Manager',
                'description'=> 'Migrate file upload handling from CI upload library to Laravel Storage facade with S3 support.',
                'status' => 'analyzing',
                'priority' => 'medium',
                'estimated_hours' => 20,
                'actual_hours' => null,
                'assigned_to' => null
            ],
            [
                'name' => 'Audit Logging',
                'description'=> 'Implement centralized audit logging using Laravel Events and Listeners. Replace scattered CI log_message calls.',
                'status' => 'not_started',
                'priority' => 'medium',
                'estimated_hours' => 30,
                'actual_hours' => null,
                'assigned_to' => null
            ],
            [
                'name' => 'Admin Panel',
                'description' => 'Rebuild admin dashboard using Laravel + Vue.js. Replace CI-based admin with modern modern single-page application.',
                'status' => 'not_started',
                'priority' => 'low',
                'estimated_hours' => 80,
                'actual_hours' => null,
                'assigned_to' => null,
            ],
            [
                'name' => 'Data Export (CSV/PDF)',
                'description' => 'Migrate export functionality using Laravel Excel and DomPDF packages. Replace CI-based CSV generation.',
                'status' => 'not_started',
                'priority' => 'low',
                'estimated_hours' => 16,
                'actual_hours' => null,
                'assigned_to' => null,
            ]
        ];

        foreach($modules as $moduleData) {
            $module = Module::create($moduleData);
            // Add Notes
            MigrationNote::factory()->count(rand(2,4))->create(['module_id' => $module->id]);

            // Add steps
            $stepCount = rand(3, 6);
            for ($i =1; $i<=$stepCount; $i++) {
                if ($module->status === 'completed') {
                    $isCompleted = true;
                } elseif ($module->status === 'not_started') {
                    $isCompleted = false;
                } else {
                    $isCompleted = (bool) rand(0, 1);  // random true or false
                }
                MigrationStep::factory()->create([
                    'module_id' => $module->id,
                    'step_number' => $i,
                    'description' => $this->getRealisticStep($module->name, $i),
                    'is_completed' => $isCompleted
                ]);
            }
        }
    }

    private function getRealisticStep(string $moduleName, int $step):string {
        $genericSteps = [
            1 => 'Analyze existing CodeIgniter code and document current functionality',
            2 => 'Design Laravel equivalent: models, controllers, routes, and migrations',
            3 => 'Implement core business logic in Laravel with Eloquent',
            4 => 'Write PHPUnit tests for all critical paths',
            5 => 'Perform integration testing with connected modules',
            6 => 'Deploy to staging and validate with QA team'
        ];

        return $genericSteps[$step] ?? "Step {$steps}: Additional implementation and review";
    }
}
