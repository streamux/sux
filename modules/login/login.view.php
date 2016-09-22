<?php

class LoginModule extends BaseView {

	var $class_name = 'login_module';	
	var $skin_dir = '';
	var $skin_path = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

	function output() {

		$smarty = new Smarty;
		if (is_readable($this->skin_path)) {
			$smarty->assign('copyrightPath', $this->copyright_path);
			$smarty->assign('skinDir', $this->skin_dir);
			$smarty->assign('sessionData', $this->session_data);
			$smarty->assign('requestData', $this->request_data);
			$smarty->assign('postData', $this->post_data);
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
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();
		
		$ljs_memberid = $this->session_data['ljs_memberid'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];

		$this->skin_dir = _SUX_PATH_ . 'modules/login/tpl/';

		$this->document_data = array();
		if (!$ljs_memberid  || !$ljs_pass1) {
			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();
			$this->skin_path = $this->skin_dir . 'login.tpl';
		} else {
			$this->request_data['action'] = '';
			$this->skin_path = $this->skin_dir . 'info.tpl';
		}

		$this->output();
	}

	function displayLogpass() {

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();		
		$this->post_data = $context->getPostAll();

		$ljs_memberid = $this->session_data['ljs_memberid'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];
		
		$ljs_member = $this->session_data['ljs_member'];
		if (!isset($ljs_member) || $ljs_member == '') {
			$ljs_member = $this->post_data['member'];
		}

		$memberid = $this->session_data['ljs_memberid'];
		if (!isset($memberid) || $memberid == '') {
			$memberid = $this->post_data['memberid'];
		}

		$pass = trim($this->session_data['ljs_pass1']);
		if (!isset($pass) || $pass == '') {
			$pass = trim($this->post_data['pass']);
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
		$rownum = $this->model->getNumRows();
		if ($rownum > 0) {		

			$rows = $this->model->getRow();
			$ljs_memberid = $rows['ljs_memberid'];
			$ljs_pass1 = $rows['ljs_pass1'];
			$ljs_name = $rows['name'];

			if ($pass !== $ljs_pass1) {
				Error::alertToBack('비밀번호가 일치하지 않습니다.');
				exit;
			}

			$conpanyname = $rows['conpany'];
			if ($conpanyname) {
				$ljs_name = $conpanyname;
			}

			$ljs_email = $rows['email'];
			$ljs_writer = $rows['writer'];			
			$ljs_point = $rows['point'];
			$grade = $rows['grade'];
			$automod1 = "yes";
			$chatip = $context->getServer('REMOTE_ADDR');
			$ljs_hit = $rows['hit'] + 1;

			$values['hit'] = $ljs_hit;
			$this->controller->update('getLogpass', $values);

			$session_list = array('ljs_member','ljs_memberid','ljs_pass1','ljs_name','ljs_email','ljs_writer','ljs_point','ljs_member','ljs_hit','grade','automod1','chatip');

			foreach ($session_list as $key => $value) {
				$context->setSession($value, ${$value});
			}			

			if ($this->request_data['action'] == "read") {
				echo ("<meta http-equiv='Refresh' content='0; URL=../board.read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod'>");
			} else if ($this->request_data['action'] == "write"){
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
		$this->session_data = $context->getSessionAll();
		foreach ($this->session_data as $key => $value) {
			$context->setSession($key, '');
		}
		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}

	function displayFail() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->session_data = $context->getSessionAll();		

		$this->skin_dir = _SUX_PATH_ . 'modules/login/tpl/';
		$this->skin_path = $this->skin_dir . 'login.tpl';

		$this->document_data = array();
		$this->controller->select('getMemberGroup');		
		$this->document_data['group'] = $this->model->getJson();		
		$this->document_data['isLogon'] = false;
		$this->request_data['action'] = 'login';

		$this->output();
	}

	function displayLeave() {

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();

		$this->skin_dir = _SUX_PATH_ . 'modules/login/tpl/';
		$this->skin_path = $this->skin_dir . 'leave.tpl';

		$this->output();
	}

	function displaySearchid() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->post_data = $context->getPostAll();

		$checkName = $this->post_data['user_name'];
		$checkEmail = $this->post_data['user_email'];

		$this->skin_dir = _SUX_PATH_ . 'modules/login/tpl/';

		$this->document_data = array();
		if (isset($checkName) && $checkName != ''){

			$this->controller->select('getSearchid');
			$rows = $this->model->getRow();

			if (count($rows) > 0) {
				$memberId = $rows['ljs_memberid'];
				$email = $rows['email'];

				if (trim($email) !== $checkEmail) {
					Error::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
					exit;
				}

				$this->document_data['user_name'] = $checkName;
				$this->document_data['user_id'] = $memberId;
				$this->request_data['action'] = 'searchresult';

				$this->skin_path = $this->skin_dir . 'searchid_result.tpl';
			} else {
				Error::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
				exit;
			}	
		} else {
			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();

			$this->skin_path = $this->skin_dir . 'searchid.tpl';
		}

		$this->output();
	}

	function displaySearchpwd() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->post_data = $context->getPostAll();

		$checkName = $this->post_data['user_name'];
		$checkMemberid = $this->post_data['user_id'];
		$checkEmail = $this->post_data['user_email'];
		$adminName = $context->get('db_admin_id');
		$adminEmail = $context->get('db_admin_email');

		$this->skin_dir = _SUX_PATH_ . 'modules/login/tpl/';

		$this->document_data = array();
		if(isset($checkMemberid) && $checkMemberid != '') {

			$this->controller->select('getSearchpwd');
			$row = $this->model->getRow();
			if (count($row) > 0) {
				$memberId = $row['ljs_memberid'];
				$email = $row['email'];
				$password = $row['ljs_pass1'];

				if (trim($memberId) !== $checkMemberid) {
					Error::alertToBack('입력하신 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
					exit;
				}

				if (trim($email) !== $checkEmail) {
					Error::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
					exit;
				}

				$this->skin_path = $this->skin_dir . 'searchpwd_result.tpl';

				$email_skin_path = _SUX_PATH_ . 'modules/mail/member/mail_searchpwd_result.tpl';
				if (!file_exists($email_skin_path)) {
					Error::alertToBack('이메일 스킨파일이 존재하지 않습니다.');
					exit;
				}

				$this->document_data['user_name'] = $checkName;
				$this->document_data['user_email'] = $checkEmail;
				$this->document_data['memberid'] = $memberId;
				$this->document_data['password'] = $password;
				$this->request_data['action'] = 'searchresult';

				/*$subject = '[ StreamUX ]에 문의하신 내용의 답변입니다.';
				$additional_headers = 'From: ' . $adminName . '<' . $adminEmail . '>\n';
				$additional_headers .= 'Reply-To : ' . $checkEmail . '\n';
				$additional_headers .= 'MIME-Version: 1.0\n';
				$additional_headers .= 'Content-Type: text/html; charset=EUC-KR\n';
				$contents = $mail_skin;

				mail($adminEmail, $subject, $contents, $additional_headers);
				mail($checkEmail, $subject, $contents, $additional_headers);*/
			} else {
				Error::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.');
				exit;
			}
		}else{

			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();

			$this->skin_path = $this->skin_dir . 'searchpwd.tpl';
		}

		$this->output();
	}
}
?>