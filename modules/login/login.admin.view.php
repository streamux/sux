<?php

class LoginAdminView extends View {

  var $class_name = 'login_view';

  function displayLoginAdmin() {

    $context = Context::getInstance();

    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_PATH_ . "modules/login/tpl"; 

    $this->document_data['jscode'] = 'loginAdmin';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '관리자 로그인';
    
    if ($context->isAdminLogin()) {
      Utils::goURL($rootPath . 'admin-admin');
      exit;
    }    

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = $skinPath;
    $this->skin_path_list['header'] = "{$skinPath}/_header_admin.tpl";
    $this->skin_path_list['contents'] = "{$skinPath}/login_admin.tpl";
    $this->skin_path_list['footer'] = "{$skinPath}/_footer_admin.tpl";

    $this->output();
  }
  function displayLogoutAdmin() {
    
    $context = Context::getInstance();
    $rootPath = _SUX_ROOT_;

    $context->setSession('admin_ok', '');

    $data = array(  'msg'=>'로그아웃',
            'result'=>'Y',
            'url'=>$rootPath . 'login-admin',
            'delay'=>0);
      
    $this->callback($data);
  }
  function displayRegisterAdmin() {

    $context = Context::getInstance();    

    $this->session_data = $context->getSessionAll();
    $this->request_data = $context->getRequestAll();

    $this->document_data['jscode'] = 'registerAdmin';
    $this->document_data['module_code'] = 'register';
    $this->document_data['module_name'] = '관리자 등록';
    
    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_PATH_ . "modules/login/tpl"; 

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = $skinPath;
    $this->skin_path_list['header'] = "{$skinPath}/_header_admin.tpl";
    $this->skin_path_list['contents'] = "{$skinPath}/register_admin.tpl";
    $this->skin_path_list['footer'] = "{$skinPath}/_footer_admin.tpl";

    $this->output();
  }
}
