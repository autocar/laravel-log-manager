<?php namespace autocar\LaravelLogManager;

use Illuminate\Support\ServiceProvider;

class LaravelLogManagerServiceProvider extends ServiceProvider {

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
		//
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		/*$this->app['logmanager'] = $this->app->share(function($app)
        	{
            		return new LaravelLogManager;
        	});*/
		$this->app->singleton('logmanager', function () {
            		return $this->app->make('autocar\LaravelLogManager\LaravelLogManager');
        	});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('logmanager');
	}

}
