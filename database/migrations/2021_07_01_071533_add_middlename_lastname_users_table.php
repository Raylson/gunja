<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMiddlenameLastnameUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('middle_name', 20)->after('first_name')->nullable();
            $table->string('last_name', 20)->after('middle_name')->nullable();
            $table->string('gender', 6)->after('last_name')->nullable();
            $table->date('dob')->after('gender')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('dob');
        });
    }
}
