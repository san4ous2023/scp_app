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
        Schema::create('safety_behaviours', function (Blueprint $table) {
            $table->id();
            $table->string('title',64)->unique();
            //$table->tinyInteger('safety_state_id',);
            $table->timestamps();

            //$table->softDeletes();

            //$table->index('safety_state_id', 'safety_behaviours_safety_states_idx');
            //$table->foreign('safety_state_id', 'safety_state_fk')->on('safety_states')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('safety_behaviours');
    }
};
