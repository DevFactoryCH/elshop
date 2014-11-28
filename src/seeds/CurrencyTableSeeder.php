<?php

use Illuminate\Database\Seeder;
use Devfactory\Elshop\Models\Currency;

class CurrencyTableSeeder extends Seeder {

  public function run()
  {
    $seed = array(
      'name' => 'Franc Suisse',
      'iso_code' => 'CHF',
      'sign' => 'CHF',
      'status' => 1,
      'default' => 1,
    );
    
    Currency::create($seed);
  }

}