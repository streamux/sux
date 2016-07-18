<?php

class BaseView extends Object {

	var $class_name = 'base_view';
	var $model = NULL;
	var $controller = NULL;

	function BaseView($m=NULL, $c=NULL) {
		
		$this->model = $m;
		$this->controller = $c;
	}

	function display($className=NULL) {

		$oDB = DB::getInstance();

		if (strlen(stristr($className, '_')) > 0) {
			$tempName = '';
			$str_arr = split('_', $className);

			for ($i=0; $i<count($str_arr); $i++) {
				$tempName .= ucfirst($str_arr[$i]);
			}
			$className = $tempName . "Panel";
		} else {
			$className = ucfirst($className) . "Panel";
		}
		
		$view = new $className($this->model, $this->controller);
		$view->init();

		$oDB->close();
	}

	function init() {}
}
?>