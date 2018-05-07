<?php

class LoginAdminView extends View {

  var $class_name = 'login_view';

  function displayLoginAdmin() {

    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_PATH_ . "modules/login/tpl"; 

    $context = Context::getInstance();
    $loginCookieId = $context->getCookieId('login_keeper');
    $loginKeeper = $context->getCookie($loginCookieId);

    $this->document_data['jscode'] = 'loginAdmin';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '관리자 로그인';
    $this->document_data['loginKeeper'] = $loginKeeper;
    
    if ($context->isAdminLogin()) {
      Utils::goURL($rootPath . 'admin-admin');
      exit;
    }

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = $skinPath;
    $this->skin_path_list['header'] = "{$skinPath}/_header_admin.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/login_admin.tpl";
    $this->skin_path_list['footer'] = "{$skinPath}/_footer_admin.tpl";

    $this->output();
  }
  
  function displayRegisterAdmin() {

    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_PATH_ . "modules/login/tpl"; 

    $this->document_data['jscode'] = 'registerAdmin';
    $this->document_data['module_code'] = 'register';
    $this->document_data['module_name'] = '관리자 등록';
    
    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = $skinPath;
    $this->skin_path_list['header'] = "{$skinPath}/_header_admin.tpl";
    $this->skin_path_list['content'] = "{$skinPath}/register_admin.tpl";
    $this->skin_path_list['footer'] = "{$skinPath}/_footer_admin.tpl";

    $this->output();
  }
}
