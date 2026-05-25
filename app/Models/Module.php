<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleFactory> */
    use HasFactory;

    /**
     * These are the fields that can be filled via create() and update().
     */
    protected $fillable = [
        'name',
        'description',
        'legacy_framework',
        'target_framework',
        'status',
        'priority',
        'estimated_hours',
        'actual_hours',
        'assigned_to'
    ];

    /**
     * A module has many migration notes.
     * One-to-many relationship
     */
    
    public function notes() {
        return $this->hasMany(MigrationNote::class);
    }

    /**
     * A module has many migration steps.
     * Onte-to-many relantionship
     */
    public function steps() {
        return $this->hasMany(MigrationStep::class);
    }

    /**
     * Query scope:get only completed modules.
     * Usage: Module::completed->get()
     */

    public function scopeCompleted($query) {
        return $query->where('status', 'completed');
    }

    /**
     * Query scope: get only in-progress modules.
     * Usage: Module::inProgress()->get()
     */

    public function scopeInProgress($query) {
        return $query->where('status', 'in_progress');
    }

    /**
     * Query scope: filter by status.
     * Usage: Module::byStatus('testing')->get()
     */
    public function scopeByStatus($query, string $status) {
        return $query->where('status', $status);
    }

    /**
     * Accessor: calculate completion percentage of steps.
     * Usage: $module->completion_percentage
     */
    public function getCompletionPercentageAttribute():int {
        $total = $this->steps()->count();
        if ($total === 0) return 0;

        $completed = $this->steps()->where('is_completed', true)->count();
        return (int) round(($completed / $total) * 100);
    }

    /**
     * All notes in module that an author wrote
     */
    public function notesByAuthor($author) {
        $notes = $this->notes()
                ->where('author', $author)
                ->get();
        
        return $notes;
    }


}
