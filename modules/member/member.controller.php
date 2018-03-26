<?php

class MemberController extends Controller
{
  function checkValidation( $post ) {

    $labelList = array('아이디를','이메일을','닉네임을','이름을','비밀번호를');
    $ckeckList = array('user_id','email_address','nickname','user_name','password');

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
    $adminInfo = $context->getAdminInfo();
    $category = trim($posts['category']);

    if (empty($category)) {
      $category = 'member'; // 초기 가입 시 기본회원
    }

    $userId = trim($posts['user_id']);
    $userName = trim($posts['user_name']);

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
    $email=filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($email != true) {
      $msg .= '잘못된 E-mail 주소입니다.';
      $resultYN = 'N';
      $data = array(  'url'=>$returnURL,
              'input_name'=>'email_address',
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    $passwordHash = $context->getPasswordHash($posts['password']);
    $posts['password'] = $passwordHash;
    $posts['email_address'] = $email;
    $posts['hobby'] = $hobby;

    /* Check user_id*/
    $where = new QueryWhere();
    $where->set('user_id', $userId);
    $this->model->select('member', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = "아이디가 이미 존재합니다.";
      $resultYN = "N";

      $data = array(  'url'=>$returnURL,
              'input_name'=>'user_id',
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
              'input_name'=>'email_address',
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    /* check nickname */
    $where->reset();
    $where->set('nickname', $nickname);
    $this->model->select('member', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = "닉네임이 이미 존재합니다. 다른 닉네임을 등록하세요.";
      $resultYN = "N";

      $data = array( 'url'=>$returnURL,
              'input_name'=>'nickname',
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
        $columns[$key] = $value;
      }        
    }

    $columns['grade'] = 1;
    $columns['date'] = 'now()';
    $columns['ip'] = $context->getServer('REMOTE_ADDR');
    $result = $this->model->insert('member', $columns);

    if ($result) {
      $msg .= '신규회원 가입을 완료하였습니다.' . PHP_EOL;
      $resultYN = "Y";

      $id = $this->model->getLastInsertId();
      $where = QueryWhere::getInstance();
      $where->set('id', $id);
      $this->model->select('member', 'user_id, user_name, email_address, date', $where);
      $row = $this->model->getRow();

      $userId = $row['user_id'];
      $userName = $row['user_name'];
      $userEmail = $row['email_address'];
      $joinDate = $row['date'];

      $emailSkinPath = _SUX_PATH_ . 'modules/mails/templates/member_join.html';
      $emailLogoPath = _SUX_PATH_ . 'common/images/sux_logo.svg';
      $sendedMail = $context->getSession('sx_sended_join_mail');

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

        $replaceList = array(          
          'join_date'=>$joinDate,
          'user_id'=>$userId,
          'user_name'=>$userName,
          'email_address'=>$userEmail,
          'mail_logo'=>$mailLogo
        );

        foreach ($replaceList as $key => $value) {
          $reg = sprintf('{$%s}',$key);
          $messages = str_replace($reg, $value, $messages);
        }

        $to = "${userName}<${userEmail}>";
        $from = "${adminName}<${adminEmail}>";
        $subject = "[${adminDomain}] ${userName}님의 회원가입을 환영합니다.";

        Mail::send($adminEmail, $subject, $messages, $from, $reply);
        Mail::send($to, $subject, $messages, $from, $reply);

        $context->setSession('sx_sended_join_mail', 'ok');      
      }
    }  else {
      $msg .= '신규회원 가입을 실패하였습니다.' . PHP_EOL;
      $resultYN = "N";      
    }

    //$msg .= Tracer::getInstance()->getMessage();    
    $data = array( 'url'=>$rootPath . 'login',
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function updateMemberModify() {

    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $userId = $posts['user_id']; 
    $nickname = $posts['nickname']; 
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

    $where = QueryWhere::getInstance();
    $where->set('user_id', $userId, '!=');
    $where->set('email_address', $email);
    $this->model->select('member', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = "이미 사용된 이메일 입니다. 다른 이메일을 등록하세요.";
      $resultYN = "N";

      $data = array(  'url'=>$returnURL,
              'input_name'=>'email_address',
              'result'=>$resultYN,
              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    /* check nickname */
    $where->reset();
    $where->set('user_id', $userId, '!=');
    $where->set('nickname', $nickname);
    $this->model->select('member', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = "닉네임이 이미 존재합니다. 다른 닉네임을 등록하세요.";
      $resultYN = "N";

      $data = array( 'url'=>$returnURL,
              'input_name'=>'nickname',
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
    $where->set('user_id', $userId);
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
      
        if (!preg_match($filters, $key) && isset($value) && $value) {
          $columns[$key] = $value;
        }       
      }

      $result = $this->model->update('member', $columns, $where);      
      if ($result) {
        $this->model->select('member', 'user_id,password,user_name,nickname,email_address,yoursite',$where);
        $row = $this->model->getRow();
        $buffer = array();
        $buffer['admin_info'] = array();
        $buffer['admin_info']['admin_id'] = $row['user_id'];
        $buffer['admin_info']['admin_pwd'] = $row['password'];
        $buffer['admin_info']['admin_name'] = $row['user_name'];
        $buffer['admin_info']['admin_nickname'] = $row['nickname'];
        $buffer['admin_info']['admin_email'] = $row['email_address'];
        $buffer['admin_info']['yourhome'] = $row['yoursite'];

        $filePath = 'files/config/config.admin.php';
        CacheFile::writeFile($filePath, $buffer);

        foreach ($columns as $key => $value) {
          $context->setSession($key, $value);
        }

        $msg .= '회원정보를 수정하였습니다.';
        $resultYN = "Y";
      } else {
        $msg .= '회원정보 수정을 실패하였습니다.';
        $resultYN = "N";
      }
    }

    //$msg .= Tracer::getInstance()->getMessage();
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
    $userId = $posts['user_id'];
    $password = $posts['password'];

    $returnURL = $context->getServer('REQUEST_URI');    
    $rootPath = _SUX_ROOT_; 
    $passwordHash = $context->getPasswordHash($password);

    if (empty($passwordHash)) {
      UIError::alertToBack('비밀번호를 입력해주세요.');
      exit();
    }

    $where = new QueryWhere();
    $where->set('user_id', $userId);
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