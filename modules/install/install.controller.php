<?php
/**
 * install.controller.php 는 아직 모델이 설정되어 있지 않기 때문에 DB 클래스 내 쿼리 메서드를 사용한다.
 */
class InstallController extends Controller
{

  function insertSetupDb() {

    $context = Context::getInstance();
    $posts =$context->getPostAll();

    $db_info = array('db_hostname', 'db_userid', 'db_password', 'db_database','db_table_prefix');
    
    $resultYN = 'Y';
    $msg = '';

    $rootPath = _SUX_ROOT_;
    $filePath = './files/config/config.db.php';

    $buffer = array();
    foreach ($db_info as $key => $value) {
      $buffer['db_info'][$value] = $posts[$value];
    }

    $context->makeFilesDir(false, $buffer['db_info']);
    $context->makeRouteCaches();

    $result = CacheFile::writeFile($filePath, $buffer);
    if (!$result) {
      $msg .= 'DB 설정을 실패했습니다.';
      $resultYN = 'N';
    } else {
      $msg .= " DB 설정을 완료하였습니다.<br>";
      $resultYN = 'Y';
    }

    $data = array(  'msg'=>$msg,
            'result'=>$resultYN,
            'url'=>$rootPath . 'setup-admin');

    $this->callback($data);
  }

  function insertSetupAdmin() {

    $context = Context::getInstance();
    $posts =$context->getPostAll();
    $admin_info = array('admin_id','admin_pwd','admin_nickname','admin_email','yourhome');

    $resultYN = 'Y';
    $msg = '';

    $rootPath = _SUX_ROOT_;
    $filePath = 'files/config/config.admin.php';
    $buffer = array('admin_info'=>array());

    foreach ($admin_info as $key => $value) {
      if (preg_match('/(admin_pwd)+/', $value)) {
        $buffer['admin_info'][$value] = $context->getPasswordHash($posts[$value]);
        $_SESSION[$value] = $context->getPasswordHash($posts[$value]);
      } else {
        $buffer['admin_info'][$value] = $posts[$value];
        $_SESSION[$value] = $posts[$value];
      }     
    }

    $result = CacheFile::writeFile($filePath, $buffer);
    if($result) {
      $msg = "관리자계정 설정을 완료하였습니다.<br>";
      $resultYN = 'Y';
    } else {
      $msg = "관리자 설정을 실패했습니다.";
      $resultYN = "N";      
    }

    if ($resultYN === 'N') {
      UIError::alertToBack($msg);
      exit;
    } 

    $data = array(
      'msg'=>$msg,
      'result'=>$resultYN,
      'url'=>$rootPath . 'create-table' . '?_method=insert');

    $this->callback($data);
  }

