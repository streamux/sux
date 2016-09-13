<?php

class BoardView extends BaseView {

	var $class_name = 'board_view';
	
	// display function is defined in parent class 
}

class ListPanel extends BaseView {

	var $class_name = 'board_list';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();		

		$board = $requests['board'];
		$board_grg = $requests['board_grg'] = $board . '_grg';
		$passover = $requests['passover'];
		$page = $requests['page'];
		$find = $requests['find'];
		$search = $requests['search'];
		$action = $requests['action'];
		
		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];
		$limit = $groupData['listnum'];		

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/list.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";
		$naviSkinPath = _SUX_PATH_ . "modules/board/${skinDir}/_navi.tpl";

		$this->controller->delete('limitwordFromBoard');
		
		// list logic
		if (!isset($passover) && $passover == '') {
			 $passover = 0;
		}

		if (!isset($page) &&  $page == '') {
			 $page =1;
		}

		$context->set('limit', $limit);
		$context->set('passover', $passover);		

		$methodString = (isset($search) && $search != '') ? 'fromBoardSearch' : 'fromBoard';
		$result = $this->controller->select($methodString);		
		if ($result) {

			// use in order to navi
			$numrows = $this->model->getNumRows();

			$methodString = (isset($search) && $search != '') ? 'fromBoardSearchLimit' : 'fromBoardLimit';
			$result = $this->controller->select($methodString);
			if ($result) {

				$numrows2 = $this->model->getNumRows();
				$documentData = $this->model->getRows();					
				$today = date("Y-m-d");

				for ($i=0; $i<count($documentData); $i++) {

					$sid = $documentData[$i]['id'];
					$name =htmlspecialchars($documentData[$i]['name']);					
					$title =htmlspecialchars($documentData[$i]['title']);
					$opkey =$documentData[$i]['opkey'];
					$date =$documentData[$i]['date'];
					$space =$documentData[$i]['space'];
					$ssunseo =$documentData[$i]['ssunseo'];
					$hit =$documentData[$i]['see'];
					$filename =$documentData[$i]['filename'];
					$filetype =$documentData[$i]['filetype'];					
					$compareDay =split(' ', $documentData[$i]['date'])[0];
					
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

					$subject = array();
					$subject['id'] = $documentData[$i]['id'];
					$subject['igroup'] = $documentData[$i]['igroup'];
					$subject['ssunseo'] = $documentData[$i]['ssunseo'];
					$subject['sid'] = $documentData[$i]['id'];
					$subject['title'] = $title;					
					$subject['img_name'] = '';
					$subject['opkey_name'] = '';
					$subject['passover'] = $passover;
					$subject['page'] = $page;

					// 'off' in value is a class name of CSS
					$subject['space'] = '10px';
					$subject['icon_box'] = '';
					$subject['icon_box_type'] = 0;
					$subject['icon_img'] = 'off';
					$subject['txt_tail'] = 'off';
					$subject['tail_num'] = 0;
					$subject['icon_new'] = 'off';
					$subject['icon_opkey'] = 'off';

					if ($space) {
						$subject['space'] = (10+$space*10) . 'px';
						$subject['icon_box'] = '답변';
						$subject['icon_box_color'] = 'icon-replay-color';
					}

					// 공지글 설정은 개발 예정 
					/*if (isset($isNotice) && $isNotice != '') {
						$subject['space'] = '10px';
						$subject['icon_box'] = '공지';
						$subject['icon_box_color'] = 'icon-notice-color';
					}*/

					$imgname = "";
					if ($filename){
						if ($filetype =="image/gif" || $filetype =="image/jpeg" || $filetype =="image/x-png" || $filetype =="image/png" || $filetype =="image/bmp"){
							$imgname = "icon_img.png";
						} else if ($download == 'y'  && ($filetype=="application/x-zip-compressed" || $filetype=="application/zip")) { 
							$imgname = "icon_down.png";
						}

						if ($imgname != '') {
							$subject['icon_img'] = 'on';
							$subject['img_name'] = $imgname;
						}	
					}				

					$grgresult = $this->controller->select('idFromTailCommentWhere', $sid);
					$grgnums = $this->model->getNumRows();
					if ($grgnums) {
						$subject['txt_tail'] = 'on';
						$subject['tail_num'] = $grgnums;
					}

					if ($compareDay == $today){
						$subject['icon_new'] = 'on';
						$subject['icon_new_title'] = 'new';
					}
					
					$subject['icon_opkey'] = $opkey;
					$subject['icon_opkey_color'] = 'icon-opkey-color';

					$documentData[$i]['name'] = $name;
					$documentData[$i]['hit'] = $hit;
					$documentData[$i]['date'] = split(' ', $date)[0];
					$documentData[$i]['subject'] = $subject;

					$subject = null;
				}
			} else {
				echo '게시물 목록 가져오기를 실패하였습니다.';
			}
		} else {
			echo '게시물 전체 목록 가져오기를 실패하였습니다.';
		}

		// navi logic
		$navi = New Navigator();
		$navi->passover = $passover;
		$navi->limit = $limit;
		$navi->total = $numrows;
		$navi->init();

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {			
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('naviSkinPath', $naviSkinPath);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);
			$smarty->assign('documentData', $documentData);			
			$smarty->assign('naviData', $navi->get());
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
		}
	}
}

