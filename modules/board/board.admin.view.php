<?php

class BoardAdminView extends View
{

  function displayBoardAdmin() {

    $this->displayList();
  }

  function displayList() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $this->document_data['jscode'] = 'list';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_list.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayAdd() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $msg = '';

    $context = Context::getInstance();
    $sessionData = $context->getSessionAll();
    $category = $context->getParameter('category');
    $userName = $sessionData['user_name'];
    $nickname = $sessionData['nickname'];
    $password = $sessionData['password'];
    $admin_pass = $context->checkAdminPass();
    $returnURL = $rootPath . $category;
    
    if ($admin_pass === FALSE) {
      $context->setSession( 'return_url', $returnURL);
      $msg = '관리자 로그인이 필요합니다.';
      UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $this->model->select('board_group','category, board_name');
    $board_list = $this->model->getRows();

    $contentData = array();
    $contentData['wallname'] = Utils::getWallKey();

    if (isset($nickname) && $nickname) {
      $contentData['css_user_label'] = 'sx-hide';
      $contentData['user_name_type'] = 'hidden';
      $contentData['user_pass_type'] = 'hidden';
      $contentData['user_name'] = $userName;
      $contentData['nickname'] = $nickname;
      $contentData['user_password'] = $password;
    } else {
      $uniqNickname = 'Guest_' . Utils::getMicrotimeInt();
      $contentData['css_user_label'] = 'sx-show-inline';      
      $contentData['user_name_type'] = 'text';
      $contentData['user_pass_type'] = 'password';
      $contentData['user_name'] = $uniqNickname;
      $contentData['nickname'] = $uniqNickname;
      $contentData['user_password'] = '';
    }

    $this->document_data['category'] = $category;
    $this->document_data['content'] = $contentData;
    $this->document_data['board_list'] = $board_list;

    $this->document_data['jscode'] = 'add';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;    
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_add.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayModify() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $msg = '';

    $context = Context::getInstance();
    $sessionData = $context->getSessionAll();
    $id = $context->getParameter('id');
    $nickname = $sessionData['nickname'];
    $password = $sessionData['password'];
    $admin_pass = $context->checkAdminPass();
    $returnURL = $rootPath . $category;
    
    if ($admin_pass === FALSE) {
      $context->setSession( 'return_url', $returnURL);
      $msg = '관리자 로그인이 필요합니다.';
      UIError::alertTo( $msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $this->model->select('board_group','category, board_name');
    $board_list = $this->model->getRows();

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board','id, category, is_notice, nickname, user_name, title, email_address, content', $where);
    
    $contentData = $this->model->getRow();
    $contentData['nickname'] = $contentData['nickname'] | $contentData['user_name'];
    $contentData['title'] = $contentData['title'];
    $contentData['content'] = FormSecurity::decodeForForm($contentData['content']);
    
    $contentType = $contentData['content_type'];
    $contentData['content_type_' . $contentType] = 'checked';
    $contentData['wallname'] = Utils::getWallKey();

    if (isset($nickname) && $nickname) {
      $contentData['css_user_label'] = 'sx-hide';
      $contentData['user_name_type'] = 'hidden';
      $contentData['user_pass_type'] = 'hidden';
      $contentData['nickname'] = $nickname;
      $contentData['user_password'] = $password;
    } else {
      $contentData['css_user_label'] = 'sx-show-inline';      
      $contentData['user_name_type'] = 'text';
      $contentData['user_pass_type'] = 'password';
      $contentData['nickname'] = 'Guest';
      $contentData['user_password'] = '';
    }

    $this->document_data['category'] = $category;
    $this->document_data['content'] = $contentData;
    $this->document_data['board_list'] = $board_list;

    $this->document_data['jscode'] = 'modify';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;    
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_modify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayDelete() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $context = Context::getInstance();
    $id = $context->getParameter('id');
    
    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board', 'id, title', $where);
    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $this->document_data['jscode'] = 'delete';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_delete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";
    
    $this->output();
  }

  function displayListJson() {

    $dataObj = null;
    $dataList = array();
    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $id = $context->getRequest('id');
    $limit = $context->getRequest('limit');
    $passover = $context->getRequest('passover');

    if (empty($limit)) {
      $limit = 10;
    }       
    if (empty($passover)) {
      $passover = 0;
    }

    if (isset($id) && $id) {
      $where = new QueryWhere();
      $where->set('id', $id);
      $this->model->select('board','*', $where);
      $totalNum = 1;
    } else {
      $this->model->select('board', 'id');
      $totalNum = $this->model->getNumRows();
      $this->model->select('board','*', null, 'id desc', $passover, $limit);
    }
    
    $numrows = $this->model->getNumRows();
    if ($numrows > 0){
      $dataObj['list'] = array();
      $dataObj['total_num'] = $totalNum;
      $dataList = array();
      $a = $numrows;
      $rows = $this->model->getRows();

      foreach ($rows as $key => $row) {
        $fields = array('no'=>$a);

        foreach ($row as $key => $value) {
          $fields[$key] = $value;
        }

        $dataList[] = $fields;
        $a--;
      }

      $dataObj['list'] =$dataList;
    } else {
      $msg = "게시글이 존재하지 않습니다.";
      $resultYN = "N";
    }

    //$msg = Tracer::getInstance()->getMessage();
    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayModifyJson() {

    $context = Context::getInstance();
    $id = $context->getPost('id');

    $dataObj = array();
    $msg = "";
    $resultYN = "Y";

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board_group','*', $where);

    $numrows = $this->model->getNumRows();
    if ($numrows > 0) {
      $row = $this->model->getRow();

      foreach ($row as $key => $value) {
        $dataObj[$key] = $value;
      }
      $resultYN = "Y";
    } else {
      $resultYN = "N";
      $msg = '게시판이 존재하지 않습니다.';
    }

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayGroup() {

    $this->displayGroupList();
  }

  function displayGroupList() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $this->document_data['jscode'] = 'list';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_group_list.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupAdd() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $skinDir = _SUX_PATH_ . "modules/board/skin/";
    $skinList = FileHandler::readDir($skinDir);
    if (!$skinList) {
      $msg = "스킨폴더가 존재하지 않습니다.";
      $resultYN = "N";
    }
    $this->document_data['skin_list'] = $skinList;
    $this->document_data['jscode'] = 'groupAdd';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_group_add.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupModify() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $context = Context::getInstance();
    $id = $context->getParameter('id');      

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board_group','category, id', $where);

    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $skinDir = _SUX_PATH_ . "modules/board/skin/";
    $skinList = FileHandler::readDir($skinDir);
    if (!$skinList) {
      $msg = "스킨폴더가 존재하지 않습니다.";
      $resultYN = "N";
    }
    $this->document_data['skin_list'] = $skinList;
    $this->document_data['jscode'] = 'groupModify';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_group_modify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupDelete() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/board/tpl";

    $context = Context::getInstance();
    $id = $context->getParameter('id');
    
    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board_group', 'id, category', $where);
    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $this->document_data['jscode'] = 'groupDelete';
    $this->document_data['module_code'] = 'board';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_group_delete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";
    
    $this->output();
  }

  function displayGroupListJson() {

    $dataObj = null;
    $dataList = array();
    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $id = $context->getRequest('id');
    $limit = $context->getRequest('limit');
    $passover = $context->getRequest('passover');

    if (empty($limit)) {
      $limit = 10;
    }       
    if (empty($passover)) {
      $passover = 0;
    }

    if (isset($id) && $id) {
      $where = new QueryWhere();
      $where->set('id', $id);
      $this->model->select('board_group','*', $where);
    } else {
      $this->model->select('board_group', 'id');
      $totalNum = $this->model->getNumRows();
      $this->model->select('board_group','*', null, 'id desc', $passover, $limit);
    }
    
    $numrows = $this->model->getNumRows();
    if ($numrows > 0){
      $dataObj['list'] = array();
      $dataObj['total_num'] = $totalNum;
      $dataList = array();
      $a = $numrows;
      $rows = $this->model->getRows();
      foreach ($rows as $key => $row) {
        $fields = array('no'=>$a);

        foreach ($row as $key => $value) {
          $fields[$key] = $value;
        }

        $dataList[] = $fields;
        $a--;
      }

      $dataObj['list'] =$dataList;
    } else {
      $msg = "게시판이 존재하지 않습니다.";
      $resultYN = "N";
    }

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayGroupModifyJson() {

    $context = Context::getInstance();
    $id = $context->getPost('id');

    $dataObj = array();
    $msg = "";
    $resultYN = "Y";

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('board_group','*', $where);

    $numrows = $this->model->getNumRows();
    if ($numrows > 0) {
      $row = $this->model->getRow();
      foreach ($row as $key => $value) {
        $dataObj[$key] = $value;
      }
      $resultYN = "Y";
    } else {
      $resultYN = "N";
      $msg = '게시판이 존재하지 않습니다.';
    }
    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayCheckBoard() {

    $context = Context::getInstance();
    $category = $context->getPost('category');

    $dataObj  = "";
    $msg = "";
    $resultYN = "Y";

    $msg = "추가 생성 게시판 : ".$category."\n";
    if (empty($category)) {
      $msg = "카테고리명을 넣고 중복체크를 하십시오.";
      $resultYN = "N";
      $data = array(  "result"=>$resultYN,
              "msg"=>$msg);

      $this->callback($data);
      exit;
    }

    if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]{2,}$/i', $category)) {
      $msg .= "카테고리명은 영문+숫자+특수문자('_')로 조합된 단어만 사용가능\n첫글자가 영문 또는 특수문자로 시작되는 4글자 이상 사용하세요.";
      $data = array(  "msg"=>$msg);     
      $this->callback($data);
      exit;
    } 

    $where = new QueryWhere();
    $where->set('category', $category);
    $this->model->select('board_group','id', $where);
    $numrows = $this->model->getNumRows();
    if ($numrows> 0) {
      $msg = "${category}는 이미 존재하는 게시판입니다.";
      $resultYN = "N";
    } else {
      $where = new QueryWhere();
      $where->set('category', $category);
      $this->model->select('document','id', $where);
      $numrows = $this->model->getNumRows();

      if ($numrows> 0) {
        $msg = "${category} 이름은 페이지관리에서 이미 사용하고 있습니다.<br>다른 이름을 사용해주세요.";
        $resultYN = "N";
      } else {
        $msg = "${category}는 사용할 수 있는 카테고리명 입니다.";
        $resultYN = "Y";
      }
    }

    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displaySkinJson() {

    $skinDir = _SUX_PATH_ . "modules/board/skin/";    
    $msg = "";
    $resultYN = "Y";

    $skinList = Utils::readDir($skinDir);
    if (!$skinList) {
      $msg = "스킨폴더가 존재하지 않습니다.";
      $resultYN = "N";
    }
    
    sort($skinList);
    $data = array(  "data"=>array("list"=>$skinList),
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }
}
?>