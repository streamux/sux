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
    $this->skin_path_list['content'] = $contentsPath;
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
    $this->skin_path_list['content'] = $contentsPath;
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
    $this->skin_path_list['content'] = $contentsPath;
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
          UIError::alertToBack('입력한 정보와 이메일이 일치하지 않습니다. \n이메일을 확인해주세요.');
          exit;
        }

        $this->document_data['user_name'] = $userName;
        $this->document_data['user_id'] = $userId;
        $this->document_data['jscode'] = 'searchResult';

        $contentsPath = $skinRealPath . 'searchid_result.tpl';
      } else {
        UIError::alertToBack('입력한 정보와 일치하는 이름이 존재하지 않습니다.\n다시 입력해주세요.');
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
    $this->skin_path_list['content'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }

  function displaySearchPassword() {

    $UIError = UIError::getInstance();

    $context = Context::getInstance();
    $this->post_data = $context->getPostAll();
    $adminInfo = $context->getAdminInfo();
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
      $where->set('user_name',$userName, '=');
      $where->set('user_id', $userId,'=','and');
      $where->set('email_address', $userEmail,'=','and');
      $this->model->select('member', 'id, user_name, user_id, email_address', $where);
      $row = $this->model->getRow();

      if (count($row) > 0) {

        $rowName = $row['user_name'];
        $id = $row['user_id']; 
        $email = $row['email_address']; 

        if ($rowName !== $userName) {
          UIError::alertToBack('입력한 정보와 이름이 일치하지 않습니다. \n이름을 다시 확인해주세요.');
          exit;
        }

        if ($id !== $userId) {
          UIError::alertToBack('입력한 정보와 아이디가 일치하지 않습니다. \n아이디를 다시 확인해주세요.');
          exit;
        }

        if ($email !== $userEmail) {
          UIError::alertToBack('입력한 정보와 이메일이 일치하지 않습니다. \n이메일을 다시 확인해주세요.');
          exit;
        }

        $this->document_data['user_id'] = $userId;
        $this->document_data['user_name'] = $userName;
        $this->document_data['user_email'] = $email;
        $this->document_data['jscode'] = 'searchResult';

        $emailSkinPath = _SUX_PATH_ . 'modules/mails/templates/search_pwd.html';
        $emailLogoPath = _SUX_PATH_ . 'common/images/sux_logo.svg';
        $sendedMail = $context->getSession('sx_sended_anth_mail');

        if (file_exists($emailSkinPath) && $sendedMail !== 'ok') {
          $messages = FileHandler::readFile($emailSkinPath);
          $mailLogo = FileHandler::readFileToBase64($emailLogoPath);

          $adminName = $adminInfo['admin_name'];
          $adminHome = $adminInfo['yourhome'];
          $adminDomain = Utils::getDomain($adminInfo['yourhome']);
          $adminEmail = $adminInfo['admin_email'];

          if (empty($adminDomain)) {
            $adminDomain = $adminHome;
          }

          $tempPassword = Utils::getRandomPassword(12);
          $hashPassword = $context->getPasswordHash($tempPassword); 

          $to = "${userName}<${userEmail}>";
          $from = "${adminName}<${adminEmail}>";
          $subject = "[${adminDomain}] 비밀번호 재등록 인증 메일입니다.";          

          $replaceList = array(
            'yourhome'=>$adminHome,
            'user_name'=>$userName,
            'temp_password'=>$tempPassword,
            'mail_logo'=>$mailLogo
          );

          foreach ($replaceList as $key => $value) {
            $reg = sprintf('{$%s}',$key);
            $messages = str_replace($reg, $value, $messages);
          }

          Mail::send($to, $subject, $messages, $from);

          $context->setCookie('sx_sended_anth_key', $hashPassword, time() + 180);
          $context->setSession('sx_sended_anth_mail', 'ok');

          $contentsPath = $skinRealPath . 'searchpwd_result.tpl';  
        }
      } else {
        UIError::alertToBack('입력한 정보와 일치하는 이름이 존재하지 않습니다. \n이름을 다시 확인해주세요.');
        exit;
      }
    }else{
      $context->setSession('sx_sended_anth_mail', null);

      $this->model->select('member_group', '*');
      $this->document_data['group'] = $this->model->getRows();

      $contentsPath = $skinRealPath . 'searchpwd.tpl';
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }
}
