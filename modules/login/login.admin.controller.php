<?php

class LoginAdminController extends Controller {

	var $class_name = 'login_admin_controlelr';

	function insertLoginAdmin() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$userId = $posts['user_id'];
		$userPwd = $posts['user_pwd'];
		$token = $posts['token'];

		$rootPath = _SUX_ROOT_;		
		$msg = '';

		$token = md5($token . 'SHIFLEFT');

		if (empty($userId)) {
			$msg = "아이디를 입력하세요.";
			UIError::alertToBack($msg);
			exit;
		} else if (empty($userPwd)) {
			$msg = "비밀번호를 입력하세요.";
			UIError::alertToBack($msg);
			exit;
		} 

		$adminId = $context->getAdminInfo('admin_id');
		$adminPwd = $context->getAdminInfo('admin_pwd');

		if ($userId !== $adminId) {
			UIError::alertToBack('아이디가 일치하지 않습니다.');
			exit;
		} else if ($userPwd !== $adminPwd) {
			UIError::alertToBack('비밀번호가 일치하지 않습니다.');
			exit;
		}

		$adminHash = $context->getPasswordHash($adminId);
		$context->setSession('admin_ok', $adminHash);

		$data = array(	'token'=>$token,
						'msg'=>'로그인 성공',
						'result'=>'Y',
						'url'=>$rootPath . 'admin',
						'delay'=>0);
			
		$this->callback($data);
	}

	function insertLogoutAdmin() {

		$context = Context::getInstance();
		$rootPath = _SUX_ROOT_;

		$context->setSession('admin_ok', '');

		$data = array(	'msg'=>'로그아웃',
						'result'=>'Y',
						'url'=>$rootPath . 'login-admin',
						'delay'=>0);
			
		$this->callback($data);
	}
}
