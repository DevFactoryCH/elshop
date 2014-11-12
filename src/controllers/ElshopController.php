<?php 
namespace Devfactory\Elshop\Controllers;

use Config;

class ElshopController extends \BaseController
{
  protected $prefix;

  public function __construct() {
    $this->prefix = Config::get('elshop::route_prefix');
    if (!empty($this->prefix)) {
      $this->prefix = $this->prefix . '.';
    }
  }
}