class SearchlistPanel extends ListPanel {

	var $class_name = 'search_list';	
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
		$groupData = $this->model->getRow();
		$log_key = $groupData['log_key'];
		$r_grade = $groupData['r_grade'];
		$r_admin = $groupData['r_admin'];
		$download = strtolower($groupData['download']);
		$tail = $groupData['tail'];
		$setup = $groupData['setup'];
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];
		$commentType = $groupData['type'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/read.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";
		$tailSkinPath = _SUX_PATH_ . "modules/board/${skinDir}/_tail.tpl";
		$opkeySkinPath = _SUX_PATH_ . "modules/board/${skinDir}/_opkey.tpl";
		
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
		$documentData = $this->model->getRow();		
		$documentData['name'] = htmlspecialchars($documentData['name']);
		$documentData['title'] = htmlspecialchars($documentData['title']);
		$documentData['hit'] = $documentData['see'];

		$type = trim($documentData['type']);
		$filename = $documentData['filename'];
		$filetype = $documentData['filetype'];

		switch ($commentType) {
			case 'all':
				if ($type =='html'){
					$documentData['comment'] = htmlspecialchars_decode($documentData['comment']);
				}else if ($type == 'text'){
					$documentData['comment'] = nl2br(htmlspecialchars($documentData['comment']));
				}
				break;
			case 'text':
				$documentData['comment'] = nl2br(htmlspecialchars($documentData['comment']));
				break;
			case 'html':
				$documentData['comment'] = htmlspecialchars_decode($documentData['comment']);
				break;			
			default:
				break;
		}

		$documentData['css_down'] = 'hide';
		$documentData['css_img'] = 'hide';

		$fileupPath = '';
		if ($filename) {

			$fileupPath = "../../board_data/${board}/${filename}";
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$documentData['css_down'] = 'show';
			} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

				$image_info = getimagesize($fileupPath);
			      $image_type = $image_info[2];

			      if ( $image_type == IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($fileupPath);
			      } elseif( $image_type == IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($fileupPath);
			      } elseif( $image_type == IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($fileupPath);
				}
				$documentData['css_img'] = 'show';
				$documentData['css_img_width'] = imagesx($image) . 'px';
			}
			$documentData['fileup_name'] = $filename;
			$documentData['fileup_path'] = $fileupPath;
		}

		// opkey
		$documentData['css_opkey'] = 'hide';
		if ($setup == 'y' || $grade > 9) {
			$documentData['css_opkey'] = 'show';
		}

		// taill
		$documentData['css_tail'] = 'hide';
		$tailData = array();		
		if ($tail == 'y') {
			$documentData['css_tail'] = 'show';

			$this->controller->select('fromTailCommentWhere', $sid);
			$tailData['num'] = $this->model->getNumRows();
			$tailData['list'] = $this->model->getRows();
		}
		
		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {					
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('opkeySkinPath', $opkeySkinPath);
			$smarty->assign('tailSkinPath', $tailSkinPath);			
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);		
			$smarty->assign('documentData', $documentData);
			$smarty->assign('tailData', $tailData);			

			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
		}
	}
}

