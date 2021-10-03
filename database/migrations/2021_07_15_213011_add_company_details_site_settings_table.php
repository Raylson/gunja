<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyDetailsSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('company_title', 100)->default('ABC Pvt. Ltd')->after('footer_appstore');
            $table->string('company_address', 150)->default('Shankhamul Tower 7th Floor, Kathmandu')->after('company_title');
            $table->string('company_phone', 30)->default('+977 014782122')->after('company_address');
            $table->string('company_email', 120)->default('info@abc.com.np')->after('company_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn('company_title');
            $table->dropColumn('company_address');
            $table->dropColumn('company_phone');
            $table->dropColumn('company_email');
        });
    }
}
