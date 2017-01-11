<?php
class BoardView extends ModuleView {

	var $class_name = 'board_view';

	function displayList() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();
		$requestData = $context->getRequestAll();

		$returnURL = $context->getServer('REQUEST_URI');
		$passover = $context->getRequest('passover');
		$category = $context->getParameter('category');
		$find = $requestData['find'];
		$search = $requestData['search'];

		if (empty($passover)) {
			 $passover = 0;
		}
		
		$this->document_data['jscode'] = 'list';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 목록';			

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$headerPath = $groupData['header_path'];
		$skinName = $groupData['skin_path'];
		$footerPath = $groupData['footer_path'];
		//$limit = $groupData['limit_pagination'];
		$limit = 5;

		/**
		 * css, js file path handler
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

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
		$context->setParameter('find', $find);
		$context->setParameter('search', $search);
		$context->setParameter('limit', $limit);
		$context->setParameter('passover', $passover);

		$methodString = (isset($search) && $search) ? 'selectFromBoardSearch' : 'selectFromBoard';
		$result = $this->model->{$methodString}('*');
		if ($result) {

			// use in order to navi
			$numrows = $this->model->getNumRows();

			$methodString = (isset($search) && $search) ? 'selectFromBoardSearchLimit' : 'selectFromBoardLimit';
			$result = $this->model->{$methodString}('*');
			if ($result) {
				$numrows2 = $this->model->getNumRows();
				$contentData['list'] = $this->model->getRows();					
				$today = date("Y-m-d");

				for ($i=0; $i<count($contentData['list']); $i++) {

					$id = $contentData['list'][$i]['id'];
					$user_id = $contentData['list'][$i]['user_id'];
					$name =htmlspecialchars($contentData['list'][$i]['user_name']);	
					$title =htmlspecialchars($contentData['list'][$i]['title']);
					$progressStep =$contentData['list'][$i]['progress_step'];
					$space = $contentData['list'][$i]['space_count'];
					
					$date =$contentData['list'][$i]['date'];				
					$compareDayArr = split(' ', $date);
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
					$subject['id'] = $id;
					$subject['title'] = $title;					
					$subject['img_name'] = '';
					$subject['progress_step_name'] = '';

					// 'off' in value is a class name of CSS
					$subject['space'] = '10px';
					$subject['icon_box'] = '';
					$subject['icon_box_type'] = 0;
					$subject['icon_img'] = 'off';
					$subject['css_comment'] = 'off';
					$subject['comment_num'] = 0;
					$subject['icon_new'] = 'off';
					$subject['icon_opkey'] = 'off';

					if (isset($space) && $space) {
						$subject['space'] = (10+$space*10) . 'px';
						$subject['icon_box'] = '답변';
						$subject['icon_box_color'] = 'icon-replay-color';
					}

					//공지글 설정은 개발 예정 
					/*if (isset($isNotice) && $isNotice != '') {
						$subject['space'] = '10px';
						$subject['icon_box'] = '공지';
						$subject['icon_box_color'] = 'icon-notice-color';
					}*/

					if ($filename){
						if ($filetype === ("image/gif" || "image/jpeg" || "image/x-png" || "image/png" || "image/bmp")) {
							$imgname = "icon_img.png";
						} else if ($download == 'y'  && ($filetype=="application/x-zip-compressed" || "application/zip")) { 
							$imgname = "icon_down.png";
						}

						if (isset($imgname) && $imgname) {
							$subject['icon_img'] = 'on';
							$subject['img_name'] = $imgname;
						}	
					}				

					$context->setParameter('id', $id);
					$this->model->selectFromComment('content_id');
					$commentNums = $this->model->getNumRows();
					//echo $commentNums;
					if ($commentNums > 0) {
						$subject['css_comment'] = 'on';
						$subject['comment_num'] = $commentNums;
					}

					if ($compareDay == $today){
						$subject['icon_new'] = 'on';
						$subject['icon_new_title'] = 'new';
					}
					
					$subject['progress_step_name'] = ($progressStep === '초기화') ? '' : $progressStep;
					$subject['icon_progress_step_color'] = 'icon-progress-step-color';

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

		$this->request_data = $requestData;
		$this->document_data['pagination'] = $navi->get();
		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;
		
		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = "{$skinPath}/list.tpl";
		$this->skin_path_list['footer'] = $footerPath;
		$this->skin_path_list['navi'] = "{$skinPath}/_navi.tpl";		

