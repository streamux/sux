<?php

class MemberAdminView extends ModuleAdminView {

	var $class_name = 'member_admin_view';

	function displayMemberAdmin() {

		$this->displayGroup();
	}

	function displayGroup() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$action = $this->request_data['action'];
		$this->document_data['jscode'] = 'groupList';
		$this->document_data['module_code'] = 'member';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_grouplist.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayGroupAdd() {
		
		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$action = $this->request_data['action'];
		$this->document_data['jscode'] = 'groupAdd';
		$this->document_data['module_code'] = 'member';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_groupadd.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayGroupDelete() {
		
		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->request_data['id'] = $context->getParameter('id');

		$this->document_data['jscode'] = 'groupDelete';
		$this->document_data['module_code'] = 'member';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_groupdelete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayGroupJson() {

		$context = Context::getInstance();

		$dataObj = array();		
		$msg = "";
		$resultYN = "Y";

		$result = $this->model->selectFromMemberGroup();
		if ($result){

			$numrow = $this->model->getNumRows();
			if ($numrow > 0) {
				$i = 1;
				foreach ($this->model->getRows() as $row) {
					$dataList['no'] = $i;
					foreach ($row as $key => $value) {
						$dataList[$key] = $value;
					}
					$dataObj[] = $dataList;
					$i++;		
				}
			} else {
				$msg = "회원그룹이 존재하지 않습니다.";
				$resultYN = "N";
			}
		} 

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function displayList() {
		
		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->selectFromMemberGroup('category', $where);
		$row = $this->model->getRow();
		$this->document_data['id'] = $id;
		$this->document_data['category'] = $row['category'];

		$this->document_data['jscode'] = 'list';
		$this->document_data['module_code'] = 'member';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayAdd() {
		
		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$action = $this->request_data['action'];
		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'member';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayModify() {
		
		$context = Context::getInstance();
		$id = $context->getParameter('id');
		$sid = $context->getParameter('sid');

		$this->document_data['jscode'] = 'modify';
		$this->document_data['module_code'] = 'member';

		$where = new QueryWhere();
		$where->set('id', $sid);
		$this->model->selectFromMember('category, user_id, user_name', $where);
		$row = $this->model->getRow();

		$this->document_data['category'] = $row['category'];
		$this->document_data['user_id'] = $row['user_id'];
		$this->document_data['user_name'] = $row['user_name'];
		$this->document_data['category_id'] = $id;
		$this->document_data['id'] = $sid;		

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_modify.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayDelete() {
		
		$context = Context::getInstance();
		$id = $context->getParameter('id');
		$sid = $context->getParameter('sid');

		$this->document_data['jscode'] = 'delete';
		$this->document_data['module_code'] = 'member';

		$where = new QueryWhere();
		$where->set('id', $sid);
		$this->model->selectFromMember('user_id', $where);
		$row = $this->model->getRow();

		$this->document_data['user_id'] = $row['user_id'];
		$this->document_data['category_id'] = $id;
		$this->document_data['id'] = $sid;		

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayListJson() {

		$context = Context::getInstance();
		$category = $context->getRequest('category');
		
		$dataObj = array();
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('category', $category);
		$result = $this->model->selectFromMember('*', $where);
		if ($result) {

			$numrows = $this->model->getNumRows();
			if ($numrows > 0){

				$limit = 10;  
				if (!$passover) {
					$passover = 0;
				}
				$a = $numrows - $passover;

				$context->set('member_passover', $passover);
				$context->set('member_limit', $limit);

				$result = $this->model->selectFromMember('*', $where, 'id desc', $passover, $limit);
				if ($result) {

					$rows = $this->model->getRows();

					for ($i=0; $i<count($rows); $i++) {

						$obj = array();
						$obj['no'] = $a;

						foreach ($rows[$i] as $key => $value) {
							$obj[$key] = $value;
						}

						$dataList[] = $obj;

						$a--;
					}

					$dataObj = array('category'=>$category, 'list'=>$dataList);
				}				
			} else {

				$dataObj = array('category'=>$category, 'list'=>$dataList);
				$msg .= '현재 등록된 회원이 없습니다.';
			}
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	'data'=>$dataObj,
						'result'=>$resultYN,
						'msg'=>$msg);

		$this->callback($data);
	}

	function displayModifyJson() {
		
		$context = Context::getInstance();
		$id = $context->getPost('id');

		$dataObj = array();
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);

		$result = $this->model->selectFromMember('*', $where);
		if ($result) {

			$row = $this->model->getRow();
			foreach ($row as $key => $value) {

				if (preg_match('/password/', $key)) {

				} else if (preg_match('/email/', $key)) {
					$emailList = split("@", $value );
					$dataObj['email_address'] = $emailList[0];
					$dataObj['email_tail2'] = $emailList[1];
				} else {
					$dataObj[$key] = $value;
				}			
			}
		} 

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}	
}
?>