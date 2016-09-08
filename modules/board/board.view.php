<?php

class BoardView extends BaseView {

	var $class_name = 'board_view';
	
	// display function is defined in parent class 
}

class Navi extends Object {

	var $passover = 0;
	var $limit = 10;
	var $total = 1;
	var $page = 1;
	
	var $nextpage = 0;
	var $befopage = 0;
	var $prevpassover = 0;
	var $hanpassoverpage = 0;
	var $newpassover = 0;
	var $nowpage = 0;
	var $nowpageend = 0;
	var $okpage = 'no';
	var $PHP_SELF = '';

	function init() {

		$context = Context::getInstance();
		$result = array();

		if (!$this->page) {
			$this->page = 1;
		}

		$passoverpage = $this->limit * 10;
		$this->nextpage = $this->page+1;
		$this->befopage = $this->page-1;
		$this->prevpassover = ($this->befopage * $passoverpage)-$passoverpage; 
		$this->hanpassoverpage = $this->page*$passoverpage;
		$this->newpassover = ($this->nextpage * $passoverpage)-$passoverpage; 
		$this->nowpage = ($this->page*10)-9;
		$this->nowpageend = $this->page*10;

		if ($this->page ==1) {
			$this->okpage ='yes';
		}

		$this->PHP_SELF = $context->getServer('PHP_SELF');
	}

	function get() {		

		$data = array();
		foreach ($this as $key => $value) {
			$data[$key] = $value;
		}
		return $data;
	}
}

class ListPanel extends BaseView {

	var $class_name = 'board_list';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();		

		$board = $requests['board'];
		$board_grg = $requests['board_grg'] = $board . '_grg';
		$passover = $requests['passover'];
		$find = $requests['find'];
		$search = $requests['search'];
		
		$this->controller->select('fromBoardGroup');
		$group_data = $this->model->getRow();
		$top_path = $group_data['include1'];
		$main_path = $group_data['include2'];
		$bottom_path = $group_data['include3'];
		$limit = $group_data['listnum'];

		$this->controller->delete('limitwordFromBoard');

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/list.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';
		$navi_skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_navi.tpl';
		
		// list logic
		if (!$passover) {
			 $passover=0;
		}

		$context->set('limit', $limit);
		$context->set('passover', $passover);

