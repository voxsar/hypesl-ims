<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageTopicUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messagetopicables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('messagetopicable_id')->unsigned()->nullable()->index();
            $table->string('messagetopicable_type')->nullable();
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
        Schema::dropIfExists('messagetopicables');
    }
}
