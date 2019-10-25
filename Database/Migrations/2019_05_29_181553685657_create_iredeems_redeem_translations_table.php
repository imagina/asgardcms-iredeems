<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIredeemsRedeemTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iredeems__redeem_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('redeem_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['redeem_id', 'locale']);
            $table->foreign('redeem_id')->references('id')->on('iredeems__redeems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iredeems__redeem_translations', function (Blueprint $table) {
            $table->dropForeign(['redeem_id']);
        });
        Schema::dropIfExists('iredeems__redeem_translations');
    }
}
