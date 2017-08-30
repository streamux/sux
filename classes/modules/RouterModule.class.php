<?php
class RouterModule
{
	static $aInstance = null;
	static $cache_data = null;

	public static function &getInstance()
	{
		if (empty(self::$aInstance)) {
			self::$aInstance = new self;			
		}
		return self::$aInstance;
	}

	private function defaultSetting() {

		Epi::setPath('base', _SUX_PATH_ . 'vendor/jmathai/epiphany/src');
		Epi::setSetting('exceptions', false);
		Epi::init('route');	

		// Epi::init('base','cache','session');
		// Epi::init('base','cache-apc','session-apc');
		// Epi::init('base','cache-memcached','session-apc');
	}

	public function init() 
	{
		$this->defaultSetting();

		$context = Context::getInstance();
		getRoute()->get('/', array( 'PageModule', 'display'));


		$moduleList = Utils::readDir('modules');
		foreach ($moduleList as $key => $value) {
			$dirName = strtolower($value['file_name']);
			$ClassName = ucfirst($dirName);

			// module class and admin class
			$classList = array();
			$classList[] = array( 'class'=>$ClassName,
								'path'=>'./files/caches/routes/' . $dirName . '.cache.php');
			$classList[] = array( 'class'=>$ClassName."Admin",
								'path'=>'./files/caches/routes/' . $dirName . '.admin.cache.php');

			for($i=0; $i<count($classList); $i++) {

				$cachePath = $classList[$i]['path'];		
				if (file_exists($cachePath)) {

					$this->loadCacheFile($cachePath);
					
					//echo $cachePath . "<br>";
					$Class = $classList[$i]['class'];
					$actionList = $this->getRoute('action');
					if ($actionList !== null &&  count($actionList) > 0) {						
			
						foreach ($actionList as $key => $value) {			
							$routeKey = strtolower($value);							
							$tempArr = explode('/', $routeKey);

							// 빈배열제거 
							$routeKeys = array_values(array_filter(array_map('trim',$tempArr)));
							$context->setModule($routeKeys[0], $Class)	;
							//echo  $Class . ' : ' . $routeKeys[0] . "<br>";

							$categoryList = $this->getRoute('categories');
							if ($categoryList !== null &&  count($categoryList) > 0){							
								foreach ($categoryList as $key => $value) {

									if (isset($value)) {
										$shotKeys = array_slice($routeKeys, 0);
										$shotKeys[1] = $shotKeys[0];
										$shotKeys[0] = $value;
									}
									$context->setModule($shotKeys[0], $Class)	;
									//echo $Class . ' : ' . $shotKeys[0] . ' : ' . $shotKeys[1] . "<br>";

									$this->addRoute( sprintf('/%s', $shotKeys[0]), array( 'PageModule', 'display'));
									$this->addRoute( sprintf('/%s/(\d+)', $shotKeys[0]), array( 'PageModule', 'display'));

									if (!empty($shotKeys[1])) {
										$this->addRoute( sprintf('/%s/%s', $shotKeys[0], $shotKeys[1]), array( 'PageModule', 'display'));
										$this->addRoute( sprintf('/%s/%s/(\d+)', $shotKeys[0], $shotKeys[1]), array( 'PageModule', 'display'));
										$this->addRoute( sprintf('/%s/(\d+)/%s', $shotKeys[0], $shotKeys[1]), array( 'PageModule', 'display'));
										$this->addRoute( sprintf('/%s/(\d+)/%s/(\d+)', $shotKeys[0], $shotKeys[1]), array( 'PageModule', 'display'));
									}
								}
							} else {

								$this->addRoute( sprintf('/%s', $routeKeys[0]), array( 'PageModule', 'display'));
								$this->addRoute( sprintf('/%s/(\d+)', $routeKeys[0]), array( 'PageModule', 'display'));

								if (!empty($routeKeys[1])) {
									$this->addRoute( sprintf('/%s/%s', $routeKeys[0], $routeKeys[1]), array( 'PageModule', 'display'));
									$this->addRoute( sprintf('/%s/%s/(\d+)', $routeKeys[0], $routeKeys[1]), array( 'PageModule', 'display'));
									$this->addRoute( sprintf('/%s/(\d+)/%s', $routeKeys[0], $routeKeys[1]), array( 'PageModule', 'display'));
									$this->addRoute( sprintf('/%s/(\d+)/%s/(\d+)', $routeKeys[0], $routeKeys[1]), array( 'PageModule', 'display'));
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

	public function install()
	{
		$this->defaultSetting();
		$context = Context::getInstance();
		getRoute()->get('/', array( 'PageModule', 'display'));

		$moduleList = Utils::readDir('modules');
		foreach ($moduleList as $key => $value) {

			$dirName = strtolower($value['file_name']);
			if (preg_match('/^(install)+$/', $dirName)) {
				$ClassName = ucfirst($dirName);
				break;
			}
		}

		if (empty($ClassName)) {
			echo 'Install Module do not exist';
			return;
		}

		/**
		 * 모듈,카테고리, 메서드명 키워드를 이용해서  클래스명을 얻을 수 있도록 등록한다.
		 * PageModule Class 에서 키워드를 이용해서 클래스명을 찾아 사용한다.
		 * */
		$context->setModule($dirName, $dirName);
		$action = $ClassName::$action;

		for ($i=0; $i<count($action); $i++) {
			$context->setModule($action[$i], $dirName);
			$this->addRoute( sprintf('/%s', $action[$i]), array( 'PageModule', 'display'));
		}

		getRoute()->run();
	}

	private function addRoute( $route, $class)
	{
		//echo $route . "<br>";
		getRoute()->get( $route, $class);
		getRoute()->post( $route, $class);
	}

	private function loadCacheFile($path) {

		$filename = $this->getRealPath($path);
		$pathinfo = pathinfo($file);

		$this->cache_data = array('categories'=>null, 'action'=>null);

		if (file_exists($filename)) {
			include($filename);			
			foreach ($this->cache_data as $key => $value) {
				$this->cache_data[$key] = ${$key};
				unset(${$key});
			}			
		} else {
			printf("[ %s ] Cache File don't exist<br>", $$pathinfo['filename']);
		}		
	}

	private function getRoute($key) {
		
		return $this->cache_data[$key];
	}

	private function getRealPath($path) {

		if(strlen($path) >= 2 && substr_compare($path, './', 0, 2) === 0) {

			return _SUX_PATH_ . substr($path, 2);
		}
		return $path;
	}
}