<?php

class MemberView extends BaseView {

	var $class_name = 'member_view';

	// display function is defined in parent class 
}

class JoinPanel extends BaseView {

	var $class_name = 'join';

	function init() {
		
		$skin_dir = _SUX_PATH_ . 'modules/member/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
		
		$skin_path = $skin_dir . 'join.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$skin_path = $skin_dir . 'footer.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '푸터 파일경로를 확인하세요.<br>';
		}
	}
}

class ModifyPanel extends BaseView {

	var $class_name = 'modify';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skin_dir = _SUX_PATH_ . 'modules/member/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
		
		$skin_path = $skin_dir . 'modify.html';
		if (is_readable($skin_path)) {

			$contents = new Template($skin_path);
			foreach ($requests as $key => $value) {
				$contents->set($key, $value);
			}
			$contents->load();
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$skin_path = $skin_dir . 'footer.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '푸터 파일경로를 확인하세요.<br>';
		}
	}
}

class GrouplistPanel extends BaseView {

	var $class_name = 'grouplist';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$result = $this->controller->select('memberListFromGroup');
		if (isset($result)) {
			$strJson = $this->model->getJson();
			echo $requests['callback'].'('.$strJson.')';
		} else {
			echo '데이터 로드를 실패하였습니다.';
		}
	}
}

class MemberfieldPanel extends BaseView {

	var $class_name = 'membrfield';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$result = $this->controller->select('fieldFromMember', '*');
		if (isset($result)) {
			$rows = $this->model->getRows();
			$email_arr = split('@', $rows['email']);
			$rows['email'] = $email_arr[0];
			$rows['email_tail2'] = $email_arr[1];
			$strJson = $this->model->parseToJson($rows);
			echo $requests['callback'].'('.$strJson.')';
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
			$strJson = $this->model->parseToJson($data);
			echo $_REQUEST['callback'].'('.$strJson.')';
			exit;
		} 

		if (isset($id)) {

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

		$strJson = $this->model->parseToJson($data);
		echo $requests['callback'].'('.$strJson.')';
		exit;
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
			if (isset($result)) {
				$msg = '신규회원 가입을 완료하였습니다.';
				$resultYN = "Y";
			} else {
				$msg = '신규회원 가입을 실패하였습니다.';
				$resultYN = "N";
			}
		}
		
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$strJson = $this->model->parseToJson($data);
		echo $this->requests['callback'].'('.$strJson.')';
	}
}

class RecordEditPanel extends RecordBasePanel {

	var $class_name = 'record_edit';

	function record() {

		$msg = '';
		$resultYN = "Y";
		$pwd = trim($this->posts['pwd1']);

		$this->controller->select('fieldFromMember', 'ljs_pass1');
		$rows = $this->model->getRows();
		$pwd = substr(md5($pwd),0,8);

		if ($pwd != $rows['ljs_pass1']) {
			$msg = '등록된 비밀번호와 일치하지 않습니다. \n다시 입력해주세요.';
			$resultYN = "N";
		} else {

			$result = $this->controller->insert('recordEdit');
			if (isset($result)) {
				$msg = '회원정보를 수정하였습니다.';
				$resultYN = "Y";
			} else {
				$msg = '회원정보 수정을 실패하였습니다.';
				$resultYN = "N";
			}
		}
		$data = array(	"result"=>$resultYN,
						"msg"=>urlencode($msg));

		$strJson = $this->model->parseToJson($data);
		echo $this->requests['callback'].'('.urldecode($strJson).')';
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
		$rows = $this->model->getRows();		
		if ($pass != $rows['ljs_pass1']) {
			$msg = '비밀번호가 잘못되었습니다.';
			$resultYN = 'N';
		} else {
			$result = $this->controller->delete('recordDelete');
			if (isset($result)) {
				$msg = '회원 탈퇴를 완료하였습니다.';
				$resultYN = 'Y';
			} else {
				$msg = '회원 탈퇴를 실패하였습니다.';
				$resultYN = 'N';
			}
		}
		$data = array(	"result"=>$resultYN,
						"msg"=>urlencode($msg));

		$strJson = $this->model->parseToJson($data);
		echo $this->requests['callback'].'('.urldecode($strJson).')';
	}
}
?>