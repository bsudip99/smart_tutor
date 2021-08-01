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
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('students_id');
            $table->unsignedInteger('tutors_id');
            $table->text('chat_text');
          
            // $table->integer('seen')->unsigned();
            $table->enum('sender',['tutor,student']);
            $table->timestamps();

            $table->foreign('students_id')->references('id')->on('students');
            $table->foreign('tutors_id')->references('id')->on('tutors');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat');
    }
}