  /**
   * @method createTable
   *  스키마 데이터 xml  연동
   * 참고 : 라우트 캐시 파일 생성은 Context.php 에 정의 되어 있음 
   */
  function insertCreateTable() {

    $realPath = _SUX_PATH_;
    $rootPath = _SUX_ROOT_;
    $resultYN = 'Y';
    $msg = '';
    
    $context = Context::getInstance();
    $context->init();

    $tableList = array();
    $tracer = Tracer::getInstance();
    $returnURL = $context->getServer('REQUEST_URI');

    $query = new Query();
    $schemas = new QuerySchema();
    $cacheFile = CacheFile::getInstance();

    // 반응이 없을 땐 DB계정 정보가 바른지 확인한다.
    $oDB = DB::getInstance();
    $tablePrefix = $context->getPrefix();
    $moduleList = FileHandler::readDir('./modules');

    foreach ($moduleList as $key => $value) {
      $module = $value['file_name'];

      // create table and make cache's column file'
      $shemasDir = './modules/' . $module . '/schemas';
      $schemasList = FileHandler::readDir($shemasDir);

      foreach ($schemasList as $key => $value) {

        if (preg_match('/(.xml+)$/', $value['file_name'] )) {
          $xmlPath = $shemasDir . '/' . $value['file_name'];

          if (file_exists($xmlPath)) {
            $query->resetSchema();
            $schemas->reset();

            $tableXml = simplexml_load_file($xmlPath);
            $tableName = $tablePrefix . $tableXml['name'];
            $query->setTable($tableName);                     

            $cacheColumn = array();
            $columns = $tableXml[0]->column;

            foreach ($columns as $key => $value) {
              $name = $value['name'];
              $type = $value['type'];
              $size = $value['size'];
              $default = isset($value['default']) ? $value['default'] : null;
              $notnull = isset($value['notnull']) ? $value['notnull'] : null;         
              $autoincrement = isset($value['auto_increment']) ? $value['auto_increment'] : null;
              $primarykey = isset($value['primary_key']) ? $value['primary_key'] : null;

              $schemas->add($name, $type, $size, $default, $notnull, $autoincrement, $primarykey);
              $cacheColumn[] = $name;
            } // end of foreach

            // setup query's columns-cache-file
            $queryCachePath = './files/caches/queries/' . $tableXml['name'] . '.getColumns.cache.php';

            $buffer = array();
            $buffer['columns'] = $cacheColumn;
            $cacheFile->writeFile($queryCachePath, $buffer);

            $keyName = (string) $tableXml['name'];  
            $tableList[$keyName] = $tableName;

            $query->setSchema($schemas);
            $result = $oDB->createTable($query);

            if (!$result) {
              $resultYN = 'N';
              $msg .= "@ create table->" . $tableName . " [ result : fail ] --- X" . PHP_EOL;
            } else {                                
              $msg .= "@ create table->" . $tableName . " [ result : success ] --- O" . PHP_EOL;
            }
          }
        }
      } // end of foreach

      /**
       * 초기 값을 갖는 테이블 일 경우 '모듈 폴더 > queries > 모듈.액션.이름.xml'  파일을 추가해서 등록한다.
       * 참고 URL : modules/document/queries/document.add.home.xml
       */
      $queryDir = './modules/' . $module . '/queries';        
      $queryList = FileHandler::readDir($queryDir);

      if ($queryList) {

        foreach ($queryList as $key => $value) {

          if (preg_match('/(.xml+)$/', $value['file_name'] )) {
            $xmlPath = $queryDir . '/' . $value['file_name'];

            if (file_exists($xmlPath)) {
              $query = new Query();
              $columns = array();       
              $queryXml = simplexml_load_file($xmlPath);  

              $moduleType = (string) $queryXml['execution'];  
              $actionType = (string) $queryXml['action'];

              if ($actionType === 'insert' && $moduleType === 'once') {
                $propTableName = trim($queryXml[0]->tables[0]->table['name']);
                $tableName = $tablePrefix . $propTableName;
                $query->setTable($tableName);
                $query->setField('*');
                $queryColumns = $queryXml[0]->columns[0]->column;
                $menuActive = 0;

                foreach ($queryColumns as $key => $value) {

                  $nodeValue = (string) $value;
                  $propValue = (string) $value['name'];

                  // xml > columns > column 내 name='category' 를 쿼리 검색 조건으로 설정 
                  if ($propValue === 'category') {
                    $where = array('category'=>$nodeValue);
                    $category = $nodeValue;
                  }

                  // 메뉴 모들 중 xml 쿼리 내 컬럼명 'is_active'가 있으면 값을 설정 
                  if ($propValue === 'is_active') {
                    $menuActive = (int) $nodeValue;
                  }

                  if (preg_match('/^(contents_path)+$/i', $propValue)) {
                    $contentsPath = $rootPath . $nodeValue;         
                  }
                  $columns[] = $nodeValue;
                }

                if (isset($where) && $where) {
                  $query->setWhere($where);
                  $oDB->select($query);
                  $numrows = $oDB->getNumRows();

                  if ($numrows < 1 && $propTableName === 'menu' && $menuActive > 0) {                    
                    $query->setColumn($columns);
                    $oDB->insert($query);
                  }

                  // 아직 등록이 안됐다면 
                  if ($numrows < 1 && $propTableName !== 'menu') {
                    $query->setColumn($columns);
                    $oDB->insert($query);
                  }
                } // end of for
                
                // 관리자 계정 등록 
                if ($module === 'member' && preg_match('/^admin/i', $category) == true) {

                  $adminInfo = array(
                    'category'=>$category,
                    'user_id'=>$_SESSION['admin_id'],
                    'nick_name'=>$_SESSION['admin_nickname'],
                    'user_name'=>$_SESSION['admin_nickname'],
                    'password'=>$_SESSION['admin_pwd'],
                    'email_address'=>$_SESSION['admin_email'],
                    'yoursite'=>$_SESSION['yourhome']
                  );

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
                    $value = $adminInfo[$key];

                    if (isset($value) && $value) {
                      $columns[$key] = $value;
                    }

                    $columns['grade'] = 10;
                    $columns['is_writable'] = 'y';
                    $columns['is_kickout'] = 'n';
                    $columns['date'] = 'now()';
                    $columns['ip'] = $context->getServer('REMOTE_ADDR');
                  }

                  $query = new Query();
                  $query->setTable($tablePrefix . 'member');
                  $query->setField('id');
                  $query->setWhere(array('category'=>$category));

                  $oDB->select($query);
                  $numrows = $oDB->getNumRows();

                  if ($numrows < 1) {
                    $query->setColumn($columns);
                    $result = $oDB->insert($query);

                    if (!$result) {
                      $msg .= '관리자 계정 등록을 실패하였습니다.' . PHP_EOL;
                      $resultYN = "N";      
                    }
                  } else {
                    $msg .= '관리자 계정이 이미 존재합니다.' . PHP_EOL;
                    $resultYN = "N";      
                  }               
                } // end of if : regist admin info

                // copy template to files's dir to read  a template in module
                if ($module == 'document') {

                  // $contentsPath was written in xml data
                  $saveFileRealDir = Utils::convertAbsolutePath($contentsPath, $realPath);

                  if (!file_exists($saveFileRealDir)) {
                    FileHandler::makeDir($saveFileRealDir, false);
                  }

                  // read files of template to module's directory      
                  $readtemplatePath = _SUX_PATH_ . 'modules/document/templates/' . $category;
                  $readtemplatePathList = array();
                  $readtemplatePathList['tpl'] = $readtemplatePath . '/' . $category . '.tpl';
                  $readtemplatePathList['css'] = $readtemplatePath . '/' . $category . '.css';
                  $readtemplatePathList['js'] = $readtemplatePath . '/' . $category . '.js';

                  $buffers = array();
                  $buffers['tpl'] = '';
                  $buffers['css'] = '';
                  $buffers['js'] = '';

                  foreach ($buffers as $key => $value) {
                    $tempPath = $readtemplatePathList[$key];

                    if (file_exists($tempPath)) {
                      $buffers[$key] .= FileHandler::readFile($tempPath);
                    } else {
                      $msg .= $tempPath . ' 파일이 존재하지 않습니다.' . PHP_EOL;
                    }      
                  }

                  $buffers['tpl'] .= $buffHeader;

                  // Save files of skin to files's directory
                  $saveTemplatePathList = array();
                  $saveTemplatePathList['tpl'] = $saveFileRealDir . '/' . $category . '.tpl';
                  $saveTemplatePathList['css'] = $saveFileRealDir . '/' . $category . '.css';
                  $saveTemplatePathList['js'] = $saveFileRealDir . '/' . $category . '.js';

                  foreach ($saveTemplatePathList as $key => $value) {

                    if (isset($buffers[$key]) && $buffers[$key]) {
                      $result = FileHandler::writeFile($value, $buffers[$key]);

                      if (!$result) {
                        $msg .= $value . "<br>${category} 템플릿 ${key} 파일 등록을 실패하였습니다." . PHP_EOL;
                      }      
                    }           
                  }

                  // write route's key
                  $routes = array();
                  $filePath = $realPath . 'files/caches/routes/document.cache.php';
                  $routeCaches = CacheFile::readFile($filePath); 

                  if (isset($routeCaches) && $routeCaches) {
                    $routes['categories'] = $routeCaches['categories'];
                    $routes['action'] = $routeCaches['action'];
                    $pattern = sprintf('/(%s)+/i', $category);

                    if (!preg_match($pattern, implode(',', $routes['categories']))) {
                      array_push($routes['categories'], $category); 
                    }
                    CacheFile::writeFile($filePath, $routes);
                  }                  
                }  // end of if
              }  // end of if : if 'actionType === insert && $moduleType === once'
            }  // end of if : file_exists
          }  // end of if
        }  // end of foreach

        // make default json for gnb's menu
        $contentsPath = 'files/gnb/gnb.json';
        $filePath = Utils::convertAbsolutePath($contentsPath, $realPath);

        if (!file_exists($filePath)) {
          $query = new Query();
          $query->setTable($tablePrefix . 'menu');
          $query->setField('*');
          $query->setOrderBy('id desc');
          $result = $oDB->select($query);
          $jsonData = array();
          $jsonData['data'] = array();

          while($row = $oDB->getFetchArray($result)) {
            $jsonData['data'][] = array('id'=>$row['id'],'sid'=>0,'menu_name'=>$row['menu_name'],'url'=>$row['category'],'depth'=>1,'isClicked'=>false,'isModified'=>false,'isDragging'=>false,'state'=>'default','badge'=>0,'sub'=>array(),'posy'=>0,'top'=>'0');
          }          

          $jsonData = JsonEncoder::parse($jsonData);
          $result = FileHandler::writeFile($filePath, $jsonData);

          if (!$result) {
            $msg .= "기본 메뉴 Json 파일 생성을 실패하였습니다." . PHP_EOL;
            $resultYN = 'N';
          }
        }  // end of if
      }  //end of if : preg_match(xml)
    }  // end of foreach

    //$msg .= Tracer::getInstance()->getMessage();
    // write table list
    $tableDir = './files/config/config.table.php';
    $pathinfo = pathinfo($tableDir);

    $buffer = array();
    $buffer['table_list'] = $tableList;   
    $result = CacheFile::writeFile($tableDir, $buffer);

    if (!$result) {
      $msg .= $pathinfo['filename'] . ' 파일을 저장하는데 실패했습니다.<br>';
      $resultYN = 'N';
    }

    $data = array(  'msg'=>$msg,
                            'result'=>$resultYN,
                            'url'=>$rootPath);

    $this->callback($data);
    $oDB->close();
  }
}