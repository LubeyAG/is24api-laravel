<?php

namespace Pits\IS24API;

use Config;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Class ServiceProvider
 * @version 1.0
 * @package Pits\IS24API
 */
class ServiceProvider extends LaravelServiceProvider
{
	protected $constantsMap = [
		'K_TIMEZONE'                    => 'timezone',
	];

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$configPath = dirname(__FILE__) . '/../config/is24api.php';
		$this->mergeConfigFrom($configPath, 'is24api');
		$this->app->singleton('is24api', function ($app) {
			return new IS24API($app);
		});
	}

	public function boot()
	{
		if (!defined('K_IS24API_EXTERNAL_CONFIG')) {
			define('K_IS24API_EXTERNAL_CONFIG', true);
		}
		foreach ($this->constantsMap as $key => $value) {
			$value = Config::get('is24api.' . $value, null);
			if (!is_null($value) && !defined($key)) {
				if (is_string($value) && strlen($value) == 0) {
					continue;
				}
				define($key, $value);
			}
		}
		$configPath = dirname(__FILE__) . '/../config/is24api.php';
		$this->publishes(array($configPath => config_path('is24api.php')), 'config');
	}

	public function provides()
	{
		return ['is24api'];
	}
}