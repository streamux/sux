<?php

class LoginController extends Controller
{

  function insertLogin() {
    
    $msg = '';
    $resultYN = 'Y';
    $url = '';
    $hasReAuth = false;

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

    $hasReAnthKey = $context->getCookie('sx_sended_anth_key');

    if (isset($hasReAnthKey) && $hasReAnthKey && ($hasReAnthKey === $passwordHash)) {
      $hasReAuth = true;
      $context->setCookie('sx_sended_anth_key');
      $msg .= "로그인 재인증 성공하였습니다. 새로운 비밀번호로 재등록하세요.<br>";

      $where = new QueryWhere();
      $where->set('user_id', $userId);
      $result = $this->model->update('member', array('password'=>$passwordHash), $where);

      if (!$result) {
        UIError::alertToBack("비밀번호 업데이트를 실패하였습니다.");
        exit;
      }   
    }

    $hasAnthMail = $context->getSession('sx_sended_anth_mail'); 

    if ($hasAnthMail === 'ok' && empty($hasReAnthKey)) {
      $hasReAuth = true;
      $context->setSession('sx_sended_anth_mail', null); 
      UIError::alertToBack("인증 시간이 만료되었습니다. 다시 시도해 주세요.");
      exit;
    }

    $where = new QueryWhere(); 
    $where->set('user_id', $userId);
    $where->set('password', $passwordHash, '=', 'and');
    $this->model->select('member', '*', $where);
    $rownum = $this->model->getNumRows();

    if ($rownum == 0) {
      $msg .= $userId .' 아이디가 등록되어 있지 않거나, 아이디 또는 비밀번호가 맞지 않습니다.';
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

    $context->setSession('sx_sended_anth_mail', null);
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
      'has_reauth'=>$hasReAuth,
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
}