class WritePanel extends BaseView {

	var $class_name = 'board_write';

	function init() {

		$context = Context::getInstance();	
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		$admin_pass = $context->checkAdminPass();

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$action = $requests['action'];
		$grade = $sessions['grade'];
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];
		$PHP_SELF = $context->getServer("PHP_SELF");		

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$log_key = $groupData['log_key'];
		$r_grade = $groupData["r_grade"];
		$r_admin = $groupData["r_admin"];
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/write.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";

		$this->controller->select('fieldFromBoardLimit', 'wall');
		$documentData = $this->model->getRow();
		$wall = $documentData['wall'];		

		if ($wall == 'a' || !isset($wall)) {
			$documentData['wallname'] = "나라사랑";
			$documentData['wallkey'] = "b";
		} else if ($wall == 'b') {
			$documentData['wallname'] = "조국사랑";
			$documentData['wallkey'] = "a";
		}

		$documentData['comment_type_text'] = 'checked';
		$documentData['comment_type_html'] = '';
		
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
			$documentData['css_user_label'] = 'hide';
			$documentData['user_name_type'] = 'hidden';
			$documentData['user_pass_type'] = 'hidden';
			$documentData['user_name'] = $ljs_name;
			$documentData['user_password'] = $ljs_pass1;
		} else {
			$documentData['css_user_label'] = 'show';			
			$documentData['user_name_type'] = 'text';
			$documentData['user_pass_type'] = 'password';
			$documentData['user_name'] = $ljs_name;
			$documentData['user_password'] = '';
		}

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {				
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);	
			$smarty->assign('documentData', $documentData);
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
		}
	}
}

class ModifyPanel extends BaseView {

	var $class_name = 'board_modify';

	function init() {
		
		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];		
		$grade = $sessions['grade'];		
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];		

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$r_grade = $groupData['r_grade'];
		$r_admin = $groupData['r_admin'];
		$log_key = $groupData['log_key'];
		$topPath =  $groupData['include1'];
		$skinName =  $groupData['include2'];
		$bottomPath =  $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/modify.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";

		$this->controller->select('fieldFromBoardWhereId', '*');
		$documentData = $this->model->getRow();		
		$documentData['comment'] = htmlspecialchars($documentData['comment']);
		$documentData['name'] = htmlspecialchars($documentData['name']);
		$documentData['title'] = nl2br($documentData['title']);
		$commentType = $documentData['type'];
		unset($documentData['pass']);

		if (isset($commentType) && $commentType != '') {
			$documentData['comment_type_' . $commentType] = 'checked';
		} else {
			$documentData['comment_type_text'] = 'checked';
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
			$documentData['css_user_label'] = 'hide';
			$documentData['user_name_type'] = 'hidden';
			$documentData['user_pass_type'] = 'hidden';
			$documentData['user_name'] = $ljs_name;
			$documentData['user_password'] = $ljs_pass1;
		} else {
			$documentData['css_user_label'] = 'show';			
			$documentData['user_name_type'] = 'text';
			$documentData['user_pass_type'] = 'password';
			$documentData['user_name'] = $ljs_name;
			$documentData['user_password'] = '';
		}

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {	
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);
			$smarty->assign('documentData', $documentData);
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
		}
	}
}

class ReplyPanel extends BaseView {

