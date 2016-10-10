<?php

class BoardAdminModule extends BaseView {
	
	var $class_name = 'board_admin_module';
	var $skin_path_list = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

	function output() { 

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
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
	}
}

class BoardAdminView extends BoardAdminModule {

	var $class_name = 'board_admin_view';

	function displayList() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/board/tpl";

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
		$skinPath = _SUX_PATH_ . "modules/board/tpl";

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
		$skinPath = _SUX_PATH_ . "modules/board/tpl";

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
		$skinPath = _SUX_PATH_ . "modules/board/tpl";

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

	function displaySkinListJson() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skinDir = _SUX_PATH_ . "modules/board/skin/";
		
		$msg = "";
		$resultYN = "Y";

		$skinList = Utils::readDir($skinDir);
		if (!$skinList) {
			$msg = "스킨폴더가 존재하지 않습니다.";
			$resultYN = "N";
		}
		
		sort($skinList);
		$data = array(	"data"=>array("list"=>$skinList),
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayListJson() {

		$context = Context::getInstance();
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

		echo $this->callback($data);
	}

	function displayModifyJson() {

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

		echo $this->callback($data);
	}

	function displayCheckTableName() {

		$context = Context::getInstance();
		$table_name = $context->getRequest('table_name');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$msg = "추가 생성 게시판 : ".$table_name."\n";

		if (!isset($table_name) || $table_name == '') {

			$msg = "게시판 이름을 넣고 중복체크를 하십시오.";
			$resultYN = "N";

			$data = array(	"result"=>$resultYN,
							"msg"=>$msg);

			echo $this->callback($data);
			exit;
		}

		if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]{3,12}$/i', $table_name)) {

			$msg .= "테이블명은 영문+숫자+특수문자('_')로 조합된 단어만 사용가능\n첫글자가 영문 또는 특수문자로 시작되는 4글자 이상 사용하세요.";

			$data = array(	"msg"=>$msg);			
			echo $this->callback($data);
			exit;
		} 

		$result = $this->controller->select('fromBoard');
		$numrows = $this->model->getNumRows();

		if ($numrows> 0) {
			$msg = "${table_name}는 이미 존재하는 게시판입니다.";
			$resultYN = "N";
		} else {
			$msg = "${table_name}는 생성할 수 있는 게시판입니다.";
			$resultYN = "Y";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordAdd() {

		$context = Context::getInstance();
		$board = $context->getRequest('table_name');

		$dir = _SUX_PATH_ . "board_data/";

		$resultYN = "Y";

		if (!is_dir($dir)) {
			if (@mkdir($dir, 0777)) {
				$msg = "게시판 디렉토리 관리 폴더를 생성하였습니다.\n";
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
				$msg .= "${board} 디렉토리가 이미 생성되어 있습니다.\n";
			} else {
				$msg .= "${board} 디렉토리 폴더 생성을 성공하였습니다.\n";
			}
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordModify() {

		$context = Context::getInstance();
		$table_name = $context->getRequest('table_name');

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

		echo $this->callback($data);
	}

	function recordDelete() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$table_name = $posts['table_name'];
		$table_name_grg =$table_name."_grg";
		$id = $posts['id'];

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
			$resultDir = Utils::deleteDir($dir);
			if ($resultDir) {
				$msg .= "${table_name} 폴더 삭제를 성공하였습니다.";
			} else {
				$msg .= "${table_name} 폴더 삭제를 실패하였습니다.";
			}
		}		

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}
}
?>