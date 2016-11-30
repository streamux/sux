<?php
class URIToMethod
{
	private static $urlInstance = null;
	var $lists = array();

	public static function getInstance() {

		if (empty(self::$urlInstance)) {
			self::$urlInstance = new self;
		}

		return self::$urlInstance;
	}

	function setURI( $uri ) {

		$arr = array();

		$uri = explode('?', $uri);
		$uri = $uri[0];
		$uries = explode('/', $uri);
		for ($i=2; $i<count($uries); $i++) {				
			if (!is_numeric($uries[$i])) {
				$arr[] = $uries[$i];
			}
		}

		$this->lists['module-key'] = $arr[0];
		$this->lists['action'] =  empty($arr[1]) ?  $this->removeHyphen($arr[0]) : $this->removeHyphen($arr[1]);
		$this->lists['category'] = empty($arr[1]) ?  null : $this->removeHyphen($arr[0]);	
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
			return $this->lists[$key];
		} else {
			return $this->lists;
		}		
	}
}