<?php

class BoardAdminView extends BaseView {

	var $class_name = 'board_admin_view';

	// display function is defined in parent class 
}

class BoardAdminModule extends BaseView {

	var $class_name = 'board_admin_module';
	var $file_name = 'admin_list.html';

	function init() {

		$this->defaultSetting();

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$board = $requests['table_name'];
		$id = $requests['id'];
		$page_type = $requests['pagetype'];
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
			$contents = new Template($skin_path);
			$contents->set('table_name', $board);
			$contents->set('id', $id);
			$contents->load();			
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$bottom_path = _SUX_PATH_ . 'modules/admin/bottom.html';
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

class ListPanel extends BoardAdminModule {

	var $class_name = 'board_admin_list';

	function defaultSetting() {

		$this->file_name = 'admin_list.html';
	}	
}

class AddPanel extends BoardAdminModule {

	var $class_name = 'board_admin_add';

	function defaultSetting() {

		$this->file_name = 'admin_add.html';
	}
}

class ModifyPanel extends BoardAdminModule {

	var $class_name = 'board_admin_modify';

	function defaultSetting() {

		$this->file_name = 'admin_modify.html';
	}
}

class ModifydataPanel extends BaseView {

	var $class_name = 'board_admin_modifydata';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$table_name = $context->getPost('table_name');

		$dataObj = array('table_name'=>$table_name);
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('fromBoard');
		if ($result) {

			$row = $this->model->getRow();
			foreach ($row as $key => $value) {
				${$key} = $value;
				$dataObj[$key] = $value;
			}
		} else {

			$msg = $table_name . "게시판이 존재하지 않습니다.";
			$resultYN = "Y";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}

class SkinlistPanel extends BaseView {

	var $class_name = 'board_admin_skin';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$path = _SUX_PATH_ . "modules/board/skin/";
		
		$msg = "";
		$resultYN = "Y";

		$skinList = Utils::getInstance()->readDir($path);
		if (!$skinList) {
			$msg = "스킨폴더가 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>array("list"=>$skinList),
						"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}

class DelpassPanel extends BoardAdminModule {

	var $class_name = 'board_admin_delpass';

	function defaultSetting() {

		$this->file_name = 'admin_delpass.html';
	}
}

class RecordModules extends BaseView {

	var $class_name = 'board_admin_record_modules';
	var $context;
	var $requests;
	var $posts;

	function init() {

		$this->context = Context::getInstance();
		$this->requests = $this->context->getRequestAll();
		$this->posts = $this->context->getPostAll();
		$this->record();
	}
}
class RecordListPanel extends RecordModules {

	var $class_name = 'board_admin_record_list';

	function record() {

		$mysql_db = $this->context->getDBInfo()['db_database'];
		$board_group = $this->context->get('db_board_group');
		$passover = $this->requests['passover'];

		$limit = 20;  
		if (!$passover) {
			 $passover = 0;			
		}

		$this->context->set('passover', $passover);
		$this->context->set('limit', $limit);

		$dataObj = null;
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$searchYN = $this->controller->searchTables($board_group);
		if ($searchYN) {

			$this->controller->select('fromBoardGroup');
			$numrows = $this->model->getNumRows();
			if ($numrows > 0){

				$a = $numrows - $passover;				
				$this->controller->select('fromBoardGroupLimit');
				$rows = $this->model->getRows();	
				foreach ($rows as $key => $row) {

					$fields = array('no'=>$a);
					foreach ($row as $key => $value) {
						$fields[$key] = $value;
					}

					$dataList[] = $fields;
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

		echo parent::callback($data);
	}
}

class RecordAddPanel extends RecordModules {

	var $class_name = 'board_admin_record_add';

	function record() {

		$context = Context::getInstance();
		$board = $context->getPost('table_name');
		if (!isset($board) && $board == '') {
			$board = $context->getRequest('table_name');
		}

		$dir = _SUX_PATH_ . "board_data/";

		$resultYN = "Y";

		if (!is_dir($dir)) {
			if (@mkdir($dir, 0777)) {
				$msg = "게시판 자료저장  폴더를 생성하였습니다.\n";
				$resultYN = "Y";
			} else {
				$msg = "게시판 자료저장  폴더를 생성 실패하였습니다.\n";
				$resultYN = "N";
			}	
		} 

		$result = $this->controller->createTable('board');
		if (!$result) {
			$msg .= "${board} 테이블이 이미 생성 되었습니다.\n";
			$resultYN = "N";
		} else {
			$msg .= "${board} 테이블 생성을 성공하였습니다.\n";

			$result = $this->controller->insert('intoBoard');
			if (!$result) {
				$msg .= "${board} 테이블에 시동 게시글 등록을 실패하였습니다.\n";		
			} else {
				$msg .= "${board} 테이블에 시동 게시글이 정상적으로 등록되었습니다.\n";
			}	

			$result = $this->controller->insert('intoBoardGroup');
			if (!$result) {
				$msg .= "${board} 테이블이 그룹테이블 등록에 실패하였습니다.\n";
			}else{
				$msg .= "${board} 테이블이 그룹테이블에 정상적으로 등록되었습니다.\n";		
			}

			$result = $this->controller->createTable('comment');
			if (!$result) {
				$msg .= "${board}_grg 꼬리글 테이블 생성을 실패하였습니다.\n";
			} else {
				$msg .= "${board}_grg 꼬리글 테이블 생성을 성공하였습니다.\n";
			}

			$dir = $dir . $board;
			if (!@mkdir( $dir, 0777)) {
				$msg .= "${board} 디렉토리가 이미 생성되어 있습니다.";
			} else {
				$msg .= "${board} 디렉토리 폴더 생성을 성공하였습니다.";
			}
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}

class RecordModifyPanel extends RecordModules {

	var $class_name = 'board_admin_record_modify';

	function record() {
		
		$table_name = $this->requests['table_name'];

		$dataObj = array();
		$resultYN = "Y";
		$msg = "";

		$result = $this->controller->update('recordModify');
		if (!$result) {
			$msg = "$table_name 테이블 수정을 실패하였습니다.";
			$resultYN = "N";	
		} else {
			$msg = "$table_name 테이블 수정을 완료하였습니다.";
		}

		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}

class RecordDeletePanel extends RecordModules {

	var $class_name = 'board_admin_record_delete';

	function record() {

		$table_name = $this->posts['table_name'];
		$table_name_grg =$table_name."_grg";
		$id = $this->posts['id'];

		$dir = _SUX_PATH_ . 'board_data/' . $table_name;

		$resultYN = "Y";
		$msg = "";

		$result = $this->controller->dropTable('board');
		if (!$result) {
			$msg .= "${table_name} 테이블 삭제를 실패하였습니다.\n";
		} else {
			$msg .= "${table_name} 테이블 삭제를 성공하였습니다.\n";
		}

		$result = $this->controller->delete('boardFromGroup');
		if (!$result) {
			$msg .= "${table_name} 레코드를 게시판그룹에서 삭제 실패하였습니다.\n";
		} else {
			$msg .= "${table_name} 레코드를 게시판그룹에서 삭제 성공하였습니다.\n";
		}
		
		$result = $this->controller->dropTable('comment');
		if (!$result) {
			$msg .= "${table_name_grg} 꼬리글 테이블 삭제를 실패하였습니다.\n";
		} else {
			$msg .= "${table_name_grg} 꼬리글 테이블 삭제를 성공하였습니다.\n";
		}

		if (trim($table_name) == "") {
			$msg .= "삭제할 폴더명을 입력해주세요.\n";
		} else {
			$resultDir = Utils::getInstance()->deleteDir($dir);
			if ($resultDir) {
				$msg .= "${table_name} 폴더 삭제를 성공하였습니다.";
			} else {
				$msg .= "${table_name} 폴더 삭제를 실패하였습니다.";
			}
		}		

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}
?>