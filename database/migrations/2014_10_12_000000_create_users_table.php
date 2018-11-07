<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->string('email')->unique();
      $table->string('password')->nullable();
      $table->string('braintree_customer_id')->nullable();
      $table->string('facebook_id')->nullable();
      $table->string('google_id')->nullable();
      $table->string('twitter_id')->nullable();
      $table->rememberToken();
      $table->timestamps();
      $table->boolean('activated')->default(false);
    });
  }

  public function down()
  {
    Schema::dropIfExists('users');
  }
}
