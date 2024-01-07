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
    Schema::create('test_counters', function (Blueprint $table) {
      $table->bigInteger('test_counter');
    });

    // DB::table('test_counters')->insert([
    //   'test_counter' => "0",
    // ]);
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('test_counter');
  }
};
