<?php

class MemberController extends Controller
{
  function checkValidation( $post ) {

    $labelList = array('아이디를','비밀번호를','닉네임을','이메일을');
    $ckeckList = array('user_id','password','nickname','email_address');
    foreach ($ckeckList as $key => $value) {

      if (empty($post[$value])) {
        $msg = $post[$value] . $labelList[$key] . ' 입력해주세요.';
        return $msg;
      }
    }
    return $msg;
  }

  function insertCheckId() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['user_id'];
    $msg = "신청 아이디 : ".$id."\n";

    if (!preg_match('/^[a-zA-Z!_][a-zA-Z0-9!_]{3,12}$/i', $id)) {

      $msg .= "아이디명은 영문+숫자+특수문자('!','_') 조합된 단어만 사용가능<br>첫글자가 영문 또는 특수문자로 시작되는 4글자 이상 사용하세요.";

      $data = array(  "result"=>$resultYN,
              "msg"=>$msg);

      $this->callback($data);
      exit;
    } 

    if (isset($id)) {
      $where = new QueryWhere();
      $where->set('user_id', $id);
      $this->model->select('member', 'id', $where);

      $numrows = $this->model->getNumRows();
      if ($numrows > 0) {
        $msg = "'${id}'는 이미 존재하는 아이디입니다.";
        $resultYN = "N";
      } else {
        $msg = "'${id}'는 생성할 수 있는 아이디입니다.";
        $resultYN = "Y";
      }
    }else{
      $msg = "아이디를 넣고 중복체크를 하세요.";
      $resultYN = "N";
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function insertMemberJoin() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();    

    $category = trim($posts['category']);
    if (empty($category)) {
      $category = 'member'; // 초기 가입 시 기본회원
    }

    $userId = trim($posts['user_id']);
    if (empty($posts['user_name'])) {
      $posts['user_name'] = trim($posts['nickname']);
    }
    $returnURL = $context->getServer('REQUEST_URI');

    // validation
    $msg = $this->checkValidation($posts);
    if (isset($msg) && $msg) {
      $resultYN = 'N';
      $data = array(  'url'=>$returnURL,
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    // hoby data
    $hobby = '';
    $index = 0;
    foreach ($posts as $key => $value) {
      if (preg_match('/^hobby+/', $key)) {
        $hobby .= ($index === 0) ? $value : ',' . $value;
        $index++;
      }     
    } 

    // email validation
    $email = $posts['email_address']; 
    $check_email=filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($check_email != true) {
      $msg .= '잘못된 E-mail 주소입니다.';
      $resultYN = 'N';
      $data = array(  'url'=>$returnURL,
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    $passwordHash = $context->getPasswordHash($posts['password']);
    $posts['password'] = $passwordHash;
    $posts['email_address'] = $email;
    $posts['hobby'] = $hobby;

    $where = new QueryWhere();
    $where->set('user_id', $user_id);
    $this->model->select('member', 'id', $where);

    $numrows = $this->model->getNumRows();
    if ($numrows > 0) {
      $msg = "아이디가 이미 존재합니다.";
      $resultYN = "N";

      $data = array(  'url'=>$returnURL,
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    /* check email */
    $where->reset();
    $where->set('email_address', $email);
    $this->model->select('member', 'id', $where);

    $numrows = $this->model->getNumRows();
    if ($numrows > 0) {
      $msg = "이미 사용된 이메일 입니다. 다른 이메일을 등록하세요.";
      $resultYN = "N";

      $data = array(  'url'=>$returnURL,
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }
    
    $cachePath = './files/caches/queries/member.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');
    if (!$columnCaches) {
      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    if (isset($posts['hp']) && $posts['hp']) {
      $hp = preg_split('/[-]/', $posts['hp']);
      $posts['hp1'] = $hp[0];
      $posts['hp2'] = $hp[1];
      $posts['hp3'] = $hp[2];
    }

    $columns = array();
    for($i=0; $i<count($columnCaches); $i++) {
      $key = $columnCaches[$i];
      $value = $posts[$key];

      if (isset($value) && $value) {
        if ($key === 'password') {
          $value = $value;
        }
        $columns[] = $value;
      } else {
        switch ($key) {
          case 'grade':
            $columns[] = 1;
            break;
          case 'date':
            $columns[] = 'now()';
            break;
          case 'ip':
            $columns[] = $context->getServer('REMOTE_ADDR');
            break;
          default:
            $columns[] = '';
            break;
        } 
      }           
    }

    $result = $this->model->insert('member', $columns);
    if ($result) {
      $msg .= '신규회원 가입을 완료하였습니다.' . PHP_EOL;
      $resultYN = "Y";
    }  else {
      $msg .= '신규회원 가입을 실패하였습니다.' . PHP_EOL;
      $resultYN = "N";      
    }

    //$msg .= Tracer::getInstance()->getMessage();    
    $data = array(  'url'=>$rootPath . 'login',
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function updateMemberModify() {

    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $user_id = $posts['user_id']; 
    $password = $posts['password'];
    $newpassword = $posts['new_password'];
    $email = $posts['email_address']; 

    $returnURL = $context->getServer('REQUEST_URI');    
    $msg = $this->checkValidation($posts);    
    if (isset($msg) && $msg) {
      $resultYN = 'N';
      $data = array(  'url'=>$returnURL,
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    // email validation    
    $check_email=filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($check_email != true) {
      $msg .= '잘못된 E-mail 주소입니다.';
      $resultYN = 'N';
      $data = array(  'url'=>$returnURL,
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    // hobe data
    $hobby = '';
    $index = 0;
    foreach ($posts as $key => $value) {
      if (preg_match('/^hobby+/', $key)) {
        $hobby .= ($index === 0) ? $value : ',' . $value;
        $index++;
      }     
    }
    
    $passwordHash = $context->getPasswordHash($password);
    if (isset($newpassword) && $newpassword) {
      $newpasswordHash = $context->getPasswordHash($newpassword);
    }   

    $where = new QueryWhere();
    $where->set('user_id', $user_id);
    $where->set('password', $passwordHash, '=', 'and');
    $this->model->select('member', '*', $where);

    $rows = $this->model->getRow();
    if ($passwordHash != $rows['password']) {
      $msg .= '등록된 비밀번호와 일치하지 않습니다. <br>다시 입력해주세요.';
      $resultYN = "N";
    } else {

      if (isset($newpasswordHash) && $newpasswordHash) {
        $posts['password'] = $newpasswordHash;
        $filters = '/^(id|category|user_id)+$/i';
      } else {
        $posts['password'] = $passwordHash;
        $filters = '/^(id|category|user_id|password)+$/i';
      }

      if (isset($posts['hp']) && $posts['hp']) {
        $hp = preg_split('/[-]/', $posts['hp']);
        $posts['hp1'] = $hp[0];
        $posts['hp2'] = $hp[1];
        $posts['hp3'] = $hp[2];
      }
     
      $posts['email_address'] = $email;
      $posts['hobby'] = $hobby;

      $cachePath = './files/caches/queries/member.getColumns.cache.php';
      $columnCaches = CacheFile::readFile($cachePath, 'columns');
      if (!$columnCaches) {
        $msg .= "QueryCacheFile Do Not Exists<br>";
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit;
      }
      
      $columns = array();
      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];
        $value = trim($posts[$key]);
      
        if (!preg_match($filters, $key)) {
          if (isset($value) && $value) {         
            $columns[$key] = $value;
          } else {
            if ($rows[$key] !== $value) {
              $columns[$key] = '';
            }           
          }    
        }       
      }

      $result = $this->model->update('member', $columns, $where);
      //$msg .= Tracer::getInstance()->getMessage();
      if ($result) {
        $context->setSession('password', $posts['password']);
        $msg .= '회원정보를 수정하였습니다.';
        $resultYN = "Y";
      } else {
        $msg .= '회원정보 수정을 실패하였습니다.';
        $resultYN = "N";
      }
    }

    $data = array(  'url'=>$returnURL,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function deleteMember() {

    $msg = '';
    $resultYN = 'Y';    

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $user_id = $posts['user_id'];
    $password = $posts['password'];

    $returnURL = $context->getServer('REQUEST_URI');    
    $rootPath = _SUX_ROOT_; 

    $passwordHash = $context->getPasswordHash($password);
    if (empty($passwordHash)) {
      UIError::alertToBack('비밀번호를 입력해주세요.');
      exit();
    }

    $where = new QueryWhere();
    $where->set('user_id', $user_id);
    $where->set('password', $passwordHash, '=', 'and');
    $this->model->select('member', 'category,password', $where);
    
    $row = $this->model->getRow();
    if (preg_match('/^admin/i', $row['category']) == true) {

      $msg .= '관리자 계정입니다. 일반 회원 전환 후 탈퇴 가능합니다.';
      $resultYN = 'N';
    } else {

      if ($passwordHash != $row['password']) {
        $msg .= '비밀번호가 일치하지 않습니다.';
        $resultYN = 'N';
      } else {

        $result = $this->model->delete('member', $where);
        if ($result) {

          $msg = '회원 탈퇴를 완료하였습니다.';
          $resultYN = 'Y';
        } else {

          $msg .= '회원 탈퇴를 실패하였습니다.';
          $resultYN = 'N';
        }
      }
    }    

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  'url'=>$rootPath . 'logout?_method=insert',
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }
}
?>