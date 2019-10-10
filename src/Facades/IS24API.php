<?php
namespace LubeyAG\IS24API\Facades;

use Illuminate\Support\Facades\Facade;

class IS24API extends Facade
{
	protected static function getFacadeAccessor(){return 'is24api';}
}