<?php

namespace Pits\IS24API;

use Config;

class IS24API
{
	protected static $format;
	
	protected $app;
	/** @var  TCPDFHelper */
	protected $is24api;

	public function __construct($app)
	{
		$this->app = $app;
		$this->reset();
	}

	public function reset()
	{
		$this->is24api =  Immocaster_Sdk::getInstance('is24','ley','secret');
	}

	public static function changeFormat($format)
	{
		static::$format = $format;
	}

	public function __call($method, $args)
	{
		if (method_exists($this->is24api, $method)) {
			return call_user_func_array([$this->is24api, $method], $args);
		}
		throw new \RuntimeException(sprintf('the method %s does not exists in Immocaster SDK', $method));
	}

}