	var $class_name = 'board_reply';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$action = $requests['action'];
		$grade = $sessions['grade'];
		$ljs_name = $sessions['ljs_name'];
		$ljs_pass1 = $sessions['ljs_pass1'];		

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();		
		$commentType = $groupData["type"];
		$log_key = $groupData['log_key'];
		$r_grade = $groupData["r_grade"];
		$r_admin = $groupData["r_admin"];
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/reply.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";

		$this->controller->select('fieldFromBoardWhereId', '*');
		$documentData = $this->model->getRow();
		$type = trim($documentData['type']);
		$filename = $documentData['filename'];
		$filetype = $documentData['filetype'];
		$download = $documentData['download'];
		$documentData['name'] = htmlspecialchars($documentData['name']);
		$documentData['title'] = htmlspecialchars($documentData['title']);

		switch ($commentType) {
			case 'all':
				if ($type =='html'){
					$documentData['comment'] = htmlspecialchars_decode($documentData['comment']);
				}else if ($type == 'text'){
					$documentData['comment'] = nl2br(htmlspecialchars($documentData['comment']));
				}
				break;
			case 'text':
				$documentData['comment'] = nl2br(htmlspecialchars($documentData['comment']));
				break;
			case 'html':
				$documentData['comment'] = htmlspecialchars_decode($documentData['comment']);
				break;			
			default:
				break;
		}
		
		$documentData['css_down'] = 'hide';
		$documentData['css_img'] = 'hide';

		$fileupPath = '';
		if ($filename) {

			$fileupPath = "../../board_data/${board}/${filename}";
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$documentData['css_down'] = 'show';
			} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

				$image_info = getimagesize($fileupPath);
			      $image_type = $image_info[2];

			      if ( $image_type == IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($fileupPath);
			      } elseif( $image_type == IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($fileupPath);
			      } elseif( $image_type == IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($fileupPath);
				}
				$documentData['css_img'] = 'show';
				$documentData['img_width'] = imagesx($image) . 'px';
			}
			$documentData['fileup_name'] = $filename;
			$documentData['fileup_path'] = $fileupPath;
		}

		$this->controller->select('fieldFromBoardLimit','wall');
		$row = $this->model->getRow();			
		$wall = $row['wall'];

		if ($wall == 'a' || !isset($wall)) {
			$documentData['wallname'] = "나라사랑";
			$documentData['wallkey'] = "b";
		} else if ($wall == 'b') {
			$documentData['wallname'] = "조국사랑";
			$documentData['wallkey'] = "a";
		}

		$documentData['comment_type_text'] = 'checked';
		$documentData['comment_type_html'] = '';
		
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
			$documentData['css_user_label'] = 'hide';
			$documentData['user_name_type'] = 'hidden';
			$documentData['user_pass_type'] = 'hidden';
			$documentData['user_name'] = $ljs_name;
			$documentData['user_password'] = $ljs_pass1;
		} else {
			$documentData['css_user_label'] = 'show';			
			$documentData['user_name_type'] = 'text';
			$documentData['user_pass_type'] = 'password';
			$documentData['user_name'] = $ljs_name;
			$documentData['user_password'] = '';
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				Error::alertTo('죄송합니다. 답변 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {				
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);	
			$smarty->assign('documentData', $documentData);
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
		}
	}
}

class DeletepassPanel extends BaseView {

	var $class_name = 'delpass';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$id = $requests['id'];

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];

		$skinDir = "skin/$skinName";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/delpass.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$document_data = $this->model->getRow();

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);
			$smarty->assign('documentData', $document_data);
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
		}
	}
}

class DeletepassgrgPanel extends BaseView {

