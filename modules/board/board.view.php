<?php

class BoardModule extends BaseView {

	var $class_name = 'board_module';
	var $skin_path_list = array();
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = array();

	function output() {

		$UIError = UIError::getInstance();
		/*
		 * @class Tracer
		 * @brief Tracer를 이용해서 코드의 흐름을 파악할 수 있다.
		 */
		/*$tracer = Tracer::getInstance();
		$tracer->output();*/

		/**
		 * @class Template
		 * @brief Template is a Wrapper Class based on Smarty
		 */
		$__template = new Template();
		if (is_readable($this->skin_path_list['contents'])) {
			$__template->assign('copyrightPath', $this->copyright_path);
			$__template->assign('skinPathList', $this->skin_path_list);
			$__template->assign('sessionData', $this->session_data);
			$__template->assign('requestData', $this->request_data);			
			$__template->assign('postData', $this->post_data);
			$__template->assign('documentData', $this->document_data);
			$__template->display( $this->skin_path_list['contents'] );		
		} else {			
			$UIError->add('스킨 파일경로가 올바르지 않습니다.');
			$UIError->useHtml = TRUE;
		}		
		$UIError->output();	
	}
}

class BoardView extends BoardModule {

	var $class_name = 'board_view';

	function displayList() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$this->request_data['board_grg'] = $this->request_data['board'] . '_grg';
		$passover = $this->request_data['passover'];
		$page = $this->request_data['page'];
		$find = $this->request_data['find'];
		$search = $this->request_data['search'];
		$action = $this->request_data['action']; // useless

		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 목록';

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$headerPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$footerPath = $groupData['include3'];
		$limit = $groupData['listnum'];

		/**
		 * css, js file path handler
		 */
		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/{$skinDir}";

