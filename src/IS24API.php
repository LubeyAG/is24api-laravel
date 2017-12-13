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
        $this->is24api =  \Immocaster_Sdk::getInstance('is24',env('IS24API_KEY', 'add IS24API_KEY to env'),env('IS24API_SECRET', 'add IS24API_SECRET to env'));
        if(env('IS24API_LIVE',false)===true)
            $this->is24api->setRequestUrl('live');
        $aDatabase = array(
            env('DB_CONNECTION'),
            env('DB_HOST'),
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_DATABASE')
        );
        $$this->is24api->setDataStorage($aDatabase);
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
