<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('observation_safety_behaviours', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('observation_id');
            $table->unsignedBigInteger('safety_behaviours_id');
            $table->enum('state', ['SAFE', 'AT RISK']);
            //$table->unsignedBigInteger('safety_states_id');

            $table->timestamps();
            $table->foreign('observation_id', 'observation_safety_behaviours_observation_fk')->on('observations')->references('id')->onDelete('cascade');
            $table->foreign('safety_behaviours_id', 'observation_safety_behaviours_safety_behaviours_fk')->on('safety_behaviours')->references('id')->onDelete('cascade');
//            $table->index('observation_id', 'observation_safety_behaviours_observation_idx');
//            $table->foreign('observation_id', 'observation_safety_behaviours_observation_fk')->on('observations')->references('id');
//
//            $table->index('safety_behaviours_id', 'observation_safety_behaviours_safety_behaviours_idx');
//            $table->foreign('safety_behaviours_id', 'observation_safety_behaviours_safety_behaviours_fk')->on('safety_behaviours')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observation_safety_behaviours');
    }
};
