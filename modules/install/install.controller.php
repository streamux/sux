<?php
/**
 * install.controller.php 는 아직 모델이 설정되어 있지 않기 때문에 DB 클래스 내 쿼리 메서드를 사용한다.
 */
class InstallController extends Controller
{

  function insertSetupDb() {

    $context = Context::getInstance();
    $posts =$context->getPostAll();

    $db_info = array('db_hostname', 'db_database', 'db_port', 'db_charset', 'db_userid', 'db_password' ,'db_table_prefix');
    
    $resultYN = 'Y';
    $msg = '';

    $rootPath = _SUX_ROOT_;
    $filePath = './files/config/config.db.php';

    $buffer = array();
    foreach ($db_info as $key => $value) {
      $buffer['db_info'][$value] = str_replace('-', '', $posts[$value]);
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
    $admin_info = array('admin_id','admin_pwd','admin_name','admin_nickname','admin_email','yourhome');

    $resultYN = 'Y';
    $msg = '';

    $rootPath = _SUX_ROOT_;
    $filePath = 'files/config/config.admin.php';
    $buffer = array('admin_info'=>array());

    foreach ($admin_info as $key => $value) {

      if (preg_match('/(admin_pwd)+/', $value)) {
        $adminValue = $context->getPasswordHash($posts[$value]);
      } else {
        $adminValue = $posts[$value];
      }

      $adminValue = preg_replace('/[-]/', '', $adminValue);
      $buffer['admin_info'][$value] = $adminValue;
      $context->setSession($value, $adminValue);
    }

    $result = CacheFile::writeFile($filePath, $buffer);
    if($result) {
      $msg = "관리자 계정 설정을 완료하였습니다.<br>";
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

    //header('Content-Type: text/html; charset=utf-8');

    $realPath = _SUX_PATH_;
    $rootPath = _SUX_ROOT_;
    $resultYN = 'Y';
    $msg = '';

    $context = Context::getInstance();
    $context->init();

    $returnURL = $context->getServer('REQUEST_URI');
    $tablePrefix = $context->getPrefix();
    $tableList = array(); 
    $query = Query::getInstance();
    $schemas = QuerySchema::getInstance();
    $cacheFile = CacheFile::getInstance();

    $query->setDBName($context->getDBInfo('db_database'));

    // 반응이 없을 땐 DB계정 정보가 올바른지 확인한다.
    $oDB = DB::getInstance();
    $oDB->createDatabase($query);
    $oDB->connect();
    $moduleList = FileHandler::readDir('./modules');

    foreach ($moduleList as $key => $value) {
      $module = $value['file_name'];

      // Create Table and Cache's Column File for Database'
      $shemasDir = './modules/' . $module . '/schemas';
      $schemasList = FileHandler::readDir($shemasDir);

      for ($i=0; $i<count($schemasList); $i++) {

        if (preg_match('/(.xml+)$/', $schemasList[$i]['file_name'] )) {
          $xmlPath = $shemasDir . '/' . $schemasList[$i]['file_name'];

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
            $oDB->showTables($query);
            $numrow = $oDB->getNumRows();

            if ($numrow === 0) {
              $result = $oDB->createTable($query);

              if (!$result) {
                $resultYN = 'N';
                $msg .= "@ create table->" . $tableName . " [ result : fail ] --- X" . PHP_EOL;
              } else {
                $msg .= "@ create table->" . $tableName . " [ result : success ] --- O" . PHP_EOL;
              }
            }
          }   // end of  if file_exists
        }   // end of if preg_match
      }  // end of foreach : schema

      /**
       * Insert First Data Into Database
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
              $query->reset();
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
                  $propName = (string) $value['name'];

                  $columns[$propName] = $nodeValue;
                }   // end of foreach : columns

                $category = $columns['category'];
                $templateName = $columns['template_type'];
                $query->setWhere(array('category'=>$category));

                if (isset($category) && $category) {                  
                  $result = $oDB->select($query);

                  if (isset($result) && $result) {
                    $numrows = $oDB->getNumRows();

                    //Not yet register
                    if ($numrows == 0) {
                      $query->setColumn($columns);
                      $oDB->insert($query);
                    }                    
                  }                  
                } 
                
                // Member Admin : Insert Into Member
                if ($module === 'member' && preg_match('/^admin/i', $category) == true) {
                  $query->reset();
                  $query->setTable($tablePrefix . 'member');
                  $query->setField('id');
                  $query->setWhere(array('category'=>$category));
                  $oDB->select($query);
                  $numrows = $oDB->getNumRows();

                  if ($numrows < 1) {
                    $mColumns = array();
                    $mColumns['category'] = $category;
                    $mColumns['user_id'] = $context->getSession('admin_id');
                    $mColumns['nickname'] = $context->getSession('admin_nickname');
                    $mColumns['user_name'] = $context->getSession('admin_nickname');
                    $mColumns['password'] = $context->getSession('admin_pwd');
                    $mColumns['email_address'] = $context->getSession('admin_email');
                    $mColumns['yoursite'] = $context->getSession('yourhome');
                    $mColumns['grade'] = '10';
                    $mColumns['ip'] = $context->getServer('REMOTE_ADDR');
                    $mColumns['date'] = 'now()';

                    $query->setColumn($mColumns);
                    $result = $oDB->insert($query);

                    if (!$result) {
                      $msg .= '관리자 계정 등록을 실패하였습니다.' . PHP_EOL;
                      $resultYN = "N";
                    }
                  } else {
                    $msg .= '관리자 계정이 이미 등록되어 있습니다.' . PHP_EOL;
                  }
                } // end of if : member

                // Document : Create Template Files
                if ($module === 'document') {
                  $contentPath = 'files/document/' . $category;    // File Path of XML
                  $saveFileRealDir = Utils::convertAbsolutePath($contentPath, $realPath);

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
                }  // end of if : document                 

                if ($module === 'board') {
                  $query->reset();
                  $query->setTable($tablePrefix . 'board');
                  $query->setField('id');
                  $query->setWhere(array('category'=>$category));
                  $oDB->select($query);
                  $numrows = $oDB->getNumRows();

                  if ($numrows < 1) {
                    $bColumns = array();
                    $bColumns['category'] = $category;
                    $bColumns['user_id'] = $context->getSession('admin_id');
                    $bColumns['user_name'] = $context->getSession('admin_nickname');
                    $bColumns['nickname'] = $context->getSession('admin_nickname');
                    $bColumns['password'] = $context->getSession('admin_pwd');
                    $bColumns['title'] = '게시판 설정 안내입니다.';
                    $bColumns['content'] = "SUX CMS 최초 설치 시 등록되는 게시판은 관리자 페이지에서 변경, 삭제가 가능합니다.<br>또한 귀하의 사이트 환경에 맞게 수정하려면 관리자 권한 로그인 후<br>우측 상단 톱니바퀴 아이콘을 클릭해서 대시보드로 이동한 후 게시판 관리 페이지를 이용해 주세요.";
                    $bColumns['email_address'] = $context->getSession('admin_email');
                    $bColumns['wall'] = 'a';
                    $bColumns['date'] = 'now()';
                    $bColumns['ip'] = $context->getServer('REMOTE_ADDR');

                    $query->setTable($tablePrefix . 'board');
                    $query->setField('');
                    $query->setColumn($bColumns);
                    $result = $oDB->insert($query);

                    if (!$result) {
                      $msg .= "설정 안내 게시글 등록을 실패하였습니다.<br>";
                      $resultYN = 'N';    
                    }
                  } else {
                    $msg .= '게시물이 이미 등록되어 있습니다.' . "<br>";
                  }
                }                

                // Document And Board : Write into Route File
                if ($module === 'document' || $module === 'board') {
                  $routes = array();
                  $filePath = $realPath . "files/caches/routes/${module}.cache.php";
                  $routeCaches = CacheFile::readFile($filePath); 

                  if (isset($routeCaches) && $routeCaches) {
                    $routes['categories'] = $routeCaches['categories'];
                    $routes['action'] = $routeCaches['action'];
                    $pattern = sprintf('/(%s)+/i', $category);

                    if (!preg_match($pattern, implode(',', $routes['categories']))) {
                      $routes['categories'][] = $category; 
                    }
                    CacheFile::writeFile($filePath, $routes);
                  }
                }  // end of if : route
              }  // end of if : if 'actionType === insert && $moduleType === once'

            }  // end of if : file_exists
          }  // end of if
        }  // end of foreach
      }  //end of if : preg_match(xml)
    }  // end of foreach : modules

    // Make Json File of GNB
    $gnbPath = 'files/gnb/gnb.json';
    $gnbFilePath = Utils::convertAbsolutePath($gnbPath, $realPath);

    if (!file_exists($gnbFilePath)) {
      $query = new Query();
      $query->setTable($tablePrefix . 'menu');
      $query->setField('*');
      $query->setWhere(array('is_active'=>1));
      $result = $oDB->select($query);
      $jsonData = array();
      $jsonData['data'] = array();
      $sunseo = array();

      while($row = $oDB->getFetchArray($result)) {
        $jsonData['data'][] = array('id'=>$row['id'],'sid'=>0,'menu_name'=>$row['menu_name'],'url'=>$row['category'],'depth'=>1,'isClicked'=>false,'isModified'=>false,'isDragging'=>false,'state'=>'default','badge'=>0,'sub'=>array(),'posy'=>0,'top'=>'0', 'sunseo'=>$row['sunseo']);
      }

      foreach ($jsonData['data'] as $key => $row) {
        $sunseo[$key] = $row['sunseo'];
      }

      array_multisort($sunseo, SORT_ASC, SORT_NUMERIC,$jsonData['data']);

      $jsonData = JsonEncoder::parse($jsonData);
      $result = FileHandler::writeFile($gnbFilePath, $jsonData);

      if (!$result) {
        $msg .= "기본 메뉴 Json 파일 생성을 실패하였습니다." . PHP_EOL;
        $resultYN = 'N';
      }
    }  // end of if

    // Make Config Table File
    $tableDir = './files/config/config.table.php';
    $pathinfo = pathinfo($tableDir);
    $buffer = array();
    $buffer['table_list'] = $tableList;   
    $result = CacheFile::writeFile($tableDir, $buffer);

    //$msg .= Tracer::getInstance()->getMessage();
    if (!$result) {
      $msg .= $pathinfo['filename'] . ' 파일을 저장하는데 실패했습니다.<br>';
      $resultYN = 'N';
    }

    $data = array(  'msg'=>$msg,
                            'result'=>$resultYN,
                            'url'=>$rootPath);

    $this->callback($data);
  }

  function deleteCaches() {

    FileHandler::deleteAll('./templates_c/');
  }

  function deleteFiles() {

    FileHandler::deleteAll('./files/');
  }

  function deleteTables() {


    $context = Context::getInstance();
    $oDB = DB::getInstance();
    $oDB->connect();
    $dbName = $context->getDB();

    $query = new Query();
    $query->setDBName( $dbName );
    $result = $oDB->showTables($query);

    $prefix = $context->getPrefix();
    $tables = array();
    $regStr = sprintf('/^(%s)+/i', $prefix);

    while (($row = $oDB->getFetchArray($result)) !== false) {

      foreach ($row as $key => $value) {
        preg_match($regStr, $value, $matched);

        if (count($matched) > 0) {
          $tables[] = $value;
        }      
      }      
    }

    $query = new Query();
    $query->setDBName( $dbName );
    $query->setTable( implode(',', $tables) );
    $oDB->dropTable( $query );
  }
  
  function deleteUninstall() {

    $context = Context::getInstance();
    $mode = $context->getPost('uninstall_mode');

    switch ($mode) {
      case 'cache':
        $this->deleteCaches();
        $returnURL = _SUX_ROOT_;
        break;

      case 'file':        
        $this->deleteCaches();
        $this->deleteFiles();
        $returnURL = _SUX_ROOT_ . 'install';
        break;

      case 'all':        
        $this->deleteCaches();
        $this->deleteFiles();
        $this->deleteTables();
        $returnURL = _SUX_ROOT_ . 'uninstall_complete.php';
        break;
      
      default:
        break;
    }

    $data = array(  'url'=>$returnURL,
                            'result'=>$resultYN,
                            'msg'=>$msg);

    $this->callback($data);
  }
}