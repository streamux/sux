<?php

class InstallModule  extends View {

	var $class_name = 'install_module';
	var $skin_path_list = array();
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;
	var $copyright_path = '';

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

class InstallView extends InstallModule {

	function displayInstall() {

		$this->displayTerms();
	}

	function displayTerms() {

		$this->skin_path_list['root'] = _SUX_ROOT_;
		$this->skin_path_list['skin_dir'] = _SUX_PATH_.'modules/install/tpl/';
		$this->skin_path_list['contents'] = _SUX_PATH_ . 'modules/install/tpl/terms.tpl';

		$this->output();
	}

	function displaySetupDb() {

		$context = Context::getInstance();
		$this->request_data['action'] = 'setupDb';

		$this->skin_path_list['root'] = _SUX_ROOT_;
		$this->skin_path_list['skin_dir'] = _SUX_PATH_.'modules/install/tpl/';
		$this->skin_path_list['contents'] = _SUX_PATH_ . 'modules/install/tpl/db_setup.tpl';

		$this->output();
	}

	function displaySetupAdmin() {

		$context = Context::getInstance();
		$this->request_data['action'] = 'setupAdmin';

		$this->skin_path_list['root'] = _SUX_ROOT_;
		$this->skin_path_list['skin_dir'] = _SUX_PATH_.'modules/install/tpl/';
		$this->skin_path_list['contents'] = _SUX_PATH_ . 'modules/install/tpl/admin_setup.tpl';

		$this->output();
	}	
}