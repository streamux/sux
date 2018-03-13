<?php

class BoardAdminController extends Controller
{
  // Form Value Validation && Security
  function getFormCheckList() {

    return array(  array('key'=>'nickname', 'msg'=>'닉네임을'),
                          array('key'=>'password', 'msg'=>'비밀번호를'),
                          array('key'=>'title', 'msg'=>'제목을'),
                          array('key'=>'content', 'msg'=>'내용을'));
  }

  function getModifyFormCheckList() {

    return array(  array('key'=>'title', 'msg'=>'제목을'),
                          array('key'=>'content', 'msg'=>'내용을'));
  }

  function getIntegerFields() {

    return array('id', 'readed_count', 'voted_count', 'blamed_count', 'igroup_count', 'space_count');
  }

  function getNoneTagFields() {

    return array('category', 'is_notice', 'user_id', 'user_name', 'nickname', 'password', 'email_address', 'progress_step', 'wall', 'contents_type');
  }

  function getSimpleTagFields() {

    return array('title');
  }

  function setEncodeFormValue($input) {

    $input = FormSecurity::encodeToInteger($input, $this->getIntegerFields());
    $input = FormSecurity::encodeWithoutTags($input, $this->getNoneTagFields());
    $input = FormSecurity::encodeWithSimpleTags($input, $this->getSimpleTagFields());

    $input = FormSecurity::encodes($input);

    return $input;
  }
  // end 

  function getUniqueId() {

    return 'Guest' . Utils::getMicrotimeInt();
  }

  function insertAdd() {

    $msg = '';
    $resultYN = 'Y';
    $rootPath = _SUX_ROOT_;
    $saveDir = _SUX_PATH_ . "files/board/";

    $context = Context::getInstance();
    $sessions = $context->getSessionAll();
    $posts = $context->getPostAll();    
    $files = $context->getFiles();

    // security - ref : utils/Forms.class.php
    Forms::validates($posts, $this->getFormCheckList());
    Forms::validateFile($files);
    $posts = $this->setEncodeFormValue($posts);

    $posts['user_id'] = empty($sessions['user_id']) ? $this->getUniqueId() : $sessions['user_id'];
    $posts['password'] = empty($sessions['password']) ?  $context->getPasswordHash($posts['password']) : $sessions['password'];

    $returnURL = $context->getServer('REQUEST_URI');
    $category = $posts['category']; 
    $wall = $posts['wall'];
    $wallname = $posts['wallname'];
    $wallok = $posts['wallok'];
    $imageUpName = $files['imgup']['name'];
    $imageUpTempName = $files['imgup']['tmp_name'];

    if ($wallname !== $wallok) {
      $msg = '경고! 잘못된 등록키입니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }    

    if (is_uploaded_file($imageUpTempName )) {
      $mktime = mktime();
      $imageUpName =$mktime . "_" . $imageUpName;
      $dest = $saveDir . $imageUpName;

      if (!move_uploaded_file($imageUpTempName , $dest)) {
        $resultYN = 'N';
        $msg .= '파일을 지정한 디렉토리에 저장하는데 실패했습니다.';
      }
    }

    $where = new QueryWhere();
    $where->set('category', $category, '=');
    $this->model->select('board', 'id', $where, 'id desc', 0, 1);
    $row = $this->model->getRow();
    $igroup_count = $row['id'] + 1;

    $cachePath = './files/caches/queries/board.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');

    if ($columnCaches) {
      $columns = array();

      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];

        // image file
        if (strpos($key, 'file') !== false) {

          // filetype의 'type' 추출 
          $prop = substr($key, 4);
          $value = $files['imgup'][$prop];  

          if ($prop === 'name') {
            $value = $imageUpName;
          }

          if (isset($value) && $value) {
            $columns[$key] = $value;
          }
        } else {
          $value = $posts[$key];
          
          if (isset($value) && $value ) {
            $columns[$key] = $value;
          }
        } // end of if
      } // end of for