		$_method = (isset($search) && $search != '') ? 'fromBoardSearch' : 'fromBoard';
		$result = $this->controller->select($_method);		
		if ($result) {

			// use in order to navi
			$numrows = $this->model->getNumRows();

			$_method = (isset($search) && $search != '') ? 'fromBoardSearchLimit' : 'fromBoardLimit';
			$result = $this->controller->select($_method);
			if ($result) {
				$numrows2 = $this->model->getNumRows();
				$rows = $this->model->getRows();				
				$list_data = array();
				$today = date("Y-m-d");

				for ($i=0; $i<count($rows); $i++) {

					$sid = $rows[$i]['id'];
					$name =htmlspecialchars($rows[$i]['name']);					
					$title =htmlspecialchars($rows[$i]['title']);
					$opkey =$rows[$i]['opkey'];
					$date =$rows[$i]['date'];
					$space =$rows[$i]['space'];
					$ssunseo =$rows[$i]['ssunseo'];
					$hit =$rows[$i]['see'];
					$filename =$rows[$i]['filename'];
					$filetype =$rows[$i]['filetype'];					
					$compareDay =split(' ', $rows[$i]['date'])[0];
					
					if (isset($search) && $search != '') {
						$find_key = strtolower($find);
						switch ($find_key) {
							case 'title':
								$title = str_replace("$search","<span class=\"color-red\">$search</span>",$title);
								break;
							case 'name':
								$name = str_replace("$search","<span class=\"color-red\">$search</span>",$name);
								break;
							default:
								break;
						}
					}

					$subject_obj = array();
					$subject_obj['id'] = $rows[$i]['id'];
					$subject_obj['igroup'] = $rows[$i]['igroup'];
					$subject_obj['ssunseo'] = $rows[$i]['ssunseo'];
					$subject_obj['sid'] = $rows[$i]['id'];
					$subject_obj['title'] = $title;
					
					$subject_obj['img_name'] = '';
					$subject_obj['opkey_name'] = '';

					// 'off' in value is a class name of CSS
					$subject_obj['space'] = '10px';
					$subject_obj['icon_box'] = '';
					$subject_obj['icon_box_type'] = 0;
					$subject_obj['icon_img'] = 'off';
					$subject_obj['txt_tail'] = 'off';
					$subject_obj['tail_num'] = 0;
					$subject_obj['icon_new'] = 'off';
					$subject_obj['icon_opkey'] = 'off';

					if ($space) {
						$subject_obj['space'] = (10+$space*10) . 'px';
						$subject_obj['icon_box'] = '답변';
						$subject_obj['icon_box_color'] = 'icon-replay-color';
					}

					$imgname = "";
					if ($filename){
						if ($filetype =="image/gif" || $filetype =="image/jpeg" || $filetype =="image/x-png" || $filetype =="image/png" || $filetype =="image/bmp"){
							$imgname = "icon_img.png";
						} else if ($download == 'y'  && ($filetype=="application/x-zip-compressed" || $filetype=="application/zip")) { 
							$imgname = "icon_down.png";
						}

						if ($imgname != '') {
							$subject_obj['icon_img'] = 'on';
							$subject_obj['img_name'] = $imgname;
						}	
					}				

					$grgresult = $this->controller->select('idFromTailCommentWhere', $sid);
					$grgnums = $this->model->getNumRows();
					if ($grgnums) {
						$subject_obj['txt_tail'] = 'on';
						$subject_obj['tail_num'] = $grgnums;
					}

					if ($compareDay == $today){
						$subject_obj['icon_new'] = 'on';
						$subject_obj['icon_new_title'] = 'new';
					}
					
					if ($opkey) {
						$img_list = array(	"f"=>"icon_finish.gif",
											"i"=>"icon_ing.gif",
											"c"=>"icon_cost.gif",
											"m"=>"icon_mail.gif",
											"n"=>"icon_no_cost.gif");

						$subject_obj['opkey_name'] = $img_list[$opkey];
					}

					$list_data[] = array(
						'name'=>$name,
						'hit'=>$hit,
						'date'=>split(' ', $date)[0],
						'subject' => $subject_obj
					);
				}
			} else {
				echo '게시물 목록 가져오기를 실패하였습니다.';
			}
		} else {
			echo '게시물 전체 목록 가져오기를 실패하였습니다.';
		}

		// navi logic
		$navi = New Navi();
		$navi->passover = $passover;
		$navi->limit = $limit;
		$navi->total = $numrows;
		$navi->init();

		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {			
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('navi_skin_path', $navi_skin_path);
			$smarty->assign('req_data', $requests);
			$smarty->assign('group_data', $group_data);
			$smarty->assign('list_data', $list_data);			
			$smarty->assign('navi_data', $navi->get());
			$smarty->display( $skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottom_path)) {
			$smarty->display( $bottom_path );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $default_footer_path );
		}
	}
}

class ReadPanel extends BaseView {

	var $class_name = 'board_read';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		$PHP_SELF = $context->getServer("PHP_SELF");

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$action = $requests['action'];
		$sid = $requests['sid'];
		
