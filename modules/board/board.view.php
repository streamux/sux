<?php

class BoardView extends BaseView {

	var $class_name = 'board_view';

	function display($className=NULL) {

		$oDB = DB::getInstance();

		if (strlen(stristr($className, '_')) > 0) {
			$tempName = '';
			$str_arr = split('_', $className);

			for ($i=0; $i<count($str_arr); $i++) {
				$tempName .= ucfirst($str_arr[$i]);
			}
			$className = $tempName . "Panel";
		} else {
			$className = ucfirst($className) . "Panel";
		}
		
		$view = new $className($this->model, $this->controller);
		$view->init();

		$oDB->close();
	}
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

		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();
		$this->controller->delete('limitWord', $rows['limit_word']);

		echo '<br>boar name : ' . $rows[name] . '<br>';

		if (isset($rows['include1'])) {
			$top_path = $rows['include1'];
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/list.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (isset($rows['include3'])) {
			$bottom_path = $rows['include3'];
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

		$find = $context->getPost('find') ?  $context->getPost('find') : $context->getRequest('find');
		$search = $context->getPost('search') ?  $context->getPost('search') : $context->getRequest('search');
		
		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();
		$this->controller->delete('limitWord', $rows['limit_word']);

		if (isset($rows['include1'])) {
			$top_path = $rows['include1'];
			if (is_readable($top_path)) {
				include $top_path;
			} else {
				echo '상단 파일경로를 확인하세요.<br>';
			}			
		} else {
			echo '상단 파일경로를 입력하세요.<br>';
		}		

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/search_list.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (isset($rows['include3'])) {
			$bottom_path = $rows['include3'];
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
		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();	

		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $rows['r_grade']) {
			Error::alertToBack('죄송합니다. 읽기 권한이 없습니다.');
			exit;
		}

		if ($rows['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($rows["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (is_readable($rows['include1'])) {
			include $rows['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/read.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($rows['include3'])) {
			include $rows['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class SearchreadPanel extends ReadPanel {

	var $class_name = 'search_read';

	function init() {

		$context = Context::getInstance();	
		$id = $context->getRequest('id');
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';

		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();	

		if (is_readable($rows['include1'])) {
			include $rows['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/read.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($rows['include3'])) {
			include $rows['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
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
		$rows = $this->model->getRows();	
		if ($rows['wall'] == 'a' || !isset($rows['wall'])) {
			$wallname = "나라사랑";
			$wallkey = "b";
		} else if ($rows['wall'] == 'b') {
			$wallname = "조국사랑";
			$wallkey = "a";
		} 

		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();	

		$grade = $context->getSession('grade');	
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $rows['r_grade']) {
			Error::alertToBack('죄송합니다. 쓰기 권한이 없습니다.');
			exit;
		}

		if ($rows['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($rows["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (is_readable($rows['include1'])) {
			include $rows['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/write.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($rows['include3'])) {
			include $rows['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
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
		$rows = $this->model->getRows();
		$storycomment =  nl2br($rows['comment']);
		$m_name = $rows['name'];
		$email = $rows['email'];
		$storytitle = $rows['title'];
		$storytitle = substr(htmlspecialchars($storytitle),0,40);
		$fileupname = $rows['filename'];
		$type = $rows['type'];
		$hit = $rows['see'];
		$date = $rows['date']; 		

		$this->controller->select('fieldFromLimit','wall');
		$rows = $this->model->getRows();		
		if ($rows['wall'] == 'a' || !isset($rows['wall'])) {
			$wallname = "나라사랑";
			$wallkey = "b";
		} else if ($rows['wall'] == 'b') {
			$wallname = "조국사랑";
			$wallkey = "a";
		} 

		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();

		$grade = $context->getSession('grade');
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $rows['r_grade']) {
			Error::alertToBack('죄송합니다. 답변 권한이 없습니다.');
			exit;
		}

		if ($rows['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($rows["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (is_readable($rows['include1'])) {
			include $rows['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/reply.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($rows['include3'])) {
			include $rows['include3'];
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
		$rows = $this->model->getRows();
		$storycomment = htmlspecialchars($rows['comment']);
		$m_name = htmlspecialchars($rows['name']);
		$storytitle = nl2br($rows['title']);
		$email = $rows['email'];
		$type = $rows['type'];

		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();

		$grade = $context->getSession('grade');
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $rows['r_grade']) {
			Error::alertToBack('죄송합니다. 수정 권한이 없습니다.');
			exit;
		}

		if ($rows['log_key'] != 'yes') {

			if (!$context->getSession('ljs_name') || !$context->getSession('ljs_pass1')) {

				$returnToURL = $_SERVER['PHP_SELF'] . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($rows["r_admin"] == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 이곳은 관리자 전용 게시판 입니다.\n관리자 로그인을 먼저 하세요.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (is_readable($rows['include1'])) {
			include $rows['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/modify.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($rows['include3'])) {
			include $rows['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class DelpassPanel extends BaseView {

	var $class_name = 'delpass';

	function init() {

		$context = Context::getInstance();
		$id = $context->getRequest('id');
		$board = $context->getRequest('board');
		$board_grg = $board . '_grg';

		$this->controller->select('fieldFromId', 'name');
		$rows = $this->model->getRows();	
		$m_name = $rows['name'];

		$this->controller->select('boardFromGroup');
		$rows = $this->model->getRows();		

		if (is_readable($rows['include1'])) {
			include $rows['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $rows['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/delpass.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($rows['include3'])) {
			include $rows['include3'];
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}
	}
}

class RecordBasePanel extends BaseView {

	var $class_name = 'record_base';

	function init() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$files = $context->getFiles();
		$this->checkValidation($posts);
		$this->checkFiles($files);
		
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

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$board = $requests['board'];
		$board_grg = $board . '_grg';

		$this->controller->insert('recordWrite');		

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordReplyPanel extends RecordBasePanel {

	var $class_name = 'record_reply';

	function record() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$board = $requests['board'];
		$board_grg = $board . '_grg';

		$this->controller->insert('recordReply');

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordModifyPanel extends RecordBasePanel {

	var $class_name = 'record_modify';

	function record() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$id = $requests['id'];
		$board = $requests['board'];
		$board_grg = $board . '_grg';

		$this->controller->insert('recordModify');
		$rows = $this->model->getRows();

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?id=$id&board=$board&board_grg=$board_grg&sid=$rows[sid]&igroup=$rows[igroup]&action=read'>");
	}
}

class RecordDeletePanel extends RecordBasePanel {

	var $class_name = 'record_delete';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$board = $requests['board'];
		$board_grg = $board . '_grg';
		$pass = trim($context->getPost('pwd'));

		$this->controller->select('fieldFromId', 'pass,filename');
		$rows = $this->model->getRows();	
		$del_filename = $rows['filename'];

		if ($pass == $rows['pass'] || $pass == $context->get('db_admin_pwd')) {

			if(isset($del_filename)) {
				$del_filename = _SUX_PATH_ . 'board_data/' . $this->board . '/$del_filename';

				if(!@unlink($del_filename)) {
					echo '파일삭제를 실패하였습니다.';
				} else {
					echo '파일삭제를 성공하였습니다.';
				}
			}
			
			$this->controller->delete('recordDelete');
		} else  {
			Error::alertToBack('비밀번호가 틀렸습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

?>