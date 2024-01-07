<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      // $this->call(RoleTableSeeder::class);
      $this->call(RoleSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(tipiSeeder::class);
      // $this->call(questionsSeeder::class);
      $this->call(postSeeder::class);
      // $this->call(CategoryTableSeeder::class);
      $this->call(pageSeeder::class);
      // $this->call(AnswerTableSeeder::class);
    }
}
