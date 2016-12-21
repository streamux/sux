<?php

class MemberAdminController extends Controller
{

	function insertGroupAdd() {

		$context = Context::getInstance();
		$category = $context->getPost('category');
		$groupName = $context->getPost('group_name');
		$summary = $context->getPost('summary');
		$headerPath = $context->getPost('header_path');
		$footerPath = $context->getPost('footer_path');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('category', $category);
		$result = $this->model->selectFromMemberGroup('id', $where);
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

		$result = $this->model->insertIntoMemberGroup($column);
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

	function deleteGroupDelete() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->deleteMemberGroup($where);
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
					$column[$key] = substr(md5($value),0,8);
				} else {
					$column[$key] = $value;
				}	
			}				
		}

		$result = $this->model->updateFromMember($column, $where);
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
		$this->model->selectFromMember('user_id', $where);
		$row = $this->model->getRow();
		$user_id = $row['user_id'];

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->deleteFromMember($where);
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