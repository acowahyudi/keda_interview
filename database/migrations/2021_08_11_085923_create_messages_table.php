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

            $table->unsignedBigInteger('receive_id');
            $table->foreign('receive_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->unsignedBigInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->unsignedBigInteger('user_reported_id')->nullable();
            $table->foreign('user_reported_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->unsignedBigInteger('type_message_id');
            $table->foreign('type_message_id')->references('id')->on('type_messages')->onUpdate('CASCADE')->onDelete('SET NULL');

            $table->string('text');
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
