<?php
class CacheFile
{
	static $mInstance = null;

	public static function getInstance() {

		if (empty($mInstance)) {
			$mInstance = new self;
		}
		return $mInstance;
	}

	function getRealPath($path) {

		if(strlen($path) >= 2 && substr_compare($path, './', 0, 2) === 0) {

			return _SUX_PATH_ . substr($path, 2);
		}
		return $path;
	}

	function readFile($path, $key=null) {

		$filename = self::getRealPath($path);
		if (!file_exists($filename)) {
			return false;
		}
		$result = include($filename);
		return (isset($key) && $key) ? $result[$key] : $result;
	}

	function writeFile($path, $buff, $mode="w") {

		$contents = array();	
		$contents[] = "<?php";
		$contents[] = "\$result = array();";
		foreach ($buff as $key => $sources) {
			$str = "\$" . $key . " = array(";
			$index = 0;
			foreach ($sources as $item => $value) {
				$str .= ($index === 0) ? "" : ",";
				if (is_int($item)) {
					$str .= "'".$value."'";
				} else {
					$str .= "'".$item."'=>'".$value."'";
				}				
				$index++;
			}
			$str .= ");";			
			$contents[] = $str;
			$contents[] = "\$result['" . $key ."'] = \$" . $key . ";";
		}
		$contents[] = "return \$result;";
		
		$buff = implode(PHP_EOL, $contents);
		$result = FileHandler::writeFile($path, $buff);
		return $result;
	}
}