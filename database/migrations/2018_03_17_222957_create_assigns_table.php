<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leave_id');
            $table->char('date');
            $table->char('day');
            $table->char('time');
            $table->boolean('is_assigned')->default(false);
            $table->char('assignee')->nullable();
            $table->char('assignee_status')->default('pending');
            $table->char('hod_status')->default('pending');
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
        Schema::dropIfExists('assigns');
    }
}
