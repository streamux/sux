<?php

class BoardAdminController extends Controller
{

  function insertAdd() {

    $msg = '';
    $resultYN = 'Y';
    $dataObj = array();

    $context = Context::getInstance();
    $posts = $context->getPostAll(); 
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

  function updateModify() {

    $dataObj = array();
    $resultYN = "Y";
    $msg = "";

    $context = Context::getInstance();
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

  function deleteDelete() {

    $context = Context::getInstance();
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
