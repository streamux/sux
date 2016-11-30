<?php

class View extends Object {

	var $class_name = 'base_view';
	var $model = NULL;
	var $controller = NULL;
	var $copyright_path = '';

	function __construct($m=NULL, $c=NULL) {
		
		$this->model = $m;
		$this->controller = $c;
	}

	function display( $methodName, $category=null, $mid=-1, $id=-1) {
		
		$methodName = 'display' . ucfirst($methodName);
		$this->defaultSetting();
		$this->{$methodName}( $category, $mid, $id);
	}

	function defaultSetting() {

		$this->copyright_path = _SUX_PATH_ . 'modules/admin/tpl/copyright.tpl';
	}

	function output() {

		echo '이글이 보인다면 상위 클래스 View의 output() 메서드를 오버라이드해서 사용하세요.<br>';
	}	
}
?>