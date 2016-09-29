<?php

class LoginAdminModule extends BaseView {

	var $class_name = 'login_admin_module';	
	var $skin_path_list = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

	function output() {

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
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
	}
}

class LoginAdminView extends LoginAdminModule {

	var $class_name = 'login_view';

	function displayLogin() {

		$context = Context::getInstance();
		$sessionData = $context->getSessionAll();
		$requestData = $context->getRequestAll();		
		$action = $requestData['action'];
		$requestData['jscode'] = $action.'Admin';
		$pageType = $requestData['pagetype'];
		
		$adminId = $this->session_data['admin_id'];

		$skinPath = _SUX_PATH_ . "modules/login/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = $skinPath;

		if (isset($adminId) && $adminId !== '') {
			Utils::goURL('../admin/index.php?action=main');			
		} else {
			$this->skin_path_list['contents'] = "{$skinPath}/login_admin.tpl";
		}

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

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
			Error::alertToBack($msg);
		}

		$adminId = $context->get('db_admin_id');
		$adminPwd = $context->get('db_admin_pwd');

		if ($userId !== $adminId) {
			Error::alertToBack('아이디가 일치하지 않습니다.');
			exit;
		} else if ($userPwd !== $adminPwd) {
			Error::alertToBack('비밀번호가 일치하지 않습니다.');
			exit;
		}

		$context->setSession('admin_id', $adminId);
		$context->setSession('admin_pwd', $adminPwd);

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