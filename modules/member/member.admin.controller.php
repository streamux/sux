<?php

class MemberAdminController extends Controller
{

	function insertGroupAdd() {

		$json = array();
		$msg = '';
		$resultYN = 'Y';

		$context = Context::getInstance();
		$posts = $context->getRequestAll();
		$menu = json_decode($posts['menu']);
		$prefix = $context->getPrefix();
		foreach ($menu as $key => $value) {
			${$key} = $value;
		}

		if (empty($group_name)) {
			UIError::alertToBack('그룹 영문 이름을 입력해주세요.');
			exit;
		}
		
		if (empty($category)) {
			/*$srl = $category . microtime(true) * 100;
			$category = $prefix . substr(md5($srl), 0, 26);*/
			$category = $group_name;
		}

		$where = new QueryWhere();
		$where->set('group_name', $group_name);
		$result = $this->model->select('member_group', 'id', $where);
		$rownum = $this->model->getNumrows();
		if ($rownum > 0) {
			UIError::alertToBack("'${group_name}' 그룹 이름이 이미 존재합니다.");
			exit;
		}

		$column = array(
			'',
			$category,
			$group_name,
			$summary,
			$header_path,
			$footer_path,
			'now()');

		$result = $this->model->insert('member_group', $column);
		if ($result) {
			$msg .= "${group_name} 회원그룹을 등록하였습니다.";
			$resultYN = "Y";				
		} else {
			$msg .= "${group_name} 레코드 등록을 실패하였습니다.";
			$resultYN = "N";		
		}

		$where->set('category', $category);
		$this->model->select('member_group', '*', $where);
		$rows = $this->model->getRows();

		//$msg = Tracer::getInstance()->getMessage();		
		
		$json['msg'] = $msg;
		$json['result'] = $resultYN;
		$json['data'] = $rows;
		
		$this->callback($json);
	}

	function insertGroupCheckid() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$category = $posts['category'];
		$msg = "카테고리 그룹 이름 : ".$category."\n";	
		
		if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{3,}$/i', $category)) {

			$msg .= "카테고리 명은 영문,숫자,특수문자('_') 단어만 사용가능합니다.<br>첫글자가 영문 시작되는 4글자 이상 단어를 사용하세요.";

			$data = array(	"result"=>$resultYN,
							"msg"=>$msg);

			$this->callback($data);
			exit;
		} 
		
		if (isset($category)) {
			$where = new QueryWhere();
			$where->set('category', $category);
			$this->model->select('member_group', 'id', $where);

			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$msg = "'${category}'는 이미 존재하는 카테고리 이름입니다.";
				$resultYN = "N";
			} else {
				$msg = "'${category}'는 사용할 수 있는 카테고리 이름입니다.";
				$resultYN = "Y";
			}
		}else{
			$msg = "카테고리 이름을 넣고 중복체크를 하세요.";
			$resultYN = "N";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function updateGroupModify() {

		$json = array();
		$msg = '';
		$resultYN = 'Y';

		$context = Context::getInstance();
		$menu = $context->getRequest('menu');
		$menu = json_decode($menu);
		
		if (empty($menu)) {
			UIError::alertToBack("그룹 정보가 존재하지 않습니다.");
			exit;
		}

		$columns = array();
		foreach ($menu as $key => $value) {
			if (empty($value) || $key === 'id') {
				continue;
			}
			if ($key === 'date') {
				$value = 'now()';
			}
			$columns[$key] = $value;
		}

		$where = new QueryWhere();
		$where->set('id', $menu->id);

		$result = $this->model->update('member_group', $columns, $where);
		if (!$result) {
			$msg .= $columns['group_name']  . " 수정을 실패하였습니다.";
			$resultYN = 'N';
		}

		//$msg = Tracer::getInstance()->getMessage();

		$json['msg'] = $msg;
		$json['result'] = $resultYN;

		$this->callback($json);
	}

	function deleteGroupDelete() {

		$dataObj	= '';
		$msg = '';
		$resultYN = 'Y';

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$id = $requests['id'];

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('member_group', 'category', $where);
		$row = $this->model->getRow();
		$category = $row['category'];

		$result = $this->model->delete('member_group', $where);
		if (!$result) {
			$msg .= "${category} 그룹 삭제를 실패하였습니다.";
			$resultYN = "N";				
		} else {
			$where->reset();
			$where->set('category', $category);
			$this->model->delete('member', $where);
			if (!$result) {
				$msg .= "${category} 회원 삭제를 실패하였습니다.";
				$resultYN = "N";
			}
		}
		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);
		
		$this->callback($data);
	}

	function updateModify() {

		$msg = "";
		$resultYN = "Y";

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		// json 형태로 값이 넘어 올때 
		if (!(isset($posts) && $posts && count($posts) > 0)) {	
			$posts = $context->getRequestAll();	
			$dataes = array();	
			$member = json_decode($posts['member']);
			foreach ($member as $key => $value) {
				$dataes[$key] = $value;
			}
			$posts = $dataes;
		}

		$id = $posts['id'];
		$user_name = $posts['user_name'];

		$where = new QueryWhere();
		$where->set('id', $id);

		$cachePath = './files/caches/queries/member.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$ignorePattern = '/^(id)$/';
		$column = array();	
		foreach ($columnCaches as $key) {
			if (!preg_match($ignorePattern, $key)) {
				$value = $posts[$key];				
				if (isset($value) && $value) {
					if (preg_match('/^(password)$/', $key)) {	
						$column[$key] = $context->getPasswordHash($value);
					} else {
						$column[$key] = $value;
					}
				}
			}	
		}

		$this->model->select('member', 'password', $where);
		$row = $this->model->getRow();
		$passwordPattern = '/^'.$row['password'].'$/';
		$newPassword = $column['password'];
		if (preg_match($passwordPattern, $newPassword)) {
			$result = $this->model->update('member', $column, $where);
			if ($result) {			
				$msg .= "${user_name} 님의 회원정보를 수정하였습니다.\n";			
				$resultYN = "Y";	
			} else {
				$msg .= "${user_name} 님의 회원정보 수정을 실패하였습니다.\n";
				$resultYN = "N";	
			}
		} else {
			$msg .= '비밀번호가 같지 않습니다.';
		}
		
		//$msg = Tracer::getInstance()->getMessage();
		$json = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($json);
	}
	
	function deleteDelete() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$id = $requests['id'];

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('member', 'user_id', $where);
		$row = $this->model->getRow();
		$user_id = $row['user_id'];

		$result = $this->model->delete('member', $where);
		if ($result) {
			$msg = "${user_id} 회원정보를 삭제하였습니다.";
			$resultYN = "Y";
		} else {
			
			$msg = "${user_id} 회원정보 삭제를 실패하였습니다.";
		 	$resultYN = "N"; 	
		 }
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
}
?>