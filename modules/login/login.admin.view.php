<?php

class LoginAdminView extends View {

  var $class_name = 'login_view';

  function displayLoginAdmin() {

    $context = Context::getInstance();    

    $this->session_data = $context->getSessionAll();
    $this->request_data = $context->getRequestAll();

    $this->document_data['jscode'] = 'loginAdmin';
    $this->document_data['module_code'] = 'login';
    $this->document_data['module_name'] = '관리자 로그인';
    
    /**
     * skin directory path
     */
    $rootPath = _SUX_ROOT_;
    $adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
    $skinPath = _SUX_PATH_ . "modules/login/tpl"; 

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['dir'] = $skinPath;
    $this->skin_path_list['header'] = "{$skinPath}/_header_admin.tpl";
    $this->skin_path_list['contents'] = "{$skinPath}/login_admin.tpl";
    $this->skin_path_list['footer'] = "{$skinPath}/_footer_admin.tpl";

    $this->output();
  }

  function displayLogoutAdmin() {
    echo 'This is a ViewPage of LogoutAdmin';
  }
}