		$grade = $sessions['grade'];
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];

		$this->controller->select('fromBoardGroup');
		$group_data = $this->model->getRow();

		$log_key = $group_data['log_key'];
		$r_grade = $group_data['r_grade'];
		$r_admin = $group_data['r_admin'];
		$download = strtolower($group_data['download']);
		$tail = $group_data['tail'];
		$setup = $group_data['setup'];
		$top_path = $group_data['include1'];
		$main_path = $group_data['include2'];
		$bottom_path = $group_data['include3'];
		$comment_type = $group_data['type'];

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/read.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';
		$tail_skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_tail.tpl';
		$opkey_skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_opkey.tpl';
		
		if (isset($grade) && $grade != '') {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			Error::alertToBack('죄송합니다. 읽기 권한이 없습니다.');
			exit;
		}

		// 비회원 권한 
		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				Error::alertTo('죄송합니다. 읽기 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		// read panel
		$this->controller->select('fieldFromBoardWhereId', 'see');
		$row = $this->model->getRow();
		$hit = $row['see']+1;
		$this->controller->update('boardSetSee', $hit);

		$this->controller->select('fieldFromBoardWhereId', '*');
		$read_data = $this->model->getRow();
		$type = trim($read_data['type']);
		$filename = $read_data['filename'];
		$filetype = $read_data['filetype'];
		$read_data['name'] = htmlspecialchars($read_data['name']);
		$read_data['title'] = htmlspecialchars($read_data['title']);

		switch ($comment_type) {
			case 'all':
				if ($type =='html'){
					$comment = htmlspecialchars_decode($read_data['comment']);
				}else if ($type == 'text'){
					$comment = nl2br(htmlspecialchars($read_data['comment']));
				}
				break;
			case 'text':
				$comment = nl2br(htmlspecialchars($read_data['comment']));
				break;
			case 'html':
				$comment = htmlspecialchars_decode($read_data['comment']);
				break;			
			default:
				break;
		}

		$read_data['comment'] = $comment;
		$read_data['down_display'] = 'none';
		$read_data['img_display'] = 'none';

		$fileup_path = '';
		if ($filename) {

			$fileup_path = '../../board_data/'. $board . '/' . $filename;			
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$read_data['down_display'] = 'block';
			} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

				$image_info = getimagesize($fileup_path);
			      $image_type = $image_info[2];

			      if ( $image_type == IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($fileup_path);
			      } elseif( $image_type == IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($fileup_path);
			      } elseif( $image_type == IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($fileup_path);
				}
				$read_data['img_display'] = 'block';
				$read_data['img_width'] = imagesx($image) . 'px';
			}
			$read_data['fileup_name'] = $filename;
			$read_data['fileup_path'] = $fileup_path;
		}

		// opkey
		$read_data['opkey_display'] = 'none';
		if ($setup == 'y' || $grade > 9) {
			$read_data['opkey_display'] = 'block';
		}

		// taill
		$read_data['tail_display'] = 'none';
		$tail_data = array();		
		if ($tail == 'y') {
			$read_data['tail_display'] = 'block';

			$this->controller->select('fromTailCommentWhere', $sid);
			$tail_data['num'] = $this->model->getNumRows();
			$tail_data['list'] = $this->model->getRows();
		}
		
		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {					
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('opkey_skin_path', $opkey_skin_path);
			$smarty->assign('tail_skin_path', $tail_skin_path);			
			$smarty->assign('req_data', $requests);
			$smarty->assign('group_data', $group_data);		
			$smarty->assign('read_data', $read_data);
			$smarty->assign('tail_data', $tail_data);
			

			$smarty->display( $skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottom_path)) {
			$smarty->display( $bottom_path );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $default_footer_path );
		}
	}
}

class WritePanel extends BaseView {

	var $class_name = 'board_write';

