<?php

class MemberAdminView extends BaseView {

	var $class_name = 'member_admin_view';

	// display function is defined in parent class 
}

class MemberAdminModule extends BaseView {

	var $class_name = 'member_admin_module';
	var $file_name = 'default.html';

	function init() {

		$this->defaultSetting();

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$page_type = $requests['pagetype'];
		$page_type = $page_type ? $page_type : "main";

		$top_path = _SUX_PATH_ . 'modules/admin/tpl/top.html';
		if (is_readable($top_path)) {
			$contents = new Template($top_path);
			$contents->set('page_type', $page_type);
			$contents->load();
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_path = _SUX_PATH_ . 'modules/member/tpl/' . $this->file_name;
		if (is_readable($skin_path)) {

			$contents = new Template($skin_path);
			foreach ($requests as $key => $value) {
				$contents->set($key, $value);
			}
			$contents->load();			
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$bottom_path = _SUX_PATH_ . 'modules/admin/tpl/bottom.html';
		if (is_readable($bottom_path)) {
			include $bottom_path;
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}

		$this->display();
	}

	function defaultSetting() {}
	function display() {}
}

class GrouplistPanel extends MemberAdminModule {

	var $class_name = 'member_admin_grouplist';

	function defaultSetting() {

		$this->file_name = 'admin_grouplist.html';
	}
}

class GrouplistdataPanel extends BaseView {

	var $class_name = 'member_admin_grouplistdata';

	function init() {

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

		$output = array(	"data"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}

class GroupaddPanel extends MemberAdminModule {

	var $class_name = 'member_admin_add';

	function defaultSetting() {

		$this->file_name = 'admin_groupadd.html';
	}
}

class GroupdelpassPanel extends MemberAdminModule {

	var $class_name = 'member_admin_groupdelpass';

	function defaultSetting() {

		$this->file_name = 'admin_groupdelpass.html';
	}
}

class ListPanel extends MemberAdminModule {

	var $class_name = 'member_admin_list';

	function defaultSetting() {

		$this->file_name = 'admin_list.html';
	}
}

class ListdataPanel extends BaseView {

	var $class_name = 'member_admin_listdata';

	function init() {

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

		$output = array(	"data"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}

class AddPanel extends MemberAdminModule {

	var $class_name = 'member_admin_add';

	function defaultSetting() {

		echo 'member_admin_add';
	}
}

class ModifyPanel extends MemberAdminModule {

	var $class_name = 'member_admin_modify';

	function defaultSetting() {

		$this->file_name = 'admin_modify.html';
	}
}

class ModifydataPanel extends BaseView {

	var $class_name = 'member_admin_modify';

	function init() {

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

		$output = array(	"data"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}

class DelpassPanel extends MemberAdminModule {

	var $class_name = 'member_admin_delpass';

	function defaultSetting() {

		$this->file_name = 'admin_delpass.html';
	}
}

class RecordGroupaddPanel extends BaseView {

	var $class_name = 'member_admin_groupadd';

	function init() {

		$context = Context::getInstance();
		$table_name = $context->getPost('table_name');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->createTable('member');
		if ($result) {
			$msg = "${table_name} 테이블 생성을 성공하였습니다.\n";
			$resultYN = "Y";

			$result = $this->controller->insert('intoMemberGroup');
			if ($result) {
				$msg .= "${table_name} 레코드 등록을 완료하여였습니다.";
				$resultYN = "Y";				
			} else {
				$msg .= "${table_name} 레코드 등록을 실패하였습니다.";
				$resultYN = "N";		
			}
		} else {
			$msg = "${table_name} 테이블 생성을 실패하였습니다.";
			$resultYN = "N";			
		}

		$output = array(	"data"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);
		
		echo parent::callback($output);
	}
}

class RecordGroupdeletePanel extends BaseView {

	var $class_name = 'member_admin_groupdelete';

	function init() {

		$context = Context::getInstance();
		$table_name = $context->getPost('table_name');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->dropTable('member');
		if ($result) {

			$result = $this->controller->delete('memberGroup');
			if (!$result) {
				$msg = "${table_name} 레코드 삭제를 실패하였습니다.";
				$resultYN = "N";
			} else {
				$msg = "${table_name} 레코드 삭제를 성공하였습니다.";
			}
		} else {
			$msg = "${table_name} 테이블 삭제를 실패하였습니다.";
			$resultYN = "N";			
		}

		$output = array(	"member"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);
		
		echo parent::callback($output);
	}
}

class RecordModifyPanel extends BaseView {

	var $class_name = 'member_admin_modify';

	function init() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$name = $posts['name'];

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->update('memberWhereId');
		if ($result) {
			$msg = "${name} 님의 회원정보 수정을 성공하였습니다.\n";			
			$resultYN = "Y";	
		} else {
			$msg = "${name} 님의 회원정보 수정을 실패하였습니다.\n";
			$resultYN = "N";	
		}
		$output = array(	"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}

class RecordDeletePanel extends BaseView {

	var $class_name = 'member_admin_delete';

	function init() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$memberid = $posts['memberid'];

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->delete('fromMember');
		if ($result) {
			$msg = "${memberid} 회원 레코드를 삭제 완료하였습니다.";
			$resultYN = "Y";
		} else {
			
			$msg = "${memberid} 회원 레코드를 삭제 실패하였습니다.";
		 	$resultYN = "N"; 	
		 }

		$output = array(	"member"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}
?>