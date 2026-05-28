<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\MigrationNote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MigrationNoteController extends Controller
{
    /**
     * GET /api/modules/{module}/notes
     */
    public function index(Module $module): JsonResponse
    {
        return response()->json(
            $module->notes()->orderBy('created_at', 'desc')->get()
        );
    }

    /**
     * POST /api/modules/{module}/notes
     */
    public function store(Request $request, Module $module): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'sometimes|in:analysis,decision,issue,progress',
            'content' => 'required|string',
            'author' => 'sometimes|string|max:255',
        ]);

        $note = $module->notes()->create($validated);

        return response()->json($note, 201);
    }
}