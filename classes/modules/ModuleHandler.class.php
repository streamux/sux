<?php

/**
*  @class ModuleHandler
*/
class ModuleHandler
{
	static $aInstance = null;

	public static function &getInstance()
	{
		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}

	function init()
	{		
		$context = Context::getInstance();
		$cookieId = $context->getCookieId();
		$cookieVersion = $context->getCookie($cookieId);
		if (!$cookieVersion) {
			$context->setCookie($cookieId, date('Y-m-d H:i:s'), time() + 86400 * 30 * 12);
		} else {
			if ($context->equalVersion($cookieId) !== true) {
				$context->makeRouteCaches();
			}
		}

		$router = RouterModule::getInstance();
		if ($context->installed()) {
			$router->init();
		} else {
			$router->install(); 
		}
		
	}

	function install()
	{
		$router = RouterModule::getInstance();
		$router->install();
	}
}