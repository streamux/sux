<?php

class PopupAdminView extends View
{

  function displayPopupAdmin() {

    $this->displayList();
  }

  function displayList() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/popup/tpl";

    $this->document_data['jscode'] = 'list';
    $this->document_data['module_code'] = 'popup';

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
    $skinPath = _SUX_PATH_ . "modules/popup/tpl";

    $path = _SUX_PATH_ . "modules/popup/skin/";
    $skinList = Utils::readDir($path);
    if (!$skinList) {
      $skinList['file_name'] = 'not exists';
    }

    $this->document_data['skin_list'] = $skinList;
    $this->document_data['jscode'] = 'add';
    $this->document_data['module_code'] = 'popup';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_add.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayModify() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/popup/tpl";

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $path = _SUX_PATH_ . "modules/popup/skin/";
    $skinList = Utils::readDir($path);
    if (!$skinList) {
      $skinList['file_name'] = 'not exists';
    }

    $this->document_data['id'] = $id;
    $this->document_data['skin_list'] = $skinList;
    $this->document_data['jscode'] = 'modify';
    $this->document_data['module_code'] = 'popup';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_modify.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayDelete() {

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/popup/tpl";

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('popup', 'id, popup_name', $where);
    $rows = $this->model->getRows();
    foreach ($rows[0] as $key => $value) {
      $this->document_data[$key] = $value;
    }
    $this->document_data['jscode'] = 'delete';
    $this->document_data['module_code'] = 'popup';

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_delete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayListJson() {

    $dataObj = array();   
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
      $result = $this->model->select('popup', '*', $where);
    } else {
      $this->model->select('popup', 'id');
      $totalNum = $this->model->getNumRows();
      $result = $this->model->select('popup', '*', null, 'id desc', $passover, $limit);
    }

    if ($result){
      $numrow = $this->model->getNumRows();
      if ($numrow > 0) {
        $dataObj['list'] = array();
        $dataObj['total_num'] = $totalNum;
        $rows = $this->model->getRows();

        for ($i=0; $i<$numrow; $i++) {
          $timeList = array();
          $dataList = array('no'=>($numrow - $i));

          foreach ($rows[$i] as $key => $value) {
            if (preg_match('/(time+)/i', $key)) {
              $timeList[$key] = UtilsString::digit($value);
            } else {
              $dataList[$key] = $value;
            }            
          }
          $dataList['date'] = $timeList['time_year'] . '-' . $timeList['time_month'] . '-' . $timeList['time_day'];
          $dataList['time'] = $timeList['time_hours'] . ':' . $timeList['time_minutes'] . ':' . $timeList['time_seconds'];
          $dataObj['list'][] = $dataList;
        }
      } else {
        $msg .= "등록된 팝업이 없습니다.";
        $resultYN = "N";
      }
    } 

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayModifyJson() {

    $dataObj = array('list'=>null); 
    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $id = $context->getPost('id');
    if (empty($id)) {
      $id = $context->getRequest('id');
    }

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->select('popup', '*', $where);
    if ($result) {
      $dataObj['list'] = $this->model->getRows();
    } else {
      $msg .= "팝업이 존재하지 않습니다.";
      $resultYN = "N";
    }

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  } 

  function displaySkinJson() {

    $dataObj = array();
    $msg = "";
    $resultYN = "Y";

    $path = _SUX_PATH_ . "modules/popup/skin/";
    $dataObj = Utils::readDir($path);
    if (!$dataObj) {
      $dataObj[] = array('file_name' => 'not exists');
    }

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }
}
