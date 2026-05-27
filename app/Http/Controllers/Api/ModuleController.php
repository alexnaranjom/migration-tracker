<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModuleRequest;
use App\Models\Module;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * GET /api/modules
     * List all modules with optional status filter.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Module::with(['notes', 'steps']);

        // Filter by statues if provided: /api/modules?status=in_progress
        if ($request->has('status')) {
            $query->byStatus($request->status);
        }

        // Sort by priority (critical first) then name
        // Using CASE WHEN for SQLite compatibility (MySQL would use FIELD())
        $modules = $query->orderByRaw("
            CASE priority
                WHEN 'critical' THEN 1
                WHEN 'high' THEN 2
                WHEN 'medium' THEN 3
                WHEN 'low' THEN 4
                ELSE 5
        ")
        ->orderBy('name')
        ->get();

        // Add completion_percentage to each module
        $modules->each(function($module) {
            $module->completation_porcentage =  $module->completation_porcentage;
        });

        return response()->json($modules);
    }

    /**
     * POST /api/modules
     * Create a new module.
     */
    public function store(StoreModuleRequest $request): JsonResponse
    {
        $module = Module::create($request->validated());
        return response()->json($module, 201); // 201 = Created
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
