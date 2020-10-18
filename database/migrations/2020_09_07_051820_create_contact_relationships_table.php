<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_relationships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->bigInteger('related_contact_id')->unsigned()->nullable()->index();
            $table->foreign('related_contact_id')->references('id')->on('contacts');
            $table->bigInteger('contact_relationship_type_id')->unsigned()->nullable()->index();
            $table->foreign('contact_relationship_type_id')->references('id')->on('contact_relationship_types');
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
        Schema::dropIfExists('contact_relationships');
    }
}