	var $class_name = 'delpassgrg';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sessions = $context->getSessionAll();
		
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];

		$skinDir = "skin/$skinName";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}/delpass_grg.tpl";
		$defaultHeaderPath = _SUX_PATH_ . "modules/board/${skinDir}/_header.tpl";
		$defaultFooterPath = _SUX_PATH_ . "modules/board/${skinDir}/_footer.tpl";

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$document_data = $this->model->getRow();

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {
			$smarty->assign('skinDir', $skinDir);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);
			$smarty->assign('documentData', $document_data);
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
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

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
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
		$groupData = $this->model->getRow();
		$topPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$bottomPath = $groupData['include3'];

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$documentData = $this->model->getRow();

		$skinDir = 'skin/' . $skinName;
		$skinPath = _SUX_PATH_ . 'modules/board/' . $skinDir . '/delpass_grg.tpl';

		$smarty = new Smarty;
		if (is_readable($topPath)) {
			$smarty->display( $topPath );
		} else {
			$smarty->assign('skinDir', $skinDir);
			$smarty->display( $defaultHeaderPath );
			echo '<p>상단 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($skinPath)) {
			//$smarty->assign('sessionData', $sessions);
			$smarty->assign('requestData', $requests);
			$smarty->assign('groupData', $groupData);
			$smarty->assign('documentData', $documentData);
			$smarty->display( $skinPath );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
		
		if (is_readable($bottomPath)) {
			$smarty->display( $bottomPath );
		} else {			
			echo '<p>하단 파일경로를 확인하세요.</p>';
			$smarty->display( $defaultFooterPath );
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

		$imageUpName = $values['imgup']['name'];

		if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imageUpName)) {
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
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$saveDir = _SUX_PATH_ . "board_data/${board}/";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName =$mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}

			$this->imageUpName = $imageUpName;
		}
		$context->set('fileup_name', $imageUpName);

		$result = $this->controller->insert('recordWrite');
		if (!isset($result)) {
			Error::alertToBack('글을 저장하는데 실패했습니다.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
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
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];
		$ljs_name = $sesstions['ljs_name'];

		$this->controller->select('fieldFromBoardWhereId', 'pass, igroup, filename');	
		$row = $this->model->getRow();
		
		if (!isset($ljs_name) && $ljs_name == '') { 
			$pass = substr(md5($pass),0,8);
		}

		if ($pass == $row['pass'] || $pass == $admin_pwd) {

			$delFileName = $row['filename'];
			$saveDir = _SUX_PATH_ . "board_data/${board}/";

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

			$result = $this->controller->update('recordModify');			
			if (!isset($result)) {
				Error::alertToBack('글을 수정하는데 실패했습니다.');
			}
		} else {
			Error::alertToBack('비밀번호가 틀립니다.\n비밀번호를 확인하세요.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&id=$id&sid=$row[sid]&igroup=$row[igroup]&action=read");
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
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$saveDir = _SUX_PATH_ . "board_data/${board}/";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName = $mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}

			$this->imageUpName = $imageUpName;
		} 
		$context->set('fileup_name', $imageUpName);

		$result = $this->controller->update('recordSsunseo');
		if (!isset($result)) {
			Error::alertToBack('순서를 변경하는데 실패했습니다.');
		}

		$result = $this->controller->insert('recordReply');
		if (!isset($result)) {
			Error::alertToBack('답글을 저장하는데 실패했습니다.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
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

		$pass = substr(md5(trim($posts['pass'])),0,8);
		$pass = substr(md5($pass),0,8);
		$admin_pwd = trim($context->get('db_admin_pwd'));

		$this->controller->select('fieldFromBoardWhereId', 'pass,filename');		
		$row = $this->model->getRow();	
		$delFileName = $row['filename'];

		if ($pass == $row['pass'] || $pass == $admin_pwd) {

			if(isset($delFileName) && $delFileName != '') {
				$delFileName = _SUX_PATH_ . "board_data/$board/$delFileName";

				if(!@unlink($delFileName)) {
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

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
	}
}

class RecordWritetailcommentPanel extends BaseView {

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

		Utils::goURL("board.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid&action=read");
	}
}

class RecordDeletetailcommentPanel extends BaseView {

	var $class_name = 'record_deletecomment';

	function init() {

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

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&id=$id&sid=$id&igroup=$igroup&passover=$passover&action=read");
	}
}
?>