	function init() {

		$context = Context::getInstance();	
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$action = $requests['action'];

		$grade = $sessions['grade'];
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();

		$this->controller->select('fromBoardGroup');
		$group_data = $this->model->getRow();
		$log_key = $group_data['log_key'];
		$r_grade = $group_data["r_grade"];
		$r_admin = $group_data["r_admin"];
		$top_path = $group_data['include1'];
		$main_path = $group_data['include2'];
		$bottom_path = $group_data['include3'];

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/write.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';

		$this->controller->select('fieldFromBoardLimit', 'wall');
		$write_data = $this->model->getRow();
		$wall = $write_data['wall'];		

		if ($wall == 'a' || !isset($wall)) {
			$write_data['wallname'] = "나라사랑";
			$write_data['wallkey'] = "b";
		} else if ($wall == 'b') {
			$write_data['wallname'] = "조국사랑";
			$write_data['wallkey'] = "a";
		}

		$write_data['comment_type_text'] = 'checked';
		$write_data['comment_type_html'] = '';
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			Error::alertToBack('죄송합니다. 쓰기 권한이 없습니다.');
			exit;
		}

		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				Error::alertTo('죄송합니다. 쓰기 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (isset($ljs_name) && $ljs_name != '') {
			$write_data['user_label_display'] = 'hide';
			$write_data['user_name_type'] = 'hidden';
			$write_data['user_pass_type'] = 'hidden';
		} else {
			$write_data['user_label_display'] = 'show';			
			$write_data['user_name_type'] = 'text';
			$write_data['user_pass_type'] = 'password';
		}

		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {				
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('ses_data', $sessions);
			$smarty->assign('req_data', $requests);
			$smarty->assign('group_data', $group_data);	
			$smarty->assign('write_data', $write_data);
			$smarty->display( $skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottom_path)) {
			$smarty->display( $bottom_path );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $default_footer_path );
		}
	}
}

class ModifyPanel extends BaseView {

	var $class_name = 'board_modify';

	function init() {
		
		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		
		$grade = $sessions['grade'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];
		$admin_pass = $context->checkAdminPass();

		$this->controller->select('fromBoardGroup');
		$group_data = $this->model->getRow();
		$r_grade = $group_data['r_grade'];
		$r_admin = $group_data['r_admin'];
		$log_key = $group_data['log_key'];
		$top_path =  $group_data['include1'];
		$main_path =  $group_data['include2'];
		$bottom_path =  $group_data['include3'];

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/modify.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';

		$this->controller->select('fieldFromBoardWhereId', '*');
		$modify_data = $this->model->getRow();
		$comment_type = $modify_data['type'];
		$modify_data['comment'] = htmlspecialchars($modify_data['comment']);
		$modify_data['name'] = htmlspecialchars($modify_data['name']);
		$modify_data['title'] = nl2br($modify_data['title']);	
		unset($modify_data['pass']);

		if (isset($comment_type) && $comment_type != '') {
			$modify_data['comment_type_' . $comment_type] = 'checked';
		} else {
			$modify_data['comment_type_text'] = 'checked';
		}

		if (isset($grade) && $grade != '') {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			Error::alertToBack('죄송합니다. 수정 권한이 없습니다.');
			exit;
		}

		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				Error::alertTo('죄송합니다. 수정 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (isset($ljs_name) && $ljs_name != '') {
			$modify_data['user_label_display'] = 'hide';
			$modify_data['user_name_type'] = 'hidden';
			$modify_data['user_pass_type'] = 'hidden';
			$modify_data['name'] = $ljs_name;
			$modify_data['pass'] = $ljs_pass1;
		} else {
			$modify_data['user_label_display'] = 'show';			
			$modify_data['user_name_type'] = 'text';
			$modify_data['user_pass_type'] = 'password';
			$modify_data['pass'] = '';
		}

		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {	
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('ses_data', $sessions);
			$smarty->assign('req_data', $requests);
			$smarty->assign('group_data', $group_data);
			$smarty->assign('modify_data', $modify_data);
			$smarty->display( $skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottom_path)) {
			$smarty->display( $bottom_path );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $default_footer_path );
		}
	}
}

class ReplyPanel extends BaseView {

	var $class_name = 'board_reply';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$action = $requests['action'];

		$grade = $sessions['grade'];
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();

		$this->controller->select('fromBoardGroup');
		$group_data = $this->model->getRow();		
		$comment_type = $group_data["type"];
		$log_key = $group_data['log_key'];
		$r_grade = $group_data["r_grade"];
		$r_admin = $group_data["r_admin"];
		$top_path = $group_data['include1'];
		$main_path = $group_data['include2'];
		$bottom_path = $group_data['include3'];

		$this->controller->select('fieldFromBoardWhereId', '*');
		$reply_data = $this->model->getRow();
		$type = trim($reply_data['type']);
		$filename = $reply_data['filename'];
		$filetype = $reply_data['filetype'];
		$download = $reply_data['download'];
		$reply_data['name'] = htmlspecialchars($reply_data['name']);
		$reply_data['title'] = htmlspecialchars($reply_data['title']);

