<?php 

namespace Devfactory\Elshop\Composers;

use Config;

class ElshopComposer {
  public function compose($view) {
    $prefix = rtrim(Config::get('elshop::route_prefix'), '.') . '.';
    $layout = (object) array(
      'extends' => Config::get('elshop::config.layout.extends'),
      'header' => Config::get('elshop::config.layout.header'),
      'content' => Config::get('elshop::config.layout.content'),
    );
    $view->with(['prefix' => $prefix, 'layout' => $layout]);
  }
}