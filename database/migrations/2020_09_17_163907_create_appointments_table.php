<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->boolean('allday')->nullable()->default(false);
            $table->datetime('start')->nullable()->useCurrent();
            $table->datetime('end')->nullable()->useCurrent();


            $table->string('title');
            $table->string('status')->nullable()->default('Pending');
            $table->text('description')->nullable();
            $table->string('url')->nullable()->length(500);
            $table->string('classnames')->nullable();
            $table->boolean('editable')->nullable()->default(false);
            $table->boolean('starteditable')->nullable()->default(false);
            $table->boolean('durationeditable')->nullable()->default(false);
            $table->boolean('resourceeditable')->nullable()->default(false);
            $table->string('display')->nullable();
            $table->boolean('overlap')->nullable()->default(false);
            $table->string('backgroundcolor')->nullable();
            $table->string('bordercolor')->nullable();
            $table->string('textcolor')->nullable();
            $table->json('extendedprops')->nullable();

            $table->json('daysofweek')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->date('startrecur')->nullable();
            $table->date('endrecur')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->bigInteger('appointment_color_id')->unsigned()->nullable()->index();
            $table->foreign('appointment_color_id')->references('id')->on('appointment_colors')->onDelete('set null')->onUpdate('set null');

            $table->bigInteger('appointment_group_id')->unsigned()->nullable()->index();
            $table->foreign('appointment_group_id')->references('id')->on('appointment_groups')->onDelete('set null')->onUpdate('set null');

            $table->bigInteger('appointment_type_id')->unsigned()->nullable()->index();
            $table->foreign('appointment_type_id')->references('id')->on('appointment_types')->onDelete('set null')->onUpdate('set null');

            $table->bigInteger('appointment_constraint_id')->unsigned()->nullable()->index();
            $table->foreign('appointment_constraint_id')->references('id')->on('appointment_constraints')->onDelete('set null')->onUpdate('set null');

            $table->bigInteger('team_id')->unsigned()->nullable()->index();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
