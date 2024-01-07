<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('posts')->insert([
      'title' => "Simple post",
      'user_id' => "1",
      'content' => "Content of a simple post",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);
  }
}
