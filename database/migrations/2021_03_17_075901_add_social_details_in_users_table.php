<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialDetailsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', ['admin', 'superadmin', 'user'])->default('admin');
            $table->enum('is_email_verified', [0, 1])->default(0);
            $table->enum('is_phone_verified', [0, 1])->default(0);
            $table->string('mobile')->nullable();
            $table->string('avatar')->default('user/avatar.jpg');
            $table->string('username', 100)->nullable();
            $table->string('website', 255)->nullable();
            $table->text('bio')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('provider', 20)->nullable();
            $table->string('provider_id')->nullable();
            $table->string('access_token')->nullable();
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
            $table->dropColumn('mobile');
            $table->dropColumn('avatar');
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('access_token');
        });
    }
}
