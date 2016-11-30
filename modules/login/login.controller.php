<?php

class LoginController extends Controller {

	var $class_name = 'login_controlelr';

	function LoginController($m=NULL) {
		
		$this->model = $m;
	}

	function insertLogin() {

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->post_data = $context->getPostAll();

		$category = trim($this->session_data['sux_category']);
		if (empty($category)) {
			$category = trim($this->post_data['category']);
		}

		$user_id = trim($this->session_data['sux_user_id']);
		if (empty($user_id)) {
			$user_id = trim($this->post_data['user_id']);
		}

		$pass = trim($this->session_data['sux_password']);
		if (!isset($pass) || $pass == '') {

			$pass = trim($this->post_data['password']);
			if (isset($pass) && $pass) {
				$pass = substr(md5($pass),0,8);
			}			
		}

		$rootPath = _SUX_ROOT_;

		if (!$user_id) {
			$msg = '아이디를 입력하세요.';
		} else if (!$pass) {
			$msg = '비밀번호를 입력하세요.';
		} 

		if (isset($msg) && $msg) {
			UIError::alertToBack($msg);			
			exit;
		}

		$context->setParameter('category', $category);
		$context->setParameter('user_id', $user_id);

		$this->model->selectLogpass();		
		$rownum = $this->model->getNumRows();
		/*$tracer = Tracer::getInstance();
		$tracer->output();*/
		if ($rownum > 0) {		

			$row = $this->model->getRow();
			$password = $row['password'];
			if ($pass !== $password) {
				$msg = '비밀번호가 일치하지 않습니다.';
				UIError::alertTo($msg, $rootPath . 'login-fail');
				exit;
			}
			
			$row['automod1'] = 'yes';
			$row['chatip'] = $context->getServer('REMOTE_ADDR');

			$row['hit_count'] = $row['hit_count'] + 1;
			$values['hit'] = $row['hit_count'];
			$this->model->updateField($values);

			$sessionList = array('category','user_id','password','user_name','nick_name','email_address','is_writable','point','hit_count','grade','automod1','chatip');

			$prefix = $context->getPrefix();

			foreach ($sessionList as $key => $value) {
				$context->setSession($prefix . '_' . $value, $row[$value]);
			}

			$data = array(	'msg'=>'로그인 성공',
							'result'=>'Y',
							'url'=>$rootPath . 'login');
			
			$this->callback($data);
		} else {
			$msg = '아이디가 등록되어 있지 않거나, 아이디 또는 비밀번호를 잘못입력하였습니다.';
			UIError::alertTo($msg, $rootPath . 'login-fail');
		}
	}

	function insertLogout() {

		$context = Context::getInstance();

		$rootPath = _SUX_ROOT_;
		$this->session_data = $context->getSessionAll();
		foreach ($this->session_data as $key => $value) {
			$context->setSession($key, '');
		}

		$data = array(	'msg'=>'로그아웃',
						'result'=>'Y',
						'url'=>$rootPath . 'login',);
		
		$this->callback($data);
	}
}
?>