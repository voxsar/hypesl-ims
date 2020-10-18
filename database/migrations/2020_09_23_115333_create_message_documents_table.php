<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_documents', function (Blueprint $table) {
            $table->id();
            $table->string("url")->nullable()->length(600);
            $table->boolean("is_local")->default(true);
            $table->timestamps();
            $table->bigInteger('documentable_id')->unsigned()->nullable()->index();
            $table->string('documentable_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_documents');
    }
}
