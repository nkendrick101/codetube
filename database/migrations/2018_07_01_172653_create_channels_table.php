<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
  public function up()
  {
    Schema::create('channels', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->string('name');
      $table->string('slug')->unique();
      $table->enum('visibility', ['public', 'private'])->default('public');
      $table->text('description')->nullable();
      $table->string('image')->url()->default('https://storage.googleapis.com/images_codetube/15be05cedc24d1.png');
      $table->timestamps();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  public function down()
  {
    Schema::dropIfExists('channels');
  }
}
