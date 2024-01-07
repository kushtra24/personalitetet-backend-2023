<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('categories')->insert([
      'name' => "MBTI",
      'slug' => "MBTI",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('categories')->insert([
      'name' => "INFJ",
      'slug' => "INFJ",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('categories')->insert([
      'name' => "INTJ",
      'slug' => "INTJ",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('categories')->insert([
      'name' => "ENFJ",
      'slug' => "ENFJ",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);
  }
}
