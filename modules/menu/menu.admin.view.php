<?php

class MenuAdminView extends View
{
  function displayMenuAdmin() {

    $this->displayList();
  }

  function displayList() {

    $context = Context::getInstance();
    $requestData = $context->getRequestAll();
    
    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinRealPath = _SUX_PATH_."modules/menu/tpl";

    $this->document_data['jscode'] = 'list';
    $this->document_data['module_code'] = 'menu';

    $this->request_data = $requestData;
    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['skinRealPath'] = $skinRealPath;
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinRealPath}/admin_list.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayAdd() {

    $context = Context::getInstance();
    $requestData = $context->getRequestAll();
    
    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinRealPath = _SUX_PATH_."modules/menu/tpl";

    $this->document_data['jscode'] = 'add';
    $this->document_data['module_code'] = 'menu';

    $this->request_data = $requestData;
    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['skinRealPath'] = $skinRealPath;
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinRealPath}/admin_modify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();    
  }

  function displayModify() {

    $context = Context::getInstance();
    $requestData = $context->getRequestAll();
    $id = $context->getParameter('id'); 
    
    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinRealPath = _SUX_PATH_."modules/menu/tpl";

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('menu', '*', $where);
    $row = $this->model->getRow();

    $this->document_data['content'] = $row;
    $this->document_data['jscode'] = 'modify';
    $this->document_data['module_code'] = 'menu';
    $this->request_data = $requestData;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['skinRealPath'] = $skinRealPath;
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinRealPath}/admin_modify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();    
  }

  function displayListJson() {
    
    $msg = '';
    $resultYN = 'Y';
    $json = array('data'=>array());

    $context = Context::getInstance();

    $id = $context->getRequest('id');
    $where = null;

    if (isset($id) && $id) {
        $where = QueryWhere::getInstance();
        $where->set('id', $id);
    }

    $result = $this->model->select('menu', '*', $where);    
    if ($result) {      
      $json['data']['list'] = $this->model->getRows();
      $json['data']['total_num'] = $this->model->getNumRows();
    } else {
      $msg .= '메뉴 테이블 선택을 실패하였습니다.';
      $resultYN = 'N';
    }

    $json['result'] = $resultYN;
    $json['msg'] = $msg;

    $this->callback($json);
  }

  function displayGnbList() {

    $resultYN = 'Y';
    $json = array('data'=>array());

    $gnburl = './files/gnb/gnb.json';
    $gnburl = FileHandler::getRealPath($gnburl);
    $jsonList = FileHandler::readFile($gnburl);
    $list = json_decode($jsonList);
    $json['data']['list'] = $list->data;
    $json['data']['total_num'] = count($list->data);

    $json['result'] = $resultYN;
    $json['msg'] = $msg;
   
    $this->callback($json);
  }
}