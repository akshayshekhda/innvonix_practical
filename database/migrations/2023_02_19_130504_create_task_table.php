<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('project_id');
            $table->string('task_name');
            $table->string('planned_start_date');
            $table->string('planned_end_date');
            $table->string('task_description');
            $table->string('actual_start_date');
            $table->string('actual_end_date');
            $table->string('remarks');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('is_deleted',[0,1])->default('1');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('project_id')->references('id')->on('project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task');
    }
};