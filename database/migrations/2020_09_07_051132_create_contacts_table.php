<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string("fname");
            $table->string("lname")->nullable();
            $table->string("oname")->nullable();
            $table->string("language")->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('mobile')->unique();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('password');
            $table->string("street")->nullable();
            $table->string("address")->nullable();
            $table->string("city")->nullable();
            $table->string("postal")->nullable();
            $table->string("type")->nullable();
            $table->boolean("login")->default(false);
            $table->text("remarks")->nullable();
            $table->string("organiation")->nullable();
            $table->json("other")->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
