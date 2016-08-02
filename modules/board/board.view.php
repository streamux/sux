<?php

class BoardView extends BaseView {

	var $class_name = 'board_view';
	
	// display function is defined in parent class 
}

class ListPanel extends BaseView {

	var $class_name = 'board_list';

	function init() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');
		$board_grg = $board."_grg";
		$id = $context->getRequest('id');;
		$igroup = $context->getRequest('igroup');
		$passover = $context->getRequest('passover');
		$page = $context->getRequest('page');
		$sid = $context->getRequest('sid');
		$action = $context->getRequest('action');
		
		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();
		$download = strtolower($row['download']);

		$this->controller->delete('limitwordFromBoard');

		$top_path = $row['include1'];
		if (isset($top_path) && $top_path != '') {
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}

		$main_path = $row['include2'];
		if (isset($main_path) && $main_path != '') {
			$skin_dir = 'skin/' . $main_path;
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/list.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		$bottom_path = $row['include3'];
		if (isset($bottom_path) && $bottom_path != '') {
			if (is_readable($bottom_path)) {
				include $bottom_path;
			} else {
				echo '하단 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '하단 파일경로를 입력하세요.<br>';
		}
	}
}

class SearchlistPanel extends BaseView {

	var $class_name = 'board_search_list';

	function init() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');
		$board_grg = $board."_grg";
		$id = $context->getRequest('id');;
		$igroup = $context->getRequest('igroup');
		$passover = $context->getRequest('passover');
		$page = $context->getRequest('page');
		$sid = $context->getRequest('sid');
		$action = $context->getRequest('action');

		$find = $context->getPost('find');
		if (!isset($find) && $find == '') {
			$find = $context->getRequest('find');
		}
		$search = $context->getPost('search');
		if (!isset($search) && $search == '') {
			$search = $context->getRequest('search');
		}

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();
		$download = strtolower($row['download']);
		$this->controller->delete('limitwordFromBoard');

		$top_path = $row['include1'];
		if (isset($top_path) && $top_path != '') {
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}		

		$main_path = $row['include2'];
		if (isset($main_path) && $main_path != '') {
			$skin_dir = 'skin/' . $main_path;
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/search_list.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		$bottom_path = $row['include3'];
		if (isset($bottom_path) && $bottom_path != '') {
			if (is_readable($bottom_path)) {
				include $bottom_path;
			} else {
				echo '하단 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '하단 파일경로를 입력하세요.<br>';
		}
	}
}

class ReadPanel extends BaseView {

	var $class_name = 'board_read';

	function init() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');
		$board_grg = $board."_grg";
		$id = $context->getRequest('id');;
		$igroup = $context->getRequest('igroup');
		$passover = $context->getRequest('passover');
		$page = $context->getRequest('page');
		$sid = $context->getRequest('sid');
		$find = $context->getRequest('find');
		$search = $context->getRequest('search');
		$action = $context->getRequest('action');		
		$grade = $context->getSession('grade');

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();	
		$download = strtolower($row['download']);

		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $row['r_grade']) {
			Error::alertToBack('죄송합니다. 읽기 권한이 없습니다.');
			exit;
		}

