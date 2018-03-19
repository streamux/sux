<?php

class LoginController extends Controller
{

  function insertLogin() {
    
    $msg = '로그인 성공';
    $resultYN = 'Y';
    $url = '';

    $context = Context::getInstance();
    $sessionData = $context->getSessionAll();
    $postData = $context->getPostAll();

    $rootPath = _SUX_ROOT_;
    $token = Utils::getMicrotimeInt() . 'SHIFLEFT';
    $userId = (isset($postData['user_id']) && $postData['user_id']) ?
                    $postData['user_id'] : $sessionData['user_id'];
    $userId = trim($userId);
    $loginKeeper = trim($postData['login_keeper']);

    if (empty($userId)) {
      UIError::alertToBack('아이디를 입력하세요.');     
      exit;
    }

    $password = trim($postData['password']);
    $passwordHash = (isset($password) && $password) ?
                     $context->getPasswordHash($password) : $sessionData['password'];
    
    if (empty($passwordHash)) {
      UIError::alertToBack('비밀번호를 입력하세요.');     
      exit;
    } 

    $where = new QueryWhere();    
    $where->set('user_id', $userId);
    $where->set('password', $passwordHash, '=', 'and');
    $this->model->select('member', '*', $where);

     $rownum = $this->model->getNumRows();

    if ($rownum == 0) {
      $msg .= $userId .' 아이디가 등록되어 있지 않거나, 아이디 또는 비밀번호를 잘못입력하였습니다.';
      UIError::alertTo($msg, $rootPath . 'login-fail');
      exit;
    }

    $row = $this->model->getRow();
    $password = $row['password'];

    if ($password !== $passwordHash) {
      $msg .= '비밀번호가 일치하지 않습니다.';
      UIError::alertTo($msg, $rootPath . 'login-fail');
      exit;
    }
    
    $row['password'] = $passwordHash;
    $row['automod1'] = 'yes';
    $row['IsAuthorized'] = 'ok';
    $row['chatip'] = $context->getServer('REMOTE_ADDR');
    $row['access_count'] = $row['access_count'] + 1;

    $columns = array();
    $columns['access_count'] = $row['access_count'];
    $this->model->update('member', $columns, $where);

    $sessionList = array('category','user_id','password','user_name','nickname','email_address','is_writable','point','access_count','grade','automod1','chatip', 'IsAuthorized');

    foreach ($sessionList as $key => $value) {
      $context->setSession($value, $row[$value]);
    }

    $grade = (int) $row['grade'];
    if ($row['category'] === 'administrator' && $grade === 10) {
      $adminHash = $context->getPasswordHash($token);
      $context->setSession('admin_ok', $adminHash);
    }

    $loginKeeper = strtoupper($loginKeeper);
    if ($loginKeeper === 'TRUE') {
      $loginCookieId = $context->getCookieId('login_keeper');
      $loginKeeperVal = Utils::getMicrotimeInt();
      $context->setCookie($loginCookieId, $loginKeeperVal, time() + 86400 * 30 * 12);
    } else {
      $loginCookieId = $context->getCookieId('login_keeper');
      $context->setCookie($loginCookieId, '', -1);
    }

    $data = array(
      'msg'=>$msg,
      'result'=>$resultYN,
      'url'=>$rootPath
    );
    
    $this->callback($data);
  }

  function insertLogout() {

    $context = Context::getInstance();

    $rootPath = _SUX_ROOT_;
    $sessionData = $context->getSessionAll();
    foreach ($sessionData as $key => $value) {
      $context->unsetSession($key, '');
    }

    $data = array(
      'msg'=>'로그아웃',
      'result'=>'Y',
      'url'=>$rootPath . 'login'
    );
    
    $this->callback($data);
  }

  function insertSearchPassowrd() {

    $UIError = UIError::getInstance();

    $context = Context::getInstance();
    $this->post_data = $context->getPostAll();
    $adminInfo = $context->getAdminInfo();
    $userName = $this->post_data['user_name'];
    $userId = $this->post_data['user_id'];    
    $userEmail = $this->post_data['email_address'];

    if (empty($userId)) {
      UIError::alertToBack('아이디가 필요합니다.');
      exit;
    }
    if (empty($userName)) {
      UIError::alertToBack('이름이 필요합니다.');
      exit;
    }
    if (empty($userEmail)) {
      UIError::alertToBack('이메일 주소가 필요합니다.');
      exit;
    }

    $rootPath = _SUX_ROOT_;

    $where = new QueryWhere();
    $where->add('(');
    $where->set('user_name',$userName, '=');
    $where->set('nickname',$userName, '=', 'or');
    $where->add(')');
    $where->set('user_id',$userId,'=','and');
    $where->set('email_address',$userEmail,'=','and');
    $this->model->select('member', 'user_name, nickname, user_id, email_address', $where);
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

      $email_skin_path = _SUX_PATH_ . 'modules/mails/templates/search_pwd.html';

      if (file_exists($email_skin_path)) {
        $contents = FileHandler::readFile($email_skin_path);

        $adminName = $adminInfo['admin_nickname'];
        $adminHome = $adminInfo['yourhome'];
        $adminDomain = Utils::getDomain($adminInfo['yourhome']);
        $adminEmail = $adminInfo['admin_email'];

        if (empty($adminDomain)) {
          $adminDomain = $adminHome;
        }

        $tempPassword = Utils::getRandomPassword(12);

        $subject = "[ " . $adminDomain . " ]에 문의하신 내용의 답변입니다.";
        $additional_headers = "From: " . $adminName . " < " . $adminEmail . " >\n";
        $additional_headers .= "Reply-To : " . $userEmail . "\n";
        $additional_headers .= "MIME-Version: 1.0\n";
        $additional_headers .= "Content-Type: text/html; charset=UTF-8\n";

       /* echo $contents;
        return*/

        mail($adminEmail, $subject, $contents, $additional_headers);
        mail($userEmail, $subject, $contents, $additional_headers);
      } else {
        UIError::alertToBack("스킨 파일이 존재하지 않습니다.\n");
      }        
    } else {
      UIError::alertToBack("입력하신 정보와 일치하는 이름이 존재하지 않습니다.\n이름을 다시 확인해주세요.");
      exit;
    }

    $data = array(
      'msg'=>'비밀번호 찾기 결과',
      'result'=>'Y',
      'url'=>$rootPath . 'search_password'
    );
    
    $this->callback($data);
  }
}
