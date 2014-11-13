<?php 
namespace Devfactory\Elshop\Controllers;

use Config;
use View;

class ElshopController extends \BaseController
{
  protected $prefix;

  public function __construct() {
    $this->prefix = Config::get('elshop::route_prefix');
    if (!empty($this->prefix)) {
      $this->prefix = $this->prefix . '.';
    }
    View::composer('elshop::*', 'Devfactory\Elshop\Composers\ElshopComposer');
  }
}