		if ($row['log_key'] != 'yes') {
			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($row["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		$top_path = $row['include1'];
		if (isset($top_path) && $top_path != '') {
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}		

		$main_path = $row['include2'];
		if (isset($main_path) && $main_path != '') {
			$skin_dir = 'skin/' . $main_path;
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/read.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		$bottom_path = $row['include3'];
		if (isset($bottom_path) && $bottom_path != '') {
			if (is_readable($bottom_path)) {
				include $bottom_path;
			} else {
				echo '하단 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '하단 파일경로를 입력하세요.<br>';
		}
	}
}

class SearchreadPanel extends ReadPanel {

	var $class_name = 'search_read';

	function init() {

		$context = Context::getInstance();	
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';
		$action = $context->getRequest('action');

		$id = $context->getRequest('id');;
		$igroup = $context->getRequest('igroup');
		$passover = $context->getRequest('passover');
		$page = $context->getRequest('page');
		$sid = $context->getRequest('sid');
		$find = $context->getRequest('find');
		$search = $context->getRequest('search');

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();
		$top_path = $row['include1'];
		if (isset($top_path) && $top_path != '') {
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}		

		$main_path = $row['include2'];
		if (isset($main_path) && $main_path != '') {
			$skin_dir = 'skin/' . $main_path;
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/read.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		$bottom_path = $row['include3'];
		if (isset($bottom_path) && $bottom_path != '') {
			if (is_readable($bottom_path)) {
				include $bottom_path;
			} else {
				echo '하단 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '하단 파일경로를 입력하세요.<br>';
		}
	}
}

class WritePanel extends BaseView {

	var $class_name = 'board_write';

	function init() {

		$context = Context::getInstance();	
		$action = $context->getRequest('action');
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';

		$this->controller->select('fieldFromLimit', 'wall');
		$row = $this->model->getRow();	
		if ($row['wall'] == 'a' || !isset($row['wall'])) {
			$wallname = "나라사랑";
			$wallkey = "b";
		} else if ($row['wall'] == 'b') {
			$wallname = "조국사랑";
			$wallkey = "a";
		} 

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();	
		$grade = $context->getSession('grade');	
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $row['r_grade']) {
			Error::alertToBack('죄송합니다. 쓰기 권한이 없습니다.');
			exit;
		}

		if ($row['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($row["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		$top_path = $row['include1'];
		if (isset($top_path) && $top_path != '') {
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}		

		$main_path = $row['include2'];
		if (isset($main_path) && $main_path != '') {
			$skin_dir = 'skin/' . $main_path;
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/write.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		$bottom_path = $row['include3'];
		if (isset($bottom_path) && $bottom_path != '') {
			if (is_readable($bottom_path)) {
				include $bottom_path;
			} else {
				echo '하단 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '하단 파일경로를 입력하세요.<br>';
		}
	}
}

class ReplyPanel extends BaseView {

	var $class_name = 'board_reply';

	function init() {

		$context = Context::getInstance();
		$id = $context->getRequest('id');
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';

		$this->controller->select('fieldFromId', '*');
		$row = $this->model->getRow();
		$storycomment =  nl2br($row['comment']);
		$m_name = $row['name'];
		$email = $row['email'];
		$storytitle = $row['title'];
		$storytitle = substr(htmlspecialchars($storytitle),0,40);
		$fileupname = $row['filename'];
		$type = $row['type'];
		$hit = $row['see'];
		$date = $row['date']; 		

		$this->controller->select('fieldFromLimit','wall');
		$row = $this->model->getRow();		
		if ($row['wall'] == 'a' || !isset($row['wall'])) {
			$wallname = "나라사랑";
			$wallkey = "b";
		} else if ($row['wall'] == 'b') {
			$wallname = "조국사랑";
			$wallkey = "a";
		} 

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();
		$grade = $context->getSession('grade');
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $row['r_grade']) {
			Error::alertToBack('죄송합니다. 답변 권한이 없습니다.');
			exit;
		}

		if ($row['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($row["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (is_readable($row['include1'])) {
			include $row['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		if (isset($row['include2']) && $row['include2'] != '') {
			$skin_dir = 'skin/' . $row['include2'];
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/reply.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		if (is_readable($row['include3'])) {
			include $row['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class ModifyPanel extends BaseView {

	var $class_name = 'board_modify';

	function init() {
		
		$context = Context::getInstance();
		$id = $context->getRequest('id');
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';

		$this->controller->select('fieldFromId', '*');
		$row = $this->model->getRow();
		$storycomment = htmlspecialchars($row['comment']);
		$m_name = htmlspecialchars($row['name']);
		$storytitle = nl2br($row['title']);
		$email = $row['email'];
		$type = $row['type'];

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();
		$grade = $context->getSession('grade');
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $row['r_grade']) {
			Error::alertToBack('죄송합니다. 수정 권한이 없습니다.');
			exit;
		}

		if ($row['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($row["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (is_readable($row['include1'])) {
			include $row['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		if (isset($row['include2']) && $row['include2'] != '') {
			$skin_dir = 'skin/' . $row['include2'];
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/modify.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		if (is_readable($row['include3'])) {
			include $row['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class DeletepassPanel extends BaseView {

	var $class_name = 'delpass';

	function init() {

		$context = Context::getInstance();
		$id = $context->getRequest('id');
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';

		$this->controller->select('fieldFromId', 'name');
		$row = $this->model->getRow();	
		$m_name = $row['name'];

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();		
		if (is_readable($row['include1'])) {
			include $row['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		if (isset($row['include2']) && $row['include2'] != '') {
			$skin_dir = 'skin/' . $row['include2'];
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/delpass.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		if (is_readable($row['include3'])) {
			include $row['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

/*
class DownPanel extends BaseView {

	var $class_name = 'down';

	function init() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');
		$fileupname = $context->getRequest('fileupname');
		$fileupname = iconv("UTF-8","EUC-KR",$fileupname) ? iconv("UTF-8","EUC-KR",$fileupname) : $fileupname;
		$filesize = $context->getRequest('filesize');
		$filetype = $context->getRequest('filetype');
		$filesdir = _SUX_PATH_ . 'board_data/' . $board . '/';
		$filespath = $filesdir . $fileupname;
		$filespath = preg_replace('/ /i', '', $filespath);
		$filespath = urldecode($filespath);

		//echo $filetype. '<br>' . $filespath . '<br>' . $filesize . '<br>';		
		$this->download_file($fileupname, $filesdir, $filetype);
	}

	function download_file($file_name, $file_dir, $file_type ) { 

		if (!$file_name || !$file_dir) return 1; 
		if (preg_match( "\\\\|\.\.|/", $file_name)) return 2; 

		if (file_exists($file_dir.$file_name)) { 

			$fp = fopen($file_dir.$file_name,"r"); 
			if ($file_type) { 
				//echo $file_type;
				header("Content-type: $file_type"); 
				Header("Content-Length: ".filesize($file_dir.$file_name));    
				Header("Content-Disposition: attachment; filename=" . $file_name);  
				Header("Content-Transfer-Encoding: binary"); 
				header("Expires: 0"); 
			} else { 

				if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) { 
					//echo 'octet-stream';
					Header("Content-type: application/octet-stream"); 
					Header("Content-Length: ".filesize($file_dir.$file_name));    
					Header("Content-Disposition: attachment; filename=" . $file_name);  
					Header("Content-Transfer-Encoding: binary");  
					Header("Expires: 0");  
				} else {
					//echo 'unknown';
					Header("Content-type: file/unknown");    
					Header("Content-Length: ".filesize($file_dir.$file_name)); 
					Header("Content-Disposition: attachment; filename=". $file_name); 
					Header("Content-Description: PHP3 Generated Data"); 
					Header("Expires: 0"); 
				}
			}
			fpassthru($fp); 
			fclose($fp); 
		}  else {
			return 1; 
		}
	} 
}
*/

class OpkeyPanel extends BaseView {

	var $class_name = 'opkey';

	function init() {

		$context = Context::getInstance();
		$id = $context->getRequest('id');
		$board = $context->getRequest('board');
		$board_grg = $board . 'grg';

		$result = $this->controller->update('recordOpkey');
		if (!isset($result)) {
			Error::alertToBack('진행상황 설정을 실패하였습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class DeletecommentPanel extends BaseView {

	var $class_name = 'delete_comment';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$id = $requests['id'];				
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$grgid = $requests['grgid'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];

		$this->controller->select('listFromBoardGroup');
		$row = $this->model->getRow();

		$this->controller->select('fieldFromId', 'name');
		$m_name = $this->model->getRow()['name'];

		if (is_readable($row['include1'])) {
			include $row['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		if (isset($row['include2']) && $row['include2'] != '') {
			$skin_dir = 'skin/' . $row['include2'];
			$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/delpass_grg.php';
			if (is_readable($skin_path)) {
				include $skin_path;
			} else {
				echo '스킨 파일경로를 확인하세요.<br>';
			}
		} else {
			echo '스킨 파일경로를 입력하세요.<br>';
		}

		if (is_readable($row['include3'])) {
			include $row['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class RecordBasePanel extends BaseView {

	var $class_name = 'record_base';
	var $requests;
	var $posts;
	var $files;

	function init() {

		$context = Context::getInstance();
		$this->requests = $context->getRequestAll();
		$this->posts = $context->getPostAll();
		$this->files = $context->getFiles();
		$this->checkValidation($this->posts);
		$this->checkFiles($this->files);
		
		$this->record();
	}

	function checkValidation($values) {

		if (!$values['m_name']) {
			Error::alertToBack('이름을 입력해주세요.');
			exit;
		}

		if (!$values['pass']) {
			Error::alertToBack('비밀번호를 입력해주세요.');
			exit;
		}

		if (!$values['storytitle']) {
			Error::alertToBack('제목을 입력해주세요.');
			exit;
		}

		if (!$values['storycomment']) {
			Error::alertToBack('내용을 입력해주세요.');
			exit;
		}

		if (!ereg('@',$values['email'])) {
			Error::alertToBack('잘못된 E-mail 주소입니다.');
			exit;
		}
	}

	function checkFiles($values) {

		$imgup_name = $values['imgup']['name'];

		if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imgup_name)) {
			Error::alertToBack('실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.');
			exit;
		}
	}
}

class RecordWritePanel extends RecordBasePanel {

	var $class_name = 'insert_write';

	function record() {

		$requests = $this->requests;
		$posts = $this->posts;
		$files = $this->files;

		$board = $requests['board'];
		$board_grg = $board . '_grg';
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imgup_name = $files['imgup']['name'];
		$imgup_tmpname = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$save_dir = _SUX_PATH_ . 'board_data/' . $board . '/';

		if (is_uploaded_file($imgup_tmpname )) {
			$mktime = mktime();
			$imgup_name =$mktime . "_" . $imgup_name;
			$dest = $save_dir . $imgup_name;

			if (!move_uploaded_file($imgup_tmpname , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$result = $this->controller->insert('recordWrite');
		if (!isset($result)) {
			Error::alertToBack('글을 저장하는데 실패했습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordReplyPanel extends RecordBasePanel {

	var $class_name = 'record_reply';

	function record() {

		$requests = $this->requests;
		$posts = $this->posts;
		$files = $this->files;

		$board = $requests['board'];
		$board_grg = $board . '_grg';
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imgup_name = $files['imgup']['name'];
		$imgup_tmpname = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$save_dir = _SUX_PATH_ . 'board_data/' . $board . '/';

		if (is_uploaded_file($imgup_tmpname )) {
			$mktime = mktime();
			$imgup_name = $mktime . "_" . $imgup_name;
			$dest = $save_dir . $imgup_name;

			if (!move_uploaded_file($imgup_tmpname , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 	

		$result = $this->controller->insert('recordReply');
		if (!isset($result)) {
			Error::alertToBack('답글을 저장하는데 실패했습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordModifyPanel extends RecordBasePanel {

	var $class_name = 'record_modify';

	function record() {

		$context = Context::getInstance();
		$requests = $this->requests;
		$posts = $this->posts;
		$files = $this->files;

		$id = $requests['id'];
		$board = $requests['board'];
		$board_grg = $board . '_grg';
		$pass = $posts['pass'];
		$admin_pwd = $context->get('db_admin_pwd');
		$imgup_name = $files['imgup']['name'];
		$imgup_tmpname = $files['imgup']['tmp_name'];

		$this->controller->select('fieldFromId', 'pass, igroup, filename');	
		$row = $this->model->getRow();

		if ($pass == $row['pass'] || $pass == $admin_pwd) {

			$del_filename = $row['filename'];

			$save_dir = _SUX_PATH_ . 'board_data/' . $board . '/';

			if ($del_filename) {
				$del_filename = $save_dir . $del_filename;

				if(!@unlink($del_filename)) {
					echo "파일삭제에 실패했습니다.";
				} else {
					echo "파일 삭제에 성공했습니다.";
				}
			}

			if (is_uploaded_file($imgup_tmpname)) {
				$mktime = mktime();
				$imgup_name = $mktime."_".$imgup_name;
				$dest = $save_dir . $imgup_name;

				if (!move_uploaded_file($imgup_tmpname, $dest)) {
					die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
				}
			} 

			$result = $this->controller->update('recordModify');			
			if (!isset($result)) {
				Error::alertToBack('글을 수정하는데 실패했습니다.');
			}
		} else {
			Error::alertToBack('비밀번호가 틀립니다.\n비밀번호를 확인하세요.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?id=$id&board=$board&board_grg=$board_grg&sid=$row[sid]&igroup=$row[igroup]&action=read'>");
	}
}

class RecordDeletePanel extends RecordBasePanel {

	var $class_name = 'record_delete';

	function record() {

		$context = Context::getInstance();
		$requests = $this->requests;
		$posts = $this->posts;
		$files = $this->files;

		$board = $requests['board'];
		$board_grg = $board . '_grg';
		
		$this->controller->select('fieldFromId', 'pass,filename');
		
		$pass = trim($posts['pwd']);
		$admin_pwd = trim($context->get('db_admin_pwd'));
		
		$row = $this->model->getRow();	
		$del_filename = $row['filename'];

		if ($pass == $row['pass'] || $pass == $admin_pwd) {

			if(isset($del_filename)) {
				$del_filename = _SUX_PATH_ . 'board_data/' . $board . '/' . $del_filename;

				if(!@unlink($del_filename)) {
					echo '파일삭제를 실패하였습니다.';
				} else {
					echo '파일삭제를 성공하였습니다.';
				}
			}
			
			$result = $this->controller->delete('recordDelete');
			if (!isset($result)) {
				Error::alertToBack('글을 삭제하는데 실패했습니다.');
			}
		} else  {
			Error::alertToBack('비밀번호가 틀렸습니다.');
		}		
		
		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordWritecommentPanel extends RecordBasePanel {

	var $class_name = 'record_writecomment';

	function record() {

		$requests = $this->requests;

		$id = $requests['id'];
		$board = $requests['board'];		
		$board_grg = $requests['board_grg'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];
		$sid = $requests['sid'];

		$result = $this->controller->insert('recordWriteComment');
		if (!isset($result)) {
			Error::alertToBack('댓글 입력을 실패하였습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid&action=read'>");
	}
}

class RecordDeletecommentPanel extends RecordBasePanel {

	var $class_name = 'record_deletecomment';

	function record() {

		$context = Context::getInstance();
		$requests = $this->requests;
		$posts = $this->posts;

		$pass = trim($posts['pwd']);
		$admin_pwd = $context->get('db_admin_pwd');
		
		$id = $requests['id'];
		$sid = $requests['sid'];
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];

		$this->controller->select('fieldFromCommentId', 'pass');
		$row = $this->model->getRow();

		if ($pass == $row['pass'] || $pass == "$admin_pwd") {
			$result = $this->controller->delete('recordDeleteComment');
			if (!isset($result)) {
				Error::alertToBack('댓글 삭제를 실패하였습니다.');
			}			
		} else  {
			Error::alertToBack('비밀번호가 틀립니다');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&action=read'>");		
	}
}
?>