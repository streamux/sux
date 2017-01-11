<?php

class LoginView extends ModuleView {

	var $class_name = 'login_view';

	function displayLogin() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();

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
		$skinDir = _SUX_ROOT_ . 'modules/login/tpl/';
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

		$user_id = $this->session_data['sux_user_id'];

		/**
		 * get data from DB
		 */
		if (!$user_id ) {
			$this->model->selectMemberGroup();
			$groupData = $this->model->getRows();
			$contentsPath = $skinPath . 'login.tpl';		
		} else {
			$contentsPath = $skinPath . 'info.tpl';
		}	

		$this->document_data['group'] = $groupData;
		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}	

	function displayLoginFail() {

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
		$skinDir = _SUX_ROOT_ . 'modules/login/tpl/';
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

		$contentsPath = $skinPath . 'login.tpl';

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->model->selectMemberGroup();
		$this->document_data['group'] = $this->model->getRows();
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
		$this->document_data['jscode'] = 'leave';
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '회원 탈퇴';
		
		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login/tpl/';
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
		$this->document_data['jscode'] = 'searchId';
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '아이디 찾기';

		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login/tpl/';
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
		$checkEmail = $this->post_data['email_address'];

		$context ->setParameter('category', $this->post_data['category']);
		$context ->setParameter('user_name', $this->post_data['user_name']);

		if (isset($checkName) && $checkName != ''){

			$this->model->selectSearchid();
			$row = $this->model->getRow();

			if (count($row) > 0) {
				$userId = $row['user_id'];
				$email = $row['email_address'];	

				if ($email !== $checkEmail) {
					UIError::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
					exit;
				}

				$this->document_data['user_name'] = $checkName;
				$this->document_data['user_id'] = $userId;
				$this->document_data['jscode'] = 'searchResult';				

				$contentsPath = $skinPath . 'searchid_result.tpl';
			} else {
				UIError::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
				exit;
			}	
		} else {
			$this->model->selectMemberGroup();
			$this->document_data['group'] = $this->model->getRows();

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
		$this->document_data['jscode'] = 'searchPassword';
		$this->document_data['module_code'] = 'login';
		$this->document_data['module_name'] = '비밀번호 찾기';

		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/login/tpl/';
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
		$checkUserId = $this->post_data['user_id'];
		$checkEmail = $this->post_data['email_address'];

		$context ->setParameter('category', $this->post_data['category']);
		$context ->setParameter('user_id', $this->post_data['user_id']);

		if(isset($checkUserId) && $checkUserId) {

			$this->model->selectSearchpwd();
			$row = $this->model->getRow();
			if (count($row) > 0) {
				$userName = $row['user_name'];
				$email = $row['email_address'];
				$password = $row['password'];			

				if ($userName !== $checkName) {
					UIError::alertToBack('입력하신 정보와 이름이 일치하지 않습니다. \n이름을 다시 확인해주세요.');
					exit;
				}

				if ($email !== $checkEmail) {
					UIError::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
					exit;
				}

				$contentsPath = $skinPath . 'searchpwd_result.tpl';

				$email_skin_path = _SUX_PATH_ . 'modules/mail/member/mail_searchpwd_result.tpl';
				if (!file_exists($email_skin_path)) {
					UIError::alertToBack('이메일 스킨파일이 존재하지 않습니다.');
					exit;
				}

				$this->document_data['user_id'] = $checkUserId;
				$this->document_data['user_name'] = $userName;
				$this->document_data['user_email'] = $email;				
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
			$this->model->selectMemberGroup();
			$this->document_data['group'] = $this->model->getRows();

			$contentsPath = $skinPath . 'searchpwd.tpl';
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}
}
?>