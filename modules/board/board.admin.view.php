<?php

class BoardAdminView extends BaseView {

	var $class_name = 'board_admin_view';

	// display function is defined in parent class 
}

class BoardAdminModuleView extends BaseView {

	var $class_name = 'board_admin_module';
	var $file_name = 'admin_list.html';

	function init() {

		$this->defaultSetting();

		$context = Context::getInstance();
		$page_type = $context->getRequest("pageType");
		$page_type = $page_type ? $page_type : "main";

		$top_path = _SUX_PATH_ . 'modules/admin/top.html';
		if (is_readable($top_path)) {
			$contents = new Template($top_path);
			$contents->set('page_type', $page_type);
			$contents->load();
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_path = _SUX_PATH_ . 'modules/board/tpl/' . $this->file_name;
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$bottom_path = _SUX_PATH_ . 'modules/admin/bottom.html';
		if (is_readable($bottom_path)) {
			include $bottom_path;
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class ListPanel extends BoardAdminModuleView {

	var $class_name = 'board_admin_list';

	function defaultSetting() {

		$this->file_name = 'admin_list.html';
	}	
}

class AddPanel extends BoardAdminModuleView {

	var $class_name = 'board_admin_add';

	function defaultSetting() {

		$this->file_name = 'admin_add.html';
	}
}

class ModifyPanel extends BoardAdminModuleView {

	var $class_name = 'board_admin_modify';

	function defaultSetting() {

		$this->file_name = 'admin_modify.html';
	}
}

class DelpassPanel extends BoardAdminModuleView {

	var $class_name = 'board_admin_delpass';

	function defaultSetting() {

		$this->file_name = 'admin_delpass.html';
	}
}

class RecordListPanel extends BaseView {

	var $class_name = 'board_admin_record_list';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$mysql_db = $context->getDBInfo()['db_database'];
		$board_group = $context->get('db_board_group');
		$passover = $context->getRequest('passover');

		$limit = 20;  
		if (!$passover) {
			 $passover = 0;			
		}

		$context->set('passover', $passover);
		$context->set('limit', $limit);

		$dataObj = null;
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$searchYN = $this->controller->searchTables($board_group);
		if ($searchYN) {

			$this->controller->select('fromBoardGroup');
			$numrows = $this->model->getNumRows();			

			if ($numrows > 0){

				$this->controller->select('fromBoardGroupLimit');
				$num = $this->model->getNumRows();
				$rows = $this->model->getRows();	

				$a = $numrows-$passover;

				for ($i=0; $i<$num; $i++) {
					$id = $rows[$i]['id'];
					$name = $rows[$i]['name'];
					$board_name = $rows[$i]['board_name'];
					$width = $rows[$i]['width'];
					$day = $rows[$i]['date'];
					$grade = $rows[$i]['grade'];
					$log_key = $rows[$i]['log_key'];
					$output = $rows[$i]['output'];

					array_push($dataList, array("no"=>$a,"id"=>$id,"table_name"=>$name, "board_name"=>$board_name,"date"=>$day,"log_key"=>$log_key,"width"=>$width));

					$a--;
				}

				$dataObj = array("list"=>$dataList);
			} else {
				$msg = "게시판이 존재하지 않습니다.";
				$resultYN = "N";
			}
		} else {
			$msg = "그룹테이블이 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$strJson = $this->model->parseToJson($data);
		echo $requests['callback'].'('.$strJson.')';
	}
}

class RecordAddPanel extends BaseView {

	var $class_name = 'board_admin_record_add';
}

class RecordModifyPanel extends BaseView {

	var $class_name = 'board_admin_record_modify';
}

class RecordDeletePanel extends BaseView {

	var $class_name = 'board_admin_record_delete';

	
}
?>