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

	function readColumnsForQuery($path) {

		if (!file_exists($path)) {
			$msg = "QueryCacheFile Dont Exists";
			UIError::alert($msg);
			exit();
		}

		$contents = include($path);
		return $contents;
	}

	function writeColumnsForQuery($path, $souces=null) {

		$context = Context::getInstance();
		$returnURL = $context->getServer('REQUEST_URI');

		if ($souces === null || count($souces) === 0) {
			$msg = 'Souces is not available';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit();
		}

		$pregSplit = preg_split('/[\/]/i', $path);
		$fileName = $pregSplit[count($pregSplit)-1];
		$fp = fopen($path, 'w');
		if (!$fp) {

			$msg .= $fileName . ' is failed to open';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit();
		} else {
		
			$content = array();	
			$content[] = "<?php";
			$str = "\$columns = array(";
			$index = 0;
			foreach ($souces as $key => $value) {
				$str .= ($index === 0) ? "" : ",";
				$str .= "'".$value."'";
				$index++;
			}
			$str .= ");";
			$content[] = $str;
			$content[] = "return \$columns;";
			$content[] = "?>";

			$buffer = implode(PHP_EOL, $content);
			@file_put_contents($path, $buffer);
			@chmod($path, 0644);
		}		
		fclose($fp);
		$fp = null;

		return true;
	}

	function saveRoute($path, $sources=null) {

		$context = Context::getInstance();
		$returnURL = $context->getServer('REQUEST_URI');

		if ($sources === null || count($sources) === 0) {
			$msg = 'Route List is not available';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit();
		}

		$pregSplit = preg_split('/[\/]/i', $path);
		$fileName = $pregSplit[count($pregSplit)-1];
		$fp = fopen($path, 'w');
		if (!$fp) {

			$msg .= $fileName . ' is failed to open';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit();
		} else {

			$content = array();	
			$content[] = "<?php";
			$content[] = "/**";
			$content[] = " * @var  categories, action";
			$content[] = " * They're value is used as a route uri of get method and a name of class\'s method";
			$content[] = " */";

			foreach ($sources as $key => $source) {

				$str = "\$".$key." = array(";
				$index = 0;
				foreach ($source as $key => $value) {
					$str .= ($index === 0) ? "" : ",";
					$str .= "'".$value."'";
					$index++;
				}
				$str .= ");";
				$content[] = $str;
			}
			$buffer = implode(PHP_EOL, $content);
			fwrite($fp, $buffer, strlen($buffer));

			@chmod($path,0777);
			unset($categories);
			unset($action);		
		}		
		fclose($fp);
		$fp = null;

		return true;
	}
}