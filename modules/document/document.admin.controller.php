<?php

class DocumentAdminController extends Controller
{
  function insertAdd() { 

    $msg = '';
    $resultYN = 'Y';
    $dataObj = array();

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $category = strtolower($posts['category']);
    $templateName = $posts['contents_path'];
    $title = $posts['document_name'];
    $returnURL = $context->getServer('REQUEST_URI');  

    $where = new QueryWhere();
    $where->set('category', $category);
    $this->model->select('document', 'id', $where);
    $numrows = $this->model->getNumRows();

    if ($numrows > 0) {
      $msg = $category . '페이지가 이미 등록되어 있습니다.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    } else {
      $this->model->select('board_group', 'id', $where);
      $numrows = $this->model->getNumRows();

      if ($numrows> 0) {
        $msg = "${category}는 게시판에서 이미 사용하고 있습니다.";
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit;
      }
    }// end of if

    /**
     * @cache's columns 
     *  페이지에서 넘어온 데이터 값들은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
     */

    $savePath = 'files/document/';
    $cachePath = './files/caches/queries/document.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');

    if ($columnCaches) {
      $columns = array();

      for($i=0; $i<count($columnCaches); $i++) {
        $key = $columnCaches[$i];
        $value = $posts[$key];

        if (isset($value) && $value) {

          if (preg_match('/^(contents_path)+$/', $key)) {
            $value = $savePath . $category;
          }
          $columns[$key] = $value;
        } 
      } //end of for

      $columns['date'] = 'now()';
    } else {
      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    } // end of if

    $result = $this->model->insert('document', $columns);

