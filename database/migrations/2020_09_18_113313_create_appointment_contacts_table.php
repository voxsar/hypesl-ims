<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointment_contacts', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('contact_id')->unsigned()->nullable()->index();
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('set null')->onUpdate('set null');

            $table->bigInteger('appointment_id')->unsigned()->nullable()->index();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('appointment_contacts');
    }
}
