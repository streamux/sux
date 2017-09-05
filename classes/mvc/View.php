<?php

class View extends Object {

	var $class_name = 'base_view';
	var $model = NULL;
	var $controller = NULL;
	var $copyright_path = '';
	var $skin_path_list = array();
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = array();

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

		$context = Context::getInstance();
		$this->copyright_path = _SUX_PATH_ . 'modules/admin/tpl/copyright.tpl';
	}

	function output() {

		$UIError = UIError::getInstance(); 		

		/**
		 * @class Template
		 * @brief Template is a Wrapper Class based on Smarty
		 */
		$__template = new Template();
		if (is_readable($this->skin_path_list['contents'])) {
			$__template->assign('copyrightPath', $this->copyright_path);
			$__template->assign('skinPathList', $this->skin_path_list);
			$__template->assign('sessionData', $this->session_data);
			$__template->assign('requestData', $this->request_data);			
			$__template->assign('postData', $this->post_data);
			$__template->assign('documentData', $this->document_data);
			$__template->display( $this->skin_path_list['contents'] );		
		} else {
			$UIError->add('스킨 파일경로가 올바르지 않습니다.');
			$UIError->useHtml = TRUE;
		}		
		$UIError->output();	
	}	
}
?>