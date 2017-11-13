<?php

namespace Pits\IS24API;

use Config;

class IS24API
{
	protected static $format;
	protected $app;
	protected $is24api;

    public function __construct($app,$key,$secret)
    {
        $this->app = $app;
        $this->start($key,$secret);
    }

    public function start($key,$secret)
    {
        $this->is24api =  \Immocaster_Sdk::getInstance('is24',$key,$secret);
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
