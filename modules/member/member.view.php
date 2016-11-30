<?php

class MemberModules extends View {

	var $class_name = 'member_module';
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


class MemberView extends MemberModules {

	var $class_name = 'member_view';

	function displayMember() {

		$this->displayMemberJoin();
	}

	function displayMemberJoin() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();

		/**
		 * css, js file path handler
		 */
		$this->document_data['jscode'] = 'join';
		$this->document_data['module_code'] = 'member';
		$this->document_data['module_name'] = '회원 가입';
		
		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/member/tpl/';
		$skinPath = _SUX_PATH_ . 'modules/member/tpl/';

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

		$contentsPath = $skinPath . 'join.tpl';

		$this->model->selectMemberGroup();
		$this->document_data['group'] = $this->model->getRows();

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}

	function displayMemberModify() {

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();

		/**
		 * css, js file path handler
		 */
		//$this->document_data['jscode'] = 'modify';
		$this->document_data['module_code'] = 'member';
		$this->document_data['module_name'] = '회원 수정';
		
		/**
		 * skin directory path
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . 'modules/member/tpl/';
		$skinPath = _SUX_PATH_ . 'modules/member/tpl/';

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

		$contentsPath = $skinPath . 'modify.tpl';

		$context->setParameter('category', $context->getSession('sux_category'));
		$context->setParameter('user_id', $context->getSession('sux_user_id'));

		$result = $this->model->selectFromMember('*');
		//Tracer::getInstance()->output();
		if ($result) {
			$contentsData = $this->model->getRow();
			$email_arr = split('@', $contentsData['email_address']);
			$contentsData['email'] = $email_arr[0];
			$contentsData['email_tail2'] = $email_arr[1];			
			$contentsData['hobby'] = explode(',', $contentsData['hobby']);
		} 

		$this->document_data['contents'] = $contentsData;
		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}

	function displayMemberGroupList() {

		$msg = '데이터 로드를 완료하였습니다.';
		$result = $this->controller->select('memberListFromGroup');
		if ($result) {
			$data = array(	'data'=>$this->model->getRows(),
							'msg'=>$msg);
		} else {
			$msg = '데이터 로드를 실패하였습니다.';
			$data = array('msg'=>$msg);			
		}

		$this->callback($data);
	}	
}
