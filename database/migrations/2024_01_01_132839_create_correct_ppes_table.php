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
        Schema::create('correct_ppes', function (Blueprint $table) {
            $table->id();
            $table->string('title',64)->unique();
            $table->unsignedInteger('safety_behaviours_id',)->unique();
            $table->tinyInteger('safety_state_id',);
            $table->softDeletes();

            $table->index('safety_behaviours_id', 'correct_ppe_safety_behaviours_idx');
            $table->foreign('safety_behaviours_id', 'observation_status_fk')->on('statuses')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correct_ppes');
    }
};
