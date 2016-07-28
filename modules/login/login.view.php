<?php

class LoginView extends BaseView {

	var $class_name = 'login_view';

	// display function is defined in parent class 
}

class LoginPanel extends BaseView {

	var $name = 'login_panel';
	var $skin_path = 'modules/login/tpl/login.html';
	var $info_skin_path = 'modules/login/tpl/info.html';

	function init() {

		$context = Context::getInstance();
		$ljs_memberid = $context->getSession('ljs_memberid');
		$ljs_pass1 = $context->getSession('ljs_pass1');	

		if (!$ljs_memberid  || !$ljs_pass1) {		
			$this->dispLogon($param);	
		} else {
			$this->dispLoginInfo();
		}
	}

	function dispLogon() {

		$context = Context::getInstance();
		$this->controller->select('getMemberGroup');
		$strJson = $this->model->getJson();
		$contents = new Template(_SUX_PATH_ . $this->skin_path);
		$contents->set('memberList', $strJson);
		$contents->load();
	}

	function dispLoginInfo() {

		$context = Context::getInstance();
		$session_list = $context->getSessionAll();
		$contents = new Template(_SUX_PATH_ . $this->info_skin_path);
		foreach ($session_list as $key => $value) {
			//echo $key . ' : ' . $value . '<br>';
			$contents->set($key, $value);
		}
		$contents->load();
	}
}

class LogpassPanel extends BaseView {

	var $name = 'logpass_panel';

	function init() {

		$context = Context::getInstance();
		$member = $context->getPost('member');
		$memberid = $context->getPost('memberid');
		$pass = trim($context->getPost('pass'));

		$msg = "";

		if (!$memberid) {
			$msg = "아이디를 입력하세요.";
		} else if (!$pass) {
			$msg = "비밀번호를 입력하세요.";
		} 

		if ($msg) {
			Error::alertToBack($msg);
		}

		$pass = substr(md5($pass),0,8);
		$this->controller->select('getLogpass');
		$num = $this->model->getNumRows();

		if ($num > 0) {			
			$rows = $this->model->getRow();
			$ljs_memberid = $rows['ljs_memberid'];
			$ljs_pass1 = $rows['ljs_pass1'];
			$ljs_name = $rows['name'];

			if ($pass !== $ljs_pass1) {
				Error::alertToBack('비밀번호가 일치하지 않습니다.');
				exit;
			}

			$ljs_conpanyname = $rows['conpany'];
			if ($ljs_conpanyname) {
				$ljs_name = $ljs_conpanyname;
			}

			$ljs_email = $rows['email'];
			$ljs_writer = $rows['writer'];			
			$ljs_point = $rows['point'];
			$grade = $rows['grade'];
			$automod1 = "yes";
			$chatip = $REMOTE_ADDR;
			$ljs_hit = $rows['hit'] + 1;

			$values['hit'] = $ljs_hit;
			$this->controller->update('getLogpass', $values);

			$_SESSION['ljs_member'] = $member;
			$_SESSION['ljs_memberid'] = $ljs_memberid;
			$_SESSION['ljs_pass1'] = $ljs_pass1;
			$_SESSION['ljs_name'] = $ljs_name;
			$_SESSION['ljs_email'] = $ljs_email;
			$_SESSION['ljs_writer'] = $ljs_writer;			
			$_SESSION['ljs_point'] = $ljs_point;
			$_SESSION['grade'] = $grade;
			$_SESSION['automod1'] = $automod1;
			$_SESSION['chatip'] = $chatip;
			$_SESSION['ljs_hit'] = $ljs_hit;			
			
			if ($ljs_mod == "r_mode") {
				echo ("<meta http-equiv='Refresh' content='0; URL=../board.read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod'>");
			} else if ($ljs_mod == "writer"){
				echo ("<meta http-equiv='Refresh' content='0; URL=../board.write.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid'>");
			} else {
				echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
			}
		} else {
			echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=fail'>");
		}
	}
}

class LogoutPanel extends BaseView {

	var $name = 'logout_panel';

	function init($param=NULL) {

		$xml_list = array();
		$xml_list[] = 'ljs_member';
		$xml_list[] = 'ljs_memberid';
		$xml_list[] = 'ljs_pass1';
		$xml_list[] = 'ljs_writer';
		$xml_list[] = 'ljs_nickname';
		$xml_list[] = 'ljs_email';
		$xml_list[] = 'ljs_hit';
		$xml_list[] = 'ljs_point';
		$xml_list[] = 'user';
		$xml_list[] = 'grade';
		$xml_list[] = 'chatip';
		$xml_list[] = 'admin_ok';

		for ($i=0; $i<count($xml_list); $i++) {
			unset($_SESSION[$xml_list[$i]]);
		}
		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}
}

