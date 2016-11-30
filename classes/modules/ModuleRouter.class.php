<?php
class ModuleRouter
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
		Epi::setPath('base','libs/epiphany');
		Epi::setSetting('exceptions', false);
		Epi::init('route');
		// Epi::init('base','cache','session');
		// Epi::init('base','cache-apc','session-apc');
		// Epi::init('base','cache-memcached','session-apc');

		getRoute()->get('/', array( 'ModuleHandler', 'display'));
		
		$moduleList = Utils::readDir('modules');
		foreach ($moduleList as $key => $value) {
			$dirName = strtolower($value['file_name']);
			$Class = ucfirst($dirName);

			// module class and admin class
			$classUri = 'modules/'.$dirName.'/'.$dirName.'.class.php';
			if (file_exists($classUri)) {			
				if (isset($Class::$action) && $Class::$action !== '') {

					$action = $Class::$action;					
					foreach ($action as $key => $value) {			
						$routeKey = strtolower($value);							
						$tempArr = explode('/', $routeKey);

						// 빈배열제거 
						$routeKeys = array_values(array_filter(array_map('trim',$tempArr)));
						$context->setModule($routeKeys[0], $Class)	;
						//echo $routeKeys[0] . ' : ' . $Class . "<br>";

						if (isset($Class::$categories) &&  count($Class::$categories) > 0){							
							foreach ($Class::$categories as $key => $value) {

								if (isset($value)) {
									$shotKeys = array_slice($routeKeys, 0);
									$shotKeys[2] = $shotKeys[1];
									$shotKeys[1] = $shotKeys[0];
									$shotKeys[0] = $value;
								}
								$context->setModule($shotKeys[0], $Class)	;
								//echo $shotKeys[0] . ' : ' . $shotKeys[1] . ' : ' . $shotKeys[2] . "<br>";

								$this->addRoute( sprintf('/%s', $shotKeys[0]), array( 'ModuleHandler', 'display'));
								$this->addRoute( sprintf('/%s/(\d+)', $shotKeys[0]), array( 'ModuleHandler', 'display'));

								if (!empty($shotKeys[1])) {
									$this->addRoute( sprintf('/%s/%s', $shotKeys[0], $shotKeys[1]), array( 'ModuleHandler', 'display'));
									$this->addRoute( sprintf('/%s/%s/(\d+)', $shotKeys[0], $shotKeys[1]), array( 'ModuleHandler', 'display'));
									$this->addRoute( sprintf('/%s/(\d+)/%s', $shotKeys[0], $shotKeys[1]), array( 'ModuleHandler', 'display'));
									$this->addRoute( sprintf('/%s/(\d+)/%s/(\d+)', $shotKeys[0], $shotKeys[1]), array( 'ModuleHandler', 'display'));
								}
							}
						} else {

							$this->addRoute( sprintf('/%s', $routeKeys[0]), array( 'ModuleHandler', 'display'));
							$this->addRoute( sprintf('/%s/(\d+)', $routeKeys[0]), array( 'ModuleHandler', 'display'));

							if (!empty($routeKeys[1])) {
								$this->addRoute( sprintf('/%s/%s', $routeKeys[0], $routeKeys[1]), array( 'ModuleHandler', 'display'));
								$this->addRoute( sprintf('/%s/%s/(\d+)', $routeKeys[0], $routeKeys[1]), array( 'ModuleHandler', 'display'));
								$this->addRoute( sprintf('/%s/(\d+)/%s', $routeKeys[0], $routeKeys[1]), array( 'ModuleHandler', 'display'));
								$this->addRoute( sprintf('/%s/(\d+)/%s/(\d+)', $routeKeys[0], $routeKeys[1]), array( 'ModuleHandler', 'display'));
							}
						}													
					}								
				}
			}
		 }
		  getRoute()->run();
	}

	function addRoute( $route, $class)
	{
		getRoute()->get( $route, $class);
		getRoute()->post( $route, $class);
	}
}
?>