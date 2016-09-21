<?php

class LoginModule extends BaseView {

	var $class_name = 'login_module';
	var $header_path = '';	
	var $footer_path = '';
	var $skin_path = '';
	var $document_data = null;

	function output() {

		$smarty = new Smarty;
		if (is_readable($this->skin_path)) {
			$smarty->assign('headerPath', $this->header_path);
			$smarty->assign('footerPath', $this->footer_path);
			$smarty->assign('documentData', $this->document_data);
			$smarty->display( $this->skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
	}
}

class LoginView extends LoginModule {

	var $class_name = 'login_view';

	function displayLogin() {

		$context = Context::getInstance();
		$this->requests = $context->getRequestAll();
		$this->sessions = $context->getSessionAll();

		$this->document_data = array();
		$this->document_data['sessions'] = $this->sessions;
		$this->document_data['requests'] = $this->requests;

		$ljs_memberid = $this->sessions['ljs_memberid'];
		$ljs_pass1 = $this->sessions['ljs_pass1'];

		$this->header_path = _SUX_PATH_ . 'modules/login/tpl/_header.tpl';
		$this->footer_path = _SUX_PATH_ . 'modules/login/tpl/_footer.tpl';

		if (!$ljs_memberid  || !$ljs_pass1) {
			$this->document_data['requests']['action'] = 'login';
			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();
			$this->skin_path = _SUX_PATH_ . 'modules/login/tpl/login.tpl';
		} else {
			$this->document_data['requests']['action'] = '';
			$this->skin_path = _SUX_PATH_ . 'modules/login/tpl/info.tpl';
		}

		parent::output();
	}

	function displayLogpass() {

		$context = Context::getInstance();
		$this->requests = $context->getRequestAll();
		$this->sessions = $context->getSessionAll();
		$this->posts = $context->getPostAll();

		$this->document_data = array();
		$this->document_data['sessions'] = $this->sessions;
		$this->document_data['requests'] = $this->requests;
		$this->document_data['posts'] = $this->posts;

		$ljs_memberid = $this->sessions['ljs_memberid'];
		$ljs_pass1 = $this->sessions['ljs_pass1'];
		
		$ljs_member = $this->sessions['ljs_member'];
		if (!isset($ljs_member) || $ljs_member == '') {
			$ljs_member = $this->posts['member'];
		}

		$memberid = $this->sessions['ljs_memberid'];
		if (!isset($memberid) || $memberid == '') {
			$memberid = $this->posts['memberid'];
		}

		$pass = trim($this->sessions['ljs_pass1']);
		if (!isset($pass) || $pass == '') {
			$pass = trim($this->posts['pass']);
			$pass = substr(md5($pass),0,8);
		}
		
		$msg = '';
		if (!$memberid) {
			$msg = "아이디를 입력하세요.";
		} else if (!$pass) {
			$msg = "비밀번호를 입력하세요.";
		} 

		if ($msg) {
			Error::alertToBack($msg);
		}
		
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

			$session_list = array('ljs_member','ljs_memberid','ljs_pass1','ljs_name','ljs_email','ljs_writer','ljs_point','ljs_member','ljs_hit','grade','automod1','chatip');

			foreach ($session_list as $key => $value) {
				$_SESSION[$value] = ${$value};
			}				
			
			if ($this->requests['action'] == "read") {
				echo ("<meta http-equiv='Refresh' content='0; URL=../board.read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod'>");
			} else if ($this->requests['action'] == "write"){
				echo ("<meta http-equiv='Refresh' content='0; URL=../board.write.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid'>");
			} else {
				echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
			}
		} else {
			echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=fail'>");
		}
	}

	function displayLogout() {

		$context = Context::getInstance();
		$this->sessions = $context->getSessionAll();
		foreach ($this->sessions as $key => $value) {
			$context->setSession($key, '');
		}
		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}

	function displayFail() {

		$context = Context::getInstance();
		$this->requests = $context->getRequestAll();
		$this->sessions = $context->getSessionAll();

		$this->header_path = _SUX_PATH_ . 'modules/login/tpl/_header.tpl';
		$this->footer_path = _SUX_PATH_ . 'modules/login/tpl/_footer.tpl';
		$this->skin_path = _SUX_PATH_ . 'modules/login/tpl/login.tpl';
		$fail_css_path = 'tpl/css/login_fail.css';

		$this->document_data = array();
		$this->document_data['sessions'] = $this->sessions;
		$this->document_data['requests'] = $this->requests;

		$this->controller->select('getMemberGroup');
		$this->document_data['group'] = $this->model->getJson();
		$this->document_data['requests']['action'] = 'login';
		$this->document_data['failCssPath'] = $fail_css_path;

		parent::output();
	}

	function displayLeave() {

		$context = Context::getInstance();
		$this->sessions = $context->getSessionAll();

		$this->header_path = _SUX_PATH_ . 'modules/login/tpl/_header.tpl';
		$this->footer_path = _SUX_PATH_ . 'modules/login/tpl/_footer.tpl';
		$this->skin_path = _SUX_PATH_ . 'modules/login/tpl/leave.tpl';

		$this->document_data = array();
		$this->document_data['sessions'] = $this->sessions;

		$this->document_data['requests']['action'] = 'leave';

		parent::output();
	}
}

class SearchidPanel extends BaseView {

	var $class_name = 'earchid_panel';
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