class FailPanel extends BaseView {

	var $name = 'fail_panel';
	var $skin_path = 'modules/login/tpl/login.html';
	var $footer_skin_path = 'modules/login/tpl/fail.html';

	function init() {

		$this->controller->select('getMemberGroup');
		$strJson = $this->model->getJson();

		$contents = new Template(_SUX_PATH_ . $this->skin_path);
		$contents->set('memberList', $strJson);
		$contents->load();

		$contents = new Template(_SUX_PATH_ . $this->footer_skin_path);
		$contents->load();
	}
}

class LeavePanel extends BaseView {

	var $name = 'leave_panel';
	var $skin_path = 'modules/login/tpl/leave.html';

	function init($param=NULL) {

		$contents = new Template(_SUX_PATH_ . $this->skin_path);
		foreach ($_SESSION as $key => $value) {
			$contents->set($key, $value);
		}
		$contents->load();
	}
}

class SearchidPanel extends BaseView {

	var $name = 'earchid_panel';
	var $skin_path = 'modules/login/tpl/searchid.html';
	var $result_skin_path = 'modules/login/tpl/searchid_result.html';

	function init() {

		$context = Context::getInstance();
		$check_name = $context->getPost('check_name');
		$check_email = $context->getPost('check_email');		

		if (isset($check_name) && $check_name){

			$this->controller->select('getSearchid');
			$rows = $this->model->getRow();

			if (count($rows) > 0) {
				$memberid = $rows['ljs_memberid'];
				$email = $rows['email'];

				if (trim($email) !== $check_email) {
					Error::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
					exit;
				}

				$contents = new Template(_SUX_PATH_ . $this->result_skin_path);
				$contents->set('check_name', $check_name);
				$contents->set('memberid', $memberid);
				$contents->load();				
			} else {
				Error::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
				exit;
			}	
		} else {
			$this->controller->select('getMemberGroup');
			$strJson = $this->model->getJson();

			$contents = new Template(_SUX_PATH_ . $this->skin_path);
			$contents->set('memberList', $strJson);
			$contents->load();
		}
	}
}

class SearchpwdPanel extends BaseView {

	var $name = 'searchpwd_panel';
	var $email_skin_path = 'modules/mail/member/email_skin.html';
	var $skin_path = 'modules/login/tpl/searchpwd.html';
	var $result_skin_path = 'modules/login/tpl/searchpwd_result.html';

	function init() {

		$context = Context::getInstance();
		$check_name = $context->getPost('check_name');
		$check_memberid = $context->getPost('check_memberid');
		$check_email = $context->getPost('check_email');
		$admin_name = $context->getPost('adminEmail');
		$admin_email = $context->getPost('adminName');		

		if(isset($check_memberid) && $check_memberid) {

			$this->controller->select('getSearchpwd');
			$rows = $this->model->getRow();

			if (count($rows) > 0) {
				$memberid = $rows['ljs_memberid'];
				$email = $rows['email'];
				$password = $rows['ljs_pass1'];

				if (trim($memberid) !== $check_memberid) {
					Error::alertToBack('입력하신 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
					exit;
				}

				if (trim($email) !== $check_email) {
					Error::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
					exit;
				}

				$contents = new Template(_SUX_PATH_ . $this->result_skin_path);
				$contents->set('check_name', $check_name);
				$contents->set('memberid', $memberid);
				$contents->set('check_email', $check_email);				
				$contents->load();

				if (!file_exists(_SUX_PATH_ . $email_skin_path)) {
					Error::alertToBack('이메일 스킨파일이 존재하지 않습니다.');
					exit;
				}

				$mail_skin = new Template(_SUX_PATH_ . $this->skin_path);
				$mail_skin->set('check_name', $check_name);
				$mail_skin->set('memberid', $memberid);
				$mail_skin->set('password', $password);
				$mail_skin->load('hide');

				$subject = '[ StreamUX ]에 문의하신 내용의 답변입니다.';
				$additional_headers = 'From: ' . $admin_name . '<' . $admin_email . '>\n';
				$additional_headers .= 'Reply-To : ' . $check_email . '\n';
				$additional_headers .= 'MIME-Version: 1.0\n';
				$additional_headers .= 'Content-Type: text/html; charset=EUC-KR\n';
				$contents = $mail_skin;

				mail($admin_email, $subject, $contents, $additional_headers);
				mail($check_email, $subject, $contents, $additional_headers);
			} else {
				Error::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.');
				exit;
			}
		}else{

			$this->controller->select('getMemberGroup');
			$strJson = $this->model->getJson();

			$contents = new Template(_SUX_PATH_ . $this->skin_path);
			$contents->set('memberList', $strJson);
			$contents->load();
		}
	}
}
?>