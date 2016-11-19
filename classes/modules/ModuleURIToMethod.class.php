<?php
class ModuleURIToMethod
{
	private static $urlInstance = null;
	var $methodes = array();

	public static function getInstance() {

		if (empty(self::$urlInstance)) {
			self::$urlInstance = new self;
		}

		return self::$urlInstance;
	}

	function setURI( $uri ) {

		$arr = array();
		$uries = explode('/', $uri);
		for ($i=2; $i<count($uries); $i++) {				
			if (!is_numeric($uries[$i])) {
				$arr[] = $uries[$i];
			}
		}
		$action = $this->removeHyphen($arr[1]);		
		$this->methodes['module'] = $arr[0];
		$this->methodes['action'] = $action;
	}

	function removeHyphen( $action ) {

		if (strstr($action, '-') != -1) {
			$pieces = explode('-', $action);
			$action = $pieces[0];
			for ($i=1; $i<count($pieces); $i++) {
				$action .= ucfirst($pieces[$i]);
			}
		}
		return $action;
	}

	function getMethod( $key) {

		if (isset($key)) {
			return $this->methodes[$key];
		} else {
			return $this->methodes;
		}		
	}
}