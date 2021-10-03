<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('website_logo');
            $table->string('meta_keywords');
            $table->text('meta_description');
            $table->text('analytics_code');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('whatsapp');
            $table->string('instagram');
            $table->string('youtube');
            $table->string('footer_logo');
            $table->text('footer_address');
            $table->text('footer_help');
            $table->text('footer_info_news');
            $table->text('footer_payments');
            $table->text('footer_appstore');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
}
