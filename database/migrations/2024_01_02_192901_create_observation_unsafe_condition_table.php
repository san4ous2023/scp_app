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
        Schema::create('observation_unsafe_conditions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('observation_id');
            $table->unsignedBigInteger('unsafe_conditions_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observation_unsafe_conditions');
    }
};
