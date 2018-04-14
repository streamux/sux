<?php

class MemberAdminController extends Controller
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

  function insertGroupAdd() {

    $json = array();
    $msg = '';
    $resultYN = 'Y';

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $prefix = $context->getPrefix();

    foreach ($posts as $key => $value) {
      ${$key} = $value;
    }

    if (empty($category)) {
      UIError::alertToBack('멤버그룹 영문 이름을 입력해주세요.');
      exit;
    }
    
    $where = new QueryWhere();
    $where->set('category', $category);
    $result = $this->model->select('member_group', 'id', $where);
    $rownum = $this->model->getNumrows();

    if ($rownum > 0) {
      UIError::alertToBack("'${category}' 그룹 이름이 이미 존재합니다.");
      exit;
    }

    /**
     * @cache's columns 
     *  페이지에서 넘어온 데이터 값들은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
     */
    $cachePath = './files/caches/queries/member_group.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');

    if (!$columnCaches) {
      $msg .= "QueryCacheFile Do Not Exists<br>";
    } else {
      $columns = array();

      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];
        $value = $posts[$key];

        if (isset($value) && $value) {
          $columns[$key] = $value;
        }        
      } // end of for
      $columns['date'] = 'now()';
    } // end of if

    $result = $this->model->insert('member_group', $columns);

    if ($result) {
      $msg .= "${group_name} 회원그룹을 등록하였습니다.";
      $resultYN = "Y";        
    } else {
      $msg .= "${group_name} 레코드 등록을 실패하였습니다.";
      $resultYN = "N";    
    }

    $where->set('category', $category);
    $this->model->select('member_group', '*', $where);
    $rows = $this->model->getRows();

    $json['msg'] = $msg;
    $json['result'] = $resultYN;
    $json['data'] = $rows;
    
    $this->callback($json);
  }

  function insertGroupCheckid() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $category = $posts['category'];
    $msg = "카테고리 그룹 이름 : ".$category."\n";  
    
    if (!preg_match('/^[a-zA-Z][a-zA-Z0-9_]{3,}$/i', $category)) {
      $msg .= "카테고리 명은 영문,숫자,특수문자('_') 단어만 사용가능합니다.<br>첫글자가 영문 시작되는 4글자 이상 단어를 사용하세요.";

      $data = array(  "result"=>$resultYN,
              "msg"=>$msg);

      $this->callback($data);
      exit;
    } 
    
    if (isset($category)) {
      $where = new QueryWhere();
      $where->set('category', $category);
      $this->model->select('member_group', 'id', $where);
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
        $msg = "'${category}'는 이미 존재하는 카테고리 이름입니다.";
        $resultYN = "N";
      } else {
        $msg = "'${category}'는 사용할 수 있는 카테고리 이름입니다.";
        $resultYN = "Y";
      }
    }else{
      $msg = "카테고리 이름을 넣고 중복체크를 하세요.";
      $resultYN = "N";
    }

    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function updateGroupModify() {

    $json = array();
    $msg = '';
    $resultYN = 'Y';

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $id = $posts['id'];
    
    if (empty($posts)) {
      UIError::alertToBack("그룹 정보가 존재하지 않습니다.");
      exit;
    }

    /**
     * @cache's columns 
     *  페이지에서 넘어온 데이터 값들은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
     */
    $cachePath = './files/caches/queries/member_group.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');

    if ($columnCaches) {
      $columns = array();

      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];
        $value = $posts[$key];

        if (isset($value) && $value) {
          $columns[$key] = $value;
        }          
      }  // end of for

      $columns['date'] = 'now()';
    } else {
      $msg .= "QueryCacheFile Do Not Exists<br>";
    }  // end of if

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('member_group', $columns, $where);

    if (!$result) {
      $msg .= $columns['group_name']  . " 수정을 실패하였습니다.";
      $resultYN = 'N';
    }

    //$msg = Tracer::getInstance()->getMessage();
    $json['msg'] = $msg;
    $json['result'] = $resultYN;

    $this->callback($json);
  }

  function deleteGroupDelete() {

    $dataObj  = '';
    $msg = '';
    $resultYN = 'Y';

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $id = $posts['id'];

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('member_group', 'category', $where);

    $row = $this->model->getRow();
    $category = trim($row['category']);

    if (preg_match('/^administrator$/', $category)) {
      UIError::alertToBack("관리자 그룹은 삭제할 수 없습니다.");
      exit;
    }

    $result = $this->model->delete('member_group', $where);

    if (!$result) {
      $msg .= "${category} 그룹 삭제를 실패하였습니다.";
      $resultYN = "N";        
    } else {
      $where->reset();
      $where->set('category', $category);
      $this->model->delete('member', $where);

      if (!$result) {
        $msg .= "${category} 회원 삭제를 실패하였습니다.";
        $resultYN = "N";
      }
    } // end of if

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "member"=>$dataObj,
                            "result"=>$resultYN,
                            "msg"=>$msg);
    
    $this->callback($data);
  }

  function insertAdd() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();    

    $category = $posts['category'];
    $userId = $posts['user_id'];
    $nickname = $posts['nickname'];
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

    /* Check user_id */
    $where = new QueryWhere();
    $where->set('user_id', $userId);
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

    // Email validation
    $email = $posts['email_address']; 
    $check_email = filter_var($email, FILTER_VALIDATE_EMAIL);

    if ($check_email != true) {
      $msg .= '잘못된 E-mail 주소입니다.';
      $resultYN = 'N';
      $data = array(  'url'=>$returnURL,
                              'result'=>$resultYN,
                              'msg'=>$msg);

      $this->callback($data);
      exit;
    }

    /* Check email */
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

    /* Check nickname*/
    $where = new QueryWhere();
    $where->set('user_id', $userId, '!=');
    $where->set('nickname', $nickname);
    $this->model->select('member', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = "닉네임이 이미 존재합니다.";
      $resultYN = "N";

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
    } //end of for

    $columns['date'] = 'now()';
    $columns['ip'] = $context->getServer('REMOTE_ADDR');
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

  function updateModify() {

    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $id = $posts['id'];
    $category = $posts['category'];
    $userId = $posts['user_id'];
    $nickname = $posts['nickname'];
    $email = $posts['email_address'];

    $returnURL = $context->getServer('REQUEST_URI');
    $msg = $this->checkValidation($posts);
    $posts['password'] = $context->getPasswordHash($posts['password']);

    if (isset($posts['new_password']) && $posts['new_password']) {
      $newPassword = $context->getPasswordHash($posts['new_password']);
    }

    // impossible to change amin's category
    $where = QueryWhere::getInstance();
    $where->set('user_id', $userId);
    $where->set('nickname', $nickname);
    $where->set('email_address', $email);
    $this->model->select('member', 'category', $where);
    $numrow = $this->model->getNumrows();

    if ($numrow > 0) {
      $row = $this->model->getRow();

      if ($category !== $row['category']) {
        $msg .= '최초 설치 관리자는 일반회원으로 전환이 불가합니다.';
      }      
    }

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

    /* Check email */
    $where = new QueryWhere();
    $where->set('user_id', $userId, '!=');
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

    /* Check nickname*/
    $where->reset();
    $where->set('user_id', $userId, '!=');
    $where->set('nickname', $nickname);
    $this->model->select('member', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = "닉네임이 이미 존재합니다.";
      $resultYN = "N";

      $data = array(  'url'=>$returnURL,
                              'result'=>$resultYN,
                              'msg'=>$msg);

      $this->callback($data);
      exit;
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

    if (isset($posts['hp']) && $posts['hp']) {
      $hp = preg_split('/[-]/', $posts['hp']);
      $posts['hp1'] = trim($hp[0]);
      $posts['hp2'] = trim($hp[1]);
      $posts['hp3'] = trim($hp[2]);
    }

    $ignorePattern = 'id';
    $columns = array(); 

    foreach ($columnCaches as $key) {
      if ($ignorePattern !== $key) {
        $value = $posts[$key];

        if (isset($value)) {
          $columns[$key] = $value;
        }
      }  // end of if
    }  // end of foreach

    $where = QueryWhere::getInstance();
    $where->set('id', $id);
    $where->set('password', $columns['password'], '=', 'and');
    $result = $this->model->select('member', 'password', $where);
    $numrow = $this->model->getNumrows();

    if ($numrow > 0 ) {
      $row = $this->model->getRow();

      if ($row['password'] === $columns['password']) {
        if (isset($newPassword) && $newPassword) {
          $columns['password'] = $newPassword;
        }

        $result = $this->model->update('member', $columns, $where);
        if (!$result) {
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

          foreach ($buffer['admin_info'] as $key => $value) {
            $context->setSession($key, $value);
          }
          
          $msg .= "'${nickname}' 님의 회원정보 수정을 실패하였습니다." . PHP_EOL;
          $resultYN = "N";  
        }
      } else {        
        $msg .= '비밀번호가 일치하지 않습니다.' . PHP_EOL;
        $resultYN = 'N';
      }
    } else {
      $msg .= '일치하는 정보가 존재하지 않습니다.';
      $resultYN = 'N';
    }
    
    //$msg .= Tracer::getInstance()->getMessage();
    $json = array(  'result'=>$resultYN,
                            'msg'=>$msg);

    $this->callback($json);
  }
  
  function deleteDelete() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    $id = $posts['id'];
    $userId = $posts['user_id'];

    $dataObj  = null;
    $msg = '';
    $resultYN = 'Y';

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('member', 'category', $where);
    $numrow = $this->model->getNumrows();

    if ($numrow > 0) {
      $row = $this->model->getRow();

      if (preg_match('/^administrator$/', $row['category'])) {
        UIError::alertToBack("관리자 계정입니다. 일반 회원 전환 후 탈퇴 가능합니다.");
        exit;
      }
    }

    

    $result = $this->model->delete('member', $where);
    if ($result) {

      $msg .= "${userId} 회원정보를 삭제하였습니다.";
      $resultYN = "Y";
    } else {
      
      $msg .= "${userId} 회원정보 삭제를 실패하였습니다.";
      $resultYN = "N";  
     }

    //$msg = Tracer::getInstance()->getMessage();
    $data = array(  'member'=>$dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }
}
?>