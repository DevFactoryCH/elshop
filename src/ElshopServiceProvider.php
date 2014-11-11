<?php namespace Devfactory\Elshop;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ElshopServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot()
  {
    $this->package('devfactory/elshop', 'elshop', __DIR__);
    include __DIR__ . 'routes.php';
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return array();
  }

}
