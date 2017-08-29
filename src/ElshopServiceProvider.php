<?php 

namespace Devfactory\Elshop;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Route;

class ElshopServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  /**
   * Where the route file lives, both inside the package and in the app (if overwritten).
   *
   * @var string
   */
  public $routeFilePath = '/routes/elshop/base.php';

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot()
  {
    $this->loadViewsFrom(resource_path('views/vendor/backpack/base'), 'elshop');
    $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'elshop');

    $this->setupRoutes($this->app->router);
    $this->publishConfig();
    $this->publishFiles();
    $this->publishMigration();
  }

  /**
   * Define the routes for the application.
   *
   * @param \Illuminate\Routing\Router $router
   *
   * @return void
   */
  public function setupRoutes(Router $router)
  {
    // by default, use the routes file provided in vendor
    $routeFilePathInUse = __DIR__ . $this->routeFilePath;
    // but if there's a file with the same name in routes/backpack, use that one
    if (file_exists(base_path().$this->routeFilePath)) {
      $routeFilePathInUse = base_path() . $this->routeFilePath;
    }

    $this->loadRoutesFrom($routeFilePathInUse);
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->app->bind('elshop', function ($app) {
        return new Elshop($app);
    });
  }

  protected function publishConfig() {
    $this->publishes([
      __DIR__ . '/config' => config_path(),
    ]);
  }

  public function publishFiles()
  {
    $this->publishes([
      __DIR__.'/resources/views' => resource_path('views/vendor/elshop')
    ], 'views');

    $this->publishes([
      __DIR__.'/resources/lang' => resource_path('lang/vendor/elshop')
    ], 'lang');
  }

  /**
   * Publish the migration stub
   */
  protected function publishMigration() {
    $this->publishes([
      __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
    ], 'migrations');
  }
}
