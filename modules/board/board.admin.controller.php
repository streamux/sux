<?php

class BoardAdminController extends Controller
{

	function insertAdd() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$returnURL = $context->getServer('REQUEST_URI');
		$adminId = $context->getAdminInfo('admin_id');
		$adminEmail = $context->getAdminInfo('admin_email');

		$msg = '';
		$resultYN = 'Y';
		
		foreach ($posts as $key => $value) {
			${$key} = $value;
		}

		$where = new QueryWhere();
		$where->set('category', $category);
		$this->model->select('board_group','id', $where);
		$numrows = $this->model->getNumRows();
		if ($numrows > 0) {
			$msg = $category . '게시판이 이미 존재합니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		} else {
			$where = new QueryWhere();
			$where->set('category', $category);
			$this->model->select('document','id', $where);
			$numrows = $this->model->getNumRows();
			if ($numrows> 0) {
				$msg = "${category} 이름은 페이지관리에서 이미 사용하고 있습니다.<br>다른 이름을 사용해주세요.";
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			} 
		}

		/**
		 * @cache's columns 
		 *  페이지에서 넘어온 데이터 값들은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
		 */
		$cachePath = './files/caches/queries/board_group.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
		} else {
			$columns = array();
			for($i=0; $i<count($columnCaches); $i++) {
				$key = $columnCaches[$i];
				$value = $posts[$key];

				if (isset($value) && $value) {
					$columns[] = $value;
				} else {
					if ($key === 'date') {
						$columns[] = 'now()';
					} else if ($key === 'ip') {
						$columns[] = $_SEVER['REMOTE_ADDR'];
					}  else {
						$columns[] = '';
					}				
				}						
			}
		} // end of if

		$result = $this->model->insert('board_group', $columns);
		if (!$result) {
			$msg .= "${category}게시판 등록을 실패하였습니다.<br>";
			$resultYN = 'N';
		} 

		$passwordHash = $context->getPasswordHash('12');
		$columns = array(
			'',$category,'n',$adminId,'운영자','운영자',$passwordHash,
			'게시판 시동 테스트',
			'본 게시물은 게시판 시동을 위해 자동 등록된 것입니다.<br> 본 게시물을 삭제하기 전에 반드시 하나를 등록하시기 바랍니다.',
			$adminEmail,'now()',$context->getServer('REMOTE_ADDR'),
			0,0,0,'',1,0,0,'a','','','','html'
		);

		$result = $this->model->insert('board', $columns);
		if (!$result) {
			$msg .= "시동 게시글 등록을 실패하였습니다.<br>";
			$resultYN = 'N';		
		} else {

			// 라우트 키 저장 
			$filePath = './files/caches/routes/board.cache.php';
			$routes = CacheFile::readFile($filePath);
			if (isset($routes) && $routes) {
				$pattern = sprintf('/(%s)+/i', $category);
				if (!preg_match($pattern, implode(',', $routes['categories']))) {
					$routes['categories'][] = $category;  
				}
			}

			$result = CacheFile::writeFile($filePath, $routes);	
			if (!$result) {
				$msg .= "라우트 키 등록을 실패했습니다. ";
				$resultYN = 'N';
			}
		}

		if ($resultYN === 'Y') {
			$msg = $category . ' 게시판이 성공적으로 생성되었습니다.';
		}

		//$msg .= Tracer::getInstance()->getMessage();
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
			if ($key !== ('id' || 'category' ||'_method')) {
				$column[$key] = $value;
			}			
		}

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->update('board_group', $column, $where);
		if (!$result) {
			$msg = "$category 게시판 수정을 실패하였습니다.";
			$resultYN = "N";	
		}

		if ($resultYN === 'Y') {
			$msg = $category . ' 게시판이 수정되었습니다.';
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
		$this->model->select('board', 'id', $where);

		$where->reset();
		$i = $this->model->getNumRows();
		$rows = $this->model->getRows();
		while ( $i--) {
			$cid = $rows[$i]['id'];
			$where->set('contents_id', $cid, '=', 'or');			
		}
		$result = $this->model->delete('comment', $where);
		if (!$result) {
			$msg .= "답글 삭제를 실패했습니다.<br>";
			$resultYN = "N";
		}

		$where->reset();
		$where->set('category', $category);
		$result = $this->model->delete('board', $where);
		if (!$result) {
			$msg .= "게시글 삭제를 실패했습니다.<br>";
			$resultYN = "N";
		} 

		$where->reset();
		$where->set('id', $id);
		$result = $this->model->delete('board_group', $where);
		if (!$result) {
			$msg .= "${category} 게시판 삭제를 실패했습니다.<br>";
			$resultYN = "N";
		} else {

			// 라우트 카테고리 키 삭제  
			$filePath = _SUX_PATH_ . 'files/caches/routes/board.cache.php';
			$routes = CacheFile::readFile($filePath);
			$len = count($routes['categories']);
			for($i=0; $i<$len; $i++) {
				$input = $routes['categories'][$i];
				//$msg .= $input . '  ';
				if ($input === $category) {
					array_splice($routes['categories'], $i, 1);
					break;
				}
			}

			$result = CacheFile::writeFile($filePath, $routes);
			if (!$result) {
				$msg .= "라우트 키 삭제를 실패했습니다.<br>";
				$resultYN = "N";
			}
		}

		if ($resultYN ==='Y') {
			$msg = $category . ' 게시판이 성공적으로 삭제되었습니다.';
		}	
		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
}
