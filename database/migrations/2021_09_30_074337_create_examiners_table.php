<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examiners', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('name', 100)->nullable();
            $table->string('phone', 30)->nullable();
            $table->string('company_name', 150)->nullable();
            $table->string('company_address')->nullable();
            $table->string('designation', 100)->nullable();
            $table->enum('status', ['pending', 'verified'])->default('pending');
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->string('unique_key')->default('');
            $table->string('submission_id')->default('');
            $table->timestamp('submitted_date')->nullable();
            $table->timestamps();

            $table->foreign('verified_by')->references('id')->on('users')
                ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('examiners');
    }
}
