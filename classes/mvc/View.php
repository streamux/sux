<?php

class View extends Object {

  var $class_name = 'base_view';
  var $model = NULL;
  var $controller = NULL;
  var $copyright_path = '';
  var $skin_path_list = array();
  var $session_data = null;
  var $request_data = null;
  var $post_data = null;
  var $document_data = array();

  function __construct($m=NULL, $c=NULL) {
    
    $this->model = $m;
    $this->controller = $c;
  }

  function display( $methodName, $category=null, $mid=-1, $id=-1) {
    
    $methodName = 'display' . ucfirst($methodName);
    $this->defaultSetting();
    $this->{$methodName}( $category, $mid, $id);
  }

  function defaultSetting() {

    $context = Context::getInstance();
    $this->session_data = $context->getSessionAll();
    $this->requestData = $context->getRequestAll();
    $this->postData = $context->getPostAll();
    $this->copyright_path = _SUX_PATH_ . 'modules/admin/tpl/copyright.tpl';
  }

  function output() {

    $UIError = UIError::getInstance();    

    /**
     * @class Template
     * @brief Template is a Wrapper Class based on Smarty
     */

    $routeURI = $this->skin_path_list['root'] . $this->document_data['category'];
    $__template = new Template();
    $__template->assign('baseUri', str_replace('/', '', _SUX_ROOT_));
    $__template->assign('copyrightPath', $this->copyright_path);

    $__template->assign('rootPath', $this->skin_path_list['root']);
    $__template->assign('skinPath', $this->skin_path_list['path']);
    $__template->assign('skinRealPath', $this->skin_path_list['realPath']);
    $__template->assign('routeURI', $routeURI);

    $__template->assign('sessionData', $this->session_data);
    $__template->assign('requestData', $this->request_data);      
    $__template->assign('postData', $this->post_data);
    $__template->assign('documentData', $this->document_data);
    $__template->assign('groupData', $this->document_data['group']);
    $__template->assign('contentData', $this->document_data['contents']);
    $__template->assign('browserTitle', $this->document_data['module_name']);
    $__template->assign('skinPathList', $this->skin_path_list);

    if (is_readable($this->skin_path_list['header'])) {
      $__template->display( $this->skin_path_list['header'] );  
    } else {
      $UIError->add('_header.tpl 스킨 파일경로가 올바르지 않습니다.');
      $UIError->useHtml = TRUE;
    }

    if (is_readable($this->skin_path_list['contents'])) {
      $__template->display( $this->skin_path_list['contents'] );  
    } else {
      $UIError->add('스킨 파일경로가 올바르지 않습니다.');
      $UIError->useHtml = TRUE;
    }

    if (is_readable($this->skin_path_list['footer'])) {
      $__template->display( $this->skin_path_list['footer'] );  
    } else {
      $UIError->add('_footer.tpl 스킨 파일경로가 올바르지 않습니다.');
      $UIError->useHtml = TRUE;
    } 
    $UIError->output(); 
  } 
}
?>