<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("message")->length(500)->nullable()->default("");
            $table->bigInteger('messageable_id')->unsigned()->nullable()->index();
            $table->string('messageable_type')->nullable();

            $table->bigInteger('message_topic_id')->unsigned()->nullable()->index();
            $table->foreign('message_topic_id')->references('id')->on('message_topics')->onDelete('set null')->onUpdate('set null');
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
        Schema::dropIfExists('messages');
    }
}
