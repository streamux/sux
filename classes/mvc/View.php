<?php

class View extends Basic
{
  var $model = NULL;
  var $controller = NULL;
  var $copyright_path = '';
  var $skin_path_list = array();
  var $session_data = null;
  var $request_data = null;
  var $post_data = null;
  var $document_data = array();
  var $cookie_version = '';

  function __construct($m=NULL, $c=NULL)
  {
    $this->model = $m;
    $this->controller = $c;
  }

  function getModel()
  {
    return $this->model;
  }

  function getController()
  {
    return $this->controller;
  }

  function display( $methodName, $category=null, $mid=-1, $id=-1)
  {
    $methodName = 'display' . ucfirst($methodName);

    $this->defaultSetting();
    $this->{$methodName}( $category, $mid, $id);
  }

  function defaultSetting()
  {
    $context = Context::getInstance();
    $this->session_data = $context->getSessionAll();
    $this->request_data = $context->getRequestAll();
    $this->post_data = $context->getPostAll();
    $this->copyright_path = _SUX_PATH_ . 'modules/admin/tpl/copyright.tpl';

    $versionCookieId = $context->getCookieId('version');
    $this->cookie_version = $context->getCookie($versionCookieId);
    $this->document_data['is_admin_login'] = $context->isAdminLogin();
  }

  function output()
  {

    $UIError = UIError::getInstance();    

    /**
     * @class Template
     * @brief Template is a Wrapper Class based on Smarty
     */
    $routeURI = $this->skin_path_list['root'] . $this->document_data['category'];
    $__template = new Template();
    $__template->assign('baseUri', str_replace('/', '', _SUX_ROOT_));
    $__template->assign('copyrightPath', $this->copyright_path);

    $__template->assign('realPath', _SUX_PATH_);
    $__template->assign('rootPath', $this->skin_path_list['root']);
    $__template->assign('skinPath', $this->skin_path_list['path']);
    $__template->assign('skinRealPath', $this->skin_path_list['realPath']);
    $__template->assign('routeURI', $routeURI);

    $__template->assign('sessionData', $this->session_data);
    $__template->assign('requestData', $this->request_data);      
    $__template->assign('postData', $this->post_data);
    $__template->assign('documentData', $this->document_data);
    $__template->assign('groupData', $this->document_data['group']);
    $__template->assign('contentData', $this->document_data['content']);
    $__template->assign('cookieVersion', $this->cookie_version);
    $__template->assign('browserTitle', $this->document_data['module_name']);
    $__template->assign('skinPathList', $this->skin_path_list);
    $__template->assign('contentPath', $this->skin_path_list['content']);


    $this->skin_path_list['layout'] = 'layouts/default/layout.tpl';

    if (is_readable($this->skin_path_list['layout'])) {
      $__template->display( $this->skin_path_list['layout'] );  
    } else {
      $UIError->add('layout.tpl 레이아웃 파일경로가 올바르지 않습니다.');
      $UIError->useHtml = TRUE;
    }

    $UIError->output(); 
  } 
}
?>