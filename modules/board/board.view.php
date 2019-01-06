<?php

class BoardView extends View
{
  function getNonTagFields() {

    return array('category','user_id','user_name','nickname');
  }

  function getSimpleTagFields() {

    return array('title');
  }

  function displayList() {

    $context = Context::getInstance();
    $UIError = UIError::getInstance();

    $requestData = $context->getRequestAll();
    $sessionData = $context->getSessionAll();

    $category = $context->getParameter('category');
    $passover = (int) $requestData['passover'];
    $find = $requestData['find'];
    $search = $requestData['search'];

    if (empty($passover)) {
       $passover = 0;
    }

    $where = new QueryWhere();
    $where->set('category',$category,'=');
    $this->model->select('board_group', '*', $where);
    $groupData = $this->model->getRow();
    $headerPath = $groupData['header_path'];
    $skinName = $groupData['skin_path'];
    $footerPath = $groupData['footer_path'];
    $limit = $groupData['limit_pagination'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = _SUX_PATH_ . "modules/board/skin/${skinName}/";

    /**
     * @var headerPath
     * @descripttion
     * smarty include 상대경로 접근 방식이 달라서 convertAbsolutePath()함수에 절대경로 처리 함.
     */
    $headerPath = Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }

    $where = new QueryWhere();
    $where->set('category', $category, '=');

    if (isset($search) && $search) {
      $where->set($find, $search, 'like');
    }

    // total rows from board
    $result = $this->model->select('board', '*', $where);

    if ($result) {
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
          $where->reset();

        if (isset($search) && $search) {
          $where->set($find, $search, 'like');
        }

        $where->set('category', $category, '=');
        $result = $this->model->select('board', '*', $where, 'igroup_count desc, ssunseo_count asc', $passover, $limit);

        if ($result) {
          $contentData['list'] = $this->model->getRows();
          $today = date("Y-m-d");

          for ($i=0; $i<count($contentData['list']); $i++) {

            $id = (int) $contentData['list'][$i]['id'];
            $user_id = FormSecurity::decodeWithoutTags($contentData['list'][$i]['user_id']);
            $name = $contentData['list'][$i]['nickname'];
            $name = FormSecurity::decodeWithoutTags($name);
            $title = FormSecurity::decodeWithSimpleTags($contentData['list'][$i]['title']);
            $content = FormSecurity::decodeToText($contentData['list'][$i]['content']);
            $progressStep = FormSecurity::decodeWithoutTags($contentData['list'][$i]['progress_step']);
            $hit = (int) $contentData['list'][$i]['readed_count'];
            $space = (int) $contentData['list'][$i]['space_count'];
            $filename = $contentData['list'][$i]['filename'];
            $filetype = $contentData['list'][$i]['filetype'];

            $date =$contentData['list'][$i]['date'];
            $compareDayArr = preg_split(' ', $date);
            $compareDay = $compareDayArr[0];

            if (isset($search) && $search != '') {
              $search_replace = sprintf('<span class="sx-text-success">%s</span>', $search);
              $find_key = strtolower($find);

              switch ($find_key) {
                case 'title':
                  $title = str_replace($search,$search_replace,$title);
                  break;
                case 'name':
                  $name = str_replace($search,$search_replace,$name);
                  break;
                default:
                  break;
              }
            }

            $subject = array();
            $subject['id'] = $id;
            $subject['title'] = $title;
            $subject['icon_img_name'] = '';
            $subject['progress_step_name'] = '';

            // 'hide' in value is a class name of CSS
            $subject['space'] = 0;
            $subject['prefix_icon_label'] = '';
            $subject['prefix_icon_type'] = 0;

            $subject['icon_img'] = 'sx-hide';
            $subject['comment_num'] = '';
            $subject['icon_new'] = 'sx-hide';
            $subject['icon_opkey'] = 'sx-hide';

            if (isset($space) && $space) {
              $subject['space'] = $space*15;
              $subject['prefix_icon_label'] = '답변';
              $subject['prefix_icon_color'] = 'sx-bg-reply';
            }

            if (isset($filename) && $filename){
              $imgname = '';

              if (preg_match('/(image\/gif|image\/jpeg|image\/x-png|image\/bmp)+/', $filetype)) {
                $imgname = "icon_img.png";
              } else if ($download === 'y'  && preg_match('/(application/x-zip-compressed|application/zip)+/', $filetype)) {
                $imgname = "icon_down.png";
              }

              if ($imgname !== '') {
                $subject['icon_img'] = 'sx-show-inline';
                $subject['icon_img_name'] = $imgname;
              }
            }

            $where->reset();
            $where->set('content_id', $id, '=');
            $this->model->select('comment', 'id', $where);
            $commentNums = $this->model->getNumRows();

            if ($commentNums > 0) {
              $subject['comment_num'] = $commentNums;
            }

            if ($compareDay == $today){
              $subject['icon_new'] = 'sx-show-inline';
              $subject['icon_new_title'] = 'new';
            }

            $subject['progress_step_name'] = ($progressStep === '초기화') ? '' : $progressStep;
            $subject['icon_progress_color'] = 'sx-bg-progress';

            $contentData['list'][$i]['name'] = $name;
            $contentData['list'][$i]['hit'] = $hit;
            $contentData['list'][$i]['space'] = $space;
            $dateArr = preg_split(' ', $date);
            $contentData['list'][$i]['date'] = $dateArr[0];
            $contentData['list'][$i]['subject'] = $subject;

            $subject = null;
          }
        }
      } else {
        $contentData['list'] = array();
      }
    } else {
      $UIError->add('게시물 전체 목록 가져오기를 실패하였습니다.');
    }

