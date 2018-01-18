<?php

class AnalyticsAdminView extends View
{
  function displayAnalyticsAdmin() {

    $this->displayConnectSiteList();
  }

  function displayConnectSite() {

    $this->displayConnectSiteList();
  }

  function displayConnectSiteList() {

    $context = Context::getInstance();    

    $this->document_data['jscode'] = 'connectSiteList';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_connect_site_list.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayConnectSiteAdd() {

    $context = Context::getInstance();

    $this->document_data['jscode'] = 'connectSiteAdd';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_connect_site_add.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayConnectSiteReset() {

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] ='connectSiteReset';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('connect_site', 'id, name', $where);

    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_connect_site_reset.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayConnectSiteDelete() {

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] = 'connectSiteDelete';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->select('connect_site', 'id, name', $where); 

    /*while($rows = $this->model->getMySqlFetchArray($result)) {
      foreach ($rows as $key => $value) {
        echo $key . ' : ' . $value;
      }
    }*/

    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_connect_site_delete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayConnectSiteListJson() {

    $dataObj = null;
    $dataList = array();
    $totalNum = 0;
    $msg = '';
    $resultYN = 'Y';  

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
      $result = $this->model->select('connect_site', '*', $where);
    } else {
      $this->model->select('connect_site', 'id');
      $totalNum = $this->model->getNumRows();
      $result = $this->model->select('connect_site', '*', null, 'id desc', $passover, $limit);
    }    
    if ($result){

      $numrows = $this->model->getNumRows();
      if ($numrows > 0){

        $a = $totalNum - $passover;
        $rows = $this->model->getRows();
        for($i=0; $i<count($rows); $i++) {

          $fields = array('no'=>$a);
          foreach ($rows[$i] as $key => $value) {

            $fields[$key] = $value;
            if (preg_match('/^(date+)$/i', $key) && empty($value)) {
              $fields[$key] = '0000-00-00';
            }            
          }

          $dataList[] = $fields;
          $a--;
        }

        $dataObj = array(
          "list"=>$dataList,
          'total_num'=>$totalNum
          );
      } else {
        $msg .= "등록된 접속키워드가 존재하지 않습니다.";
        $resultYN = "N";
      }
    } else {
      $msg .= "DB 접속을 실패하였습니다.";
      $resultYN = "N";
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayPageview() {

    $this->displayPageviewList();
  }

  function displayPageviewList() {

    $context = Context::getInstance();


    $this->document_data['jscode'] = 'pageviewList';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_pageview_list.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayPageviewAdd() {

    $context = Context::getInstance();

    $this->document_data['jscode'] = 'pageviewAdd';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_pageview_add.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayPageviewReset() {

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] = 'pageviewReset';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('pageview', 'id, name', $where);

    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_pageview_reset.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayPageviewDelete() {

    $context = Context::getInstance();
    $id = $context->getParameter('id');

    $this->document_data['jscode'] = 'pageviewDelete';
    $this->document_data['module_code'] = 'analytics';

    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/analytics/tpl";

    $where = new QueryWhere();
    $where->set('id', $id);
    $this->model->select('pageview', 'id, name', $where);

    $row = $this->model->getRow();
    foreach ($row as $key => $value) {
      $this->document_data[$key] = $value;
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = '';
    $this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/admin_pageview_delete.tpl";
    $this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

    $this->output();
  }

  function displayPageviewListJson() {

    $dataObj = array();
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
      $result = $this->model->select('pageview', '*', $where);
    } else {
      $this->model->select('pageview', 'id');
      $totalNum = $this->model->getNumRows();
      $result = $this->model->select('pageview', '*', null, 'id desc', $passover, $limit);
    }

    if ($result){
      $numrows = $this->model->getNumRows();
      if ($numrows > 0){

         $a = $totalNum - $passover;
        $rows = $this->model->getRows();
        for($i=0; $i<count($rows); $i++) {

          $fields = array('no'=>$a);
          $row = $rows[$i];
          foreach ($row as $key => $value) {
            $fields[$key] = $value;
          }

          $dataList[] = $fields;
          $a--;
        }

        $dataObj = array(
          "list"=>$dataList,
          'total_num'=>$totalNum
        );
      } else {
        $msg = "등록된 페이지뷰가 존재하지 않습니다.";
        $resultYN = "N";
      }
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }
}