		switch ($comment_type) {
			case 'all':
				if ($type =='html'){
					$comment = htmlspecialchars_decode($reply_data['comment']);
				}else if ($type == 'text'){
					$comment = nl2br(htmlspecialchars($reply_data['comment']));
				}
				break;
			case 'text':
				$comment = nl2br(htmlspecialchars($reply_data['comment']));
				break;
			case 'html':
				$comment = htmlspecialchars_decode($reply_data['comment']);
				break;			
			default:
				break;
		}

		$reply_data['comment'] = $comment;
		$down_display = 'none';
		$img_display = 'none';

		$reply_data['comment'] = $comment;
		$reply_data['down_display'] = 'none';
		$reply_data['img_display'] = 'none';

		$fileup_path = '';
		if ($filename) {

			$fileup_path = '../../board_data/'. $board . '/' . $filename;			
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$reply_data['down_display'] = 'block';
			} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

				$image_info = getimagesize($fileup_path);
			      $image_type = $image_info[2];

			      if ( $image_type == IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($fileup_path);
			      } elseif( $image_type == IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($fileup_path);
			      } elseif( $image_type == IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($fileup_path);
				}
				$reply_data['img_display'] = 'block';
				$reply_data['img_width'] = imagesx($image) . 'px';
			}
			$reply_data['fileup_name'] = $filename;
			$reply_data['fileup_path'] = $fileup_path;
		}

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/reply.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';

		$this->controller->select('fieldFromBoardLimit','wall');
		$row = $this->model->getRow();			
		$wall = $row['wall'];

		if ($wall == 'a' || !isset($wall)) {
			$reply_data['wallname'] = "나라사랑";
			$reply_data['wallkey'] = "b";
		} else if ($wall == 'b') {
			$reply_data['wallname'] = "조국사랑";
			$reply_data['wallkey'] = "a";
		}

		$reply_data['comment_type_text'] = 'checked';
		$reply_data['comment_type_html'] = '';
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			Error::alertToBack('죄송합니다. 답변 권한이 없습니다.');
			exit;
		}

		// 비회원 허용 유무 
		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				Error::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if (isset($ljs_name) && $ljs_name != '') {
			$reply_data['user_label_display'] = 'hide';
			$reply_data['user_name_type'] = 'hidden';
			$reply_data['user_pass_type'] = 'hidden';
		} else {
			$reply_data['user_label_display'] = 'show';			
			$reply_data['user_name_type'] = 'text';
			$reply_data['user_pass_type'] = 'password';
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				Error::alertTo('죄송합니다. 답변 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {				
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('ses_data', $sessions);
			$smarty->assign('req_data', $requests);
			$smarty->assign('group_data', $group_data);	
			$smarty->assign('reply_data', $reply_data);
			$smarty->display( $skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottom_path)) {
			$smarty->display( $bottom_path );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $default_footer_path );
		}
	}
}

class DeletepassPanel extends BaseView {

	var $class_name = 'delpass';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$id = $requests['id'];

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$row = $this->model->getRow();	
		$name = $row['name'];

		$this->controller->select('fromBoardGroup');
		$row = $this->model->getRow();

		if (is_readable($row['include1'])) {
			include $row['include1'];
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $row['include2'];
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/delpass.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
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
		$requests = $context->getRequestAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];

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
						
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$id = $requests['id'];
		$grgid = $requests['grgid'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];

		$this->controller->select('fromBoardGroup');
		$row = $this->model->getRow();
		$top_path = $row['include1'];
		$main_path = $row['include2'];
		$bottom_path = $row['include3'];

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$row = $this->model->getRow();
		$name = $row['name'];