		/**
		 * @var headerPath
		 * @descripttion
		 * smarty include 상대경로 접근 방식이 달라서 convertAbsolutePath()함수에 절대경로 처리 함.
		 */		
		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}
		
		// list logic
		if (!isset($passover) || $passover === '') {
			 $passover = 0;
		}

		if (!isset($page) ||  $page === '') {
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
				$contentData['list'] = $this->model->getRows();					
				$today = date("Y-m-d");

				for ($i=0; $i<count($contentData['list']); $i++) {

					$sid = $contentData['list'][$i]['id'];
					$name =htmlspecialchars($contentData['list'][$i]['name']);					
					$title =htmlspecialchars($contentData['list'][$i]['title']);
					$opkey =$contentData['list'][$i]['opkey'];
					$date =$contentData['list'][$i]['date'];
					$space =$contentData['list'][$i]['space'];
					$ssunseo =$contentData['list'][$i]['ssunseo'];
					$hit =$contentData['list'][$i]['see'];
					$filename =$contentData['list'][$i]['filename'];
					$filetype =$contentData['list'][$i]['filetype'];					
					$compareDayArr = split(' ', $contentData['list'][$i]['date']);
					$compareDay = $compareDayArr[0];
					
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
					$subject['id'] = $contentData['list'][$i]['id'];
					$subject['igroup'] = $contentData['list'][$i]['igroup'];
					$subject['ssunseo'] = $contentData['list'][$i]['ssunseo'];
					$subject['sid'] = $contentData['list'][$i]['id'];
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
					// if (isset($isNotice) && $isNotice != '') {
					// 	$subject['space'] = '10px';
					// 	$subject['icon_box'] = '공지';
					// 	$subject['icon_box_color'] = 'icon-notice-color';
					// }

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

					$contentData['list'][$i]['name'] = $name;
					$contentData['list'][$i]['hit'] = $hit;
					$contentData['list'][$i]['space'] = $space;
					$dateArr = split(' ', $date);
					$contentData['list'][$i]['date'] = $dateArr[0];
					$contentData['list'][$i]['subject'] = $subject;

					$subject = null;
				}
			} else {
				$UIError->add('게시물 목록 가져오기를 실패하였습니다.');
			}
		} else {
			$UIError->add('게시물 전체 목록 가져오기를 실패하였습니다.');
		}

		// navi logic
		$navi = New Navigator();
		$navi->passover = $passover;
		$navi->limit = $limit;
		$navi->total = $numrows;
		$navi->init();

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = "{$skinPath}/list.tpl";
		$this->skin_path_list['footer'] = $footerPath;
		$this->skin_path_list['navi'] = "{$skinPath}/_navi.tpl";
		
		$this->document_data['pagination'] = $navi->get();
		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->output();
	} 

	function displayRead() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();	

		$board = $this->request_data['board'];
		$board_grg = $this->request_data['board_grg'];		
		$sid = $this->request_data['sid'];
		$action = $this->request_data['action'];

		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 읽기';

		$grade = $this->session_data['grade'];
		$ljs_name = $this->session_data['ljs_name'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];

		$PHP_SELF = $context->getServer("PHP_SELF");		

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$log_key = $groupData['log_key'];
		$r_grade = $groupData['r_grade'];
		$r_admin = $groupData['r_admin'];
		$download = strtolower($groupData['download']);
		$tail = $groupData['tail'];
		$setup = $groupData['setup'];
		$headerPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$footerPath = $groupData['include3'];
		$commentType = $groupData['type'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}";

		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add('상단 파일경로가 올바르지 않습니다.');
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add('하단 파일경로가 올바르지 않습니다.');
		}
		
		if (isset($grade) && $grade != '') {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			UIError::alertToBack('죄송합니다. 읽기 권한이 없습니다.');
			exit;
		}

		// nonmember's authority
		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				UIError::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				UIError::alertTo('죄송합니다. 읽기 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		// read panel
		$this->controller->select('fieldFromBoardWhereId', 'see');
		$row = $this->model->getRow();
		$hit = $row['see']+1;
		$this->controller->update('boardSetSee', $hit);

		$this->controller->select('fieldFromBoardWhereId', '*');
		$contentData = $this->model->getRow();		
		$contentData['name'] = htmlspecialchars($contentData['name']);
		$contentData['title'] = htmlspecialchars($contentData['title']);
		$contentData['hit'] = $contentData['see'];

		$type = trim($contentData['type']);
		$filename = $contentData['filename'];
		$filetype = $contentData['filetype'];

		switch ($commentType) {
			case 'all':
				if ($type =='html'){
					$contentData['comment'] = htmlspecialchars_decode($contentData['comment']);
				}else if ($type == 'text'){
					$contentData['comment'] = nl2br(htmlspecialchars($contentData['comment']));
				}
				break;
			case 'text':
				$contentData['comment'] = nl2br(htmlspecialchars($contentData['comment']));
				break;
			case 'html':
				$contentData['comment'] = htmlspecialchars_decode($contentData['comment']);
				break;			
			default:
				break;
		}

		$contentData['css_down'] = 'hide';
		$contentData['css_img'] = 'hide';

		$fileupPath = '';
		if ($filename) {

			$fileupPath = "../../board_data/${board}/${filename}";
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$contentData['css_down'] = 'show';
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
				$contentData['css_img'] = 'show';
				$contentData['css_img_width'] = imagesx($image) . 'px';
			}
			$contentData['fileup_name'] = $filename;
			$contentData['fileup_path'] = $fileupPath;
		}

		// opkey
		$contentData['css_opkey'] = 'hide';
		if ($setup == 'y' || $grade > 9) {
			$contentData['css_opkey'] = 'show';
		}

		// taill
		$contentData['css_tail'] = 'hide';
		$tailData = array();		
		if ($tail == 'y') {
			$contentData['css_tail'] = 'show';

			$this->controller->select('fromTailCommentWhere', $sid);
			$tailData['num'] = $this->model->getNumRows();
			$tailData['list'] = $this->model->getRows();
		}

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/read.tpl";
		$this->skin_path_list['footer'] = $footerPath;
		$this->skin_path_list['tail'] =  "{$skinPath}/_tail.tpl";
		$this->skin_path_list['opkey'] =  "{$skinPath}/_opkey.tpl";
		
		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;
		$this->document_data['tails'] = $tailData;

		$this->output();		
	}

	function displayWrite() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();	
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();		
		
		$board = $this->request_data['board'];
		$board_grg = $this->request_data['board_grg'];
		$action = $this->request_data['action'];

		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 쓰기';
		
		$grade = $this->session_data['grade'];
		$ljs_name = $this->session_data['ljs_name'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$log_key = $groupData['log_key'];
		$r_grade = $groupData["r_grade"];
		$r_admin = $groupData["r_admin"];
		$headerPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$footerPath = $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}";

		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add('상단 파일경로가 올바르지 않습니다.');
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add('하단 파일경로가 올바르지 않습니다.');
		}

		$this->controller->select('fieldFromBoardLimit', 'wall');
		$contentData = $this->model->getRow();
		$wall = $contentData['wall'];		

		if ($wall == 'a' || !isset($wall)) {
			$contentData['wallname'] = "나라사랑";
			$contentData['wallkey'] = "b";
		} else if ($wall == 'b') {
			$contentData['wallname'] = "조국사랑";
			$contentData['wallkey'] = "a";
		}

		$contentData['comment_type_text'] = 'checked';
		$contentData['comment_type_html'] = '';
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			UIError::alertToBack('죄송합니다. 쓰기 권한이 없습니다.');
			exit;
		}

		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);
				UIError::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				UIError::alertTo('죄송합니다. 쓰기 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (isset($ljs_name) && $ljs_name != '') {
			$contentData['css_user_label'] = 'hide';
			$contentData['user_name_type'] = 'hidden';
			$contentData['user_pass_type'] = 'hidden';
			$contentData['user_name'] = $ljs_name;
			$contentData['user_password'] = $ljs_pass1;
		} else {
			$contentData['css_user_label'] = 'show';			
			$contentData['user_name_type'] = 'text';
			$contentData['user_pass_type'] = 'password';
			$contentData['user_name'] = $ljs_name;
			$contentData['user_password'] = '';
		}

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/write.tpl";
		$this->skin_path_list['footer'] = $footerPath;

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->output();
	}

	function displayModify() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();		
		
		$board = $this->request_data['board'];
		$board_grg = $this->request_data['board_grg'];
		$action = $this->request_data['action'];
		
		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 수정';

		$grade = $this->session_data['grade'];		
		$ljs_name = $this->session_data['ljs_name'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];	
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();	

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$r_grade = $groupData['r_grade'];
		$r_admin = $groupData['r_admin'];
		$log_key = $groupData['log_key'];
		$headerPath =  $groupData['include1'];
		$skinName =  $groupData['include2'];
		$footerPath =  $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}";		

		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add('상단 파일경로가 올바르지 않습니다.');
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add('하단 파일경로가 올바르지 않습니다.');
		}

		$this->controller->select('fieldFromBoardWhereId', '*');
		$contentData = $this->model->getRow();		
		$contentData['comment'] = htmlspecialchars($contentData['comment']);
		$contentData['user_name'] = htmlspecialchars($contentData['name']);
		$contentData['title'] = nl2br($contentData['title']);
		$commentType = $contentData['type'];
		unset($contentData['pass']);

		if (isset($grade) && $grade != '') {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			UIError::alertToBack('죄송합니다. 수정 권한이 없습니다.');
			exit;
		}

		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				UIError::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				UIError::alertTo('죄송합니다. 수정 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (isset($ljs_name) && $ljs_name != '' && $ljs_name == $contentData['name']) {
			$contentData['user_name'] = $ljs_name;
		} else {
			$contentData['user_name'] = $contentData['name'];
		}

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/modify.tpl";
		$this->skin_path_list['footer'] = $footerPath;

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->output();
	}

	function displayReply() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();

		$board = $this->request_data['board'];
		$board_grg = $this->request_data['board_grg'];
		$action = $this->request_data['action'];

		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 답변';		

		$grade = $this->session_data['grade'];
		$ljs_name = $this->session_data['ljs_name'];
		$ljs_pass1 = $this->session_data['ljs_pass1'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();	

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();		
		$commentType = $groupData["type"];
		$log_key = $groupData['log_key'];
		$r_grade = $groupData["r_grade"];
		$r_admin = $groupData["r_admin"];
		$headerPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$footerPath = $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}";		

		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add('상단 파일경로가 올바르지 않습니다.');
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add('하단 파일경로가 올바르지 않습니다.');
		}

		$this->controller->select('fieldFromBoardWhereId', '*');
		$contentData = $this->model->getRow();
		$type = trim($contentData['type']);
		$filename = $contentData['filename'];
		$filetype = $contentData['filetype'];
		$download = $contentData['download'];
		$contentData['name'] = htmlspecialchars($contentData['name']);
		$contentData['title'] = htmlspecialchars($contentData['title']);

		switch ($commentType) {
			case 'all':
				if ($type =='html'){
					$contentData['comment'] = htmlspecialchars_decode($contentData['comment']);
				}else if ($type == 'text'){
					$contentData['comment'] = nl2br(htmlspecialchars($contentData['comment']));
				}
				break;
			case 'text':
				$contentData['comment'] = nl2br(htmlspecialchars($contentData['comment']));
				break;
			case 'html':
				$contentData['comment'] = htmlspecialchars_decode($contentData['comment']);
				break;			
			default:
				break;
		}
		
		$contentData['css_down'] = 'hide';
		$contentData['css_img'] = 'hide';

		$fileupPath = '';
		if ($filename) {

			$fileupPath = "../../board_data/${board}/${filename}";
			if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {

				$contentData['css_down'] = 'show';
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
				$contentData['css_img'] = 'show';
				$contentData['img_width'] = imagesx($image) . 'px';
			}
			$contentData['fileup_name'] = $filename;
			$contentData['fileup_path'] = $fileupPath;
		}

		$this->controller->select('fieldFromBoardLimit','wall');
		$row = $this->model->getRow();			
		$wall = $row['wall'];

		if ($wall == 'a' || !isset($wall)) {
			$contentData['wallname'] = "나라사랑";
			$contentData['wallkey'] = "b";
		} else if ($wall == 'b') {
			$contentData['wallname'] = "조국사랑";
			$contentData['wallkey'] = "a";
		}

		$contentData['comment_type_text'] = 'checked';
		$contentData['comment_type_html'] = '';
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 1;
		}

		if ($level < $r_grade) {
			UIError::alertToBack('죄송합니다. 답변 권한이 없습니다.');
			exit;
		}

		// 비회원 허용 유무 
		if ($log_key != 'yes') {
			if (!isset($ljs_name) && $ljs_name == '') {

				$returnToURL = $PHP_SELF . '?board=' . $board . '&action=' . $action;
				$returnToURL = str_replace('&', urlencode('&'), $returnToURL);

				UIError::alertTo('죄송합니다. 이곳은 회원 전용 게시판 입니다.\n로그인을 먼저 하세요.' , '../login/login.php?action=login&returnToURL=' .  $returnToURL);
			} 
		}

		if ($r_admin == 'n') {
			if ($admin_pass === FALSE) {
				UIError::alertTo('죄송합니다. 답변 권한이 없습니다.' ,'board.php?board=' . $board . '&action=list');
			}
		}

		if (isset($ljs_name) && $ljs_name != '') {
			$contentData['css_user_label'] = 'hide';
			$contentData['user_name_type'] = 'hidden';
			$contentData['user_pass_type'] = 'hidden';
			$contentData['user_name'] = $ljs_name;
			$contentData['user_password'] = $ljs_pass1;
		} else {
			$contentData['css_user_label'] = 'show';			
			$contentData['user_name_type'] = 'text';
			$contentData['user_pass_type'] = 'password';
			$contentData['user_name'] = $ljs_name;
			$contentData['user_password'] = '';
		}	

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/reply.tpl";
		$this->skin_path_list['footer'] = $footerPath;

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->output();
	}

	function displayDelete() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();		
		
		$board = $this->request_data['board'];
		$board_grg = $this->request_data['board_grg'];
		$id = $this->request_data['id'];
		$action = $this->request_data['action'];

		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시물 삭제';

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$headerPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$footerPath = $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}";

		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add('상단 파일경로가 올바르지 않습니다.');
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add('하단 파일경로가 올바르지 않습니다.');
		}

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$contentData = $this->model->getRow();

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/delete.tpl";
		$this->skin_path_list['footer'] = $footerPath;

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->output();
	}

	function displayDeleteTail() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		
		$board = $this->request_data['board'];
		$board_grg = $this->request_data['board_grg'];
		$id = $this->request_data['id'];
		$grgid = $this->request_data['grgid'];
		$igroup = $this->request_data['igroup'];
		$passover = $this->request_data['passover'];
		$action = $this->request_data['action'];

		$this->document_data['jscode'] ='delete';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시물 삭제';

		$this->controller->select('fromBoardGroup');
		$groupData = $this->model->getRow();
		$headerPath = $groupData['include1'];
		$skinName = $groupData['include2'];
		$footerPath = $groupData['include3'];

		$skinDir = "skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/${skinDir}";

		$headerPath =Utils::convertAbsolutePath($headerPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add('상단 파일경로가 올바르지 않습니다.');
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add('하단 파일경로가 올바르지 않습니다.');
		}

		$this->controller->select('fieldFromBoardWhereId', 'name');
		$contentData = $this->model->getRow();

		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/delete_tail.tpl";
		$this->skin_path_list['footer'] = $footerPath;

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->output();
	}

	function _checkValidation( $value ) {

		if (!$value['name']) {
			UIError::alertToBack('이름을 입력해주세요.');
			exit;
		} else  if (!$value['pass']) {
			UIError::alertToBack('비밀번호를 입력해주세요.');
			exit;
		} else  if (!$value['title']) {
			UIError::alertToBack('제목을 입력해주세요.');
			exit;
		} else  if (!$value['comment']) {
			UIError::alertToBack('내용을 입력해주세요.');
			exit;
		}
	}

	function _checkFiles( $value ) {

		$imageUpName = $value['imgup']['name'];

		if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imageUpName)) {
			UIError::alertToBack('실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.');
			exit;
		}
	}

	function recordWrite() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->_checkValidation($posts);
		$this->_checkFiles($files);

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			UIError::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$saveDir = _SUX_PATH_ . "board_data/${board}/";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName =$mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				UIError::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}

			$this->imageUpName = $imageUpName;
		}
		$context->set('fileup_name', $imageUpName);

		$result = $this->controller->insert('recordWrite');
		if (!isset($result)) {
			UIError::alertToBack('글을 저장하는데 실패했습니다.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
	}

	function recordModify() {

		$context = Context::getInstance();
		$sesstions = $context->getSessionAll();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->_checkValidation($posts);
		$this->_checkFiles($files);

		$id = $requests['id'];
		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$pass = substr(md5(trim($posts['pass'])),0,8);
		$pass = substr(md5($pass),0,8);

		$admin_pwd = $context->get('db_admin_pwd');
		$admin_pwd = substr(md5(trim($admin_pwd)),0,8);
		$admin_pwd = substr(md5(trim($admin_pwd)),0,8);

		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];
		$ljs_name = $sesstions['ljs_name'];

		$this->controller->select('fieldFromBoardWhereId', 'pass, igroup, filename');	
		$row = $this->model->getRow();

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
				UIError::alertToBack('글을 수정하는데 실패했습니다.');
			}
		} else {
			UIError::alertToBack('비밀번호가 틀립니다.\n비밀번호를 확인하세요.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&id=$id&sid=$row[sid]&igroup=$row[igroup]&action=read");
	}

	function recordReply() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->_checkValidation($posts);
		$this->_checkFiles($files);

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$imageUpName = $files['imgup']['name'];
		$imageUpTempName = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			UIError::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$saveDir = _SUX_PATH_ . "board_data/${board}/";

		if (is_uploaded_file($imageUpTempName )) {
			$mktime = mktime();
			$imageUpName = $mktime . "_" . $imageUpName;
			$dest = $saveDir . $imageUpName;

			if (!move_uploaded_file($imageUpTempName , $dest)) {
				UIError::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}

			$this->imageUpName = $imageUpName;
		} 

		$context->set('fileup_name', $imageUpName);

		$result = $this->controller->update('recordSsunseo');
		if (!isset($result)) {
			UIError::alertToBack('순서를 변경하는데 실패했습니다.');
		}

		$result = $this->controller->insert('recordReply');
		if (!isset($result)) {
			UIError::alertToBack('답글을 저장하는데 실패했습니다.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
	}

	function recordDelete() {

		$context = Context::getInstance();
		$requests =  $context->getRequestAll();
		$posts =  $context->getPostAll();
		$files =  $context->getFiles();

		$board = $requests['board'];
		$board_grg = $requests['board_grg'];

		$pass = substr(md5(trim($posts['pass'])),0,8);
		$pass = substr(md5($pass),0,8);
		$admin_pwd = trim($context->get('db_admin_pwd'));

		$admin_pwd = substr(md5(trim($admin_pwd)),0,8);
		$admin_pwd = substr(md5($admin_pwd),0,8);

		$this->controller->select('fieldFromBoardWhereId', 'pass,filename');		
		$row = $this->model->getRow();	
		$delFileName = $row['filename'];

		//UIError::alert( $pass . ' : ' . $row['pass'] . ' : ' . $admin_pwd );

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
				UIError::alertToBack('글을 삭제하는데 실패했습니다.');
			}
		} else  {
			UIError::alertToBack('비밀번호가 틀렸습니다.');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&action=list");
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

	function recordWriteTail() {

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
			UIError::alertToBack('댓글 입력을 실패하였습니다.');
		}

		Utils::goURL("board.php?id=$id&sid=$id&board=$board&board_grg=$board_grg&igroup=$igroup&passover=$passover&sid=$sid&action=read");
	}

	function recordDeleteTail() {

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
				UIError::alertToBack('댓글 삭제를 실패하였습니다.');
			}			
		} else  {
			UIError::alertToBack('비밀번호가 틀립니다');
		}

		Utils::goURL("board.php?board=$board&board_grg=$board_grg&id=$id&sid=$id&igroup=$igroup&passover=$passover&action=read");
	}

	/*function displayDownload() {

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
	}*/
}
?>