<?php
class ModuleHandler
{
	function init()
	{		
		$this->routeCollection();

	}

	function routeCollection() 
	{
		Epi::setPath('base','libs/epiphany');
		Epi::setSetting('exceptions', false);
		Epi::init('route');
		// Epi::init('base','cache','session');
		// Epi::init('base','cache-apc','session-apc');
		// Epi::init('base','cache-memcached','session-apc');

		getRoute()->get('/', array( 'HomeClass', 'display'));
		
		$moduleList = Utils::readDir('modules');
		foreach ($moduleList as $key => $value) {
			$route = strtolower($value['file_name']);
			$class = ucfirst($value['file_name']);

			$this->addRoute( sprintf('/%s', $route), array(  $class, 'display'));
			$this->addRoute( sprintf('/%s/(\d+)', $route), array(  $class, 'display'));			
			
			$classUri = 'modules/'.$route.'/'.$route.'.class.php';
			if (file_exists($classUri)) {
				if (isset($class::$steps) || $class::$steps ) {
					$subRoutes = $class::$steps;					
					foreach ($subRoutes as $key => $value) {						
						$subRoute = strtolower($value);
						//echo $route. '/'.$subRoute . "<br>";
						$this->addRoute( sprintf('/%s/%s', $route, $subRoute), array(  $class, 'display'));
						$this->addRoute( sprintf('/%s/%s/(\d+)', $route, $subRoute), array(  $class, 'display'));
						$this->addRoute( sprintf('/%s/(\d+)/%s', $route, $subRoute), array(  $class, 'display'));
						$this->addRoute( sprintf('/%s/(\d+)/%s/(\d+)', $route, $subRoute), array(  $class, 'display'));				
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

class HomeClass
{	
	static function display( $param)
	{
		include 'index.html';
	}
}
?>