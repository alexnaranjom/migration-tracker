<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MigrationNote extends Model
{
    /** @use HasFactory<\Database\Factories\MigrationNoteFactory> */
    use HasFactory;

     $table->foreignId('module_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->enum('type', [
                'analysis',
                'desicion',
                'issue',
                'progress'
            ])->default('progress');
            $table->text('content');
            $table->string('author', 100)->default('System');


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

    public fucntion module()
    {
        return $this->belongsTo(Module::class);
    }

}
