<?php

class BoardView extends BaseView {

	var $class_name = 'board_view';
	
	// display function is defined in parent class 
}

class Navi extends Object {

	var $class_name = 'board_navi';
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
}

class ListPanel extends BaseView {

	var $class_name = 'board_list';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$board = $requests['board'];
		$board_grg = $requests['board_grg'] = $board . '_grg';

		$id = $requests['id'];
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];
		$page = $requests['page'];
		$sid = $requests['sid'];
		$action = $requests['action'];
		$find = $requests['find'];
		$search = $requests['search'];
		
		$this->controller->select('fromBoardGroup');
		$row = $this->model->getRow();
		$width = $row['width'];
		$download = strtolower($row['download']);
		$top_path = $row['include1'];
		$main_path = $row['include2'];
		$bottom_path = $row['include3'];
		$limit = $row['listnum'];

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
			$numrows = $this->model->getNumRows();

			$_method = (isset($search) && $search != '') ? 'fromBoardSearchLimit' : 'fromBoardLimit';
			$result = $this->controller->select($_method);
			if ($result) {
				$numrows2 = $this->model->getNumRows();
				$rows = $this->model->getRows();				
				$list_data = array();
				$today = date("Y-m-d");

				for ($i=0; $i<count($rows); $i++) {

					$name =htmlspecialchars($rows[$i]['name']);
					$id =$rows[$i]['id'];
					$igroup =$rows[$i]['igroup'];
					$sid =$rows[$i]['id'];
					$title =htmlspecialchars($rows[$i]['title']);
					$opkey =$rows[$i]['opkey'];
					$date =$rows[$i]['date'];					
					$space =$rows[$i]['space'];
					$hit =$rows[$i]['see'];
					$filename =$rows[$i]['filename'];
					$filetype =$rows[$i]['filetype'];					
					$compareDay =split(' ', $rows[$i]['date'])[0];
					$subject_str = "";

					$subject_obj = array();

					if (isset($search) && $search != '') {

						$subject_obj['find'] = $find;
						$subject_obj['search'] = $search;

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
					
					$subject_obj['id'] = $id;
					$subject_obj['igroup'] = $igroup;
					$subject_obj['sid'] = $sid;
					$subject_obj['title'] = $title;
					$subject_obj['comment_num'] = 0;
					$subject_obj['img_name'] = '';
					$subject_obj['opkey_name'] = '';

					// 'off' in value is a class name of CSS
					$subject_obj['space'] = 'space-off';
					$subject_obj['icon_reply'] = 'off';
					$subject_obj['icon_reply_type'] = 0;
					$subject_obj['icon_img'] = 'off';
					$subject_obj['txt_comment'] = 'off';
					$subject_obj['icon_new'] = 'off';
					$subject_obj['icon_opkey'] = 'off';

					if ($space) {
						$subject_obj['space'] = 'space-on';
						$subject_obj['icon_reply'] = 'on';
						$subject_obj['icon_reply_type'] = $space%4;					
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
						$subject_obj['txt_comment'] = 'on';
						$subject_obj['comment_num'] = $grgnums;
					}

					if ($compareDay == $today){
						$subject_obj['icon_new'] = 'on';
					}
					
					if ($opkey) {
						$img_list = array(	"f"=>"icon_finish.gif",
											"i"=>"icon_ing.gif",
											"c"=>"icon_cost.gif",
											"m"=>"icon_mail.gif",
											"n"=>"icon_no_cost.gif");

						$subject_obj['icon_opkey'] = 'on';
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

		$navi_data = array();
		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {
			$smarty->assign('width', $width);
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('navi_skin_path', $navi_skin_path);	
			$smarty->assign('list_data', $list_data);

			foreach ($requests as $key => $value) {
				$smarty->assign($key, $value);
			}
			// navi logic			
			foreach ($navi as $key => $value) {
				$navi_data[$key] = $value;
			}
			$smarty->assign('navi_data', $navi_data);
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

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$id = $requests['id'];;
		$igroup = $requests['igroup'];
		$passover = $requests['passover'];
		$page = $requests['page'];
		$sid = $requests['sid'];
		$find = $requests['find'];
		$search = $requests['search'];
		$action = $requests['action'];

		$grade = $sessions['grade'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];

		$this->controller->select('fromBoardGroup');
		$grow = $this->model->getRow();

		$width = $grow['width'];
		$log_key = $grow['log_key'];
		$r_grade = $grow['r_grade'];
		$r_admin = $grow['r_admin'];
		$download = strtolower($grow['download']);
		$tail = $grow['tail'];
		$setup = $grow['setup'];
		$top_path = $grow['include1'];
		$main_path = $grow['include2'];
		$bottom_path = $grow['include3'];
		$comment_type = $grow['type'];

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
		$data = $this->model->getRow();
		$type = trim($data['type']);
		$filename = $data['filename'];
		$filetype = $data['filetype'];
		$download = $data['download'];
		$data['name'] = htmlspecialchars($data['name']);
		$data['title'] = htmlspecialchars($data['title']);

		switch ($comment_type) {
			case 'all':
				if ($type =='html'){
					$comment = $data['comment'];
				}else if ($type == 'text'){
					$comment = nl2br($data['comment']);
				}
				break;
			case 'text':
				$comment = nl2br($data['comment']);
				break;
			case 'html':
				$comment = $data['comment'];
				break;			
			default:
				break;
		}

		$data['comment'] = $comment;
		$down_display = 'none';
		$img_display = 'none';

		if ($filename) {
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$down_display = 'block';
				$fileup_path = "<a href=\"../../board_data/$board/$filename\">${filename}&nbsp;<b>[ 다운로드 ]</b></a>";
			} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

				$imgpath = '../../board_data/'.$board.'/'.$filename;
				$image_info = getimagesize($imgpath);
			      $image_type = $image_info[2];

			      if ( $image_type == IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($imgpath);
			      } elseif( $image_type == IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($imgpath);
			      } elseif( $image_type == IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($imgpath);
				}

				$img_width = imagesx($image) . 'px';
				$fileup_path = "$board/$filename";
				$img_display = 'block';

				$data['img_width'] = $img_width;
				$data['fileup_path'] = $fileup_path;
			}
		}

		$data['down_display'] = $down_display;
		$data['img_display'] = $img_display;

		// opkey
		$data['opkey'] = 'none';
		if ($setup == 'y' || $grade > 9) {
			$data['opkey'] = 'block';
		}

		// comment_tail
		$tail_data = array();
		$data['tail'] = 'none';
		if ($tail == 'y') {
			$data['tail'] = 'block';

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
			$smarty->assign('wdith', $wdith);		
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('opkey_skin_path', $opkey_skin_path);
			$smarty->assign('tail_skin_path', $tail_skin_path);
			$smarty->assign('tail_data', $tail_data);
			$smarty->assign('data', $data);

			foreach ($requests as $key => $value) {
				$smarty->assign($key, $value);
			}

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
		$row = $this->model->getRow();
		$comment_type = $row["type"];
		$log_key = $row['log_key'];
		$r_grade = $row["r_grade"];
		$r_admin = $row["r_admin"];
		$top_path = $row['include1'];
		$main_path = $row['include2'];
		$bottom_path = $row['include3'];

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/write.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';

		$this->controller->select('fieldFromBoardLimit', 'wall');
		$data = $this->model->getRow();
		$wall = $data['wall'];

		if ($wall == 'a' || !isset($wall)) {
			$data['wallname'] = "나라사랑";
			$data['wallkey'] = "b";
		} else if ($wall == 'b') {
			$data['wallname'] = "조국사랑";
			$data['wallkey'] = "a";
		}

		if (isset($comment_type) && $comment_type != '') {
			$data['comment_type_' . $comment_type] = 'checked';
		} else {
			$data['comment_type_text'] = 'checked';
		}	
		
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

		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {
			$smarty->assign('wdith', $wdith);		
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('data', $data);

			foreach ($requests as $key => $value) {
				$smarty->assign($key, $value);
			}

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
		$row = $this->model->getRow();
		$r_grade = $row['r_grade'];
		$r_admin = $row['r_admin'];
		$log_key = $row['log_key'];
		$top_path =  $row['include1'];
		$main_path =  $row['include2'];
		$bottom_path =  $row['include3'];

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/modify.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';

		$this->controller->select('fieldFromBoardWhereId', '*');
		$data = $this->model->getRow();
		$comment_type = $data['typpe'];
		$data['comment'] = htmlspecialchars($data['comment']);
		$data['name'] = htmlspecialchars($data['name']);
		$data['title'] = nl2br($data['title']);	
		unset($data['pass']);

		if (isset($comment_type) && $comment_type != '') {
			$data['comment_type_' . $comment_type] = 'checked';
		} else {
			$data['comment_type_text'] = 'checked';
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

		$smarty = new Smarty;
		if (is_readable($top_path)) {
			$smarty->display( $top_path );
		} else {
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->display( $default_header_path );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skin_path)) {
			$smarty->assign('wdith', $wdith);		
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('data', $data);

			foreach ($requests as $key => $value) {
				$smarty->assign($key, $value);
			}

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
		$row = $this->model->getRow();
		$comment_type = $row["type"];
		$log_key = $row['log_key'];
		$r_grade = $row["r_grade"];
		$r_admin = $row["r_admin"];
		$top_path = $row['include1'];
		$main_path = $row['include2'];
		$bottom_path = $row['include3'];

		$this->controller->select('fieldFromBoardWhereId', '*');
		$data = $this->model->getRow();
		$type = trim($data['type']);
		$filename = $data['filename'];
		$filetype = $data['filetype'];
		$download = $data['download'];
		$data['name'] = htmlspecialchars($data['name']);
		$data['title'] = htmlspecialchars($data['title']);

		switch ($comment_type) {
			case 'all':
				if ($type =='html'){
					$comment = $data['comment'];
				}else if ($type == 'text'){
					$comment = nl2br($data['comment']);
				}
				break;
			case 'text':
				$comment = nl2br($data['comment']);
				break;
			case 'html':
				$comment = $data['comment'];
				break;			
			default:
				break;
		}

		$data['comment'] = $comment;
		$down_display = 'none';
		$img_display = 'none';

		if ($filename) {
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$down_display = 'block';
				$fileup_path = "<a href=\"../../board_data/$board/$filename\">${filename}&nbsp;<b>[ 다운로드 ]</b></a>";
			} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

				$imgpath = '../../board_data/'.$board.'/'.$filename;
				$image_info = getimagesize($imgpath);
			      $image_type = $image_info[2];

			      if ( $image_type == IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($imgpath);
			      } elseif( $image_type == IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($imgpath);
			      } elseif( $image_type == IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($imgpath);
				}

				$img_width = imagesx($image) . 'px';
				$fileup_path = "$board/$filename";
				$img_display = 'block';

				$data['img_width'] = $img_width;
				$data['fileup_path'] = $fileup_path;
			}
		}

		$data['down_display'] = $down_display;
		$data['img_display'] = $img_display;

		$skin_dir = 'skin/' . $main_path;
		$skin_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/reply.tpl';
		$default_header_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_header.tpl';
		$default_footer_path = _SUX_PATH_ . 'modules/board/' . $skin_dir . '/_footer.tpl';

		$this->controller->select('fieldFromBoardLimit','wall');
		$row = $this->model->getRow();			
		$wall = $row['wall'];

		if ($wall == 'a' || !isset($wall)) {
			$data['wallname'] = "나라사랑";
			$data['wallkey'] = "b";
		} else if ($wall == 'b') {
			$data['wallname'] = "조국사랑";
			$data['wallkey'] = "a";
		}

		if (isset($comment_type) && $comment_type != '') {
			$data['comment_type_' . $comment_type] = 'checked';
		} else {
			$data['comment_type_text'] = 'checked';
		}
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			Error::alertToBack('죄송합니다. 답변 권한이 없습니다.');
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
			$smarty->assign('wdith', $wdith);		
			$smarty->assign('skin_dir', $skin_dir);
			$smarty->assign('data', $data);

			foreach ($requests as $key => $value) {
				$smarty->assign($key, $value);
			}

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

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$row = $this->model->getRow();	
		$m_name = $row['name'];

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
		$posts = $this->posts;
		$files = $this->files;

		$id = $requests['id'];
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$pass = $posts['pass'];
		$admin_pwd = $context->get('db_admin_pwd');
		$imgup_name = $files['imgup']['name'];
		$imgup_tmpname = $files['imgup']['tmp_name'];

		$this->controller->select('fieldFromBoardWhereId', 'pass, igroup, filename');	
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