    // notice
    $where = new QueryWhere();
    $where->set('is_notice', 'y');
    $this->model->select('board', '*', $where, 'id desc');
    $contentData['notce_list'] = $this->model->getRows();

    if (count($contentData['notce_list']) > 0) {

      for ($i=0; $i<count($contentData['notce_list']); $i++) {

        $id = (int) $contentData['notce_list'][$i]['id'];
        $n_category = $contentData['notce_list'][$i]['category'];
        $user_id = FormSecurity::decodeWithoutTags($contentData['notce_list'][$i]['user_id']);
        $isNotice = $contentData['notce_list'][$i]['is_notice'];
        $name = $contentData['notce_list'][$i]['nickname'];
        $name = FormSecurity::decodeWithoutTags($name);
        $title = FormSecurity::decodeWithSimpleTags($contentData['notce_list'][$i]['title']);
        $content = FormSecurity::decodeToText($contentData['notce_list'][$i]['content']);
        $progressStep = FormSecurity::decodeWithoutTags($contentData['notce_list'][$i]['progress_step']);
        $hit = (int) $contentData['notce_list'][$i]['readed_count'];
        $space = (int) $contentData['notce_list'][$i]['space_count'];
        $filename = $contentData['notce_list'][$i]['filename'];
        $filetype = $contentData['notce_list'][$i]['filetype'];

        $date =$contentData['notce_list'][$i]['date'];
        $compareDayArr = preg_split(' ', $date);
        $compareDay = $compareDayArr[0];

        $subject = array();
        $subject['id'] = $id;
        $subject['title'] = $title;
        $subject['icon_img_name'] = '';
        $subject['progress_step_name'] = '';

        // 'hide' in value is a class name of CSS
        $subject['space'] = 0;
        $subject['prefix_icon_label'] = '';
        $subject['prefix_icon_type'] = 0;

        $subject['icon_img'] = 'sx-hide';
        $subject['comment_num'] = '';
        $subject['icon_new'] = 'sx-hide';
        $subject['icon_opkey'] = 'sx-hide';

        if (isset($space) && $space) {
          $subject['space'] = $space*10;
          $subject['prefix_icon_label'] = '답변';
          $subject['prefix_icon_color'] = 'sx-bg-reply';
        }

        //공지글 설정은 개발 예정
        if (isset($isNotice) && $isNotice != '') {
          $subject['space'] = '0';
          $subject['prefix_icon'] = '공지';
          $subject['prefix_icon_color'] = 'sx-bg-notice';
        }

        if (isset($filename) && $filename){
          $imgname = '';

          if (preg_match('/(image\/gif|image\/jpeg|image\/x-png|image\/bmp)+/', $filetype)) {
            $imgname = "icon_img.png";
          } else if ($download === 'y'  && preg_match('/(application/x-zip-compressed|application/zip)+/', $filetype)) {
            $imgname = "icon_down.png";
          }

          if ($imgname !== '') {
            $subject['icon_img'] = 'sx-show-inline';
            $subject['icon_img_name'] = $imgname;
          }
        }

        $where->reset();
        $where->set('content_id', $id, '=');
        $this->model->select('comment', 'id', $where);
        $commentNums = $this->model->getNumRows();

        if ($commentNums > 0) {
          $subject['comment_num'] = $commentNums;
        }

        if ($compareDay == $today){
          $subject['icon_new'] = 'sx-show-inline';
          $subject['icon_new_title'] = 'new';
        }

        $subject['progress_step_name'] = ($progressStep === '초기화') ? '' : $progressStep;
        $subject['icon_progress_color'] = 'sx-bg-progress';

        $contentData['notice_list'][$i]['name'] = $name;
        $contentData['notice_list'][$i]['category'] = $n_category;
        $contentData['notice_list'][$i]['hit'] = $hit;
        $contentData['notice_list'][$i]['space'] = $space;
        $dateArr = preg_split(' ', $date);
        $contentData['notice_list'][$i]['date'] = $dateArr[0];
        $contentData['notice_list'][$i]['subject'] = $subject;

        $subject = null;
      }
    } else {
      $contentData['notice_list'] = array();
    }

