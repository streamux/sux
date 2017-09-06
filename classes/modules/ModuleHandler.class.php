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

	public function init()
	{
		$context = Context::getInstance();
		$cookieId = $context->getCookieId();
		$hasCookieVersion = $context->getCookie($cookieId);
		if (!$hasCookieVersion) {
			$context->setCookie($cookieId, date('Y-m-d H:i:s'), time() + 86400 * 30 * 12);
			//echo 'set cookie version is ' . date('Y-m-d H:i:s') . ' : location -> 25 line in ModuleHandler.class.php' . "<br>";
		} else {
			$isEqual = $context->equalVersion($cookieId);
			if (!$isEqual) {				
				$context->makeRouteCaches();
				/*echo 'cookie version is different : location -> 28 line in ModuleHandler.class.php' . "<br>";
				echo 'cookie version - ' . $hasCookieVersion . "<br>";
				exit;*/
			}
			
		}
		
		$router = RouterModule::getInstance();
		if ($context->installed()) {
			$router->init();
		} else {
			$router->install(); 
		}		
	}
}