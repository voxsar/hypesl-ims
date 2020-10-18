<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialiteTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialite_tokens', function (Blueprint $table) {
            $table->id();
            $table->text("type")->nullable();
            $table->text("oauthId")->nullable();
            $table->text("token")->nullable();
            $table->text("refreshToken")->nullable();
            $table->text("expiresIn")->nullable();
            $table->datetime("nextRefresh")->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');

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
        Schema::dropIfExists('socialite_tokens');
    }
}