    // navi logic
    $navi = New Navigator();
    $navi->passover = $passover;
    $navi->limit = $limit;
    $navi->total = $numrows;
    $navi->init();

    $this->request_data = $requestData;
    $this->session_data = $sessionData;

    $this->document_data['jscode'] = 'list';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시판 목록';
    $this->document_data['module_type'] = 'board';

    $this->document_data['pagination'] = $navi->get();
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;
    $this->document_data['category'] = $category;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}/list.tpl";
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displayRead() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();
    $requestData = $context->getRequestAll();
    $sessionData = $context->getSessionAll();

    $find = $requestData['find'];
    $search = $requestData['search'];

    $category = $context->getParameter('category');
    $id = $context->getParameter('id');
    $grade = $sessionData['grade'];
    $nickname = $sessionData['nickname'];
    $userId = $sessionData['user_id'];
    $password = $sessionData['password'];

    $where = new QueryWhere();
    $where->set('category',$category,'=');
    $this->model->select('board_group', '*', $where);
    $groupData = $this->model->getRow();
    $nonmember = strtolower($groupData['allow_nonmember']);

    $grade_r = strtolower($groupData['grade_r']);
    $grade_w = strtolower($groupData['grade_w']);
    $grade_m = strtolower($groupData['grade_m']);
    $grade_re= strtolower($groupData['grade_re']);

    $is_readable = strtolower($groupData['is_readable']);
    $is_writable = strtolower($groupData['is_writable']);
    $is_modifiable = strtolower($groupData['is_modifiable']);
    $is_repliable = strtolower($groupData['is_repliable']);

    $is_download = strtolower($groupData['is_download']);
    $is_comment = strtolower($groupData['is_comment']);
    $is_progress_step = strtolower($groupData['is_progress_step']);
    $headerPath = $groupData['header_path'];
    $skinName = $groupData['skin_path'];
    $footerPath = $groupData['footer_path'];
    $contentType = $groupData['board_type'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = "modules/board/skin/${skinName}/";

    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $skinRealPath =Utils::convertAbsolutePath($skinRealPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add('상단 파일경로가 올바르지 않습니다.');
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add('하단 파일경로가 올바르지 않습니다.');
    }

    if (isset($grade) && $grade) {
      $level = $grade;
    } else {
      $level = 0;
    }

    $queryString = '';
    if (isset($search) && $search) {
      $queryString = "?find=${find}&search=${search}";
    }
    $returnURL = $rootPath . $category . $queryString;

    // Allow Nonmember 허용 : Y
    if (strtolower($nonmember) !== 'y' && empty($nickname)) {
      $context->setSession( 'return_url', $returnURL);
      $msg = '이곳은 회원 전용 게시판 입니다.<br>회원가입 후 이용하세요.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
      exit;
    }

    // level
    if ($level < $grade_r) {
      $context->setSession( 'return_url', $returnURL);
      $msg .= '읽기 권한이 없습니다.';
      UIError::alertTo($msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
      exit;
    }

    // Check Admin
    if (strtolower($is_readable) !== 'y' && $context->checkAdminPass() === FALSE) {
      $context->setSession( 'return_url', $returnURL);
      $msg = '이곳은 관리자 전용 게시판입니다.';
      UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    // read panel
    $where->reset();
    $where->set('id',$id,'=');
    $this->model->select('board', 'user_id, readed_count', $where);
    $row = $this->model->getRow();

    // Control Button UI
    $isWritable = false;
    $isRepliable = fasle;
    $isModifiable = fasle;
    $isDelelable = false;

    if  ($is_writable === 'y' && $grade_w <= $level) {
      $isWritable = true;
    }

    if  ($is_repliable === 'y' && $grade_re <= $level) {
      $isRepliable = true;
    }

    if  ($context->checkAdminPass() || ($is_modifiable === 'y' && $grade_m <= $level &&
          $userId === $row['user_id'])) {
      $isModifiable = true;
    }

    if ($context->checkAdminPass() || $userId === $row['user_id']) {
      $isDelelable = true;
    }

    $hit = $row['readed_count']+1;
    $this->model->update('board', array('readed_count'=>$hit), $where);
    $this->model->select('board','*', $where);

    $contentData = $this->model->getRow();
    $nickname = $contentData['nickname'];
    $contentData['nickname'] = FormSecurity::decodeWithoutTags($nickname);
    $nickname = '';
    $contentData['title'] = FormSecurity::decodeWithSimpleTags($contentData['title']);

    $filename = $contentData['filename'];
    $filetype = $contentData['filetype'];
    $filesize = $contentData['filesize'];
    $content = $contentData['content'];

    switch ($contentType) {
      case 'text':
        $content = FormSecurity::decodeToText($content);
        break;
      case 'html':
        $content = FormSecurity::decodeToHtml($content);
        break;
    }

    $contentData['content'] = $content;
    $content = '';
    $contentData['is_down'] = 'hide';
    $contentData['is_img'] = 'hide';

    if (isset($filename) && $filetype) {
      $fileupPath = $rootPath . "files/board/${filename}";

      if ($is_download === 'y') {
        $contentData['is_down'] = 'sx-show';
      }

      if (preg_match( '/(jpg|jpeg|gif|png)+/i', $filetype)){
        $imageInfo = getimagesize($fileupPath);
        $imageType = $imageInfo[2];

        if ($imageType === IMAGETYPE_JPEG) {
          $image = imagecreatefromjpeg($fileupPath);
        } elseif($imageType === IMAGETYPE_GIF) {
          $image = imagecreatefromgif($fileupPath);
        } elseif($imageType === IMAGETYPE_PNG) {
          $image = imagecreatefrompng($fileupPath);
        }

        $contentData['is_img'] = 'sx-show';
        $contentData['is_img_width'] = imagesx($image) . 'px';
      }
      $contentData['fileup_name'] = $filename;
      $contentData['fileup_path'] = $fileupPath;
    }

    // Opkey
    $contentData['css_progress_step'] = 'hide';

    if ($is_progress_step === 'y') {
      $contentData['css_progress_step'] = 'show';
      $progressSteps = array(
        '진행완료'=>'progress_step_done',
        '진행중'=>'progress_step_ing',
        '입금완료'=>'progress_step_charged',
        '미입금'=>'progress_step_nocharged',
        '메일발송'=>'progress_step_sended',
        '초기화'=>'progress_step_reset'
      );

      $stepKey = strtolower($contentData['progress_step']);
      $contentData[$progressSteps[$stepKey]] = 'checked';
    }

    // comment
    $contentData['css_comment'] = 'hide';
    $commentData = array();

    if ($is_comment === 'y') {
      $contentData['css_comment'] = 'show';

      $where->reset();
      $where->set('content_id',$id,'=');
      $this->model->select('comment','*', $where);
      $commentData['num'] = $this->model->getNumRows();
      $commentData['list'] = $this->model->getRows();
    }

    $this->request_data = $requestData;
    $this->session_data = $sessionData;

    $this->document_data['jscode'] = 'read';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시판 읽기';
    $this->document_data['module_type'] = 'board';

    $this->document_data['is_writable'] = $isWritable;
    $this->document_data['is_repliable'] = $isRepliable;
    $this->document_data['is_modifiable'] = $isModifiable;
    $this->document_data['is_delelable'] = $isDelelable;

    $this->document_data['category'] = $category;
    $this->document_data['id'] = $id;
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;
    $this->document_data['comments'] = $commentData;
    $this->document_data['category'] = $category;

    $this->skin_path_list['root'] =$rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}read.tpl";
    $this->skin_path_list['footer'] = $footerPath;
    $this->skin_path_list['comment'] =  "{$skinRealPath}_comment.tpl";
    $this->skin_path_list['progress_step'] =  "{$skinRealPath}_progress_step.tpl";

    $this->output();
  }

  function displayWrite() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();
    $requestData = $context->getRequestAll();
    $sessionData = $context->getSessionAll();

    $find = $requestData['find'];
    $search = $requestData['search'];
    $category = $context->getParameter('category');
    $grade = $sessionData['grade'];
    $userName = $sessionData['user_name'];
    $nickname = $sessionData['nickname'];
    $password = $sessionData['password'];
    $admin_pass = $context->checkAdminPass();

    $where = new QueryWhere();
    $where->set('category',$category,'=');
    $this->model->select('board_group', '*', $where);

    $groupData = $this->model->getRow();
    $nonemember = $groupData['allow_nonmember'];
    $grade_r = $groupData['grade_r'];
    $grade_w = $groupData['grade_w'];
    $is_writable   = $groupData['is_writable'];
    $headerPath = $groupData['header_path'];
    $skinName = $groupData['skin_path'];
    $footerPath = $groupData['footer_path'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = _SUX_PATH_ . "modules/board/skin/${skinName}/";

    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add('상단 파일경로가 올바르지 않습니다.');
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add('하단 파일경로가 올바르지 않습니다.');
    }

    if (isset($grade) && $grade) {
      $level = $grade;
    } else {
      $level = 0;
    }

    $queryString = '';
    if (isset($search) && $search) {
      $queryString = "?find=${find}&search=${search}";
    }
    $returnURL = $rootPath . $category . '/write' . $queryString ;

    if (strtolower($nonemember) !== 'y' && empty($nickname)) {
      $context->setSession( 'return_url', $returnURL);
      $msg = '이곳은 회원 전용 게시판 입니다.<br>로그인을 먼저 하세요.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login?return_url=' . $returnToURL, 'delay'=>3));
    }

    if ($level < $grade_w) {
      $context->setSession( 'return_url', $returnURL);
      $msg .= '쓰기 권한이 없습니다.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
      exit;
    }

    if (strtolower($is_writable) !== 'y' && $admin_pass === FALSE) {
      $context->setSession( 'return_url', $returnURL);
      $msg = '죄송합니다. 이곳은 관리자 전용게시판입니다.';
      UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $contentData = array();
    $contentData['wallname'] = Utils::getWallKey();

    if (isset($nickname) && $nickname) {
      $contentData['css_user_label'] = 'sx-hide';
      $contentData['user_name_type'] = 'hidden';
      $contentData['user_pass_type'] = 'hidden';
      $contentData['nickname'] = $nickname;
      $contentData['user_name'] = $userName;
      $contentData['user_password'] = $password;
    } else {
      $uniqNickname = 'Guest_' . Utils::getMicrotimeInt();

      $contentData['css_user_label'] = 'sx-show-inline';
      $contentData['user_name_type'] = 'text';
      $contentData['user_pass_type'] = 'password';
      $contentData['nickname'] = $uniqNickname;
      $contentData['user_password'] = '';
    }

    $this->request_data = $requestData;
    $this->session_data = $sessionData;

    $this->document_data['jscode'] = 'write';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시판 쓰기';
    $this->document_data['category'] = $category;
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}/write.tpl";
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displayModify() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();

    $sessionData = $context->getSessionAll();
    $requestData = $context->getRequestAll();

    $category = $context->getParameter('category');
    $id = $context->getParameter('id');
    $find = $requestData['find'];
    $search = $requestData['search'];
    $grade = $sessionData['grade'];
    $nickname = $sessionData['nickname'];
    $password = $this->session_data['password'];

    $where = new QueryWhere();
    $where->set('category',$category,'=');
    $this->model->select('board_group', '*', $where);

    $groupData = $this->model->getRow();
    $grade_r = $groupData['grade_r'];
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
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = _SUX_PATH_ . "modules/board/skin/${skinName}/";
    $this->document_data['uri'] = $rootPath.$category;

    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add('상단 파일경로가 올바르지 않습니다.');
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add('하단 파일경로가 올바르지 않습니다.');
    }

    $where->reset();
    $where->set('id', $id, '=');
    $this->model->select('board', '*', $where);

    $contentData = $this->model->getRow();
    $contentData['user_name'] = $contentData['user_name'];
    $contentData['nickname'] = $contentData['nickname'];
    $contentData['title'] = $contentData['title'];
    $contentData['content'] = FormSecurity::decodeForForm($contentData['content']);

    $contentType = $contentData['content_type'];
    $contentData['content_type_' . $contentType] = 'checked';
    unset($contentData['password']);
    $contentData['wallname'] = Utils::getWallKey();

    if (isset($grade) && $grade) {
      $level = $grade;
    } else {
      $level = 0;
    }

    $queryString = '';
    if (isset($search) && $search) {
      $queryString = "?find=${find}&search=${search}";
    }
    $returnURL = $rootPath . $category . "/$id" . '/modify' . $queryString;

    if (strtolower($nonemember) !== 'y' && empty($nickname)) {
      $context->setSession('return_url', $returnURL);
      $msg = '이곳은 회원 전용 게시판 입니다.<br>로그인을 먼저 하세요.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
    }

    if ($level < $grade_m) {
      $context->setSession('return_url', $returnURL);
      $msg = '수정권한이 없습니다.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
      exit;
    }

    $admin_pass = $context->checkAdminPass();
    if (strtolower($is_modifiable) !== 'y' && $admin_pass === false) {
      $context->setSession('return_url', $returnURL);
      $msg = '이곳은 관리자 전용 게시판입니다.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
    }

    $this->document_data['jscode'] = 'modify';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시판 수정';
    $this->document_data['category'] = $category;
    $this->document_data['id'] = $id;
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;

    $this->skin_path_list['root'] =$rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}/modify.tpl";
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displayReply() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();
    $requestData = $context->getRequestAll();
    $sessionData = $context->getSessionAll();

    $find = $requestData['find'];
    $search = $requestData['search'];
    $category = $context->getParameter('category');
    $id = $context->getParameter('id');
    $grade = $sessionData['grade'];
    $userName = $sessionData['user_name'];
    $nickname = $sessionData['nickname'];
    $password = $sessionData['password'];
    $admin_pass = $context->checkAdminPass();

    $where = new QueryWhere();
    $where->set('category',$category,'=');
    $this->model->select('board_group', '*', $where);

    $groupData = $this->model->getRow();
    $is_progress_step = $groupData['is_progress_step'];
    $noneMember = $groupData["allow_nonmember"];
    $grade_r = $groupData["grade_r"];
    $grade_re = $groupData["grade_re"];
    $is_repliable = $groupData["is_repliable"];
    $headerPath = $groupData['header_path'];
    $skinName = $groupData['skin_path'];
    $footerPath = $groupData['footer_path'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = _SUX_PATH_ . "modules/board/skin/${skinName}/";

    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add('상단 파일경로가 올바르지 않습니다.');
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add('하단 파일경로가 올바르지 않습니다.');
    }

    $where->reset();
    $where->set('id',$id,'=');
    $this->model->select('board','igroup_count,space_count,ssunseo_count', $where);
    $contentData = $this->model->getRow();

    // Create Wall Key
    $contentData['wallname'] = Utils::getWallKey();

    if (isset($grade) && $grade) {
      $level = $grade;
    } else {
      $level = 0;
    }

    $queryString = '';
    if (isset($search) && $search) {
      $queryString = "?find=${find}&search=${search}";
    }
    $returnURL = $rootPath . $category . "/$id" . '/reply' . $queryString;

    // 비회원 허용 유무
    if (strtolower($noneMember) !== 'y') {
      $context->setSession('return_url', $returnURL);
      $msg = '이곳은 회원 전용 게시판 입니다. 로그인을 먼저 하세요.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
    }

    if ($level < $grade_re) {
      $context->setSession('return_url', $returnURL);
      $msg = '답변권한이 없습니다.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
      exit;
    }

    if (strtolower($is_repliable) !== 'y' && $admin_pass === false) {
      $context->setSession('return_url', $returnURL);
      $msg = '이곳은 관리지 전용게시판입니다.';
      UIError::alertTo( $msg, true, array('url'=>$rootPath . 'login', 'delay'=>3));
      exit;
    }

    if (isset($nickname) && $nickname) {
      $contentData['css_user_label'] = 'sx-hide';
      $contentData['user_name_type'] = 'hidden';
      $contentData['user_pass_type'] = 'hidden';
      $contentData['user_name'] = $userName;
      $contentData['nickname'] = $nickname;
      $contentData['user_password'] = $password;
    } else {
      $uniqNickname = 'Guest_' . Utils::getMicrotimeInt();
      $contentData['css_user_label'] = 'sx-show-inline';
      $contentData['user_name_type'] = 'text';
      $contentData['user_name'] = '';
      $contentData['nickname'] = $uniqNickname;
      $contentData['user_pass_type'] = 'password';
      $contentData['user_password'] = '';
    }

    $this->request_data = $requestData;
    $this->session_data = $sessionData;

    $this->document_data['jscode'] = 'reply';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시판 답변';
    $this->document_data['category'] = $category;
    $this->document_data['id'] = $id;
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;
    $this->document_data['uri'] = $rootPath.$category;

    $this->skin_path_list['root'] =$rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}/reply.tpl";
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displayDelete() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();

    $category = $context->getParameter('category');
    $id = $context->getParameter('id');

    $where = new QueryWhere();
    $where->set('category', $category, '=');
    $this->model->select('board_group', '*', $where);

    $groupData = $this->model->getRow();
    $headerPath = $groupData['header_path'];
    $skinName = $groupData['skin_path'];
    $footerPath = $groupData['footer_path'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = _SUX_PATH_ . "modules/board/skin/${skinName}/";

    $this->document_data['uri'] = $rootPath.$category;

    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add('상단 파일경로가 올바르지 않습니다.');
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add('하단 파일경로가 올바르지 않습니다.');
    }

    $where->reset();
    $where->set('id', $id, '=');
    $this->model->select('board', 'id, category, user_name, nickname', $where);
    $contentData = $this->model->getRow();

    $this->document_data['jscode'] = 'delete';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시물 삭제';
    $this->document_data['category'] = $category;
    $this->document_data['id'] = $id;
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;

    $this->skin_path_list['root'] =$rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}/delete.tpl";
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displayCommentJson() {

    $resultYN = 'Y';
    $msg = '';

    $context = Context::getInstance();

    $category = $context->getParameter('category');
    $cid = $context->getParameter('id');
    $rootPath = _SUX_ROOT_;

    $where = QueryWhere::getInstance();
    $where->set('content_id',$cid);
    $result = $this->model->select('comment','*', $where);
    //$msg .= Tracer::getInstance()->getMessage();

    if (!$result) {
      $msg .= '댓글 가져오기를  실패하였습니다.';
    }
    $rows = $this->model->getRows();
    $data = array(
            'data'=>$rows,
            'url'=>$rootPath . $category,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data);
  }

  function displayDeleteComment() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();

    $category = $context->getParameter('category');
    $mid = $context->getParameter('id');  // 메인 아이디
    $id = $context->getParameter('sid');    // 서브 아이디

    $this->document_data['category'] = $category;
    $this->document_data['mid'] = $mid;

    $this->document_data['jscode'] ='delete';
    $this->document_data['module_code'] = 'board';
    $this->document_data['module_name'] = '게시물 삭제';

    $where = new QueryWhere();
    $where->set('category', $category, '=');
    $this->model->select('board_group', '*', $where);

    $groupData = $this->model->getRow();
    $headerPath = $groupData['header_path'];
    $skinName = $groupData['skin_path'];
    $footerPath = $groupData['footer_path'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/board/skin/${skinName}/";
    $skinRealPath = _SUX_PATH_ . "modules/board/skin/${skinName}/";

    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = "{$skinRealPath}/_header.tpl";
      $UIError->add('상단 파일경로가 올바르지 않습니다.');
    }

    if (!is_readable($footerPath)) {
      $footerPath = "{$skinRealPath}/_footer.tpl";
      $UIError->add('하단 파일경로가 올바르지 않습니다.');
    }

    $where->reset();
    $where->set('id', $id, '=');
    $this->model->select('comment', '*', $where);

    $contentData = $this->model->getRow();
    $contentData['id'] = $id;
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;

    $this->skin_path_list['root'] =$rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = "{$skinRealPath}/delete_comment.tpl";
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }
}