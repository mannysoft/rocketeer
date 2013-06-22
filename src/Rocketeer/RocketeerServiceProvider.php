<?php
namespace Rocketeer;

use Illuminate\Support\ServiceProvider;

class RocketeerServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// Register config file
    $this->app['config']->package('anahkiasen/rocketeer', __DIR__.'/../../config');

    // Register commands
    $this->registerCommands();
	}

	/**
	 * Register the Rocketeer commands
	 */
	protected function registerCommands()
	{
    $this->app->bind('deploy.setup',  function($app) {
    	return new Commands\DeploySetupCommand($app);
    });

    $this->app->bind('deploy.deploy', function($app) {
    	return new Commands\DeployDeployCommand($app);
    });

    $this->commands('deploy.setup', 'deploy.deploy');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('rocketeer');
	}

}