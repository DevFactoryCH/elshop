<?php

use Illuminate\Database\Seeder;
use Devfactory\Elshop\Models\Language;


class LanguageTableSeeder extends Seeder {

  public function run()
  {
    $seed = array(
      'name' => 'Français',
      'iso_code' => 'fr',
      'code' => 'fr_FR',
      'status' => 1,
      'default' => 1,
    );
    
    Language::create($seed);
  }

}