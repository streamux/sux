<?php

class LoginAdminModule extends BaseView {

	var $class_name = 'login_admin_module';	
	var $skin_path_list = array();
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = array();

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

class LoginAdminView extends LoginAdminModule {

	var $class_name = 'login_view';

	function displayLogin() {

		$context = Context::getInstance();		

		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();

		$action = $this->request_data['action'];
		$this->document_data['jscode'] = $action.'Admin';
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '관리자 로그인';
		
		$adminId = $this->session_data['admin_id'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/login/tpl";		

		$this->skin_path_list['dir'] = $skinPath;
		$this->skin_path_list['header'] = "{$skinPath}/_header_admin.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/login_admin.tpl";
		$this->skin_path_list['footer'] = "{$skinPath}/_footer_admin.tpl";

		$this->output();
	}

	function displayLogpass() {

		$context = Context::getInstance();
		$userId = $context->getPost('user_id');
		$userPwd = $context->getPost('user_pwd');
		
		$msg = '';
		if (!isset($userId) && $userId == '') {
			$msg = "아이디를 입력하세요.";
		} else if (!isset($userPwd) && $userPwd == '') {
			$msg = "비밀번호를 입력하세요.";
		} 

		if ($msg) {
			UIError::alertToBack($msg);
		}

		$adminId = $context->get('db_admin_id');
		$adminPwd = $context->get('db_admin_pwd');

		if ($userId !== $adminId) {
			UIError::alertToBack('아이디가 일치하지 않습니다.');
			exit;
		} else if ($userPwd !== $adminPwd) {
			UIError::alertToBack('비밀번호가 일치하지 않습니다.');
			exit;
		}

		$context->setSession('admin_id', md5($adminId));
		$context->setSession('admin_pwd', md5($adminPwd));

		Utils::goURL('../admin/index.php?action=main');
	}

	function displayLogout() {

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		foreach ($this->session_data as $key => $value) {
			$context->setSession($key, '');
		}

		Utils::goURL('../login/login.admin.php?action=login');
	}

	function displaySearchID() {		
	}

	function displaySearchPassword() {		
	}
}
?>