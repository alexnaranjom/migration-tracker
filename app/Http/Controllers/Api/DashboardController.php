<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    /**
     * GET /api/dashboard
     * Returns migration progress statistics.
     */
    public function index(): JsonResponse
    {
        $total = Module::count();
        $completed = Module::completed()->count();

        $byStatus = [
            'not_started' => Module::byStatus('not_started')->count(),
            'analyzing' => Module::byStatus('analyzing')->count(),
            'in_progress' => Module::byStatus('in_progress')->count(),
            'testing' => Module::byStatus('testing')->count(),
            'completed' => Module::byStatus('completed')->count(),
        ];

        $totalEstimatedHours = Module::sum('estimated_hours');
        $totalActualHours = Module::sum('actual_hours');

        return response()->json([
            'total_modules' => $total,
            'completed_modules' => $completed,
            'completion_percentage' => $total > 0
                ? round(($completed / $total) * 100)
                : 0,
            'by_status' => $byStatus,
            'total_estimated_hours' => (int) $totalEstimatedHours,
            'total_actual_hours' => (int) $totalActualHours,
        ]);
    }
}
