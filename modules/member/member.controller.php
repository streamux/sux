<?php

class MemberController extends Controller {

	var $class_name = 'member_conntroller';

	private function checkValidation( $post ) {

		$labelList = array('이름','닉네임','아이디','비밀번호','이메일','핸드폰 앞자리','핸드폰 가운데 자리','핸드폰 뒷자리');
		$ckeckList = array('user_name','nick_name','user_id','password','email_address','hp1','hp2','hp3');
		foreach ($ckeckList as $key => $value) {

			if (empty($post[$value])) {
				$msg = $post[$value] . $labelList[$key] . '을(를) 입력해주세요.';
				return $msg;
			}
		}
		return $msg;
	}

	function insertCheckId() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$id = $posts['user_id'];
		$msg = "신청 아이디 : ".$id."\n";

		if (!preg_match('/^[a-zA-Z!_][a-zA-Z0-9!_]{3,12}$/i', $id)) {

			$msg .= "아이디명은 영문+숫자+특수문자('!','_') 조합된 단어만 사용가능<br>첫글자가 영문 또는 특수문자로 시작되는 4글자 이상 사용하세요.";

			$data = array(	"result"=>$resultYN,
							"msg"=>$msg);

			$this->callback($data);
			exit;
		} 

		if (isset($id)) {
			$where = new QueryWhere();
			$where->set('user_id', $id);
			$this->model->select('member', 'id', $where);

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

		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	/*function selectMemberField() {

		$msg = '데이터 로드를 완료하였습니다.';
		$result = $this->model->select('member', '*');
		if ($result) {
			$rows = $this->model->getRow();
			$email_arr = split('@', $rows['email']);
			$rows['email'] = $email_arr[0];
			$rows['email_tail2'] = $email_arr[1];
			$resultYN = "Y";

			$data = array(	'data'=>$rows,
							'msg'=>$msg);			
		} else {
			$msg = '데이터 로드를 실패하였습니다.';
			$data = array('msg'=>$msg);
			$resultYN = "N";
		}		
		
		$data = array(	'url'=>$rootPath . 'login',
						'result'=>$resultYN,
						'msg'=>$msg);

		$this->callback($data);
	}*/

	function insertMemberJoin() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();		

		$category = $posts['category'];
		$user_id = $posts['user_id'];
		$returnURL = $context->getServer('REQUEST_URI');

		// validation
		$msg = $this->checkValidation($posts);
		if (isset($msg) && $msg) {
	 		$resultYN = 'N';
	 		$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}

		// hoby data
		$hobby = '';
		$index = 0;
		foreach ($posts as $key => $value) {
			if (preg_match('/^hobby+/', $key)) {
				$hobby .= ($index === 0) ? $value : ',' . $value;
				$index++;
			}			
		}	

		// email validation
		$email = $posts['email_address'];
		if ($posts['email_tail1'] !== '직접입력') {
			$email .= '@' . $posts['email_tail1'];
		} else {
			$email .= '@' . $posts['email_tail2'];
		}
	
		$check_email=filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($check_email != true) {
			$msg .= '잘못된 E-mail 주소입니다.';
	 		$resultYN = 'N';
	 		$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}

		$passwordHash = $context->getPasswordHash($posts['password']);
		$posts['password'] = $passwordHash;
		$posts['email_address'] = $email;
		$posts['hobby'] = $hobby;

		$where = new QueryWhere();
		$where->set('user_id', $user_id);
		$this->model->select('member', 'id', $where);

		$numrows = $this->model->getNumRows();
		if ($numrows > 0) {
			$msg = "아이디가 이미 존재합니다.";
			$resultYN = "N";

			$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}
		
		$cachePath = './files/caches/queries/member.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$columns = array();
		for($i=0; $i<count($columnCaches); $i++) {
			$key = $columnCaches[$i];
			$value = $posts[$key];

			if (isset($value) && $value) {
				if ($key === 'password') {
					$value = $value;
				}
				$columns[] = $value;
			} else {
				if ($key === 'date') {
					$columns[] = 'now()';
				} else if ($key === 'ip') {
					$columns[] = $context->getServer('REMOTE_ADDR');
				}  else {
					$columns[] = '';
				}				
			}						
		}

		$result = $this->model->insert('member', $columns);
		if ($result) {
			$msg .= '신규회원 가입을 완료하였습니다.' . PHP_EOL;
			$resultYN = "Y";
		}  else {
			$msg .= '신규회원 가입을 실패하였습니다.' . PHP_EOL;
			$resultYN = "N";			
		}

		//$msg .= Tracer::getInstance()->getMessage();		
		$data = array(	'url'=>$rootPath . 'login',
						'result'=>$resultYN,
						'msg'=>$msg);

		$this->callback($data);
	}