      $columns['igroup_count'] = $igroup_count;
      $columns['date'] = 'now()';
      $columns['ip'] = $context->getServer('REMOTE_ADDR');
    } else {
      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $result = $this->model->insert('board', $columns);
    if (!isset($result)) {
      $resultYN = 'N';
      $msg .= '글을 저장하는데 실패했습니다.';
    }

    /*Tracer::getInstance()->output();
    return;*/
    $data = array(  'url'=>$rootPath . $category,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data); 
  }

  function updateModify() {

    $msg = '';
    $resultYN = 'Y';

    $context = Context::getInstance();
    $sessions = $context->getSessionAll();
    $posts = $context->getPostAll();
    $files = $context->getFiles();
    
    Forms::validates($posts, $this->getModifyFormCheckList());
    Forms::validateFile($files);
    $posts = $this->setEncodeFormValue($posts);

    $returnURL = $context->getServer('REQUEST_URI');
    $category = $posts['category'];
    $id = $posts['id'];
    $nickname = $posts['nickname'];
    $passwordHash = $context->getPasswordHash($posts['password']);
    $adminPassword = $context->getAdminInfo('admin_pwd');
    $adminPasswordHash = $context->getPasswordHash($adminPassword);
    $imageUpName = $files['imgup']['name'];
    $imageUpTempName = $files['imgup']['tmp_name'];

    $wall = $posts['wall'];
    $wallname = $posts['wallname'];
    $wallok = $posts['wallok'];

    if ($wallname !== $wallok) {
      $msg = '경고! 잘못된 등록키입니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    } 
   
    $rootPath = _SUX_ROOT_;
    $saveDir = _SUX_PATH_ . "files/board/";
    
    $where = new QueryWhere();
    $where->set('id', $id, '=');
    $this->model->select('board','password, igroup_count, filename', $where);
    $numrow = $this->model->getNumRows();

    if ($numrow > 0) {      
      $row = $this->model->getRow();
   
      if ($passwordHash === $adminPasswordHash) { 
        $delFileName = $row['filename'];

        if ($delFileName) {
          $delFileName = $saveDir . $delFileName;

          if(!@unlink($delFileName)) {
            $resultYN = 'N';
            $msg .= "' " . $delFileName . "' 파일삭제를 실패했습니다.";
          } 
        }

        if (is_uploaded_file($imageUpTempName)) {
          $mktime = mktime();
          $imageUpName = $mktime."_".$imageUpName;
          $dest = $saveDir . $imageUpName;

          if (!move_uploaded_file($imageUpTempName, $dest)) {
            $resultYN = 'N';
            $msg .= "파일을 지정한 디렉토리에 저장하는데 실패했습니다.";  
          }
        }
        $context->set('fileup_name', $imageUpName);
        $cachePath = './files/caches/queries/board.getColumns.cache.php';
        $columnCaches = CacheFile::readFile($cachePath, 'columns');

        if (!$columnCaches) {
          $msg .= "QueryCacheFile Do Not Exists<br>";
        } else {
          $regFilters = '/^(category|id|password|user_id|user_name)+$/';
          $columns = array();

          for($i=0; $i<count($columnCaches); $i++) {
            $key = $columnCaches[$i];
            
            if (strpos($key,'file') !== false) {
              $option = substr($key, 4);  
              $value = $files['imgup'][$option];

              if ($option === 'name') {
                $value = $imageUpName;
              } 

              if (isset($value) && $value) {
                $columns[$key] = $value;
              } else {
                $columns[$key] = '';
              }
            } else {

              if (!preg_match($regFilters, $key)) {
                $value = $posts[$key];

                if (isset($value) && $value) {
                  $columns[$key] = $value;
                }              
              }
            }             
          }
        }

        $result = $this->model->update('board', $columns, $where);        
        if (!isset($result)) {
          $msg .= '글을 수정하는데 실패했습니다.';
          UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
          exit();
        }
      } else {
        $msg .= '관리자 로그인이 필요합니다.';
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit();
      }
    } else {
      $msg .= '데이터가 존재하지 않습니다..';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
    }

    /*Tracer::getInstance()->output();
    return;*/

    $data = array(  'url'=>$rootPath . 'board-admin/list',
                            'result'=>$resultYN,
                            'msg'=>$msg,
                            'delay'=>0);

    $this->callback($data); 
  }

  function deleteDelete() {

    $msg = '';
    $resultYN = 'Y';
    $rootPath = _SUX_ROOT_;
    $deletePath = _SUX_PATH_ . "files/board/";    

    $context = Context::getInstance();
    $posts =  $context->getPostAll();
    $sessions = $context->getSessionAll();

    Forms::validates($posts);
    $posts = FormSecurity::encodes($posts);
    $returnURL = $context->getServer('REQUEST_URI');    
    $password = trim($sessions['password']);
    $id = $posts['id'];

    if (empty($password)) {
      $msg .= '관리자 로그인을 입력해주세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }
    
    $passwordHash = $context->getPasswordHash($password);
    $adminPassword = $context->getAdminInfo('admin_pwd');
    $adminPasswordHash = $context->getPasswordHash($adminPassword);
    
    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board', 'password,filename', $where); 
    $row = $this->model->getRow();    

    if (($passwordHash == $row['password']) || ($passwordHash == $adminPasswordHash)) {
      $delFileName = $row['filename'];

      if(isset($delFileName) && $delFileName != '') {
        $deletePath = $deletePath . $delFileName;

        if(!@unlink($deletePath)) {
          $resultYN = 'N';
          $msg .= '파일삭제를 실패하였습니다.';
        } 
      }
      
      $where = new QueryWhere();
      $where->set('id', $id);
      $result = $this->model->delete('board', $where);

      if (!isset($result)) {
        $msg .= '글을 삭제하는데 실패했습니다.';
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit;
      }
    } else  {
      $msg .= '비밀번호가 맞지 않습니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
      exit;
    }

    $data = array(  'url'=>$rootPath . $category,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data);
  }

  function insertGroupAdd() {

    $msg = '';
    $resultYN = 'Y';
    $dataObj = array();

    $context = Context::getInstance();
    $context->setCookieVersion();
    $posts = $context->getPostAll(); 
    $returnURL = $context->getServer('REQUEST_URI');

    $category = strtolower($posts['category']);
    $posts['category'] = $category;
    

    /**
     * @cache's columns 
     *  페이지에서 넘어온 데이터 값들은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
     */
    $cachePath = './files/caches/queries/board_group.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');

    if (!$columnCaches) {
      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }
    
    foreach ($columnCaches as $key => $value) {

      if (isset($posts[$value]) && $posts[$value]) {  
        ${$value} = $posts[$value];
      } 
    }

    if (empty($category)) {
      $msg = '카테고리를 입력해주세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
    }

    if (empty($board_name)) {
      $board_name = $category;
    }

    $where = new QueryWhere();
    $where->set('category', $category);
    $this->model->select('board_group','id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = $category . '이미 등록된 게시판 입니다. 다시 생성해 주세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $where = new QueryWhere();
    $where->set('category', $category);
    $this->model->select('document','id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows> 0) {
      $msg = "페이지관리에 이미 등록된 이름입니다. 다른 이름을 사용해주세요.";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    } 

    $columns = array();

    foreach ($columnCaches as $index => $key) {
      $value = $posts[$key];

      if (isset($value) && $value) {
        $columns[$key] = $value;
      }
    } //end of foreach

    $columns['date'] = 'now()';
    $result = $this->model->insert('board_group', $columns);

    if ($result) {
      $msg .= "게시판 생성을 완료하였습니다.<br>";

       $id = $this->model->getInsertId();
        $where = new QueryWhere();
        $where->set('id', $id);

        $this->model->select('board_group', '*', $where);
        $dataObj = $this->model->getRows();

      // 라우트 키 저장 
      $routes = array();      
      $filePath = './files/caches/routes/board.cache.php';
      $routeCaches  = CacheFile::readFile($filePath);

      if (isset($routeCaches) && $routeCaches) {
        $routes['categories'] = $routeCaches['categories'];
        $routes['action'] = $routeCaches['action'];
        $pattern = sprintf('/(%s)+/i', $category);

        if (!preg_match($pattern, implode(',', $routes['categories']))) {
          //array_push($routes['categories'], $category); 
          $routes['categories'][] = $category;  
        }
        CacheFile::writeFile($filePath, $routes);
      }

      $adminId = $context->getAdminInfo('admin_id');
      $adminPassword = $context->getAdminInfo('admin_pwd');
      $adminNickname = $context->getAdminInfo('admin_nickname');
      $adminEmail = $context->getAdminInfo('admin_email');

      $columns = array();
      $columns['category'] = $category;
      $columns['user_id'] = $adminId;
      $columns['user_name'] = $adminNickname;
      $columns['nickname'] = $adminNickname;
      $columns['password'] = $adminPassword;
      $columns['title'] = '게시판 시동 테스트';
      $columns['content'] = "본 게시물은 게시판 시동을 위해 자동 등록된 것입니다.<br>본 게시물을 삭제하기 전에 반드시 하나를 등록하시기 바랍니다.";

      $columns['email_address'] = $adminEmail;
      $columns['date'] = 'now()';
      $columns['ip'] = $context->getServer('REMOTE_ADDR');
      $result = $this->model->insert('board', $columns);

      if (!$result) {
        $msg .= "시동 게시글 등록을 실패하였습니다.<br>";
        $resultYN = 'N';    
      }

      $columns = array();
      $columns['category'] = $category;
      $columns['menu_name'] = $board_name;
      $columns['url'] = $category;
      $columns['date'] = 'now()';
      $result = $this->model->insert('menu', $columns);

      if (!$result) {
        $msg .= "메뉴 등록을 실패하였습니다.<br>";
        $resultYN = 'N';
      } 
    } else {
      $msg .= "${category}게시판 생성을 실패하였습니다.<br>";
      $resultYN = 'N';
    } 

    //$msg .= Tracer::getInstance()->getMessage();
    $json = array(  "data"=> $dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($json);
  }

  function updateGroupModify() {

    $dataObj = array();
    $resultYN = "Y";
    $msg = "";

    $context = Context::getInstance();
    $context->setCookieVersion();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $category = $posts['category'];
    $title = $posts['board_name'];
    $returnURL = $context->getServer('REQUEST_URI');

    /**
     * @cache's columns 
     *  페이지에서 넘어온 데이터 값들은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
     */
    $cachePath = './files/caches/queries/board_group.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');
    if (!$columnCaches) {
      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $filters = '/^(id|category|date)+$/i';
    $columns = array();
    foreach ($columnCaches as $key => $value) {
      if (!preg_match($filters, $value)) {
        if (isset($posts[$value]) && $posts[$value]) {
          $columns[$value] = $posts[$value];
        } else {
          $columns[$value] =  '';
        }
      }             
    }

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('board_group', $columns, $where);
    if ($result) {
      $this->model->select('board_group', '*', $where);
      $dataObj = $this->model->getRows();

      // 라우트 키 저장 
      $routes = array();      
      $filePath = './files/caches/routes/board.cache.php';
      $routeCaches  = CacheFile::readFile($filePath);
      if (isset($routeCaches) && $routeCaches) {
        $routes['categories'] = $routeCaches['categories'];
        $routes['action'] = $routeCaches['action'];

        $pattern = sprintf('/(%s)+/i', $category);
        if (!preg_match($pattern, implode(',', $routes['categories']))) {
          //array_push($routes['categories'], $category); 
          $routes['categories'][] = $category;      
        }
        CacheFile::writeFile($filePath, $routes);
      }

      // insert into menu 
      $where->reset();
      $where->set('category', $category);
      $result = $this->model->select('menu', 'id', $where);
      if ($result) {
        $numrows = $this->model->getNumRows();
        if ($numrows > 0) {
          $columns = array();
          $columns['menu_name'] = $title;
          $columns['url'] = $category;
          
          $result = $this->model->update('menu', $columns, $where);
          if (!$result) {
            $msg .= "메뉴 업데이트를 실패하였습니다.";
            $resultYN = 'N';
          }
        } else {
          $columns = array();
          $columns['category'] = $category;
          $columns['menu_name'] = $title;
          $columns['url'] = $category;
          $columns['date'] = 'now()';

          $result = $this->model->insert('menu', $columns);
          if (!$result) {
            $msg .= "메뉴 등록을 실패하였습니다.<br>";
            $resultYN = 'N';
          }
        }
      }     
    } else {
      $msg .= "$category 게시판 수정을 실패하였습니다.";
      $resultYN = "N";  
    }

    //$msg = Tracer::getInstance()->getMessage();
    $data = array(  "data"=> array('list'=>$dataObj),
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function deleteGroupDelete() {

    $context = Context::getInstance();
    $context->setCookieVersion();
    $posts = $context->getPostAll();

    $category = $posts['category'];
    $id = $posts['id'];

    $dir = _SUX_PATH_ . 'board_data/';

    $resultYN = "Y";
    $msg = "";
    
    $where = new QueryWhere();
    $where->set('category', $category);
    $result = $this->model->select('board', 'id', $where);
    if ($result) {

    }

    $where->reset();
    $i = $this->model->getNumRows();
    $rows = $this->model->getRows();
    while ( $i--) {
      $cid = $rows[$i]['id'];
      $where->set('content_id', $cid, '=', 'or');      
    }

    $result = $this->model->delete('comment', $where);
    if (!$result) {
      $msg .= "답글 삭제를 실패했습니다.<br>";
      $resultYN = "N";
    }

    $where->reset();
    $where->set('category', $category);
    $result = $this->model->delete('board', $where);
    if (!$result) {
      $msg .= "게시글 삭제를 실패했습니다.<br>";
      $resultYN = "N";
    } 

    $where->reset();
    $where->set('id', $id);
    $result = $this->model->delete('board_group', $where);
    if (!$result) {
      $msg .= "${category} 게시판 삭제를 실패했습니다.<br>";
      $resultYN = "N";
    } else {

      // 라우트 카테고리 키 삭제  
      $filePath = _SUX_PATH_ . 'files/caches/routes/board.cache.php';
      $routes = CacheFile::readFile($filePath);
      $len = count($routes['categories']);
      for($i=0; $i<$len; $i++) {
        $input = $routes['categories'][$i];
        //$msg .= $input . '  ';
        if ($input === $category) {
          array_splice($routes['categories'], $i, 1);
          break;
        }
      }

      $result = CacheFile::writeFile($filePath, $routes);
      if (!$result) {
        $msg .= "라우트 키 삭제를 실패했습니다.<br>";
        $resultYN = "N";
      }

      $where->reset();
      $where->set('category', $category);
      $result = $this->model->delete('menu', $where);
      if (!$result) {
        $msg .= "메뉴 삭제를 실패했습니다.<br>";
        $resultYN = "N";
      }
    }

    if ($resultYN ==='Y') {
      $msg = $category . ' 게시판이 성공적으로 삭제되었습니다.';
    } 
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }
}
