<?php

class MemberView extends BaseView {

	var $class_name = 'member_view';

	// display function is defined in parent class 
}

class MemberModules extends BaseView {

	var $class_name = 'member_modules';
	var $file_name = 'default.html';

	function init() {

		$this->defaultSetting();

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skin_dir = _SUX_PATH_ . 'modules/member/tpl/';
		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
		
		$skin_path = $skin_dir . $this->file_name;
		if (is_readable($skin_path)) {			
			if (preg_match('/modify/', $skin_path)) {

				$contents = new Template($skin_path);
				foreach ($requests as $key => $value) {
					$contents->set($key, $value);
				}
				$contents->load();
			} else {
				include $skin_path;
			}
			
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$skin_path = $skin_dir . 'footer.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '푸터 파일경로를 확인하세요.<br>';
		}

		function display() {}
	}

	function defaultSetting() {}
	function display() {}
}
class JoinPanel extends MemberModules {

	var $class_name = 'join';

	function defaultSetting() {

		$this->file_name = 'join.html';
	}
}

class ModifyPanel extends MemberModules {

	var $class_name = 'modify';

	function defaultSetting() {

		$this->file_name = 'modify.html';
	}
}

class GrouplistPanel extends BaseView {

	var $class_name = 'grouplist';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$msg = '';

		$result = $this->controller->select('memberListFromGroup');
		if ($result) {

			$data = array(	'data'=>$this->model->getRows(),
							'msg'=>$msg);
		} else {
			$msg = '데이터 로드를 실패하였습니다.';
			$data = array('msg'=>$msg);

			
		}

		echo parent::callback($data);	
	}
}

class MemberfieldPanel extends BaseView {

	var $class_name = 'membrfield';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$result = $this->controller->select('fieldFromMember', '*');
		if ($result) {
			$rows = $this->model->getRow();
			$email_arr = split('@', $rows['email']);
			$rows['email'] = $email_arr[0];
			$rows['email_tail2'] = $email_arr[1];

			echo parent::callback($rows);
		} else {
			echo '데이터 로드를 실패하였습니다.';
		}
	}
}

class SearchidPanel extends BaseView {

	var $class_name = 'searchid';

	function init() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$requests = $context->getRequestAll();
		$table_name = $posts['table_name'];
		$id = $posts['memberid'];

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$msg = "신청 아이디 : ".$id."\n";

		if (strlen($id) < 4) {

			$msg .= "아이디명은 4글자 이상 사용하세요.";

			$data = array(	"msg"=>$msg);
			echo parent::callback($rows);
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

		echo parent::callback($data);
	}
}

class SearchcorpPanel extends BaseView {

	var $class_name = 'searchcorp';

	function init() {

	}
}

class RecordBasePanel extends BaseView {

	var $class_name = 'record_base';
	var $posts;
	var $requests;

	function init() {

		$context = Context::getInstance();
		$this->posts = $context->getPostAll();
		$this->requests = $context->getRequestAll();

		$this->record();
	}
}

class RecordAddPanel extends RecordBasePanel {

	var $class_name = 'record_add';

	function record() {

		$dataObj = '';
		$msg = '';
		$resultYN = "Y";


		$email = $this->posts['email'];
		if (!preg_match('/@/i', $email)) {
			$msg = "잘못된 E-mail 주소입니다.";
	 		$resultYN = "N";
		}

		$this->controller->select('fieldFromMember', 'ljs_memberid');
		$numrows = $this->model->getNumRows();
		if ($numrows > 0) {
			$msg = $numrows . "같은 아이디가 존재합니다.";
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
		
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}

class RecordEditPanel extends RecordBasePanel {

	var $class_name = 'record_edit';

	function record() {

		$msg = '';
		$resultYN = "Y";
		$pwd = trim($this->posts['pwd1']);

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

		echo parent::callback($data);
	}
}

class RecordDeletePanel extends RecordBasePanel {

	var $class_name = 'record_delete';

	function record() {

		$msg = '';
		$resultYN = 'Y';
		$pass = trim($this->posts['pass']);
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

		echo parent::callback($data);
	}
}
?>