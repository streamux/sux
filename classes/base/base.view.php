<?php

class BaseView {

	var $name = 'base_view';
	var $model = NULL;
	var $controller = NULL;

	function BaseView($m=NULL, $c=NULL) {
		
		$this->model = $m;
		$this->controller = $c;
	}

	function init() {}

	function display($className=NULL) {

		echo '이 글이 보인다면 제 정의해서 사용하세요.';
	}

	function toString() {

		return $this->name;
	}
}
?>