    if ($result) {
      $msg .= "\"${category}\" 페이지 등록을 완료하였습니다.<br>";

      $realPath = _SUX_PATH_ . $savePath;

      // make new template dir
      $saveFileRealDir = $realPath . $category;

      if (!file_exists($saveFileRealDir)) {
        FileHandler::makeDir($saveFileRealDir, false);
      }

      // read files of template to module's directory      
      $readtemplatePath = _SUX_PATH_ . 'modules/document/templates/' . $templateName;
      $readtemplatePathList = array();
      $readtemplatePathList['tpl'] = $readtemplatePath . '/' . $templateName . '.tpl';
      $readtemplatePathList['css'] = $readtemplatePath . '/' . $templateName . '.css';
      $readtemplatePathList['js'] = $readtemplatePath . '/' . $templateName . '.js';

      $buffers = array();
      $buffers['tpl'] = '';
      $buffers['css'] = '';
      $buffers['js'] = '';

      foreach ($buffers as $key => $value) {
        $buffer = $posts['contents_' . $key];

        if (isset($buffer) && $buffer) {
          $buffers[$key] = $buffer;
        } else {
          $tempPath = $readtemplatePathList[$key];

          if (file_exists($tempPath)) {
            $buffers[$key] = FileHandler::readFile($tempPath);
          } else {
            $msg .= $tempPath . ' 파일이 존재하지 않습니다.';
          }
        }        
      }

      foreach ($buffers as $key => $value) {
        $buffers[$key] = $posts['contents_' . $key];

        if (empty($buffers[$key])) {
          $buffers[$key] = $key . ' 내용을 입력해주세요';
        }
      }

      $buffer = $posts['contents'];

      if (!empty($buffer)) {
          $buffers['tpl'] = $buffer;
      }

      // Save files of skin to files's directory
      $saveTemplatePathList = array();
      $saveTemplatePathList['tpl'] = $saveFileRealDir . '/' . $category . '.tpl';
      $saveTemplatePathList['css'] = $saveFileRealDir . '/' . $category . '.css';
      $saveTemplatePathList['js'] = $saveFileRealDir . '/' . $category . '.js';

      foreach ($saveTemplatePathList as $key => $value) {

        if (isset($buffers[$key]) && $buffers[$key]) {          
          $result = FileHandler::writeFile($value, $buffers[$key]);

          if (!$result) {
            $msg .= "${category} 템플릿 ${key} 파일 등록을 실패하였습니다.<br>";
          }      
        }           
      }       

      // write route's key
      $routes = array();
      $cacheFilePath = './files/caches/routes/document.cache.php';
      $routeCaches = CacheFile::readFile($cacheFilePath);      

      if (isset($routeCaches) && $routeCaches) {
        $routes['categories'] = $routeCaches['categories'];
        $routes['action'] = $routeCaches['action'];
        $pattern = sprintf('/(%s)+/i', $category);
        $routeList =  implode(',', $routes['categories']);

        if (!preg_match($pattern, $routeList)) {
          $routes['categories'][] = $category;
        }

        CacheFile::writeFile($cacheFilePath, $routes);
      }

      // insert into menu
      $columns = array();
      $columns['category'] = $posts['category'];
      $columns['menu_name'] = $posts['document_name'];
      $columns['url'] = $posts['category'];
      $columns['date'] = 'now()';
      $result = $this->model->insert('menu', $columns);

      if (!$result) {
        $msg .= "메뉴 등록을 실패하였습니다.";
        $resultYN = 'N';
      }

      $where->reset();
      $where->set('category', $category);
      $result = $this->model->select('document', '*',  $where);

      if ($result) {
        $dataObj['list'] = $this->model->getRows();
      } else {
        $msg .= "${category} 페이지 선택을 실패하였습니다.<br>";
        $resultYN = 'N';
      }
    } else {
      $msg .= "${category} 페이지 등록을 실패하였습니다.<br>";
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  'data'=> $dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function updateModify() {

    $dataObj = array();
    $resultYN = "Y";
    $msg = "";
    $is_document = 'N';

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $category = $posts['category'];
    $title = $posts['document_name'];
    $contents_path = $posts['contents_path'];

    /**
     * @cache's columns 
     *  페이지에서 넘어온 데이터 값은 캐시에 저장된 컬럼키와 매칭이 된 값만 저장된다.
     */
    $cachePath = './files/caches/queries/document.getColumns.cache.php';
    $cacheColumns = CacheFile::readFile($cachePath);

    $columns = array();
    for($i=2; $i<count($cacheColumns['columns']); $i++) {
      $key = $cacheColumns['columns'][$i];
      $value = $posts[$key];

      if (isset($value) && $value) {
        if (preg_match('/^(contents_path)+$/', $key)) {
          if (!preg_match('/(.tpl+)$/i', $value)) {
            $value = 'files/document/' . $category;
          }
          $contents_path = $value;
        }
        $columns[$key] = $value;
      }           
    }   
    // end of page

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('document', $columns, $where);   
    if ($result) {

      if (isset($contents_path) && $contents_path) {
        $realPath = _SUX_PATH_ . 'files/document/';

        $buffers = array();
        $buffers['tpl'] = '';
        $buffers['css'] = '';
        $buffers['js'] = '';

        foreach ($buffers as $key => $value) {
          $buffers[$key] = $posts['contents_' . $key];
          if (empty($buffers[$key])) {
            $buffers[$key] = $key . ' 내용을 입력해주세요';
          }
        }

        // Save files of skin to files's directory
        $contents_path = _SUX_ROOT_ . $contents_path;
        $saveTemplatePath =Utils::convertAbsolutePath($contents_path, $realPath);

        if (!file_exists($saveTemplatePath)) {
          FileHandler::makeDir($saveTemplatePath, false);
        }

        $saveTemplatePathList = array();
        $saveTemplatePathList['tpl'] = $saveTemplatePath . '/' . $category . '.tpl';
        $saveTemplatePathList['css'] = $saveTemplatePath . '/' . $category . '.css';
        $saveTemplatePathList['js'] = $saveTemplatePath . '/' . $category . '.js';

        foreach ($saveTemplatePathList as $key => $value) {
          if (isset($buffers[$key]) && $buffers[$key]) {
            $result = FileHandler::writeFile($value, $buffers[$key]);
            if (!$result) {
              $msg .= "${category} 템플릿 ${key} 파일 등록을 실패하였습니다.<br>";
            }      
          }           
        }

        // rewrite route's key
        $routes = array();
        $filePath = './files/caches/routes/document.cache.php';
        $routeCaches = CacheFile::readFile($filePath);      
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

        $where->reset();
        $where->set('category', $category);
        $result = $this->model->select('document', '*',  $where);
        if ($result) {
          $dataObj['list'] = $this->model->getRows();
        } else {
          $msg .= "${category} 페이지 선택을 실패하였습니다.<br>";
          $resultYN = 'N';
        }
      }

      $result = $this->model->select('document', '*', $where);
      if ($result) {
        $dataObj['list'] = $this->model->getRows();
      } 
    } else {
      $msg .= "$category 페이지 수정을 실패하였습니다.";
      $resultYN = "N";  
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function deleteDelete() {

    $resultYN = "Y";
    $msg = "";  

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $category = strtolower($posts['category']);
    $id = $posts['id'];   

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('document', 'contents_path', $where);
    $row = $this->model->getRow();    
      
    $result = $this->model->delete('document', $where);
    if ($result) {
      $msg .= "${category} 페이지을 삭제하였습니다.<br>";

      $realPath = _SUX_PATH_ . 'files/document/' . $category;
      $contents_path = _SUX_ROOT_ . $row['contents_path'];
      $contentsPath =Utils::convertAbsolutePath($contents_path, $realPath);
      $result = FileHandler::deleteAll($contentsPath);
      if (!$result) {
        $msg .= "$category 컨텐츠 파일 삭제를 실패하였습니다.<br>";
      }

      // 라우트 카테고리 키 저장 
      $filePath = './files/caches/routes/document.cache.php';
      $routes = CacheFile::readFile($filePath);
      $len = count($routes['categories']);
      for($i=0; $i<$len; $i++) {
        $input = $routes['categories'][$i];
        if (strcmp($input, $category) === 0) {
          array_splice($routes['categories'], $i, 1);
          break;
        }
      }

      $result = CacheFile::writeFile($filePath, $routes);
      if (!$result) {
        $msg .= "라우트 파일 재설정을 실패하였습니다.";
      }

      // delete menu
      $where = new QueryWhere();
      $where->set('category', $category);
      $result = $this->model->delete('menu', $where);
      if (!$result) {
        $msg .= "메뉴 삭제를 실패하였습니다.";
        $resultYN = 'N';
      }
    } else {
      $msg .= "${category} 페이지 삭제를 실패하였습니다.<br>";
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }
}