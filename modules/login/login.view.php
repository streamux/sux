<?php

class LoginView extends BaseView {

	var $name = 'login_view';
	var $model = NULL;
	var $controller = NULL;

	function LoginView($m=NULL, $c=NULL) {
		
		$this->model = $m;
		$this->controller = $c;
	}

	function display($className=NULL, $param=NULL) {

		$className = ucfirst($className) . "Panel";
		$contents = new $className($this->model, $this->controller);
		$contents->init($param);
		$contents = NULL;
	}

	/*function GetContentsCurl($url) {

	    $ch = curl_init();
	    
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    
	    $data = curl_exec($ch);
	    curl_close($ch);
	    
	    return $data;
	}*/
}

class LoginPanel extends BaseView {

	var $name = 'login_panel';

	function init($param=NULL) {

		$ljs_memberid = $_SESSION['ljs_memberid'];
		$ljs_pass1 = $_SESSION['ljs_pass1'];

		if (!$ljs_memberid  || !$ljs_pass1) {		
			$this->dispLogon();	
		} else {
			$this->dispLoginInfo();
		}
	}

	function dispLogon() {

		$strJson = $this->model->getJson();

		$contents = new TemplateLoader('skin/default/login.html');
		$contents->set('memberList', $strJson);
		$contents->load();
	}

	function dispLoginInfo() {

		$contents = new TemplateLoader('skin/default/login.info.html');
		foreach ($_SESSION as $key => $value) {
			$contents->set($key, $value);
		}
		$contents->load();
	}
}

class LogoutPanel extends BaseView {

	var $name = 'logout_panel';

	function init($param=NULL) {

		unset($_SESSION['ljs_member']);
		unset($_SESSION['ljs_memberid']);
		unset($_SESSION['ljs_pass1']);
		unset($_SESSION['ljs_writer']);
		unset($_SESSION['ljs_nickname']);
		unset($_SESSION['ljs_email']);
		unset($_SESSION['ljs_hit']);
		unset($_SESSION['ljs_point']);
		unset($_SESSION['user']);
		unset($_SESSION['grade']);
		unset($_SESSION['chatip']);
		unset($_SESSION['admin_ok']);
		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}
}

class FailPanel extends BaseView {

	var $name = 'fail_panel';

	function init($param=NULL) {

		$strJson = $this->model->getJson();

		$contents = new TemplateLoader('skin/default/login.html');
		$contents->set('memberList', $strJson);
		$contents->load();

		$contents = new TemplateLoader('skin/default/login.fail.html');
		$contents->load();
	}
}

class LeavePanel extends BaseView {

	var $name = 'leave_panel';

	function init($param=NULL) {

		$contents = new TemplateLoader('skin/default/login.leave.html');
		foreach ($_SESSION as $key => $value) {
			$contents->set($key, $value);
		}
		$contents->load();
	}
}

class SearchidPanel extends BaseView {

	var $name = 'earchid_panel';

	function init($param=NULL) {

		$member = $param['post']['member'];
		$check_name = trim($param['post']['check_name']);
		$check_email = trim($param['post']['check_email']);		

		if (isset($check_name) && $check_name){

			$query = array();
			$query['select'] = 'ljs_memberid, email';
			$query['from'] = $member;
			$query['where'] = 'name=\''.$check_name.'\'';

			$this->model->select($query);
			$rows = $this->model->getVariables()[0];

			if (count($rows) > 0) {
				$memberid = $rows['ljs_memberid'];
				$email = $rows['email'];

				if (trim($email) !== $check_email) {
					Error::alert('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
					exit;
				}

				$contents = new TemplateLoader('skin/default/login.searchid_result.html');
				$contents->set('check_name', $check_name);
				$contents->set('memberid', $memberid);
				$contents->load();
			} else {
				Error::alert('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
				exit;
			}	
		} else {
			$strJson = $this->model->getJson();

			$contents = new TemplateLoader('skin/default/login.searchid.html');
			$contents->set('memberList', $strJson);
			$contents->load();
		}
	}
}

class SearchpwdPanel extends BaseView {

	var $name = 'searchpwd_panel';

	function init($param=NULL) {

		$member = $param['post']['member'];
		$check_name = $param['post']['check_name'];
		$check_memberid = $param['post']['check_memberid'];
		$check_email = $param['post']['check_email'];
		$strJson = $this->model->getJson();

		if(isset($check_memberid) && $check_memberid) {

			$query = array();
			$query['select'] = 'ljs_memberid, email, ljs_pass1';
			$query['from'] = $member;
			$query['where'] = 'name=\''.$check_name.'\'';

			$this->model->select($query);
			$rows = $this->model->getVariables()[0];

			if (count($rows) > 0) {
				$memberid = $rows['ljs_memberid'];
				$email = $rows['email'];

				if (trim($memberid) !== $check_memberid) {
					Error::alert('입력하신 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
					exit;
				}

				if (trim($email) !== $check_email) {
					Error::alert('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
					exit;
				}

				$contents = new TemplateLoader('skin/default/login.searchpwd_result.html');
				$contents->set('check_name', $check_name);
				$contents->set('check_email', $check_email);
				$contents->set('memberid', $memberid);
				$contents->load();
			} else {
				Error::alert('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.');
				exit;
			}
			/*
			$contents = new TemplateLoader('skin/default/login.searchpwd_result.html');
			$contents->load();*/
		}else{

			$contents = new TemplateLoader('skin/default/login.searchpwd.html');
			$contents->set('memberList', $strJson);
			$contents->load();
		}
	}
}
?>