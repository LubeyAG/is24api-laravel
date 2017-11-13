<?php

namespace Pits\IS24API;

use Config;

class IS24API
{
	protected static $format;
	protected $app;
	protected $is24api;

    public function __construct($app)
    {
        $this->app = $app;
        $this->start();
    }

    public function start()
    {
        $this->is24api =  \Immocaster_Sdk::getInstance('is24',env('IS24API_KEY', '06846297'),env('IS24API_SECRET', 'x11QwA0qgSQYgVBE'));
    }

	public static function changeFormat($format)
	{
		static::$format = $format;
	}

	public function __call($method, $args)
	{
        return call_user_func_array([$this->is24api, $method], $args);
/*
 *  SUCKS
        if (method_exists($this->is24api, $method)) {
			return call_user_func_array([$this->is24api, $method], $args);
		}
		throw new \RuntimeException(sprintf('the method %s does not exists in Immocaster SDK', $method));
*/
	}
    public function  dump() {
        dump($this->is24api);
    }

}
