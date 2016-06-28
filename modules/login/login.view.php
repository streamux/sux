<?php

class LoginView extends BaseView {

	var $name = 'login_view';

	function display($className=NULL) {

		$className = ucfirst($className) . "Panel";
		$contents = new $className($this->model, $this->controller);
		$contents->init();
		$contents = NULL;
	}
}

class LoginPanel extends BaseView {

	var $name = 'login_panel';

	function init() {

		$ljs_memberid = $_SESSION['ljs_memberid'];
		$ljs_pass1 = $_SESSION['ljs_pass1'];

		if (!$ljs_memberid  || !$ljs_pass1) {		
			$this->dispLogon($param);	
		} else {
			$this->dispLoginInfo();
		}
	}

	function dispLogon() {

		$this->controller->setQuery('memberGroup');
		$strJson = $this->model->getJson();

		$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.html');
		$contents->set('memberList', $strJson);
		$contents->load();
	}

	function dispLoginInfo() {

		$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.info.html');
		foreach ($_SESSION as $key => $value) {
			$contents->set($key, $value);
		}
		$contents->load();
	}
}

class LogpassPanel extends BaseView {

	var $name = 'logpass_panel';

	function init() {

		$post = $this->model->getParam('post');

		$member = trim($post['member']);
		$memberid = trim($post['memberid']);
		$pass = trim($post['pass']);

		$msg = "";

		if (!$memberid) {
			$msg = "아이디를 입력하세요.";
		} else if (!$pass) {
			$msg = "비밀번호를 입력하세요.";
		} 

		if ($msg) {
			Error::alert($msg);
		}

		$pass = substr(md5($pass),0,8);
		$queryy = "select ljs_memberid, ljs_pass1, hit from $member where ljs_memberid='$memberid' ";
		$result = mysql_query($queryy);
		$num = mysql_num_rows($result);

		if ($num) {
			$row = mysql_fetch_array($result);
			$ljs_memberid = $row['ljs_memberid'];
			$ljs_pass1 = $row['ljs_pass1'];
			$ljs_name = $row['name'];
			$ljs_conpanyname = $row['conpany'];

			if ($ljs_conpanyname) {
				$ljs_name = $ljs_conpanyname;
			}

			$ljs_email = $row['email'];
			$ljs_writer = $row['writer'];
			$ljs_hit = $row['hit'];
			$ljs_point = $row['point'];
			$grade = $row['grade'];
			$automod1 = "yes";
			$chatip = $REMOTE_ADDR;

			$result = mysql_query("select hit from $member where ljs_memberid='$ljs_memberid' ");
			$row = mysql_fetch_array($result);
			$hit = $row['hit']+1;
			$sql = mysql_query("update $member set hit=$hit where ljs_memberid='$ljs_memberid' ");

			$_SESSION['ljs_member'] = $member;
			$_SESSION['ljs_memberid'] = $ljs_memberid;
			$_SESSION['ljs_pass1'] = $ljs_pass1;
			$_SESSION['ljs_name'] = $ljs_name;
			$_SESSION['ljs_email'] = $ljs_email;
			$_SESSION['ljs_writer'] = $ljs_writer;
			$_SESSION['ljs_hit'] = $hit;
			$_SESSION['ljs_point'] = $ljs_point;
			$_SESSION['grade'] = $grade;
			$_SESSION['automod1'] = $automod1;
			$_SESSION['chatip'] = $chatip;
			
			if ($ljs_mod == "r_mode") {
				echo ("<meta http-equiv='Refresh' content='0; URL=board.read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod'>");
			} else if ($ljs_mod == "writer"){
				echo ("<meta http-equiv='Refresh' content='0; URL=board.write.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid'>");
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

		$i = 0;
		while ( $i<count($xml_list)) {
			unset($_SESSION[$xml_list[$i]]);
			$i++;
		}
		echo ("<meta http-equiv='Refresh' content='0; URL=login.php?action=login'>");
	}
}

class FailPanel extends BaseView {

	var $name = 'fail_panel';

	function init() {

		$this->controller->setQuery('memberGroup');
		$strJson = $this->model->getJson();

		$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.html');
		$contents->set('memberList', $strJson);
		$contents->load();

		$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.fail.html');
		$contents->load();
	}
}

class LeavePanel extends BaseView {

	var $name = 'leave_panel';

	function init($param=NULL) {

		$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.leave.html');
		foreach ($_SESSION as $key => $value) {
			$contents->set($key, $value);
		}
		$contents->load();
	}
}

class SearchidPanel extends BaseView {

	var $name = 'earchid_panel';

	function init() {

		$check_name = trim($this->model->getParam('post')['check_name']);
		$check_email = trim($this->model->getParam('post')['check_email']);		

		if (isset($check_name) && $check_name){

			$this->controller->setQuery('searchid');	
			$rows = $this->model->getRows()[0];

			if (count($rows) > 0) {
				$memberid = $rows['ljs_memberid'];
				$email = $rows['email'];

				if (trim($email) !== $check_email) {
					Error::alert('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
					exit;
				}

				$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.searchid_result.html');
				$contents->set('check_name', $check_name);
				$contents->set('memberid', $memberid);
				$contents->load();				
			} else {
				Error::alert('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
				exit;
			}	
		} else {
			$this->controller->setQuery('memberGroup');
			$strJson = $this->model->getJson();

			$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.searchid.html');
			$contents->set('memberList', $strJson);
			$contents->load();
		}
	}
}

class SearchpwdPanel extends BaseView {

	var $name = 'searchpwd_panel';

	function init() {

		$check_name = $this->model->getParam('post')['check_name'];
		$check_memberid = $this->model->getParam('post')['check_memberid'];
		$check_email = $this->model->getParam('post')['check_email'];

		$admin_name = $this->model->getParam('post')['adminEmail'];
		$admin_email = $this->model->getParam('post')['adminName'];		

		if(isset($check_memberid) && $check_memberid) {

			$this->controller->setQuery('searchpwd');
			$rows = $this->model->getRows()[0];

			if (count($rows) > 0) {
				$memberid = $rows['ljs_memberid'];				
				$email = $rows['email'];
				$password = $rows['ljs_pass1'];

				if (trim($memberid) !== $check_memberid) {
					Error::alert('입력하신 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
					exit;
				}

				if (trim($email) !== $check_email) {
					Error::alert('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
					exit;
				}

				$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.searchpwd_result.html');
				$contents->set('check_name', $check_name);
				$contents->set('memberid', $memberid);
				$contents->set('check_email', $check_email);				
				$contents->load();

				$skin_path = _SUX_PATH_ . 'modules/mail/member/member.searchpwd.html';
				if (!file_exists($skin_path)) {
					Error::alert('이메일 스킨파일이 존재하지 않습니다.');
					exit;
				}

				$mail_skin = new TemplateLoader($skin_path);
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
				Error::alert('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.');
				exit;
			}
		}else{

			$this->controller->setQuery('memberGroup');
			$strJson = $this->model->getJson();

			$contents = new TemplateLoader(_SUX_PATH_ . 'modules/login/skin/default/login.searchpwd.html');
			$contents->set('memberList', $strJson);
			$contents->load();
		}
	}
}
?>