<?php

class BoardController extends Controller {

	var $class_name = 'board_controller';

	function __construct($m=NULL) {
		
		$this->model = $m;
	}

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

		if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imageUpName)) {
			$msg = '실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.';
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
		$category = $context->getParameter('category');

		$msg = '';
		$resultYN = 'Y';
		
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall !== $wallok) {
			$msg = '경고! 잘못된 등록키입니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$rootPath = _SUX_ROOT_;
		$saveDir = _SUX_PATH_ . "files/board";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName =$mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				$resultYN = 'N';
				$msg .= '파일을 지정한 디렉토리에 저장하는데 실패했습니다.';
			}
			$this->imageUpName = $imageUpName;
		}
		$context->set('fileup_name', $imageUpName);

		$result = $this->model->insertWrite();
		if (!isset($result)) {
			$resultYN = 'N';
			$msg .= '글을 저장하는데 실패했습니다.';
		}
		
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
		
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');

		$this->model->selectFromBoardWhere('password, igroup_count, filename', array('id'=>$id));
		$row = $this->model->getRow();

		if ($passwordHash === ($row['password'] || $adminPasswordHash)) {			
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

			$result = $this->model->updateModify();	
			//Tracer::getInstance()->output();
			if (!isset($result)) {
				$msg .= '글을 수정하는데 실패했습니다.';
				UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit();
			}
		} else {
			$msg = '비밀번호가 틀립니다.\n비밀번호를 확인하세요.';
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
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			$msg = '경고! 잘못된 등록키입니다.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$category = $context->getParameter('category');
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

		$context->set('fileup_name', $imageUpName);
		$result = $this->model->updateSsunseoCount();
		if (!isset($result)) {
			$resultYN = 'N';
			$msg .= '순서를 변경하는데 실패했습니다'; 
		}

		$result = $this->model->insertReply();
		/*Tracer::getInstance()->output();
		return;*/
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
		$files =  $context->getFiles();

		$returnURL = $context->getServer('REQUEST_URI');		
		$password = trim($posts['password']);
		if (empty($password)) {
			$msg .= '비밀번호를 입력해주세요.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		$category = $context->getParameter('category');
		$rootPath = _SUX_ROOT_;
		$deletePath = _SUX_PATH_ . "files/board/";
		$msg = '';
		$resultYN = 'Y';

		$passwordHash = $context->getPasswordHash($password);
		$adminPassword = $context->getAdminInfo('admin_pwd');
		$adminPasswordHash = $context->getPasswordHash($adminPassword);
		
		$this->model->selectFromBoardWhere('password,filename');		
		$row = $this->model->getRow();	
		$delFileName = $row['filename'];

		if ($passwordHash == ($row['password'] || $adminPasswordHash)) {

			if(isset($delFileName) && $delFileName != '') {
				$deletePath = $deletePath . $delFileName;

				if(!@unlink($deletePath)) {
					$resultYN = 'N';
					$msg .= '파일삭제를 실패하였습니다.';
				} 
			}
			
			$result = $this->model->deleteDelete();
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

		$returnURL = $context->getServer('REQUEST_URI');
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');
		$rootPath = _SUX_ROOT_;
		$msg = '';
		$resultYN = 'Y';

		$result = $this->model->updateProgressStep();
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
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');
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

		$result = $this->model->insertComment();
		//Tracer::getInstance()->output();
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

		$returnURL = $context->getServer('REQUEST_URI');
		$password = trim($posts['password']);
		if (!(isset($password) && $password)) {
			$msg .= '비밀번호를 입력해주세요.';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}
		$adminPwd = $context->getAdminInfo('admin_pwd');

		$category = $context->getParameter('category');
		$id = $context->getParameter('id');
		$sid = $context->getParameter('sid');
		$rootPath = _SUX_ROOT_;
		$msg = '';
		$resultYN = 'Y';

		$this->model->selectFromCommentWhere('password', array('id'=>$sid));
		$row = $this->model->getRow();
		//Tracer::getInstance()->output();
		if ($password === ($row['password'] || $adminPwd)) {
			$result = $this->model->deleteComment();
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

		$data = array(	'url'=>$rootPath . $category . '/' . $id,
						'result'=>$resultYN,
						'msg'=>$msg,
						'delay'=>0);

		$this->callback($data);
	}
}
?>