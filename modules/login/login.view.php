<?php

class LoginView extends View
{

  var $class_name = 'login_view';

  function displayLogin() {

    $UIError = UIError::getInstance();
    $context = Context::getInstance();

    $loginCookieId = $context->getCookieId('login_keeper');
    $loginKeeper = $context->getCookie($loginCookieId);

    /**
     * css, js file path handler
     */
    $this->document_data['jscode'] = 'login';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '회원 로그인';

    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . 'modules/login/tpl/';
    $skinRealPath = _SUX_PATH_ . 'modules/login/tpl/';

    $headerPath = _SUX_PATH_ . 'common/_header.tpl';
    if (!is_readable($headerPath)) {
      $headerPath = $skinRealPath . "_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    $footerPath = _SUX_PATH_ . 'common/_footer.tpl';
    if (!is_readable($footerPath)) {
      $footerPath = $skinRealPath . "_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }

    $user_id = $context->getSession('user_id');
    
    /**
     * get data from DB
     */
    if (!$user_id ) {
      $this->model->select('member_group', '*');
      $groupData = $this->model->getRows();
      $contentsPath = $skinRealPath . 'login.tpl';    
    } else {
      $contentsPath = $skinRealPath . 'info.tpl';
    } 

    $this->document_data['loginKeeper'] = $loginKeeper;
    $this->document_data['isLogon'] = 'success';
    $this->document_data['group'] = $groupData;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['contents'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  } 

  function displayLoginFail() {

    $UIError = UIError::getInstance();

    $context = Context::getInstance();
    $this->request_data = $context->getRequestAll();
    $this->session_data = $context->getSessionAll();    

    /**
     * css, js file path handler
     */
    $this->document_data['jscode'] = 'login';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '회원 로그인 실패';
    
    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . 'modules/login/tpl/';
    $skinRealPath = _SUX_PATH_ . 'modules/login/tpl/';

    $headerPath = _SUX_PATH_ . 'common/_header.tpl';
    if (!is_readable($headerPath)) {
      $headerPath = $skinRealPath . "_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    $footerPath = _SUX_PATH_ . 'common/_footer.tpl';
    if (!is_readable($footerPath)) {
      $footerPath = $skinRealPath . "_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }

    $contentsPath = $skinRealPath . 'login.tpl';
    $this->model->select('member_group', '*');
    $this->document_data['group'] = $this->model->getRows();
    $this->document_data['isLogFail'] = true;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['contents'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;
    
    $this->output();
  }

  function displayLeave() {

    $UIError = UIError::getInstance();

    $context = Context::getInstance();
    $this->session_data = $context->getSessionAll();

    /**
     * css, js file path handler
     */
    $this->document_data['jscode'] = 'leave';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '회원 탈퇴';
    
    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . 'modules/login/tpl/';
    $skinRealPath = _SUX_PATH_ . 'modules/login/tpl/';

    $headerPath = _SUX_PATH_ . 'common/_header.tpl';
    if (!is_readable($headerPath)) {
      $headerPath = $skinRealPath . "_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    $footerPath = _SUX_PATH_ . 'common/_footer.tpl';
    if (!is_readable($footerPath)) {
      $footerPath = $skinRealPath . "_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }

    $contentsPath = $skinRealPath . 'leave.tpl';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['contents'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displaySearchId() {

    $UIError = UIError::getInstance();

    $context = Context::getInstance();
    $this->post_data = $context->getPostAll();
    $userName = $this->post_data['user_name'];
    $userEmail = $this->post_data['email_address'];

    /**
     * css, js file path handler
     */
    $this->document_data['jscode'] = 'searchId';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '아이디 찾기';

    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . 'modules/login/tpl/';
    $skinRealPath = _SUX_PATH_ . 'modules/login/tpl/';

    $headerPath = _SUX_PATH_ . 'common/_header.tpl';
    if (!is_readable($headerPath)) {
      $headerPath = $skinRealPath . "_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    $footerPath = _SUX_PATH_ . 'common/_footer.tpl';
    if (!is_readable($footerPath)) {
      $footerPath = $skinRealPath . "_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }   

    if (isset($userName) && $userName != ''){

      $where = new QueryWhere();
      $where->set('user_name',$userName);
      $where->set('email_address',$userEmail,'=','and');
      $this->model->select('member', 'user_id, email_address', $where);

      $row = $this->model->getRow();
      if (count($row) > 0) {
        $userId = $row['user_id'];
        $email = $row['email_address']; 

        if ($email !== $userEmail) {
          UIError::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
          exit;
        }

        $this->document_data['user_name'] = $userName;
        $this->document_data['user_id'] = $userId;
        $this->document_data['jscode'] = 'searchResult';

        $contentsPath = $skinRealPath . 'searchid_result.tpl';
      } else {
        UIError::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
        exit;
      } 
    } else {
      $this->model->select('member_group', '*');
      $this->document_data['group'] = $this->model->getRows();

      $contentsPath = $skinRealPath . 'searchid.tpl';
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['contents'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displaySearchPassword() {

    $UIError = UIError::getInstance();

    $context = Context::getInstance();
    $this->post_data = $context->getPostAll();
    $userName = $this->post_data['user_name'];
    $userId = $this->post_data['user_id'];    
    $userEmail = $this->post_data['email_address'];

    /**
     * css, js file path handler
     */
    $this->document_data['jscode'] = 'searchPassword';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '비밀번호 찾기';

    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . 'modules/login/tpl/';
    $skinRealPath = _SUX_PATH_ . 'modules/login/tpl/';

    $headerPath = _SUX_PATH_ . 'common/_header.tpl';
    if (!is_readable($headerPath)) {
      $headerPath = $skinRealPath . "_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    $footerPath = _SUX_PATH_ . 'common/_footer.tpl';
    if (!is_readable($footerPath)) {
      $footerPath = $skinRealPath . "_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }   

    if(isset($userId) && $userId) {

      $where = new QueryWhere();
      $where->set('user_name',$userName);
      $where->set('user_id',$userId,'=','and');
      $where->set('email_address',$userEmail,'=','and');
      $this->model->select('member', 'user_name, user_id, email_address', $where);

      $row = $this->model->getRow();
      if (count($row) > 0) {
        $name = $row['user_name'];
        $id = $row['user_id']; 
        $email = $row['email_address'];        

        if ($name !== $userName) {
          UIError::alertToBack('입력하신 정보와 이름이 일치하지 않습니다. \n이름을 다시 확인해주세요.');
          exit;
        }

        if ($id !== $userId) {
          UIError::alertToBack('입력하신 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
          exit;
        }

        if ($email !== $userEmail) {
          UIError::alertToBack('입력하신 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
          exit;
        }

        $contentsPath = $skinRealPath . 'searchpwd_result.tpl';       

        $this->document_data['user_id'] = $userId;
        $this->document_data['user_name'] = $userName;
        $this->document_data['user_email'] = $email;
        $this->document_data['jscode'] = 'searchResult';

        /*$email_skin_path = _SUX_PATH_ . 'modules/mail/member/mail_searchpwd_result.tpl';
        if (!file_exists($email_skin_path)) {
          UIError::alertToBack('이메일 스킨파일이 존재하지 않습니다.');
          exit;
        }

        $subject = '[ StreamUX ]에 문의하신 내용의 답변입니다.';
        $additional_headers = 'From: ' . $adminName . '<' . $adminEmail . '>\n';
        $additional_headers .= 'Reply-To : ' . $userEmail . '\n';
        $additional_headers .= 'MIME-Version: 1.0\n';
        $additional_headers .= 'Content-Type: text/html; charset=EUC-KR\n';
        $contents = $mail_skin;

        mail($adminEmail, $subject, $contents, $additional_headers);
        mail($userEmail, $subject, $contents, $additional_headers);*/
      } else {
        UIError::alertToBack('입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.');
        exit;
      }
    }else{      
      $this->model->select('member_group', '*');
      $this->document_data['group'] = $this->model->getRows();

      $contentsPath = $skinRealPath . 'searchpwd.tpl';
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['contents'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }
}
