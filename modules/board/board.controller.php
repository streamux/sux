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
				$resultYN = 'N';
		 		$data = array(	'url'=>$returnURL,
								'result'=>$resultYN,
								'msg'=>$msg);

				$this->callback($data);
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
			UIError::alertToBack('실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.');
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
		
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall !== $wallok) {
			$msg = '경고! 잘못된 등록키입니다.';
			$resultYN = 'N';
	 		$data = array(	'url'=>$returnURL,
							'result'=>$resultYN,
							'msg'=>$msg);

			$this->callback($data);
			exit;
		}

		$rootPath = _SUX_ROOT_;
		$saveDir = _SUX_PATH_ . "board_data/";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName =$mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				$msg = '파일을 지정한 디렉토리에 저장하는데 실패했습니다.';
				$resultYN = 'N';
		 		$data = array(	'url'=>$returnURL,
								'result'=>$resultYN,
								'msg'=>$msg);

				$this->callback($data); 
			}
			$this->imageUpName = $imageUpName;
		}
		$context->set('fileup_name', $imageUpName);

		$result = $this->model->insertWrite();
		if (!isset($result)) {
			$msg = '글을 저장하는데 실패했습니다.';
		}

		$resultYN = 'N';
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

		$user_name = $sesstions['sux_user_name'];
		$pass = substr(md5(trim($posts['password'])),0,8);
		$pass = substr(md5($pass),0,8);

		$adminPwd = $context->getAdminInfo('admin_pwd');
		$adminPwd = substr(md5(trim($adminPwd)),0,8);
		$adminPwd = substr(md5(trim($adminPwd)),0,8);

		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		$msg = '';
		$resultYN = 'Y';
		$rootPath = _SUX_ROOT_;
		
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');

		$this->model->selectFromBoardWhere('password, igroup_count, filename', array('id'=>$id));
		$row = $this->model->getRow();

		if ($pass == $row['password'] || $pass == $adminPwd) {			
			$saveDir = _SUX_PATH_ . "board_data/";
			$delFileName = $row['filename'];
			if ($delFileName) {
				$delFileName = $saveDir . $delFileName;
				if(!@unlink($delFileName)) {
					echo "파일삭제에 실패했습니다.";
				} else {
					echo "파일 삭제에 성공했습니다.";
				}
			}		

			if (is_uploaded_file($imageUpTempName)) {
				$mktime = mktime();
				$imageUpName = $mktime."_".$imageUpName;
				$dest = $saveDir . $imageUpName;
				if (!move_uploaded_file($imageUpTempName, $dest)) {
					die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
				}
			}
			$context->set('fileup_name', $imageUpName);

			$result = $this->model->updateModify();	
			//Tracer::getInstance()->output();
			if (!isset($result)) {
				UIError::alertToBack('글을 수정하는데 실패했습니다.');
			}
		} else {
			UIError::alertToBack('비밀번호가 틀립니다.\n비밀번호를 확인하세요.');
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

		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			UIError::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$category = $context->getParameter('category');
		$rootPath = _SUX_ROOT_;
		$saveDir = _SUX_PATH_ . "board_data/";

		if (is_uploaded_file($imageUpTempName )) {			
			$mktime = mktime();
			$imageUpName = $mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				UIError::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다."); 
				exit;
			}

			$this->imageUpName = $imageUpName;
		} 

		$context->set('fileup_name', $imageUpName);
		$result = $this->model->updateSsunseoCount();
		if (!isset($result)) {
			UIError::alertToBack('순서를 변경하는데 실패했습니다.');
			exit;
		}

		$result = $this->model->insertReply();
		/*Tracer::getInstance()->output();
		return;*/
		if (!isset($result)) {
			UIError::alertToBack('답글을 저장하는데 실패했습니다.');
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

		$pass = trim($posts['password']);
		if (empty($pass)) {
			UIError::alertToBack('비밀번호를 입력해주세요.');
			exit;
		}

		$category = $context->getParameter('category');
		$rootPath = _SUX_ROOT_;

		$pass = substr(md5(trim($pass)),0,8);
		$pass = substr(md5($pass),0,8);

		$admin_pwd = trim($context->getAdminInfo('admin_pwd'));
		$admin_pwd = substr(md5($admin_pwd),0,8);
		$admin_pwd = substr(md5($admin_pwd),0,8);

		$this->model->selectFromBoardWhere('password,filename');		
		$row = $this->model->getRow();	
		$delFileName = $row['filename'];

		//UIError::alert( $pass . ' : ' . $row['password'] . ' : ' . $admin_pwd );
		if ($pass == $row['password'] || $pass == $admin_pwd) {

			if(isset($delFileName) && $delFileName != '') {
				$delFileName = _SUX_PATH_ . "board_data/$delFileName";

				if(!@unlink($delFileName)) {
					echo '파일삭제를 실패하였습니다.';
				} else {
					echo '파일삭제를 성공하였습니다.';
				}
			}
			
			$result = $this->model->deleteDelete();
			if (!isset($result)) {
				UIError::alertToBack('글을 삭제하는데 실패했습니다.');
			}
		} else  {
			UIError::alertToBack('비밀번호가 틀렸습니다.');
		}

		Utils::goURL($rootPath . $category);
	}

	function recordOpkey() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];

		$result = $this->controller->update('recordOpkey');
		if (!isset($result)) {
			UIError::alertToBack('진행상황 설정을 실패하였습니다.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
	}

	function recordWriteComment() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$id = $requests['id'];
		$board = $requests['board'];		
		$board_grg = $requests['board_grg'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];
		$sid = $requests['sid'];

		$result = $this->controller->insert('recordWriteComment');
		if (!isset($result)) {
			UIError::alertToBack('댓글 입력을 실패하였습니다.');
		}

		Utils::goURL("board.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid&action=read");
	}

	function recordDeleteComment() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();

		$pass = trim($posts['pass']);
		$admin_pwd = $context->get('db_admin_pwd');
				
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$id = $requests['id'];
		$grgid = $requests['grgid'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];

		$this->controller->select('fieldFromCommentId', 'pass');
		$row = $this->model->getRow();

		if ($pass == $row['pass'] || $pass == "$admin_pwd") {
			$result = $this->controller->delete('recordDeleteComment');
			if (!isset($result)) {
				UIError::alertToBack('댓글 삭제를 실패하였습니다.');
			}			
		} else  {
			UIError::alertToBack('비밀번호가 틀립니다');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&id=$id&sid=$id&igroup=$igroup&passover=$passover&action=read");
	}
}
?>