		if (is_readable($top_path)) {
			include $top_path;
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/delpass_grg.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		if (is_readable($bottom_path)) {
			include $bottom_path;
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
		$this->sessions = $context->getSessionAll();
		$this->posts = $context->getPostAll();
		$this->files = $context->getFiles();
		$this->checkValidation($this->posts);
		$this->checkFiles($this->files);
		
		$this->record();
	}

	function checkValidation($values) {

		if (!$values['name']) {
			Error::alertToBack('이름을 입력해주세요.');
			exit;
		}

		if (!$values['pass']) {
			Error::alertToBack('비밀번호를 입력해주세요.');
			exit;
		}

		if (!$values['title']) {
			Error::alertToBack('제목을 입력해주세요.');
			exit;
		}

		if (!$values['comment']) {
			Error::alertToBack('내용을 입력해주세요.');
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
		$requests = $this->requests;
		$posts = $this->posts;
		$files = $this->files;

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
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

			$this->imgup_name = $imgup_name;
		}
		$context->set('fileup_name', $imgup_name);

		$result = $this->controller->insert('recordWrite');
		if (!isset($result)) {
			Error::alertToBack('글을 저장하는데 실패했습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordModifyPanel extends RecordBasePanel {

	var $class_name = 'record_modify';

	function record() {

		$context = Context::getInstance();
		$requests = $this->requests;
		$sesstions = $this->sessions;
		$posts = $this->posts;
		$files = $this->files;

		$id = $requests['id'];
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$pass = substr(md5(trim($posts['pass'])),0,8);
		$admin_pwd = $context->get('db_admin_pwd');
		$imgup_name = $files['imgup']['name'];
		$imgup_tmpname = $files['imgup']['tmp_name'];

		$this->controller->select('fieldFromBoardWhereId', 'pass, igroup, filename');	
		$row = $this->model->getRow();

		$ljs_name = $sesstions['ljs_name'];
		if (!isset($ljs_name) && $ljs_name == '') { 
			$pass = substr(md5($pass),0,8);
		}

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

			$context->set('fileup_name', $imgup_name);

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

class RecordReplyPanel extends RecordBasePanel {

	var $class_name = 'record_reply';

	function record() {

		$context = Context::getInstance();
		$requests = $this->requests;
		$posts = $this->posts;
		$files = $this->files;

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
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

			$this->imgup_name = $imgup_name;
		} 
		$context->set('fileup_name', $imgup_name);

		$result = $this->controller->update('recordSsunseo');
		if (!isset($result)) {
			Error::alertToBack('순서를 변경하는데 실패했습니다.');
		}

		$result = $this->controller->insert('recordReply');
		if (!isset($result)) {
			Error::alertToBack('답글을 저장하는데 실패했습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?board=$board&board_grg=$board_grg&action=list'>");
	}
}

class RecordDeletePanel extends BaseView {

	var $class_name = 'record_delete';

	function init() {

		$context = Context::getInstance();
		$requests =  $context->getRequestAll();
		$posts =  $context->getPostAll();
		$files =  $context->getFiles();

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		
		$this->controller->select('fieldFromBoardWhereId', 'pass,filename');
		
		$pass = substr(md5(trim($posts['pass'])),0,8);
		$pass = substr(md5($pass),0,8);
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

class recordWriteTailCommentPanel extends BaseView {

	var $class_name = 'record_writecomment';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$id = $requests['id'];
		$board = $requests['board'];		
		$board_grg = $requests['board_grg'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];
		$sid = $requests['sid'];

		$result = $this->controller->insert('recordWriteTailComment');
		if (!isset($result)) {
			Error::alertToBack('댓글 입력을 실패하였습니다.');
		}

		echo ("<meta http-equiv='Refresh' content='0; URL=board.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid&action=read'>");
	}
}

class recordDeleteTailCommentPanel extends BaseView {

	var $class_name = 'record_deletecomment';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();

		$pass = trim($posts['pass']);
		$admin_pwd = $context->get('db_admin_pwd');
		
		$id = $requests['id'];
		$sid = $requests['sid'];
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];

		$this->controller->select('fieldFromTailCommentId', 'pass');
		$row = $this->model->getRow();

		if ($pass == $row['pass'] || $pass == "$admin_pwd") {
			$result = $this->controller->delete('recordDeleteTailComment');
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