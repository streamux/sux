<?php

class BoardController extends Controller
{

  // Form Value Validation && Security
  function getFormCheckList() {

    return array(  array('key'=>'user_name', 'msg'=>'이름을'),
                          array('key'=>'password', 'msg'=>'비밀번호를'),
                          array('key'=>'title', 'msg'=>'제목을'),
                          array('key'=>'contents', 'msg'=>'내용을'));
  }

  function getIntegerFields() {

    return array('id', 'readed_count', 'voted_count', 'blamed_count', 'igroup_count', 'space_count');
  }

  function getNoneTagFields() {

    return array('category', 'is_notice', 'user_id', 'user_name', 'nick_name', 'password', 'email_address', 'progress_step', 'wall', 'contents_type');
  }

  function getSimpleTagFields() {

    return array('title');
  }

  function setEncodeFormValue($input) {

    $input = FormSecurity::encodeByInteger($input, $this->getIntegerFields());
    $input = FormSecurity::encodeByNonTags($input, $this->getNoneTagFields());
    $input = FormSecurity::encodeBySimpleTags($input, $this->getSimpleTagFields());
    $input = FormSecurity::encodes($input);

    return $input;
  }
  // end 

  function getUniqueId() {

    return 'Guest' . Utils::getMicrotimeInt();
  }

  function insertWrite() {

    $msg = '';
    $resultYN = 'Y';

    $context = Context::getInstance();
    $sessions = $context->getSessionAll();
    $posts = $context->getPostAll();    
    $files = $context->getFiles();

    // security - ref : utils/Forms.class.php
    Forms::validates($posts, $this->getFormCheckList());
    Forms::validateFile($files);
    $posts = $this->setEncodeFormValue($posts);

    /*echo $posts['contents'];
    return;*/
    
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

    $rootPath = _SUX_ROOT_;
    $saveDir = _SUX_PATH_ . "files/board/";

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
    
    Forms::validates($posts, $this->getFormCheckList());
    Forms::validateFile($files);
    $posts = $this->setEncodeFormValue($posts);

    $returnURL = $context->getServer('REQUEST_URI');
    $category = $posts['category'];
    $id = $posts['id'];
    $user_name = $posts['user_name'];
    $passwordHash = $context->getPasswordHash($posts['password']);
    $adminPassword = $context->getAdminInfo('admin_pwd');
    $adminPasswordHash = $context->getPasswordHash($adminPassword);
    $imageUpName = $files['imgup']['name'];
    $imageUpTempName = $files['imgup']['tmp_name'];
   
    $rootPath = _SUX_ROOT_;
    $saveDir = _SUX_PATH_ . "files/board/";
    
    $where = new QueryWhere();
    $where->set('id', $id, '=');
    $where->set('user_name', $user_name, '=');
    $where->set('password', $passwordHash, '=', 'and');
    $this->model->select('board','password, igroup_count, filename', $where);

    /*Tracer::getInstance()->output();
    echo $passwordHash . ' : ' . $row['password'];
    return;*/

    $numrow = $this->model->getNumRows();
    if ($numrow > 0) {      
      $row = $this->model->getRow();
   
      if (($passwordHash === $row['password']) || ($passwordHash === $adminPasswordHash)) { 
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
        $msg .= '비밀번호가 맞지 않습니다.';
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit();
      }
    } else {
      $msg .= '정보가 일치하지 않습니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
    }

    //$msg .=  "<br>" . Tracer::getInstance()->getMessage();
    //return;

    $data = array(  'url'=>$rootPath . $category,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data); 
  }

