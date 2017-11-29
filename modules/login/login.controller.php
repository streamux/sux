<?php

class LoginController extends Controller
{

  function insertLogin() {

    $rootPath = _SUX_ROOT_;

    $context = Context::getInstance();
    $this->session_data = $context->getSessionAll();
    $this->post_data = $context->getPostAll();

    $userId = (isset($this->post_data['user_id']) && $this->post_data['user_id']) ?
                    $this->post_data['user_id'] : $this->session_data['user_id'];
    $userId = trim($userId);
    if (empty($userId)) {
      UIError::alertToBack('아이디를 입력하세요.');     
      exit;
    }

    $password = trim($this->post_data['password']);
    $passwordHash = (isset($password) && $password) ?
                     $context->getPasswordHash($password) : $this->session_data['password'];
    
    if (empty($passwordHash)) {
      UIError::alertToBack('비밀번호를 입력하세요.');     
      exit;
    } 

    $where = new QueryWhere();    
    $where->set('user_id', $userId);
    $where->set('password', $passwordHash, '=', 'and');
    $this->model->select('member', '*', $where);

    $rownum = $this->model->getNumRows();
    if ($rownum > 0) {

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
      $row['hit_count'] = $row['hit_count'] + 1;

      $columns = array();
      $columns['hit'] = $row['hit_count'];
      $this->model->update('member', $columns, $where);

      $sessionList = array('category','user_id','password','user_name','nick_name','email_address','is_writable','point','hit_count','grade','automod1','chatip', 'IsAuthorized');

      foreach ($sessionList as $key => $value) {
        $context->setSession($value, $row[$value]);
      }

      $data = array(
        'msg'=>'로그인 성공',
        'result'=>'Y',
        'url'=>$rootPath . 'login'
      );
      
      $this->callback($data);
    } else {
      $msg .= $userId .' 아이디가 등록되어 있지 않거나, 아이디 또는 비밀번호를 잘못입력하였습니다.';
      UIError::alertTo($msg, $rootPath . 'login-fail');
    }
  }

  function insertLogout() {

    $context = Context::getInstance();

    $rootPath = _SUX_ROOT_;
    $this->session_data = $context->getSessionAll();
    foreach ($this->session_data as $key => $value) {
      if (strpos($key, 'admin_ok') !== false) {
        continue;
      }
      $context->setSession($key, '');
    }

    $data = array(
      'msg'=>'로그아웃',
      'result'=>'Y',
      'url'=>$rootPath . 'login'
    );
    
    $this->callback($data);
  }
}
