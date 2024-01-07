<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('first_name');
      $table->string('last_name');
      $table->date('age')->nullable();
      $table->string('email', 128)->unique();
      $table->string('password');
      $table->string('adresa')->nullable();
      $table->string('shteti')->nullable();
      $table->string('shkollimi')->nullable();
      $table->string('vendlindja')->nullable();
      $table->string('gjinia')->nullable();
      $table->string('hobby')->nullable();
      $table->tinyInteger('verified')->default(0);
      $table->string('email_token')->nullable();
      $table->rememberToken();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('users');
  }
};