  function insertReply() {

    $resultYN = 'Y';
    $msg = '';

    $context = Context::getInstance();
    $sessions = $context->getSessionAll();
    $posts = $context->getPostAll();
    $files = $context->getFiles();

    Forms::validates($posts, $this->getFormCheckList());
    Forms::validateFile($files);
    $posts = $this->setEncodeFormValue($posts);
    $posts['user_id'] = empty($sessions['user_id']) ? $this->getUniqueId() : $sessions['user_id'];

    $returnURL = $context->getServer('REQUEST_URI');
    $category = $posts['category'];
    $id = $posts['id'];
    $posts['password'] = empty($sessions['password']) ?  $context->getPasswordHash($posts['password']) : $sessions['password'];

    $igroup_count = $posts['igroup_count'];
    $space_count = $posts['space_count'];
    $ssunseo_count = $posts['ssunseo_count'];

    $wallname = $posts['wallname'];
    $wallok = $posts['wallok'];
    $imageUpName = $files['imgup']['name'];
    $imageUpTempName = $files['imgup']['tmp_name'];

    if ($wallname !== $wallok) {
      $msg = '경고! 잘못된 등록키입니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }
    
    $rootPath = _SUX_ROOT_;
    $saveDir = _SUX_PATH_ . "files/board/";

    if (is_uploaded_file($imageUpTempName )) {      
      $mktime = mktime();
      $imageUpName = $mktime . "_" . $imageUpName;
      $dest = $saveDir . $imageUpName;

      if (!move_uploaded_file($imageUpTempName , $dest)) {
        $resultYN = 'N';
        $msg .= '파일을 지정한 디렉토리에 저장하는데 실패했습니다.'; 
      }
      $this->imageUpName = $imageUpName;
    } 

    $columns = array('ssunseo_count' => '(ssunseo_count+1)');

    $where = new QueryWhere();
    $where->set('ssunseo_count', $ssunseo_count, '>');
    $where->set('igroup_count', $igroup_count, '=','and');
    $result = $this->model->update('board',$columns, $where);
    if (!isset($result)) {
      $resultYN = 'N';
      $msg .= '순서를 변경하는데 실패했습니다'; 
    }

    $cachePath = './files/caches/queries/board.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');
    if ($columnCaches) {

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
            $columns[] = $value;
          } else {
            $columns[] = '';
          }
        } else {

          $value = $posts[$key];
          if ((isset($value) && $value) || is_numeric($value)) {

            if ($key === 'space_count') {
              $value = $space_count + 1;
            } else if ($key === 'ssunseo_count') {
              $value = $ssunseo_count + 1;
            }

            $columns[$key] = $value;
          } else {
            if ($key === 'is_notice') {
              $columns[] = 'n';
            } else if ($key === 'date') {
              $columns[] = 'now()';
            } else if ($key === 'ip') {
              $columns[] = $context->getServer('REMOTE_ADDR');
            }  else {
              $columns[] = '';
            }       
          }
        } // end of if
      } // end of for

      $columns['date'] = 'now()';
      $columns['ip'] = $context->getServer('REMOTE_ADDR');
    } else {

      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }
    
    $result = $this->model->insert('board', $columns);
    if (!isset($result)) {
      $msg .= '답글을 저장하는데 실패했습니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $data = array(  'url'=>$rootPath . $category,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data); 
  }

  function deleteDelete() {

    $context = Context::getInstance();
    $posts =  $context->getPostAll();

    Forms::validates($posts);
    $posts = FormSecurity::encodes($posts);

    $returnURL = $context->getServer('REQUEST_URI');    
    $password = trim($posts['password']);
    if (empty($password)) {
      $msg .= '비밀번호를 입력해주세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $category = $posts['category'];
    $id = $posts['id'];

    $rootPath = _SUX_ROOT_;
    $deletePath = _SUX_PATH_ . "files/board/";
    $msg = '';
    $resultYN = 'Y';

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

  function updateProgressStep() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $returnURL = $context->getServer('REQUEST_URI');
    $category = $posts['category'];
    $id = $posts['id'];
    $progressStep = $posts['progress_step'];

    $rootPath = _SUX_ROOT_;
    $msg = '';
    $resultYN = 'Y';

    $cachePath = './files/caches/queries/board.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');
    if (!$columnCaches) {
      $msg .= "QueryCacheFile Do Not Exists<br>";
    } else {
      $columns = array();
      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];     
        $value = $posts[$key];
        if (isset($value) && $value) {
          if (!preg_match('/^(id|category)+$/', $key)) {
            $columns[$key] = $value;
          }             
        }     
      }
    }
    
    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('board', $columns, $where);
    if (!isset($result)) {
      $msg .= '진행상황 설정을 실패하였습니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $data = array(  'url'=>$rootPath . $category . '/' . $id,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data);
  }

  function insertComment() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $returnURL = $context->getServer('REQUEST_URI');
    $category = $posts['category'];
    $id = $posts['contents_id'];

    $rootPath = _SUX_ROOT_;
    $msg = '';
    $resultYN = 'Y';

    $checkLabel = array('이름을', '비밀번호를', '내용을');
    $checkList = array('nickname', 'password', 'comment');

    $index = 0;
    foreach ($checkList as $key => $value) {      
      if (empty($posts[$value])) {
        $msg = $checkLabel[$index] . ' 입력해주세요.';
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        return false;
      }
      $index++;
    }

    $cachePath = './files/caches/queries/comment.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');
    if ($columnCaches) {

      $columns = array();
      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];

        //$msg .= $key . "<br>";
        $value = $posts[$key];
        if (isset($value) && $value) {
          if ($key === 'password') {
            $value = $context->getPasswordHash($value); 
          }
          $columns[$key] = $value;              
        }
      } //end of for

      $columns['date'] = 'now()';
    } else {

      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit();
    }

    $result = $this->model->insert('comment', $columns);
    //$msg .= Tracer::getInstance()->getMessage();
    if (!$result) {
      $msg .= '댓글 입력을 실패하였습니다.';
    }

    $data = array(  'url'=>$rootPath . $category . '/' . $id,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data);
  }

  function deleteDeleteComment() {

    $rootPath = _SUX_ROOT_;
    $msg = '';
    $resultYN = 'Y';

    $context = Context::getInstance();
    $posts = $context->getPostAll();  

    $category = $posts['category'];
    $mid = $posts['mid'];
    $id = $posts['cid'];

    $returnURL = $context->getServer('REQUEST_URI');
    $password = trim($posts['password']);
    if (!(isset($password) && $password)) {
      $msg .= '비밀번호를 입력해주세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $passwordHash = $context->getPasswordHash($password);
    $adminPassword = $context->getAdminInfo('admin_pwd');
    $adminPasswordHash = $context->getPasswordHash($adminPassword);

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('comment', '*', $where);

    $row = $this->model->getRow();
    $msg .= $passwordHash . ' === ' . $row['password'] . "<br>";
    if (($passwordHash === $row['password']) || ($passwordHash === $adminPasswordHash)) {
      $result = $this->model->delete('comment', $where);
      if (!isset($result)) {
        $msg .= '댓글 삭제를 실패하였습니다.';
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit;
      }     
    } else  {
      $msg .= '비밀번호가 일치하지 않습니다..';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $data = array(  'url'=>$rootPath . $category . '/' . $mid,
            'result'=>$resultYN,
            'msg'=>$msg,
            'delay'=>0);

    $this->callback($data);
  }
}
?>