<?php
namespace App;

class Configure {
	
	private static $instanceConfigure = null;
	
	private static function getInstance() {
		if (!isset(self::$instanceConfigure))
		{
			$configure = parse_ini_file(__DIR__ . '/../Config/chat.'.APP_MODE.'.ini', true);
			self::$instanceConfigure = $configure;
		}
		if (empty(self::$instanceConfigure))
		{
			exit("lack of configure");
		}
		return self::$instanceConfigure;
	}
	
	public static function getKey($key = '')
	{
		 $instanceConfigure = self::getInstance();
		 return isset($instanceConfigure[$key]) ? $instanceConfigure[$key] : $instanceConfigure;
	}
	
}
