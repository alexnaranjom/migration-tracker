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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string("legacy_framework")->default('CodeIgniter');
            $table->string("target_framework")->default('Laravel');
            $table->enum('status', [    //migration status
                'not_started',
                "analyzing",
                'in_progress',
                'testing',
                'completed'
            ])->default('not_started');
            $table->enum('priority', [
                'low',
                'medium',
                'high',
                'critical'
            ])->default('medium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules');
    }
};
