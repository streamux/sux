<?php

class MemberModules extends BaseView {

	var $class_name = 'member_module';	
	var $skin_dir = '';
	var $skin_path = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

	function output() {

		/**
		 * @class Template
		 * @brief Template is a Wrapper Class based on Smarty
		 */
		$__template = new Template();
		if (is_readable($this->skin_path)) {
			$__template->assign('copyrightPath', $this->copyright_path);
			$__template->assign('skinDir', $this->skin_dir);
			$__template->assign('sessionData', $this->session_data);
			$__template->assign('requestData', $this->request_data);
			$__template->assign('postData', $this->post_data);
			$__template->assign('documentData', $this->document_data);
			$__template->display( $this->skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
	}
}


class MemberView extends MemberModules {

	var $class_name = 'member_view';

	function displayJoin() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$this->skin_dir = _SUX_PATH_ . 'modules/member/tpl/';
		$this->skin_path = $this->skin_dir . 'join.tpl';

		$this->output();
	}

	function displayModify() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$this->skin_dir = _SUX_PATH_ . 'modules/member/tpl/';
		$this->skin_path = $this->skin_dir . 'modify.tpl';

		$this->output();
	}

	function displayGroupList() {

		$msg = '데이터 로드를 완료하였습니다.';
		$result = $this->controller->select('memberListFromGroup');
		if ($result) {
			$data = array(	'data'=>$this->model->getRows(),
							'msg'=>$msg);
		} else {
			$msg = '데이터 로드를 실패하였습니다.';
			$data = array('msg'=>$msg);			
		}

		echo $this->callback($data);
	}

	function displaySearchID() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$requests = $context->getRequestAll();

		$table_name = $posts['table_name'];
		$id = $posts['memberid'];

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$msg = "신청 아이디 : ".$id."\n";

		if (!preg_match('/^[a-zA-Z!_][a-zA-Z0-9!_]{3,12}$/i', $id)) {

			$msg .= "아이디명은 영문+숫자+특수문자('!','_') 조합된 단어만 사용가능\n첫글자가 영문 또는 특수문자로 시작되는 4글자 이상 사용하세요.";

			$data = array(	"msg"=>$msg);
			echo parent::callback($data);
			exit;
		} 

		if ($id) {

			$this->controller->select('fieldFromMember', 'name');
			$numrows = $this->model->getNumRows();

			if ($numrows > 0) {
				$msg = "'${id}'는 이미 존재하는 아이디입니다.";
				$resultYN = "N";
			} else {
				$msg = "'${id}'는 생성할 수 있는 아이디입니다.";
				$resultYN = "Y";
			}
		}else{
			$msg = "아이디를 넣고 중복체크를 하세요.";
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function didsplaySearchCorp() {

		$msg = "중복회사 체크 작업 중.";
		$resultYN = "Y";

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayMemberField() {

		$msg = '데이터 로드를 완료하였습니다.';
		$result = $this->controller->select('fieldFromMember', '*');
		if ($result) {
			$rows = $this->model->getRow();
			$email_arr = split('@', $rows['email']);
			$rows['email'] = $email_arr[0];
			$rows['email_tail2'] = $email_arr[1];

			$data = array(	'data'=>$rows,
							'msg'=>$msg);			
		} else {
			$msg = '데이터 로드를 실패하였습니다.';
			$data = array('msg'=>$msg);
		}
		echo $this->callback($data);
	}

	function recordJoin() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$dataObj = '';
		$msg = '';
		$resultYN = "Y";

		$email = $posts['email'];
		if (!preg_match('/@/i', $email)) {
			$msg .= "잘못된 E-mail 주소입니다.";
	 		$resultYN = "N";
		} else {
			$this->controller->select('fieldFromMember', 'ljs_memberid');
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$msg = "아이디가 이미 존재합니다.";
				$resultYN = "N";
			} else {
				$result = $this->controller->insert('recordAdd');
				if ($result) {
					$msg .= '신규회원 가입을 완료하였습니다.';
					$resultYN = "Y";
				} else {
					$msg .= '신규회원 가입을 실패하였습니다.';
					$resultYN = "N";
				}
			}
		}
				
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$msg = '';
		$resultYN = "Y";
		$pwd = trim($posts['pwd1']);

		$this->controller->select('fieldFromMember', 'ljs_pass1');
		$rows = $this->model->getRow();
		$pwd = substr(md5($pwd),0,8);

		if ($pwd != $rows['ljs_pass1']) {
			$msg = '등록된 비밀번호와 일치하지 않습니다. \n다시 입력해주세요.';
			$resultYN = "N";
		} else {

			$result = $this->controller->insert('recordEdit');
			if ($result) {
				$msg = '회원정보를 수정하였습니다.';
				$resultYN = "Y";
			} else {
				$msg = '회원정보 수정을 실패하였습니다.';
				$resultYN = "N";
			}
		}
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordDelete() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$msg = '';
		$resultYN = 'Y';
		$pass = trim($posts['pass']);
		$pass = substr(md5($pass),0,8);

		$this->controller->select('fieldFromMember', 'ljs_pass1');
		$rows = $this->model->getRow();		
		if ($pass != $rows['ljs_pass1']) {
			$msg = '비밀번호가 잘못되었습니다.';
			$resultYN = 'N';
		} else {
			$result = $this->controller->delete('recordDelete');
			if ($result) {
				$msg = '회원 탈퇴를 완료하였습니다.';
				$resultYN = 'Y';
			} else {
				$msg = '회원 탈퇴를 실패하였습니다.';
				$resultYN = 'N';
			}
		}
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}
}
?>