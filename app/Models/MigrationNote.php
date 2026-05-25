<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrationNote extends Model
{
    /** @use HasFactory<\Database\Factories\MigrationNoteFactory> */
    use HasFactory;

    protected $fillable = [
        'module_id',
        'type',
        'content',
        'author'
    ];

    /**
     * A note belongs to one module.
     * Inverse of hasMany.
     */

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
