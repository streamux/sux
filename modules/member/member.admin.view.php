<?php

class MemberAdminView extends View {

  function displayMemberAdmin() {

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    if (isset($id) && $id > 0) {
      $this->displayList();
    } else {
      $this->displayGroup();
    }   
  }

  function displayGroup() {

    $context = Context::getInstance();
    $this->request_data = $context->getRequestAll();

    $action = $this->request_data['action'];
    $this->document_data['jscode'] = 'groupList';
    $this->document_data['module_code'] = 'member';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->model->select('member_group', 'id');
    $totalNum = $this->model->getNumRows();

    $this->document_data['total_num'] = $totalNum;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_grouplist.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupAdd() {
    
    $context = Context::getInstance();
    $this->request_data = $context->getRequestAll();

    $action = $this->request_data['action'];
    $this->document_data['jscode'] = 'groupAdd';
    $this->document_data['module_code'] = 'member';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_groupadd.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupModify() {

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] = 'groupModify';
    $this->document_data['module_code'] = 'member';

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('member_group', '*', $where);
    $row = $this->model->getRow();

    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_groupmodify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupDelete() {
    
    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] = 'groupDelete';
    $this->document_data['module_code'] = 'member';
    
    $where = QueryWhere::getInstance();
    $where->set('id', $id);
    $this->model->select('member_group', 'group_name', $where);
    $row = $this->model->getRow();

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->request_data['id'] = $id;           
    $this->document_data['content'] = $row;    
    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_groupdelete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayGroupJson() {

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

    $dataObj = array();   
    $msg = "";
    $resultYN = "Y";

    if (isset($id) && $id) {
      $where = new QueryWhere();
      $where->set('id', $id);
      $result = $this->model->select('member_group', '*', $where);
    } else {
      $this->model->select('member_group', 'id');
      $totalNum = $this->model->getNumRows();
      $result = $this->model->select('member_group', '*', null, 'id desc');
    }
    
    if ($result){
      $numrow = $this->model->getNumRows();
      if ($numrow > 0) {

        $where = new QueryWhere();
        $dataObj['list'] = array();
        $dataObj['total_num'] = $totalNum;

        $rows = $this->model->getRows();
        foreach ( $rows as $key => $row) {

          $where->reset();
          $where->set('category', $row['category']);
          $this->model->select('member', 'id', $where);
          $dataList['member_num'] = $this->model->getNumRows();

          $dataList['no'] = (int) $key+1;
          foreach ($row as $key => $value) {
            $dataList[$key] = $value;
          }
          $dataObj['list'][] = $dataList;
        }
      } else {
        $msg = "회원그룹이 존재하지 않습니다.";
        $resultYN = "N";
      }
    } 

    $json = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg); 

    $this->callback($json);
  }

  function displayGroupModifyJson() {

    $dataObj = array();   
    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
   $requests = $context->getRequestAll();
    $id = $requests['id'];

    $where = new QueryWhere();
    $where->set('id', $id);

    $result = $this->model->select('member_group', '*', $where);    
    if ($result){
      $dataObj = $this->model->getRow();
    } 

    //$msg .= Tracer::getInstance()->getMessage();
    $json = array(  'data'=>$dataObj,
                            'result'=>$resultYN,
                            'msg'=>$msg); 

    $this->callback($json);
  }

  function displayList() {
    
    $context = Context::getInstance();
    $groupId = $context->getParameter('id');

    if (isset($groupId) && $groupId) {
      $where = new QueryWhere();
      $where->set('id', $groupId);
      $this->model->select('member_group', 'category', $where);
      $row = $this->model->getRow();
    }

    $this->model->select('member_group', 'category');
    $categoryList = $this->model->getRows();    

    $this->model->select('member', '*');
    $totalNum = $this->model->getNumRows();

    $this->document_data['categories'] = $categoryList; 
    $this->document_data['total_num'] = $totalNum;

    $this->document_data['category'] = $row['category'];
    $this->document_data['jscode'] = 'list';
    $this->document_data['module_code'] = 'member';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_list.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayAdd() {
    
    $context = Context::getInstance();
    $requests = $context->getRequestAll();

    $this->model->select('member_group', 'category');
    $group = $this->model->getRows();    
    
    $this->request_data = $requests;
    $this->document_data['jscode'] = 'add';
    $this->document_data['module_code'] = 'member';
    $this->document_data['group'] = $group; 

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_add.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayModify() {
    
    $context = Context::getInstance();    
    $sessions = $context->getSessionAll();
    $id = $context->getParameter('id');
    $category = $sessions['category'];
    $userId = $sessions['user_id'];

    $this->document_data['jscode'] = 'modify';
    $this->document_data['module_code'] = 'member';

    $this->model->select('member_group', 'category');
    $categories = $this->model->getRows();

    $where = new QueryWhere();
    if (isset($id) && $id) {
      $where->set('id', $id);
    } else {
      $where->set('category', $category);
      $where->set('user_id', $userId);
    }    
    $this->model->select('member', 'id, category, user_id, user_name', $where);
    $row = $this->model->getRow();

    $this->document_data['category'] = $row['category'];
    $this->document_data['categories'] = $categories;
    $this->document_data['user_id'] = $row['user_id'];
    $this->document_data['user_name'] = $row['user_name'];
    $this->document_data['id'] = $row['id'];

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_modify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayDelete() {
    
    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] = 'delete';
    $this->document_data['module_code'] = 'member';

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('member', 'user_id', $where);
    $row = $this->model->getRow();

    $this->document_data['user_id'] = $row['user_id'];
    $this->document_data['category'] = $row['category'];
    $this->document_data['id'] = $id;    

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/member/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_delete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayListJson() {

    $dataObj = array();
    $dataList = array();
    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $category = $posts['category'];
    $passover = $posts['passover'];
    $limit = $posts['limit'];

    $findGroup = $posts['find_group'];
    if (isset($findGroup) && $findGroup) {
      $category = $findGroup;
    }
    $find = $posts['find'];
    $search = $posts['search'];

    if (!$limit) {
      $limit = 10;  
    }

    if (!$passover) {
      $passover = 0;
    }

    $where = new QueryWhere();

    if (isset($search) && $search) { 

      if (preg_match('/,/', $find)) {
        $findPieces = explode(',', $find);

        for ($i=0; $i<count($findPieces); $i++) {
          $findPiece = trim($findPieces[$i]);
          $where->set($findPiece, $search, 'like', 'or');
        }
      } else {
        $where->set($find, $search, 'like');
      }
    }

    if (isset($category) && $category) {
      $where->set('category', $category, '=', 'and');
    }

    $this->model->select('member', '*', $where);      
    $numrows = $this->model->getNumRows();

    if ($numrows > 0){        
      $a = $numrows - $passover;
      $result = $this->model->select('member', '*', $where, 'id desc', $passover, $limit);

      if ($result) {
        $rows = $this->model->getRows();

        for ($i=0; $i<count($rows); $i++) {
          $obj = array();
          $obj['hp'] = '';
          $obj['no'] = $a;

          foreach ($rows[$i] as $key => $value) {
            $obj[$key] = $value;
          }

          if (isset($obj['hp1']) && $obj['hp1']) {
            $obj['hp'] =  $obj['hp1'] .' - '. $obj['hp2'] . ' - '. $obj['hp3'];
          }              
          $dataList[] = $obj;
          $a--;
        }

        $dataObj = array(
          'category'=>$category,
          'list'=>$dataList,
          'total_num'=>$numrows
        );
      }       
    } else {

      $dataObj = array('category'=>$category, 'list'=>$dataList);
      $msg .= '현재 등록된 회원이 존재하지 않습니다.';
      $resultYN = 'N';
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $json = array(  'data'=>$dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($json);
  }

  function displayModifyJson() {
    
    $context = Context::getInstance();
    $sessions = $context->getSessionAll();
    $category = $sessions['category'];
    $userId = $sessions['user_id'];
    $id = $context->getPost('id');

    $dataObj = array();
    $msg = "";
    $resultYN = "Y";

    $where = new QueryWhere();

    if (isset($id) && $id) {
      $where->set('id', $id);
    } else {
      $where->set('category', $category);
      $where->set('user_id', $userId);
    }

    $result = $this->model->select('member', '*', $where);

    if ($result) {
      $row = $this->model->getRow();
      foreach ($row as $key => $value) {
        $dataObj[$key] = $value;
      }
    } 

    if (isset($row['hp1']) && $row['hp1']) {
      $dataObj['hp'] = $row['hp1'] .' - '. $row['hp2'] . ' - '. $row['hp3'];
    }

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  } 
}
