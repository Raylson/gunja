<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examiner_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->string('answer');
            $table->integer('user_score');
            $table->integer('admin_score')->default('0');
            $table->text('review')->default('');
            $table->integer('admin_id');
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('examiners')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('question_id')->references('id')->on('questions')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('answer_id')->references('id')->on('question_answers')
                ->onDelete('cascade')->onUpdate('cascade');

            // $table->foreign('admin_id')->references('id')->on('users')
            //     ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
}
