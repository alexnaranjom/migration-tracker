<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrationStep extends Model
{
    /** @use HasFactory<\Database\Factories\MigrationStepFactory> */
    use HasFactory;

    protected $fillable = [
        'module_id',
        'step_number',
        'description',
        'is_completed'
    ];

     /**
     * Cast is_completed to boolean automatically.
     * Without this, it would be 0/1 from the database.
     */
    protected $casts = [
        'is_completed' => 'boolean',
    ];

    public function Module() {
        $this->belongTo(Module::class);
    }




      
}
