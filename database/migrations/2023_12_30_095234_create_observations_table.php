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
        Schema::create('observations', function (Blueprint $table) {
            $table->id();
            $table->string('site', 32)->default('SCP');
            $table->string('location', 32)->default('SCP');
            $table->text('description');
            $table->mediumText('further')->nullable();
            $table->mediumText('corrective')->nullable();
            $table->mediumText('comments')->nullable();
            $table->unsignedInteger('status_id')->default(1);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_id')->nullable();
            $table->unsignedInteger('department_id')->default(1);

            $table->softDeletes();

            $table->timestamps();

            $table->index('department_id', 'observation_department_idx');
            $table->foreign('department_id', 'observation_department_fk')->on('department')->references('id');

            $table->index('user_id', 'observation_user_idx');
            $table->foreign('user_id', 'observation_user_fk')->on('users')->references('id');

//            $table->index('job_id', 'observation_job_idx');
//            $table->foreign('job_id', 'observation_job_fk')->on('jobs')->references('id');

            $table->index('status_id', 'observation_status_idx');
            $table->foreign('status_id', 'observation_status_fk')->on('statuses')->references('id');

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
