<?php
class ModuleCache
{
	static $mInstance = null;

	public static function getInstance() {

		if (empty($mInstance)) {
			$mInstance = new self;
		}
		return $mInstance;
	}

	function saveCacheForRoute($path, $routes=null) {

		$context = Context::getInstance();
		$returnURL = $context->getServer('REQUEST_URI');

		if (!file_exists($path)) {
			$msg = 'Path do not exists';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			return false;
		}

		if ($routes === null || count($routes) === 0) {
			$msg = 'Route is not available';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			return false;
		}

		$pregSplit = preg_split('/[\/]/i', $path);
		$fileName = $pregSplit[count($pregSplit)-1];
		$fp = fopen($path, 'w');
		if (!$fp) {

			$msg .= $fileName . ' is failed to open';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			return false;
		} else {

			$str = "";	
			$str .= "<?php\n";
			$str .= "/**\n";
			$str .= " * @var  categories, action\n";
			$str .= " * They're value is used as a route uri of get method and a name of class's method\n";
			$str .= " */\n";

			foreach ($routes as $key => $route) {
				
				$str .= "\$".$key." = array(";
				$index = 0;
				foreach ($route as $key => $value) {
					$str .= ($index === 0) ? "" : ",";
					$str .= "'".$value."'";
					$index++;
				}
				$str .= ");\n";
			}
			fwrite($fp, $str, strlen($str));	

			$result = @chmod($path,0777);
			if (!$result) {
				$msg .= $fileName . ' is failed to setup permission';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				return false;
			}
			unset($categories);
			unset($action);		
		}		
		fclose($fp);

		return true;
	}
}