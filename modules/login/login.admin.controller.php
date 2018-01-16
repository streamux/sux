<?php

class LoginAdminController extends Controller {

  var $class_name = 'login_admin_controlelr';

  function insertLoginAdmin() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $userId = $posts['user_id'];
    $userPwd = $posts['user_pwd'];
    $token = $posts['token'];
    $loginKeeper = $posts['login_keeper'];

    $rootPath = _SUX_ROOT_;   
    $msg = '';
    $token = $token . 'SHIFLEFT';

    if (empty($userId)) {
      $msg = "아이디를 입력하세요.";
      UIError::alertToBack($msg);
      exit;
    } else if (empty($userPwd)) {
      $msg = $userPwd. "비밀번호를 입력하세요.";
      UIError::alertToBack($msg);
      exit;
    } 

    $userPwd = $context->getPasswordHash($userPwd);

    $where = new QueryWhere();
    $where->set('category', 'administrator');
    $where->set('user_id', $userId, '=', 'and');
    $where->set('password', $userPwd, '=', 'and');
    $this->model->select('member', '*', $where);    
    $rownum = $this->model->getNumRows();

    if ($rownum < 1) {
      UIError::alertToBack('정보가 일치하지 않습니다.');
      exit;
    }

    $row = $this->model->getRow();
    $row['automod1'] = 'yes';
    $row['IsAuthorized'] = 'ok';
    $row['chatip'] = $context->getServer('REMOTE_ADDR');
    $sessionList = array('category','user_id','password','user_name','nick_name','email_address','is_writable','point','hit_count','grade','automod1','chatip', 'IsAuthorized');

    for ($i=0; $i<count($sessionList); $i++) {
      $key = $sessionList[$i];

      if (isset($row[$key]) && $row[$key]) {
        $context->setSession($key, $row[$key]);
      }
    }

    $adminHash = $context->getPasswordHash($token);
    $context->setSession('admin_ok', $adminHash);

    $loginKeeper = strtoupper($loginKeeper);
    if ($loginKeeper === 'ON') {
      $loginCookieId = $context->getCookieId('login_keeper');
      $context->setCookie($loginCookieId, date('Y-m-d H:i:s'), time() + 86400 * 30 * 12);
    } else {
      $loginCookieId = $context->getCookieId('login_keeper');
      $context->setCookie($loginCookieId, '', -1);
    }

    $data = array(  'token'=>$adminHash,
            'msg'=>'로그인 성공',
            'result'=>'Y',
            'url'=>$rootPath . 'admin',
            'delay'=>0);
      
    $this->callback($data);
  }

  function insertRegisterAdmin() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $userId = $posts['admin_id'];
    $userPwd = $posts['admin_pwd'];
    $userNewPwd = $posts['admin_newpwd'];

    $rootPath = _SUX_ROOT_;   
    $resultYN = 'Y';
    $msg = '';

    $token = $token . 'SHIFLEFT';
    if (empty($userId)) {
      $msg = "관리자 아이디를 입력하세요.";
      UIError::alertToBack($msg);
      exit;
    } else if (empty($userPwd)) {
      $msg = "관리자 비밀번호를 입력하세요.";
      UIError::alertToBack($msg);
      exit;
    } 

    $adminId = $context->getAdminInfo('admin_id');
    $adminPwd = $context->getAdminInfo('admin_pwd');
    $userPwd = $context->getPasswordHash($userPwd);
    $userNewPwd = $context->getPasswordHash($userNewPwd);

    if ($userId !== $adminId) {
      UIError::alertToBack('아이디가 일치하지 않습니다.');
      exit;
    } else if ($userPwd !== $adminPwd) {
      UIError::alertToBack('비밀번호가 일치하지 않습니다.');
      exit;
    }

    $admin_info = array('admin_id','admin_name','admin_pwd','admin_email','yourhome');

    $rootPath = _SUX_ROOT_;
    $filePath = 'files/config/config.admin.php';
    $buffer = array('admin_info'=>array());
    $adminInfo = $context->getAdminInfo();
    foreach ($admin_info as $key => $value) {
      if (isset($posts[$value]) && $posts[$value]) {
        $buffer['admin_info'][$value] = $posts[$value];
      } else {
        if (isset($adminInfo[$value]) && $adminInfo[$value]) {
          $buffer['admin_info'][$value] = $adminInfo[$value];
        }       
      }   
    }
    $buffer['admin_info']['admin_pwd'] = $userNewPwd;
    $result = CacheFile::writeFile($filePath, $buffer);
    if(!$result) {
      $msg = "관리자 설정을 실패했습니다.";
      $resultYN = "N";
    } else {
      $msg = "관리자계정 설정을 완료하였습니다.<br>";
      $resultYN = 'Y';
    }

    $adminHash = $context->getPasswordHash($token);
    $context->setSession('admin_ok', $adminHash);

    $data = array(  'token'=>$adminHash,
            'msg'=>'로그인 성공',
            'result'=>'Y',
            'url'=>$rootPath . 'login-admin',
            'delay'=>0);
      
    $this->callback($data);
  }

  function insertLogoutAdmin() {

    $context = Context::getInstance();    
    $sessionData = $context->getSessionAll();
    $rootPath = _SUX_ROOT_;

    foreach ($sessionData as $key => $value) {
      $context->setSession($key, '');
    }

    $data = array(  'msg'=>'로그아웃',
            'result'=>'Y',
            'url'=>$rootPath . 'login-admin',
            'delay'=>0);
      
    $this->callback($data);
  }
}
