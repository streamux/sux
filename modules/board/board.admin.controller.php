<?php

class BoardAdminController extends Controller
{

	function insertAdd() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$returnURL = $context->getServer('REQUEST_URI');
		$adminId = $context->getAdminInfo('admin_id');
		$adminEmail = $context->getAdminInfo('admin_email');

		$resultYN = 'Y';
		
		foreach ($posts as $key => $value) {
			${$key} = $value;
		}

		$where = new QueryWhere();
		$where->set('category', $category);
		$this->model->selectFromBoardGroup('id', $where);
		$numrows = $this->model->getNumRows();
		if ($numrows > 0) {
			$msg = $category . '게시판이 이미 존재합니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$column = array(
			'', 
			$category,
			$board_name, $summary,$header_path, $skin_path, $footer_path, $allow_nonmember,
			$is_writable, $is_readable, $is_modifiable, $is_repliable,
			$grade_w, $grade_r, $grade_m, $grade_re,$board_width,
			$board_type,$is_latest,$limit_pagination,
			$is_comment, $is_download, $is_progress_step,
			$limit_choice, $limit_word, 'now()'
		);

		$result = $this->model->insertIntoBoardGroup($column);
		if (!$result) {
			$msg .= "${category}게시판 등록을 실패하였습니다.<br>";
		}else{
			$msg .= "${category}게시판이 정상적으로 등록되었습니다.<br>";		
		}

		$testPwd = '12';
		$testPwd = substr(md5(trim($testPwd)),0,8);
		$testPwd = substr(md5(trim($testPwd)),0,8);

		$column = array(
			'',$category,'n',$adminId,'운영자','운영자',$testPwd,
			'게시판 시동 테스트',
			'본 게시물은 게시판 시동을 위해 자동 등록된 것입니다.<br> 본 게시물을 삭제하기 전에 반드시 하나를 등록하시기 바랍니다.',
			$adminEmail,'now()',$context->getServer('REMOTE_ADDR'),
			0,0,0,'',1,0,0,'a','','','','html'
		);
		$result = $this->model->insertIntoBoard($column);
		if (!$result) {
			$msg .= "시동 게시글 등록을 실패하였습니다.<br>";		
		} else {
			$msg .= "시동 게시글이 정상적으로 등록되었습니다.<br>";

			// 라우트 키 저장 
			$filePath = _SUX_PATH_ . 'caches/board.cache.php';
			$routes = array();
			if (is_readable($filePath)) {
				include($filePath);
				$routes['categories'] = $categories;
				$routes['action'] = $action;

				$pattern = sprintf('/(%s)+/i', $category);
				if (!preg_match($pattern, implode(',', $routes['categories']))) {
					$routes['categories'][] = $category;  
				}
			}

			$modueCache = ModuleCache::getInstance();
			$modueCache->saveCacheForRoute($filePath, $routes);			
		}	

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function updateModify() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

		$dataObj = array();
		$resultYN = "Y";
		$msg = "";

		$posts = $context->getPostAll();
		$column = array();
		foreach ($posts as $key => $value) {			
			if (!($key == 'id' || $key == 'category' || $key == '_method')) {
				$column[$key] = $value;
			}			
		}

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->updateBoardGroup($column, $where);
		if (!$result) {
			$msg = "$category 게시판 수정을 실패하였습니다.";
			$resultYN = "N";	
		} else {
			$msg = "$category 게시판 수정을 완료하였습니다.";
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"member"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function deleteDelete() {

		$context = Context::getInstance();
		$category = $context->getPost('category');
		$id = $context->getPost('id');

		$dir = _SUX_PATH_ . 'board_data/';

		$resultYN = "Y";
		$msg = "";
		
		$where = new QueryWhere();
		$where->set('category', $category);
		$this->model->selectFromBoard('id', $where);

		$where->reset();
		$i = $this->model->getNumRows();
		$rows = $this->model->getRows();
		while ( $i--) {
			$cid = $rows[$i]['id'];
			$where->set('contents_id', $cid, '=', 'or');			
		}
		$result = $this->model->deleteFromComment($where);
		if (!$result) {
			$msg .= "[${cid}]번 게시글의 답글 삭제를 실패하였습니다.<br>";
		}

		$where->reset();
		$where->set('category', $category);
		$result = $this->model->deleteFromBoard($where);
		if (!$result) {
			$msg .= "${category} 게시판에 등록된 모든 글 삭제를 실패하였습니다.<br>";
		} else {
			$msg .= "${category} 게시판에 등록된 모든 글을 삭제하였습니다.<br>";
		}

		$where->reset();
		$where->set('id', $id);
		$result = $this->model->deleteFromBoardGroup($where);
		if (!$result) {
			$msg .= "${category} 게시판 삭제를 실패하였습니다.<br>";
		} else {
			$msg .= "${category} 게시판을 삭제하였습니다.<br>";

			// 라우트 카테고리 키 저장 
			$filePath = _SUX_PATH_ . 'caches/board.cache.php';
			$routes = array();
			if (is_readable($filePath)) {
				include($filePath);
				$routes['categories'] = $categories;
				$routes['action'] = $action;

				$len = count($routes['categories']);
				for($i=0; $i<$len; $i++) {
					$input = $routes['categories'][$i];
					//$msg .= $input . '  ';
					if (strcmp($input, $category) === 0) {
						array_splice($routes['categories'], $i, 1);
						break;
					}
				}
			}

			$modueCache = ModuleCache::getInstance();
			$modueCache->saveCacheForRoute($filePath, $routes);
		}		

		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
}