	function updateMemberModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$category = $posts['category'];
		$user_id = $posts['user_id'];

		$returnURL = $context->getServer('REQUEST_URI');
		
		$msg = $this->checkValidation($posts);		
		if (isset($msg) && $msg) {
	 		$resultYN = 'N';
	 		$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}



		// email validation
		$email = $posts['email_address'];
		if ($posts['email_tail1'] !== '직접입력') {
			$email .= '@' . $posts['email_tail1'];
		} else {
			$email .= '@' . $posts['email_tail2'];
		}
	
		$check_email=filter_var($email, FILTER_VALIDATE_EMAIL);
		if ($check_email != true) {
			$msg .= '잘못된 E-mail 주소입니다.';
	 		$resultYN = 'N';
	 		$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}

		// hobe data
		$hobby = '';
		$index = 0;
		foreach ($posts as $key => $value) {
			if (preg_match('/^hobby+/', $key)) {
				$hobby .= ($index === 0) ? $value : ',' . $value;
				$index++;
			}			
		}

		$resultYN = "Y";
		$passwordHash = $context->getPasswordHash($posts['password']);
		$passwordHashConf = $context->getPasswordHash($posts['passwordConf']);

		if ($passwordHash !== $passwordHashConf) {
			$msg .= '확인 비밀번호와 일치하지 않습니다.';
	 		$resultYN = 'N';
	 		$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}

		$posts['password'] = $passwordHash;
		$posts['email_address'] = $email;
		$posts['hobby'] = $hobby;

		$where = new QueryWhere();
		$where->set('category', $category);
		$where->set('user_id', $user_id, '=', 'and');
		$this->model->select('member', 'password', $where);

		$rows = $this->model->getRow();
		if ($passwordHash != $rows['password']) {
			$msg = '등록된 비밀번호와 일치하지 않습니다. <br>다시 입력해주세요.';
			$resultYN = "N";
		} else {

			$cachePath = './files/caches/queries/member.getColumns.cache.php';
			$columnCaches = CacheFile::readFile($cachePath, 'columns');
			if (!$columnCaches) {
				$msg .= "QueryCacheFile Do Not Exists<br>";
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			}

			$filters = '/^(id|category|user_id|password)+$/i';
			$columns = array();
			for($i=0; $i<count($columnCaches); $i++) {
				$key = $columnCaches[$i];
				$value = $posts[$key];

				if (isset($value) && $value) {
					if (!preg_match($filters, $key)) {
						$columns[$key] = $value;
					}					
				} 					
			}

			$result = $this->model->update('member', $columns, $where);
			/*$msg .= Tracer::getInstance()->getMessage();
			echo $msg;
			return;*/
			if ($result) {
				$msg = '회원정보를 수정하였습니다.';
				$resultYN = "Y";
			} else {
				$msg = '회원정보 수정을 실패하였습니다.';
				$resultYN = "N";
			}
		}

		$data = array(	'url'=>$returnURL,
						'result'=>$resultYN,
						'msg'=>$msg);

		$this->callback($data);
	}

	function deleteMember() {

		$msg = '';
		$resultYN = 'Y';		

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$category = $posts['category'];
		$user_id = $posts['user_id'];

		$rootPath = _SUX_ROOT_;	

		$passwordHash = $context->getPasswordHash($posts['password']);
		if (empty($passwordHash)) {
			UIError::alertToBack('비밀번호를 입력해주세요.');
			exit();
		}

		$where = new QueryWhere();
		$where->set('category', $category);
		$where->set('user_id', $user_id);
		$this->model->select('member', 'password', $where);

		$row = $this->model->getRow();
		if ($passwordHash != $row['password']) {
			$msg = '비밀번호가 잘못되었습니다.';
			$resultYN = 'N';
		} else {
			$result = $this->model->delete('member', $where);
			if ($result) {
				$msg = '회원 탈퇴를 완료하였습니다.';
				$resultYN = 'Y';
			} else {
				$msg = '회원 탈퇴를 실패하였습니다.';
				$resultYN = 'N';
			}
		}
		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	'url'=>$rootPath . 'logout?_method=insert',
						'result'=>$resultYN,
						'msg'=>$msg);

		$this->callback($data);
	}
}
?>