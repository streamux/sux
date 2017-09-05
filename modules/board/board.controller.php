<?php

class BoardController extends Controller
{

	function _checkValidation( $datas ) {

		$context = Context::getInstance();
		$returnURL = $context->getServer('REQUEST_URI');
		$checkLabel = array('이름', '비밀번호','제목','내용');
		$checkList = array('user_name', 'password', 'title','contents');
		$bool = true;
		$index = 0;

		foreach ($checkList as $key => $value) {			
			if (empty($datas[$value])) {
				$msg = $checkLabel[$index] . '을(를) 입력해주세요';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				$bool = false;
				exit;
			}
			$index++;
		}

		return $bool;
	}

	function _checkFiles( $value ) {

		$imageUpName = $value['imgup']['name'];
		if (isset($imageUpName) && $imageUpName && !preg_match('/(jpg|jpeg|gif|png|bmp|zip)+$/', $imageUpName)) {
			$msg .= '[ jpg, jpeg, gif, png, bmp, zip ] 형식의 이미지 파일과 압축 파일만 등록이 가능합니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}
	}

	function insertWrite() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->_checkValidation($posts);
		$this->_checkFiles($files);

		$returnURL = $context->getServer('REQUEST_URI');
		$category = $posts['category'];

		$msg = '';
		$resultYN = 'Y';
		
		$wall = trim($posts['wall']);
		$wallname = trim($posts['wallname']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wallname !== $wallok) {
			$msg = '경고! 잘못된 등록키입니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$rootPath = _SUX_ROOT_;
		$saveDir = _SUX_PATH_ . "files/board/";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName =$mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				$resultYN = 'N';
				$msg .= '파일을 지정한 디렉토리에 저장하는데 실패했습니다.';
			}
		}

		$where = new QueryWhere();
		$where->set('category', $category, '=');
		$this->model->select('board', 'id', $where, 'id desc', 0, 1);

		$row = $this->model->getRow();
		$igroup_count = $row['id'] + 1;

