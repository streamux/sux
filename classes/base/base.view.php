<?php

class BaseView extends Object {

	var $class_name = 'base_view';
	var $model = NULL;
	var $controller = NULL;

	function __construct($m=NULL, $c=NULL) {
		
		$this->model = $m;
		$this->controller = $c;
	}

	function display($className=NULL) {

		$oDB = DB::getInstance();

		$methodName = $className;

		if (preg_match('/(log|fail|leave|searchid|searchpwd)/i', $className)) {
			$methodName = 'display' . ucfirst($methodName);
			$this->{$methodName}();
		} else {
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
		}

		$oDB->close();	
	}

	function output() {

		echo '이글이 보인다면 상위 클래스 BaseView의 output() 메서드를 오버라이드해서 사용하세요.<br>';
	}

	function callback($data) {

		$context = Context::getInstance();
		$callback = $context->getRequest('callback');
		$strJson = JsonEncoder::parse($data);
		return $callback . '('.$strJson.')';
	}
}
?>