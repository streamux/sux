<?php

class MemberAdminModule extends BaseView {
	
	var $class_name = 'admin_admin_module';
	var $skin_path_list = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

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

class MemberAdminView extends MemberAdminModule {

	var $class_name = 'member_admin_view';

	function displayGroupList() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_grouplist.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}	

	function displayGroupAdd() {
		
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_groupadd.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayGroupDelete() {
		
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_groupdelete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayList() {
		
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayAdd() {
		
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayModify() {
		
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_modify.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayDelete() {
		
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/member/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayGroupListJson() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$dataObj = array();
		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('fromMemberGroup');
		if ($result){

			$numrow = $this->model->getNumRows();
			if ($numrow > 0) {

				$rows = $this->model->getRows();
				for ($i=0; $i<count($rows); $i++) {

					$dataList = array('no'=>($i+1));
					foreach ($rows[$i] as $key => $value) {
						$dataList[$key] = $value;
					}
					$dataObj[] = $dataList;
				}				
			} else {
				$msg = "회원그룹이 존재하지 않습니다.";
				$resultYN = "N";
			}
		} 

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayListJson() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();

		$group = $context->get('db_member_group');	
		$table_name = $posts["table_name"];
		if (!isset($table_name) && $table_name == '') {
			$table_name = $requests['table_name'];
		}
		$passover = $requests['passover'];
		
		$dataObj = array();
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('memberFromMemberGroup');
		if ($result){

			$result = $this->controller->select('member');
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

					$result = $this->controller->select('memberLimit');
					if ($result) {

						$rows = $this->model->getRows();

						for ($i=0; $i<count($rows); $i++) {				
							$adm_id = $rows[$i]["id"];
							$adm_name = $rows[$i]["name"];
							$adm_memberid = $rows[$i]["ljs_memberid"];
							$adm_company = $rows[$i]["company"];
							$adm_day = $rows[$i]["date"];
							$adm_point = $rows[$i]["point"];
							$adm_grade = $rows[$i]["grade"];
							$adm_hit = $rows[$i]["hit"];
							$adm_ip = $rows[$i]["ip"];

							array_push($dataList, array("no"=>$a,"id"=>$adm_id,"memberid"=>$adm_memberid,"name"=>$adm_name,"date"=>$adm_day,"hit"=>$adm_hit,"grade"=>$adm_grade,"table_name"=>$table_name));

							$a--;
						}

						$dataObj = array("table_name"=>$table_name, "list"=>$dataList);
					}				
				} else {

					$dataObj = array("table_name"=>$table_name, "list"=>$dataList);
					$msg .= "현재 등록된 회원이 없습니다.";
				}
			}			
		} else {
			$msg .= "현재 등록된 회원그룹이 없습니다.";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayModifyJson() {
		
		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$table_name = $posts['table_name'];
		$memberid = $posts['memberid'];

		$dataObj = array(
			'table_name'=>$table_name
		);
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('memberWhereId');
		if ($result) {

			$row = $this->model->getRow();
			foreach ($row as $key => $value) {

				if (preg_match('/ljs_pass/', $key)) {

				} else if (preg_match('/email/', $key)) {
					$emailList = split("@", $value );
					$dataObj['email'] = $emailList[0];
					$dataObj['email_tail2'] = $emailList[1];
				} else {
					$dataObj[$key] = $value;
				}			
			}
		} else {
			$msg = "$memberid 회원이 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}	

	function RecordGroupAdd() {

		$context = Context::getInstance();
		$table_name = $context->getPost('table_name');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->createTable('member');
		if ($result) {

			$result = $this->controller->insert('intoMemberGroup');
			if ($result) {
				$msg .= "${table_name} 회원그룹을 등록하였습니다.";
				$resultYN = "Y";				
			} else {
				$msg .= "${table_name} 레코드 등록을 실패하였습니다.";
				$resultYN = "N";		
			}
		} else {
			$msg = "${table_name} 테이블 생성을 실패하였습니다.";
			$resultYN = "N";			
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);
		
		echo $this->callback($data);
	}	

	function RecordGroupDelete() {

		$context = Context::getInstance();
		$table_name = $context->getPost('table_name');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->dropTable('member');
		if ($result) {

			$result = $this->controller->delete('memberGroup');
			if (!$result) {
				$resultYN = "Y";
				$msg = "${table_name} 회원그룹을 삭제하였습니다.";				
			} else {
				$msg = "${table_name} 레코드 삭제를 실패하였습니다.";
				$resultYN = "N";
			}
		} else {
			$msg = "${table_name} 테이블 삭제를 실패하였습니다.";
			$resultYN = "N";			
		}

		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);
		
		echo $this->callback($data);
	}

	function RecordModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$name = $posts['name'];

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->update('memberWhereId');
		if ($result) {
			$msg = "${name} 님의 회원정보를 수정하였습니다.\n";			
			$resultYN = "Y";	
		} else {
			$msg = "${name} 님의 회원정보 수정을 실패하였습니다.\n";
			$resultYN = "N";	
		}
		$data = array(	"result"=>$resultYN,
							"msg"=>$msg);

		echo $this->callback($data);
	}
	
	function RecordDelete() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$memberid = $posts['memberid'];

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->delete('fromMember');
		if ($result) {
			$msg = "${memberid} 회원정보를 삭제하였습니다.";
			$resultYN = "Y";
		} else {
			
			$msg = "${memberid} 회원 레코드를 삭제 실패하였습니다.";
		 	$resultYN = "N"; 	
		 }

		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}
}
?>