		$cachePath = './files/caches/queries/board.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
		} else {
			$columns = array();
			for($i=0; $i<count($columnCaches); $i++) {
				$key = $columnCaches[$i];				

				$option = substr($key, 4);
				$compareField = 'file' . $option;
				if (strpos($key,$compareField) !== false) {

					$value = $files['imgup'][$option];
					if ($option === 'name') {
						$value = $imageUpName;
					} 

					if (isset($value) && $value) {
						$columns[] = $value;
					} else {
						$columns[] = '';
					}
				} else {
					$value = $posts[$key];
					if (isset($value) && $value ) {
						if ($key === 'category') {						
							$value = $category;
						} else if ($key === 'wall') {
							$value = $wall;
						} 
						$columns[] = $value;
					} else {
						if ($key === 'is_notice') {
							$columns[] = 'n';
						} else if ($key === 'igroup_count') {
							$columns[] = $igroup_count;
						} else if ($key === 'space_count') {
							$columns[] = 0;
						} else if ($key === 'ssunseo_count') {
							$columns[] = 0;
						} else if ($key === 'date') {
							$columns[] = 'now()';
						} else if ($key === 'ip') {
							$columns[] = $context->getServer('REMOTE_ADDR');
						}  else {
							$columns[] = '';
						}				
					}
				}				
			}
		}		

		$msg .= $row['id'];

		$result = $this->model->insert('board', $columns);
		if (!isset($result)) {
			$resultYN = 'N';
			$msg .= '글을 저장하는데 실패했습니다.';
		}
		
		/*$msg .=  Tracer::getInstance()->getMessage();
		echo $msg;
		return;*/
 		$data = array(	'url'=>$rootPath . $category,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data); 
	}

	function updateModify() {

		$context = Context::getInstance();
		$sesstions = $context->getSessionAll();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->_checkValidation($posts);
		$this->_checkFiles($files);

		$category = $posts['category'];
		$id = $posts['id'];

		$returnURL = $context->getServer('REQUEST_URI');
		$user_name = $sesstions['sux_user_name'];
		$passwordHash = $context->getPasswordHash($posts['password']);

		$adminPassword = $context->getAdminInfo('admin_pwd');
		$adminPasswordHash = $context->getPasswordHash($adminPassword);

		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		$msg = '';
		$resultYN = 'Y';
		$rootPath = _SUX_ROOT_;
		$saveDir = _SUX_PATH_ . "files/board/";
		
		$where = new QueryWhere();
		$where->set('id',$id, '=');
		$this->model->select('board','password, igroup_count, filename', $where);

		$row = $this->model->getRow();
		if (($passwordHash === $row['password']) || ($passwordHash === $adminPasswordHash)) {	
			$delFileName = $row['filename'];
			if ($delFileName) {
				$delFileName = $saveDir . $delFileName;
				if(!@unlink($delFileName)) {
					$resultYN = 'N';
					$msg .= "파일삭제에 실패했습니다.";
				} 
			}		

			if (is_uploaded_file($imageUpTempName)) {
				$mktime = mktime();
				$imageUpName = $mktime."_".$imageUpName;
				$dest = $saveDir . $imageUpName;
				if (!move_uploaded_file($imageUpTempName, $dest)) {
					$resultYN = 'N';
					$msg .= "파일을 지정한 디렉토리에 저장하는데 실패했습니다.";  
				}
			}
			$context->set('fileup_name', $imageUpName);

			$cachePath = './files/caches/queries/board.getColumns.cache.php';
			$columnCaches = CacheFile::readFile($cachePath, 'columns');
			if (!$columnCaches) {
				$msg .= "QueryCacheFile Do Not Exists<br>";
			} else {
				$columns = array();
				for($i=0; $i<count($columnCaches); $i++) {
					$key = $columnCaches[$i];				

					$option = substr($key, 4);
					$compareField = 'file' . $option;
					if (strpos($key,$compareField) !== false) {					
						$value = $files['imgup'][$option];
						if ($option === 'name') {
							$value = $imageUpName;
						} 
						if (isset($value) && $value) {
							$columns[$key] = $value;
						} else {
							$columns[$key] = '';
						}
					} else {
						$value = $posts[$key];
						if (isset($value) && $value) {
							if ($key === 'category') {						
								$value = $category;
							} else if ($key === 'wall') {
								$value = $wall;
							}

							if (!preg_match('/^(user_id|password)+$/', $key)) {
								$columns[$key] = $value;
							}							
						}
					}				
				}
			}

			$result = $this->model->update('board', $columns, $where);	
			//Tracer::getInstance()->output();
			if (!isset($result)) {
				$msg .= '글을 수정하는데 실패했습니다.';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit();
			}
		} else {
			$msg .= '비밀번호가 맞지 않습니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit();
		}

		$data = array(	'url'=>$rootPath . $category,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data); 
	}

	function insertReply() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->_checkValidation($posts);
		$this->_checkFiles($files);

		$resultYN = 'Y';
		$msg = '';

		$returnURL = $context->getServer('REQUEST_URI');
		$category = $posts['category'];
		$id = $posts['id'];
		$igroup_count = $posts['igroup_count'];
		$space_count = $posts['space_count'];
		$ssunseo_count = $posts['ssunseo_count'];

		$wall = trim($posts['wall']);
		$wallname = trim($posts['wallname']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wallname !== $wallok) {
			$msg = '경고! 잘못된 등록키입니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}
		
		$rootPath = _SUX_ROOT_;
		$saveDir = _SUX_PATH_ . "files/board/";

		if (is_uploaded_file($imageUpTempName )) {			
			$mktime = mktime();
			$imageUpName = $mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				$resultYN = 'N';
				$msg .= '파일을 지정한 디렉토리에 저장하는데 실패했습니다.'; 
			}
			$this->imageUpName = $imageUpName;
		} 

		$columns = array('ssunseo_count' => '(ssunseo_count+1)');

		$where = new QueryWhere();
		$where->set('ssunseo_count', $ssunseo_count, '>');
		$where->set('igroup_count', $igroup_count, '=','and');
		$result = $this->model->update('board',$columns, $where);
		if (!isset($result)) {
			$resultYN = 'N';
			$msg .= '순서를 변경하는데 실패했습니다'; 
		}

		$cachePath = './files/caches/queries/board.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
		} else {
			$columns = array();
			for($i=0; $i<count($columnCaches); $i++) {
				$key = $columnCaches[$i];				

				$option = substr($key, 4);
				$compareField = 'file' . $option;
				if (strpos($key,$compareField) !== false) {

					$value = $files['imgup'][$option];
					if ($option === 'name') {
						$value = $imageUpName;
					} 
					if (isset($value) && $value) {
						$columns[] = $value;
					} else {
						$columns[] = '';
					}
				} else {

					$value = $posts[$key];
					//echo $key . ' : ' . $value . ' : ' . is_numeric($value) . "<br>";
					if ((isset($value) && $value) || is_numeric($value)) {
						if ($key === 'category') {						
							$value = $category;
						} else if ($key === 'wall') {
							$value = $wall;
						} else if ($key === 'space_count') {
							$value = $space_count + 1;
						} else if ($key === 'ssunseo_count') {
							$value = $ssunseo_count + 1;
						}
						$columns[] = $value;
					} else {
						if ($key === 'is_notice') {
							$columns[] = 'n';
						} else if ($key === 'date') {
							$columns[] = 'now()';
						} else if ($key === 'ip') {
							$columns[] = $context->getServer('REMOTE_ADDR');
						}  else {
							$columns[] = '';
						}				
					}
				}				
			}
		}
		
		$result = $this->model->insert('board', $columns);
		if (!isset($result)) {
			$msg .= '답글을 저장하는데 실패했습니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

 		$data = array(	'url'=>$rootPath . $category,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data); 
	}

	function deleteDelete() {

		$context = Context::getInstance();
		$posts =  $context->getPostAll();

		$returnURL = $context->getServer('REQUEST_URI');		
		$password = trim($posts['password']);
		if (empty($password)) {
			$msg .= '비밀번호를 입력해주세요.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$category = $posts['category'];
		$id = $posts['id'];

		$rootPath = _SUX_ROOT_;
		$deletePath = _SUX_PATH_ . "files/board/";
		$msg = '';
		$resultYN = 'Y';

		$passwordHash = $context->getPasswordHash($password);
		$adminPassword = $context->getAdminInfo('admin_pwd');
		$adminPasswordHash = $context->getPasswordHash($adminPassword);
		
		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('board', 'password,filename', $where);	

		$row = $this->model->getRow();		
		if (($passwordHash == $row['password']) || ($passwordHash == $adminPasswordHash)) {
			$delFileName = $row['filename'];
			if(isset($delFileName) && $delFileName != '') {
				$deletePath = $deletePath . $delFileName;

				if(!@unlink($deletePath)) {
					$resultYN = 'N';
					$msg .= '파일삭제를 실패하였습니다.';
				} 
			}
			
			$where = new QueryWhere();
			$where->set('id', $id);
			$result = $this->model->delete('board', $where);
			if (!isset($result)) {
				$msg .= '글을 삭제하는데 실패했습니다.';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			}
		} else  {
			$msg .= '비밀번호가 맞지 않습니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
			exit;
		}

		$data = array(	'url'=>$rootPath . $category,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data);
	}

	function updateProgressStep() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$returnURL = $context->getServer('REQUEST_URI');
		$category = $posts['category'];
		$id = $posts['id'];
		$progressStep = $posts['progress_step'];

		$rootPath = _SUX_ROOT_;
		$msg = '';
		$resultYN = 'Y';

		$cachePath = './files/caches/queries/board.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
		} else {
			$columns = array();
			for($i=0; $i<count($columnCaches); $i++) {
				$key = $columnCaches[$i];			
				$value = $posts[$key];
				if (isset($value) && $value) {
					if (!preg_match('/^(id|category)+$/', $key)) {
						$columns[$key] = $value;
					}							
				}			
			}
		}
		
		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->update('board', $columns, $where);
		if (!isset($result)) {
			$msg .= '진행상황 설정을 실패하였습니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$data = array(	'url'=>$rootPath . $category . '/' . $id,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data);
	}

	function insertComment() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$returnURL = $context->getServer('REQUEST_URI');
		$category = $posts['category'];
		$id = $posts['contents_id'];

		$rootPath = _SUX_ROOT_;
		$msg = '';
		$resultYN = 'Y';

		$checkLabel = array('이름을', '비밀번호를', '내용을');
		$checkList = array('nickname', 'password', 'comment');

		$index = 0;
		foreach ($checkList as $key => $value) {			
			if (empty($posts[$value])) {
				$msg = $checkLabel[$index] . ' 입력해주세요.';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				return false;
			}
			$index++;
		}

		$cachePath = './files/caches/queries/comment.getColumns.cache.php';
		$columnCaches = CacheFile::readFile($cachePath, 'columns');
		if (!$columnCaches) {
			$msg .= "QueryCacheFile Do Not Exists<br>";
		} else {
			$columns = array('');
			for($i=0; $i<count($columnCaches); $i++) {
				$key = $columnCaches[$i];

				$msg .= $key . "<br>";
				$value = $posts[$key];
				if (isset($value) && $value) {
					if ($key === 'password') {
						$value = $context->getPasswordHash($value);	
					}
					$columns[] = $value;							
				} else {
					if ($key === 'date') {
						$columns[] = 'now()';
					} else if (($key === 'voted_count') || ($key === 'blamed_count')) {
						$columns[] = 0;
					}
				}		
			}
		}

		$result = $this->model->insert('comment', $columns);
		if (!isset($result)) {
			$msg .= '댓글 입력을 실패하였습니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit();
		}

		$data = array(	'url'=>$rootPath . $category . '/' . $id,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data);
	}

	function deleteDeleteComment() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();	

		$category = $posts['category'];
		$mid = $posts['mid'];
		$id = $posts['id'];

		$returnURL = $context->getServer('REQUEST_URI');
		$password = trim($posts['password']);
		if (!(isset($password) && $password)) {
			$msg .= '비밀번호를 입력해주세요.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$passwordHash = $context->getPasswordHash($password);
		$adminPassword = $context->getAdminInfo('admin_pwd');
		$adminPasswordHash = $context->getPasswordHash($adminPassword);

		$rootPath = _SUX_ROOT_;
		$msg = '';
		$resultYN = 'Y';

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('comment', 'password', $where);

		$row = $this->model->getRow();
		if (($passwordHash === $row['password']) || ($passwordHash === $adminPasswordHash)) {
			$result = $this->model->delete('comment', $where);
			if (!isset($result)) {
				$msg .= '댓글 삭제를 실패하였습니다.';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			}			
		} else  {
			$msg .= '비밀번호가 맞지 않습니다..';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$data = array(	'url'=>$rootPath . $category . '/' . $mid,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data);
	}
}
?>