		$this->output();
	} 

	function displayRead() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->session_data = $context->getSessionAll();

		$this->document_data['jscode'] = 'read';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 읽기';

		$find = $this->request_data['find'];
		$search = $this->request_data['search'];

		$returnURL = $context->getServer('HTTP_REFERER');
		$returnURL = urldecode($returnURL);		
		if (isset($search) && $search) {
			$returnURL .= "?find=${find}&search=${search}";
		}

		$grade = $this->session_data['sux_grade'];
		$user_name = $this->session_data['sux_user_name'];
		$password = $this->session_data['sux_password'];

		$PHP_SELF = $context->getServer("PHP_SELF");		

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$nonmember = strtolower($groupData['allow_nonmember']);
		$grade_r = strtolower($groupData['grade_r']);
		$is_readable = strtolower($groupData['is_readable']);
		$is_download = strtolower($groupData['is_download']);
		$is_comment = strtolower($groupData['is_comment']);
		$is_progress_step = strtolower($groupData['is_progress_step']);
		$headerPath = $groupData['header_path'];
		$skinName = $groupData['skin_path'];
		$footerPath = $groupData['footer_path'];
		$contentsType = $groupData['contents_type'];

		/**
		 * css, js file path handler
		 */
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');

		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

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

		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 0;
		}

		// level
		if ($level < $grade_r) {
			$msg .= '죄송합니다. 읽기 권한이 없습니다.';
			UIError::alertTo($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		// nonmember's authority
		if ($nonmember != 'y') {
			if (empty($user_name)) {
				$returnToURL = $rootPath . $category . '/'. $id ;
				$msg = '죄송합니다. 이곳은 회원 전용 게시판 입니다.<br>로그인을 먼저 하세요.';
				UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login?return_url=' . $returnToURL, 'delay'=>3));
				exit;
			} 
		}

		// admin
		if ($is_readable == 'n') {
			if ($context->checkAdminPass() === FALSE) {
				$msg = '죄송합니다. 이곳은 관리자 전용 게시판입니다.';
				UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			}
		}

		// read panel
		$this->model->selectFromBoardWhere('readed_count', array('id'=>$id));
		$row = $this->model->getRow();
		$hit = $row['readed_count']+1;
		$this->model->updateFromBoard($hit);

		$this->model->selectFromBoardWhere('*', array('id'=>$id));
		$contentData = $this->model->getRow();
		$contentData['user_name'] = htmlspecialchars($contentData['user_name']);
		$contentData['title'] = htmlspecialchars($contentData['title']);
		$conType = trim($contentData['contents_type']);
		$filename = $contentData['filename'];
		$filetype = $contentData['filetype'];

		switch ($contentsType) {
			case 'all':
				if ($conType ==='html'){
					$contentData['conetents'] = htmlspecialchars_decode($contentData['conetents']);
				}else if ($conType === 'text'){
					$contentData['conetents'] = nl2br(htmlspecialchars($contentData['conetents']));
				}
				break;
			case 'text':
				$contentData['conetents'] = nl2br(htmlspecialchars($contentData['conetents']));
				break;
			case 'html':
				$contentData['conetents'] = htmlspecialchars_decode($contentData['conetents']);
				break;			
			default:
				break;
		}

		$contentData['css_down'] = 'hide';
		$contentData['css_img'] = 'hide';

		$fileupPath = '';
		if ($filename) {

			$fileupPath = $rootPath . "files/board/${filename}";
			if (($is_download === 'y') && ($filetype === ("application/x-zip-compressed" || "application/zip"))) {

				$contentData['css_down'] = 'show';
			} else if ($filetype !== ("application/x-zip-compressed" || "application/zip")){

				$image_info = getimagesize($fileupPath);
			      $image_type = $image_info[2];

			      if ( $image_type === IMAGETYPE_JPEG ) {
			      		$image = imagecreatefromjpeg($fileupPath);
			      } elseif( $image_type === IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($fileupPath);
			      } elseif( $image_type === IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($fileupPath);
				}
				$contentData['css_img'] = 'show';
				$contentData['css_img_width'] = imagesx($image) . 'px';
			}
			$contentData['fileup_name'] = $filename;
			$contentData['fileup_path'] = $fileupPath;
		}

		// opkey
		$contentData['css_progress_step'] = 'hide';
		if (($is_progress_step === 'y') || ($grade > 9)) {
			$contentData['css_progress_step'] = 'show';

			$progressSteps = array('진행완료'=>'progress_step_done', '진행중'=>'progress_step_ing', '입금완료'=>'progress_step_charged', '미입금'=>'progress_step_nocharged' , '메일발송'=>'progress_step_sended', '초기화'=>'progress_step_reset');

			$stepKey = strtolower($contentData['progress_step']);			
			$contentData[$progressSteps[$stepKey]] = 'checked';
		}

		// comment
		$contentData['css_comment'] = 'hide';
		$commentData = array();		
		if ($is_comment === 'y') {
			$contentData['css_comment'] = 'show';

			$this->model->selectFromComment('*');
			$commentData['num'] = $this->model->getNumRows();
			$commentData['list'] = $this->model->getRows();
		}

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;
		$this->document_data['comments'] = $commentData;

		$this->skin_path_list['root'] =$rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/read.tpl";
		$this->skin_path_list['footer'] = $footerPath;
		$this->skin_path_list['comment'] =  "{$skinPath}/_comment.tpl";
		$this->skin_path_list['progress_step'] =  "{$skinPath}/_progress_step.tpl";	

		$this->output();		
	}

	function displayWrite() {

		$UIError = UIError::getInstance();

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->session_data = $context->getSessionAll();	

		$find = $this->request_data['find'];
		$search = $this->request_data['search'];

		$returnURL = $context->getServer('HTTP_REFERER');
		$returnURL = urldecode($returnURL);
		if (isset($search) && $search) {
			$returnURL .= "?find=${find}&search=${search}";
		}
		
		$this->document_data['jscode'] = 'write';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 쓰기';

		$grade = $this->session_data['sux_grade'];
		$user_id = $this->session_data['sux_user_id'];
		$user_name = $this->session_data['sux_user_name'];
		$password = $this->session_data['sux_password'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$nonemember = $groupData['allow_nonmember'];
		$grade_w = $groupData['grade_w'];
		$is_writable	 = $groupData['is_writable'];
		$headerPath = $groupData['header_path'];
		$skinName = $groupData['skin_path'];
		$footerPath = $groupData['footer_path'];

		/**
		 * css, js file path handler
		 */
		$category = $context->getParameter('category');

		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;		

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

		$this->model->selectFromBoardLatestLimit('wall');
		$contentData = $this->model->getRow();
		$wall = $contentData['wall'];		

		if ($wall === 'a' || !isset($wall)) {
			$contentData['wallname'] = "나라사랑";
			$contentData['wallkey'] = "b";
		} else if ($wall === 'b') {
			$contentData['wallname'] = "조국사랑";
			$contentData['wallkey'] = "a";
		}

		$contentsType = $contentData['contents_type'];
		$contentData['contents_type_' . $contentsType] = 'checked';
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 0;
		}

		//echo '<meta charset="utf-8" />';
		if ($level < $grade_w) {
			$msg .= '죄송합니다. 쓰기 권한이 없습니다.';		
			UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		if ($nonemember === 'n') {
			if (empty($user_name)) {
				$returnToURL = $rootPath . $category . '/write';
				$msg = '죄송합니다. 이곳은 회원 전용 게시판 입니다.<br>로그인을 먼저 하세요.';
				UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login?return_url=' . $returnToURL, 'delay'=>3));
			} 
		}

		if ($is_writable === 'n') {
			if ($admin_pass === FALSE) {
				$msg = '죄송합니다. 이곳은 관리자 전용게시판입니다.';
				UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			}
		}

		if (isset($user_name) && $user_name) {
			$contentData['css_user_label'] = 'hide';
			$contentData['user_name_type'] = 'hidden';
			$contentData['user_pass_type'] = 'hidden';
			$contentData['user_id'] = empty($user_id) ? 'Guest': $user_id;
			$contentData['user_name'] = empty($user_name) ? 'Guest': $user_name;
			$contentData['user_password'] = $password;
		} else {
			$contentData['css_user_label'] = 'show';			
			$contentData['user_name_type'] = 'text';
			$contentData['user_pass_type'] = 'password';
			$contentData['user_id'] = empty($user_id) ? 'Guest': $user_id;
			$contentData['user_name'] = empty($user_name) ? 'Guest': $user_name;
			$contentData['user_password'] = '12';
		}

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/write.tpl";
		$this->skin_path_list['footer'] = $footerPath;		

		$this->output();
	}

	function displayModify() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();
		
		$this->session_data = $context->getSessionAll();
		$this->request_data = $context->getRequestAll();

		$find = $this->request_data['find'];
		$search = $this->request_data['search'];

		$returnURL = $context->getServer('HTTP_REFERER');
		$returnURL = urldecode($returnURL);
		if (isset($search) && $search) {
			$returnURL .= "?find=${find}&search=${search}";
		}
		
		//$this->document_data['jscode'] = 'modify';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 수정';

		$grade = $this->session_data['sux_grade'];		
		$user_name = $this->session_data['sux_user_name'];
		$password = $this->session_data['sux_password'];	
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();	

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$grade_m = $groupData['grade_m'];
		$nonemember = $groupData['allow_nonmember'];
		$is_modifiable = $groupData['is_modifiable'];
		$is_progress_step = $groupData['is_progress_step'];
		$headerPath =  $groupData['header_path'];
		$skinName =  $groupData['skin_path'];
		$footerPath =  $groupData['footer_path'];

		/**
		 * css, js file path handler
		 */

		$category = $context->getParameter('category');
		$id = $context->getParameter('id');

		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

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

		$this->model->selectFromBoardWhere('*', array('id'=>$id));
		$contentData = $this->model->getRow();		
		$contentData['user_name'] = htmlspecialchars($contentData['user_name']);
		$contentData['title'] = nl2br($contentData['title']);
		$contentData['contents'] = htmlspecialchars($contentData['contents']);
		$contentsType = $contentData['contents_type'];
		$contentData['contents_type_' . $contentsType] = 'checked';
		unset($contentData['password']);

		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 0;
		}

		if ($level < $grade_m) {
			$msg = '죄송합니다. 수정권한이 없습니다.';
			UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		if ($nonemember === 'n') {
			if (empty($user_name)) {
				$returnToURL = $rootPath . $category . ' / '. $id . '/modify';
				$msg = '죄송합니다. 이곳은 회원 전용 게시판 입니다.<br>로그인을 먼저 하세요.';
				UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login?return_url=' . $returnToURL, 'delay'=>3));
			} 
		}

		if ($is_modifiable === 'n') {
			if ($admin_pass === false) {
				$msg = '죄송합니다. 이곳은 관리자 전용 게시판입니다.';
				UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
			}
		}

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->skin_path_list['root'] =$rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/modify.tpl";
		$this->skin_path_list['footer'] = $footerPath;		

		$this->output();
	}

	function displayReply() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();
		$this->session_data = $context->getSessionAll();

		$find = $this->request_data['find'];
		$search = $this->request_data['search'];

		$returnURL = $context->getServer('HTTP_REFERER');
		$returnURL = urldecode($returnURL);
		if (isset($search) && $search) {
			$returnURL .= "?find=${find}&search=${search}";
		}

		//$this->document_data['jscode'] = 'reply';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시판 답변';		

		$grade = $this->session_data['sux_grade'];
		$user_id = $this->session_data['sux_user_id'];
		$user_name = $this->session_data['sux_user_name'];
		$password = $this->session_data['sux_password'];
		$PHP_SELF = $context->getServer("PHP_SELF");
		$admin_pass = $context->checkAdminPass();

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$is_progress_step = $groupData['is_progress_step'];
		$grade_re = $groupData["grade_re"];
		$is_repliable = $groupData["is_repliable"];
		$headerPath = $groupData['header_path'];
		$skinName = $groupData['skin_path'];
		$footerPath = $groupData['footer_path'];

		/**
		 * css, js file path handler
		 */
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');

		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

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

		$this->model->selectFromBoardWhere('*', array('id'=>$id));
		$contentData = $this->model->getRow();		
		$contentData['user_name'] = empty($user_name) ? 'Guest' : $user_name;
		$contentData['title'] = htmlspecialchars($contentData['title']);
		$contentsType = trim($contentData['conetents_type']);

		$is_download = $contentData['is_download'];
		$filename = $contentData['filename'];
		$filetype = $contentData['filetype'];
		
		if ($contentsType === 'html'){
			$contentData['contents'] = htmlspecialchars_decode($contentData['contents']);
		}else if ($contentsType === 'text'){
			$contentData['contents'] = nl2br(htmlspecialchars($contentData['contents']));
		}
		
		$contentData['css_down'] = 'hide';
		$contentData['css_img'] = 'hide';

		$fileupPath = '';
		if ($filename) {

			$fileupPath = $rootPath . "files/board/${filename}";
			if (($is_download == 'y') && ($filetype === ("application/x-zip-compressed" || "application/zip"))) {

				$contentData['css_down'] = 'show';
			} else if ($filetype !== ("application/x-zip-compressed" || "application/zip")){

				$image_info = getimagesize($fileupPath);
			      $image_type = $image_info[2];

			      if ( $image_type === IMAGETYPE_JPEG ) {
			      	$image = imagecreatefromjpeg($fileupPath);
			      } elseif( $image_type === IMAGETYPE_GIF ) {
			       	$image = imagecreatefromgif($fileupPath);
			      } elseif( $image_type === IMAGETYPE_PNG ) {
			     		$image = imagecreatefrompng($fileupPath);
				}
				$contentData['css_img'] = 'show';
				$contentData['img_width'] = imagesx($image) . 'px';
			}
			$contentData['fileup_name'] = $filename;
			$contentData['fileup_path'] = $fileupPath;
		}

		$this->model->selectFromBoardLatestLimit('wall');
		$row = $this->model->getRow();			
		$wall = $row['wall'];

		if ($wall === 'a' || !isset($wall)) {
			$contentData['wallname'] = "나라사랑";
			$contentData['wallkey'] = "b";
		} else if ($wall === 'b') {
			$contentData['wallname'] = "조국사랑";
			$contentData['wallkey'] = "a";
		}

		$contentsType = $contentData['contents_type'];
		$contentData['contents_type_' . $contentsType] = 'checked';
		
		if (isset($grade) && $grade) {
			$level = $grade;
		} else {
			$level = 0;
		}

		if ($level < $grade_re) {
			$msg = '죄송합니다. 답변권한이 없습니다.';
			UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		// 비회원 허용 유무 
		if ($is_progress_step !== 'y') {
			if (!isset($user_name) && $user_name == '') {
				$returnToURL = $rootPath . $category . '/'. $id . '/reply' ;
				$msg = '죄송합니다. 이곳은 회원 전용 게시판 입니다.<br>로그인을 먼저 하세요.';
				UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login?return_url=' . $returnToURL, 'delay'=>3));
			} 
		}

		if ($is_repliable === 'n') {
			if ($admin_pass === FALSE) {
				$msg = '죄송합니다. 이곳은 관리지 전용게시판입니다.';
				UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
				exit;
			}
		}

		if (empty($user_name)) {
			$contentData['css_user_label'] = 'hide';
			$contentData['user_name_type'] = 'hidden';
			$contentData['user_pass_type'] = 'hidden';
			$contentData['user_id'] = empty($user_id) ? 'guest' : $user_id;
			$contentData['user_name'] = empty($user_name) ? 'Guest' : $user_name;
			$contentData['user_password'] = $password;
		} else {
			$contentData['css_user_label'] = 'show';			
			$contentData['user_name_type'] = 'text';
			$contentData['user_id'] = empty($user_id) ? 'guest' : $user_id;
			$contentData['user_name'] = empty($user_name) ? 'Guest' : $user_name;
			$contentData['user_pass_type'] = 'password';
			$contentData['user_password'] = '12';
		}

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->skin_path_list['root'] =$rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/reply.tpl";
		$this->skin_path_list['footer'] = $footerPath;		

		$this->output();
	}

	function displayDelete() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();
		$category = $context->getParameter('category');

		//$this->document_data['jscode'] = 'delete';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시물 삭제';

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$headerPath = $groupData['header_path'];
		$skinName = $groupData['skin_path'];
		$footerPath = $groupData['footer_path'];

		/**
		 * css, js file path handler
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

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

		$id = $context->getParameter('id');
		$this->model->selectFromBoardWhere('id, category, user_name', array('id'=>$id));
		$contentData = $this->model->getRow();

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->skin_path_list['root'] =$rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/delete.tpl";
		$this->skin_path_list['footer'] = $footerPath;		

		$this->output();
	}

	function displayDeleteComment() {

		$UIError = UIError::getInstance();
		$context = Context::getInstance();

		//$this->document_data['jscode'] ='delete';
		$this->document_data['module_code'] = 'board';
		$this->document_data['module_name'] = '게시물 삭제';

		$this->model->selectFromBoardGroup();
		$groupData = $this->model->getRow();
		$headerPath = $groupData['header_path'];
		$skinName = $groupData['skin_path'];
		$footerPath = $groupData['footer_path'];
		/**
		 * css, js file path handler
		 */
		$category = $context->getParameter('category');
		$id = $context->getParameter('id');
		$sid = $context->getParameter('sid');

		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/board/skin/${skinName}";
		$skinPath = _SUX_PATH_ . "modules/board/skin/${skinName}";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

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

		$this->model->selectFromBoardWhere('id, user_name', array('id'=>$id));
		$contentData = $this->model->getRow();
		$contentData['sid'] = $sid;
		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;

		$this->skin_path_list['root'] =$rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;		
		$this->skin_path_list['contents'] = "{$skinPath}/delete_comment.tpl";
		$this->skin_path_list['footer'] = $footerPath;		

		$this->output();
	}

	/*function displayDownload() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');
		$fileupname = $context->getRequest('fileupname');
		$fileupname = iconv("UTF-8","EUC-KR",$fileupname) ? iconv("UTF-8","EUC-KR",$fileupname) : $fileupname;
		$filesize = $context->getRequest('filesize');
		$filetype = $context->getRequest('filetype');
		$filesdir = _SUX_PATH_ . 'files/board/' . $board . '/';
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