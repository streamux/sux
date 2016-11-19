<?php

class LoginModule extends View {

	var $class_name = 'login_module';	
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

		/*$tracer = Tracer::getInstance();
		$tracer->output();*/

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

class LoginView extends LoginModule {

	var $class_name = 'login_view';

	function displayLogin() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();

		/**
		 * css, js file path handler
		 */
		$this->document_data['jscode'] = $context->get('action');
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '회원 로그인';
		
		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login';
		$skinPath = _SUX_PATH_ . 'modules/login/tpl/';

		$headerPath = _SUX_PATH_ . 'common/_header.tpl';
		if (!is_readable($headerPath)) {
			$headerPath = $skinPath . "_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		$footerPath = _SUX_PATH_ . 'common/_footer.tpl';
		if (!is_readable($footerPath)) {
			$footerPath = $skinPath . "_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}

		$ljs_memberid = $this->session_data['ljs_memberid'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];

		/**
		 * get data from DB
		 */
		if (!$ljs_memberid ) {
			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();
			$contentsPath = $skinPath . 'login.tpl';		
		} else {
			$this->document_data['jscode'] = '';
			$contentsPath = $skinPath . 'info.tpl';
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}	

	function displayFail() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->session_data = $context->getSessionAll();

		/**
		 * css, js file path handler
		 */
		$this->document_data['jscode'] = 'login';
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '회원 로그인';
		
		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login';
		$skinPath = _SUX_PATH_ . 'modules/login/tpl/';

		$headerPath = _SUX_PATH_ . 'common/_header.tpl';
		if (!is_readable($headerPath)) {
			$headerPath = $skinPath . "_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		$footerPath = _SUX_PATH_ . 'common/_footer.tpl';
		if (!is_readable($footerPath)) {
			$footerPath = $skinPath . "_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}

		$ljs_memberid = $this->session_data['ljs_memberid'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];

		$contentsPath = $skinPath . 'login.tpl';

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->controller->select('getMemberGroup');		
		$this->document_data['group'] = $this->model->getJson();		
		$this->document_data['isLogon'] = false;
		
		$this->output();
	}

	function displayLeave() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();

		/**
		 * css, js file path handler
		 */
		$this->document_data['jscode'] = $context->get('action');
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '회원 탈퇴';
		
		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login';
		$skinPath = _SUX_PATH_ . 'modules/login/tpl/';

		$headerPath = _SUX_PATH_ . 'common/_header.tpl';
		if (!is_readable($headerPath)) {
			$headerPath = $skinPath . "_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		$footerPath = _SUX_PATH_ . 'common/_footer.tpl';
		if (!is_readable($footerPath)) {
			$footerPath = $skinPath . "_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}

		$contentsPath = $skinPath . 'leave.tpl';

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}

	function displaySearchId() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->post_data = $context->getPostAll();

		/**
		 * css, js file path handler
		 */
		$this->document_data['jscode'] = $context->get('action');
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '아이디 찾기';

		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login';
		$skinPath = _SUX_PATH_ . 'modules/login/tpl/';

		$headerPath = _SUX_PATH_ . 'common/_header.tpl';
		if (!is_readable($headerPath)) {
			$headerPath = $skinPath . "_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		$footerPath = _SUX_PATH_ . 'common/_footer.tpl';
		if (!is_readable($footerPath)) {
			$footerPath = $skinPath . "_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}

		$checkName = $this->post_data['user_name'];
		$checkEmail = $this->post_data['user_email'];

		if (isset($checkName) && $checkName != ''){

			$this->controller->select('getSearchid');
			$rows = $this->model->getRow();

			if (count($rows) > 0) {
				$memberId = $rows['ljs_memberid'];
				$email = $rows['email'];				

				if (trim($email) !== $checkEmail) {
					UIError::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
					exit;
				}

				$this->document_data['user_name'] = $checkName;
				$this->document_data['user_id'] = $memberId;
				$this->document_data['jscode'] = 'searchResult';				

				$contentsPath = $skinPath . 'searchid_result.tpl';
			} else {
				UIError::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
				exit;
			}	
		} else {
			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();

			$contentsPath = $skinPath . 'searchid.tpl';
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}

	function displaySearchPassword() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->post_data = $context->getPostAll();

		/**
		 * css, js file path handler
		 */
		$this->document_data['jscode'] = $context->get('action');
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '비밀번호 찾기';

		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login';
		$skinPath = _SUX_PATH_ . 'modules/login/tpl/';

		$headerPath = _SUX_PATH_ . 'common/_header.tpl';
		if (!is_readable($headerPath)) {
			$headerPath = $skinPath . "_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		$footerPath = _SUX_PATH_ . 'common/_footer.tpl';
		if (!is_readable($footerPath)) {
			$footerPath = $skinPath . "_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}

		$checkName = $this->post_data['user_name'];
		$checkMemberid = $this->post_data['user_id'];
		$checkEmail = $this->post_data['user_email'];
		$adminName = $context->get('db_admin_id');
		$adminEmail = $context->get('db_admin_email');

		if(isset($checkMemberid) && $checkMemberid != '') {

			$this->controller->select('getSearchpwd');
			$row = $this->model->getRow();
			if (count($row) > 0) {
				$memberId = $row['ljs_memberid'];
				$email = $row['email'];
				$password = $row['ljs_pass1'];

				if (trim($memberId) !== $checkMemberid) {
					UIError::alertToBack('입력하신 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
					exit;
				}

				if (trim($email) !== $checkEmail) {
					UIError::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
					exit;
				}

				$contentsPath = $skinPath . 'searchpwd_result.tpl';

				$email_skin_path = _SUX_PATH_ . 'modules/mail/member/mail_searchpwd_result.tpl';
				if (!file_exists($email_skin_path)) {
					UIError::alertToBack('이메일 스킨파일이 존재하지 않습니다.');
					exit;
				}

				$this->document_data['user_name'] = $checkName;
				$this->document_data['user_email'] = $checkEmail;
				$this->document_data['memberid'] = $memberId;
				$this->document_data['password'] = $password;
				$this->document_data['jscode'] = 'searchResult';

				/*$subject = '[ StreamUX ]에 문의하신 내용의 답변입니다.';
				$additional_headers = 'From: ' . $adminName . '<' . $adminEmail . '>\n';
				$additional_headers .= 'Reply-To : ' . $checkEmail . '\n';
				$additional_headers .= 'MIME-Version: 1.0\n';
				$additional_headers .= 'Content-Type: text/html; charset=EUC-KR\n';
				$contents = $mail_skin;

				mail($adminEmail, $subject, $contents, $additional_headers);
				mail($checkEmail, $subject, $contents, $additional_headers);*/
			} else {
				UIError::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.');
				exit;
			}
		}else{

			$this->controller->select('getMemberGroup');
			$this->document_data['group'] = $this->model->getJson();

			$contentsPath = $skinPath . 'searchpwd.tpl';
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}

	function displayLogout() {

		$context = Context::getInstance();

		$rootPath = _SUX_ROOT_;
		$this->session_data = $context->getSessionAll();
		foreach ($this->session_data as $key => $value) {
			$context->setSession($key, '');
		}
		Utils::goURL("{$rootPath}login");
	}

	function recordLogpass() {

		$context = Context::getInstance();

		$rootPath = _SUX_ROOT_;
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
		
		if (!$memberid) {
			$msg = "아이디를 입력하세요.";
		} else if (!$pass) {
			$msg = "비밀번호를 입력하세요.";
		} 

		if (isset($msg) && $msg) {
			UIError::alertToBack($msg);
		}
	
		$this->controller->select('getLogpass');
		$rownum = $this->model->getNumRows();
		if ($rownum > 0) {		

			$rows = $this->model->getRow();
			$ljs_memberid = $rows['ljs_memberid'];
			$ljs_pass1 = $rows['ljs_pass1'];
			$ljs_name = $rows['name'];

			if ($pass !== $ljs_pass1) {
				UIError::alertTo('비밀번호가 일치하지 않습니다.', $rootPath . 'login/fail');
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

			$action = $context->get('action');		

			if ($action == "read") {
				Utils::goURL("../board.read.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&s_mod=$s_mod");
			} else if ($action == "write"){
				Utils::goURL("../board.write.php?board=$board&board_grg=$board_grg&id=$id&igroup=$igroup&passover=$passover&page=$page&sid=$sid");
			} else {
				Utils::goURL("{$rootPath}login");
			}
		} else {
			UIError::alertTo('아이디가 등록되어 있지 않거나, 아이디 또는 비밀번호를 잘못입력하였습니다다.', $rootPath . 'login/fail');
		}
	}	
}
?>