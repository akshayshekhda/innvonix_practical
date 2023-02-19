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
        Schema::create('project', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('project_name');
            $table->string('planned_start_date');
            $table->string('planned_end_date');
            $table->string('project_description');
            $table->string('actual_start_date');
            $table->string('actual_end_date');
            $table->string('remarks');
            $table->enum('status',['active','inactive'])->default('active');
            $table->enum('is_deleted',[0,1])->default('1');
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
};