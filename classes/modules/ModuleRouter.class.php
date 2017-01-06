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
			$ClassName = ucfirst($dirName);
			/*if (!preg_match('/^(board)+/i', $ClassName)) {
				continue;
			}*/

			// module class and admin class
			$classList = array();
			$classList[] = array( 'class'=>$ClassName,
								'path'=>'files/caches/routes/' . $dirName . '.cache.php');
			$classList[] = array( 'class'=>$ClassName."Admin",
								'path'=>'files/caches/routes/' . $dirName . '.admin.cache.php');

			for($i=0; $i<count($classList); $i++) {

				$cachePath = _SUX_PATH_ . $classList[$i]['path'];				
				if (file_exists($cachePath)) {
					
					//echo $cachePath . "<br>";
					$Class = $classList[$i]['class'];
					$actionList = $this->getRoute('action', $cachePath);
					if ($actionList !== null &&  count($actionList) > 0) {						
			
						foreach ($actionList as $key => $value) {			
							$routeKey = strtolower($value);							
							$tempArr = explode('/', $routeKey);

							// 빈배열제거 
							$routeKeys = array_values(array_filter(array_map('trim',$tempArr)));
							$context->setModule($routeKeys[0], $Class)	;
							//echo  $Class . ' : ' . $routeKeys[0] . "<br>";

							$categoryList = $this->getRoute('categories', $cachePath);
							if ($categoryList !== null &&  count($categoryList) > 0){							
								foreach ($categoryList as $key => $value) {

									if (isset($value)) {
										$shotKeys = array_slice($routeKeys, 0);
										$shotKeys[1] = $shotKeys[0];
										$shotKeys[0] = $value;
									}
									$context->setModule($shotKeys[0], $Class)	;
									//echo $Class . ' : ' . $shotKeys[0] . ' : ' . $shotKeys[1] . "<br>";

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
					} else {
						printf("[ %sClass ] An Error Occurred<br>", $ClassName);	
					}
				}
			}			
		}
		getRoute()->run();
	}

	function addRoute( $route, $class)
	{
		//echo $route . "<br>";
		getRoute()->get( $route, $class);
		getRoute()->post( $route, $class);
	}

	function getRoute($key, $cache_path) {

		$file = $cache_path;
		$tempList = preg_split('/\//', $file);
		$fileName = $tempList[count($tempList)-1];
		if (file_exists($file)) {
			include($file);
			$result = ${$key};
			unset(${$key});
		} else {
			printf("[ %s ] Cache File don't exist<br>", $fileName);
		}
		
		return $result;
	}
}