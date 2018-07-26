<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_chat', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('event-id');
          $table->integer('user_id');
          $table->string('trainer_name', 15);
          $table->integer('trainer_team');
          $table->string('comment', 255);
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
        Schema::dropIfExists('event_chat');
    }
}
