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
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->string('site',32)->default('SCP');
            $table->string('location',32)->default('SCP');
            $table->text('description');
            $table->mediumText('further')->nullable();
            $table->mediumText('corrective')->nullable();
            $table->mediumText('comments')->nullable();
            $table->unsignedInteger('status_id')->default(1);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_id')->nullable();;
            $table->unsignedInteger('department_id')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observations');
    }
};
