<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_topics', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("type")->nullable()->default("General");
            $table->boolean("is_confidential")->default(true);
            $table->string("status")->default("Open");
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
        Schema::dropIfExists('message_topics');
    }
}
