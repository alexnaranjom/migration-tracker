<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('migration_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')
                  ->constrained()
                  ->onDelete('cascade');
            $table->enum('type', [
                'analysis',
                'decision',
                'issue',
                'progress'
            ])->default('progress');
            $table->text('content');
            $table->string('author', 100)->default('System');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('migration_notes');
    }
};
