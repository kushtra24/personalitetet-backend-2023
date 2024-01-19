<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('tipis')->insert([
      'type' => "INTJ",
      'name' => "Arkitekti",
      'type_img' => "images/INTJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "INFJ",
      'name' => "KËSHILLUESI",
      'type_img' => "images/INFJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ISTJ",
      'name' => "INSPEKTORI",
      'type_img' => "images/ISTJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ISFJ",
      'name' => "Mbrojtësi",
      'type_img' => "images/ISFJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "INTP",
      'name' => "Mendimtari",
      'type_img' => "images/INTP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "INFP",
      'name' => "NDËRMJETËSUESI",
      'type_img' => "images/INFP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ISTP",
      'name' => "I SHKATHËTI",
      'type_img' => "images/ISTP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ISFP",
      'name' => "Aventuristi",
      'type_img' => "images/ISFP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ENTJ",
      'name' => "KOMANDANTI",
      'type_img' => "images/ENTJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ENFJ",
      'name' => "Protagonisti",
      'type_img' => "	images/ENFJ.png	",
      'feat_img' => "	images/feat-ESTP.png	",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);


    DB::table('tipis')->insert([
      'type' => "ESTJ",
      'name' => "zbatuesi",
      'type_img' => "images/ESTJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ESFJ",
      'name' => "Ofruesi",
      'type_img' => "images/ESFJ.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ENTP",
      'name' => "debatuesi",
      'type_img' => "images/ENTP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ENFP",
      'name' => "Përkrahësi",
      'type_img' => "images/ENFP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ESTP",
      'name' => "sipërmarrësi",
      'type_img' => "images/ESTP.png",
      'feat_img' => "images/feat.png",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);

    DB::table('tipis')->insert([
      'type' => "ESFP",
      'name' => "ARGËTUESI",
      'type_img' => "images/ESFP.png",
      'feat_img' => "	images/feat-ESTP.png	",
      'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
    ]);
  }
}
