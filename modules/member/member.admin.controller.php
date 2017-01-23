<?php

class MemberAdminController extends Controller
{

	function insertGroupAdd() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$category = $posts['category'];
		$groupName = $posts['group_name'];
		$summary = $posts['summary'];
		$headerPath = $posts['header_path'];
		$footerPath = $posts['footer_path'];

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('category', $category);
		$result = $this->model->select('member_group', 'id', $where);

		$rownum = $this->model->getNumrows();
		if ($rownum > 0) {
			UIError::alertToBack('This Category Name Already Exists!');
			exit;
		}

		$column = array(
			'',
			$category,
			$groupName,
			$summary,
			$headerPath,
			$footerPath,
			'now()');

		$result = $this->model->insert('member_group', $column);
		if ($result) {
			$msg .= "${category} 회원그룹을 등록하였습니다.";
			$resultYN = "Y";				
		} else {
			$msg .= "${category} 레코드 등록을 실패하였습니다.";
			$resultYN = "N";		
		}		
		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);
		
		$this->callback($data);
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

	function deleteGroupDelete() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->delete('member_group', $where);
		if ($result) {
			$resultYN = "Y";
			$msg = "회원그룹을 삭제하였습니다.";				
		} else {
			$msg = "레코드 삭제를 실패하였습니다.";
			$resultYN = "N";
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);
		
		$this->callback($data);
	}

	function updateModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$id = $posts['id'];
		$user_name = $posts['user_name'];

		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);

		$column_data = array_slice($posts, 2);
		$column = array();
		foreach ($column_data as $key => $value) {			
			if ($value != '') {
				if (preg_match('/password/', $key)) {	
					$column[$key] = $context->getPassowordHash($value);
				} else {
					$column[$key] = $value;
				}	
			}				
		}

		$result = $this->model->update('member', $column, $where);
		if ($result) {			
			$msg = "${user_name} 님의 회원정보를 수정하였습니다.\n";			
			$resultYN = "Y";	
		} else {
			$msg = "${user_name} 님의 회원정보 수정을 실패하였습니다.\n";
			$resultYN = "N";	
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
	
	function deleteDelete() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

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