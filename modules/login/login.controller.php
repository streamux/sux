<?php

class LoginController extends Controller
{

	function insertLogin() {

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->post_data = $context->getPostAll();

		$category = trim($this->session_data['category']);
		if (empty($category)) {
			$category = trim($this->post_data['category']);
		}

		$userId = trim($this->session_data['user_id']);		
		if (empty($userId)) {
			$userId = trim($this->post_data['user_id']);
		}

		$password = trim($this->session_data['password']);
		if (empty($password)) {
			$password = trim($this->post_data['password']);
			if (isset($password) && $password) {
				$passwordHash = $context->getPasswordHash($password);
			}
		}

		$rootPath = _SUX_ROOT_;

		if (empty($userId)) {
			$msg .= '아이디를 입력하세요.';
		} else if (empty($passwordHash)) {
			$msg .= '비밀번호를 입력하세요.';
		} 

		if (isset($msg) && $msg) {
			UIError::alertToBack($msg);			
			exit;
		}

		$where = new QueryWhere();
		$where->set('category',$category,'=');
		$where->set('user_id',$userId,'=','and');
		$this->model->select('member', '*', $where);

		$rownum = $this->model->getNumRows();
		if ($rownum > 0) {

			$row = $this->model->getRow();
			$password = $row['password'];
			if ($password !== $passwordHash) {
				$msg .= '비밀번호가 일치하지 않습니다.';
				UIError::alertTo($msg, $rootPath . 'login-fail');
				exit;
			}
			
			$row['automod1'] = 'yes';
			$row['chatip'] = $context->getServer('REMOTE_ADDR');
			$row['hit_count'] = $row['hit_count'] + 1;

			$columns = array();
			$columns['hit'] = $row['hit_count'];
			$this->model->update('member', $columns, $where);

			$sessionList = array('category','user_id','password','user_name','nick_name','email_address','is_writable','point','hit_count','grade','automod1','chatip');

			foreach ($sessionList as $key => $value) {
				$context->setSession($value, $row[$value]);
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
			if (strpos($key, 'admin_ok') !== false) {
				continue;
			}
			$context->setSession($key, '');
		}

		$data = array(	'msg'=>'로그아웃',
						'result'=>'Y',
						'url'=>$rootPath . 'login');
		
		$this->callback($data);
	}
}
