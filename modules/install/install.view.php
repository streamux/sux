<?php

class InstallView extends View
{

  function checkInstall() {

    $context = Context::getInstance();

    // 관리자 로그인 없이 설치를 시도한 경우 
    if ($context->installed() && $context->isAdminLogin() === false) {
      $uri = _SUX_ROOT_ . 'login-admin';
      header("Location: $uri");
      exit();
    }
  }

  function displayInstall() {

    $this->displayTerms();  
  }

  function displayTerms() {

    $this->checkInstall();

    $this->skin_path_list['root'] = _SUX_ROOT_;
    $this->skin_path_list['header'] = _SUX_PATH_.'modules/install/tpl/_header.tpl';
    $this->skin_path_list['footer'] = _SUX_PATH_.'modules/install/tpl/_footer.tpl';
    $this->skin_path_list['content'] = _SUX_PATH_ . 'modules/install/tpl/terms.tpl';

    $this->output();
  }

  function displaySetupDb() {

    $this->checkInstall();

    $context = Context::getInstance();
    $this->request_data['action'] = 'setupDb';

    $this->skin_path_list['root'] = _SUX_ROOT_;
    $this->skin_path_list['header'] = _SUX_PATH_.'modules/install/tpl/_header.tpl';
    $this->skin_path_list['footer'] = _SUX_PATH_.'modules/install/tpl/_footer.tpl';
    $this->skin_path_list['content'] = _SUX_PATH_ . 'modules/install/tpl/db_setup.tpl';

    $this->output();
  }

  function displaySetupAdmin() {

    $this->checkInstall();

    // DB 접속 테스트 
    $oDB = DB::getInstance();
    $oDB->close();

    $context = Context::getInstance();
    $this->request_data['action'] = 'setupAdmin';

    $this->skin_path_list['root'] = _SUX_ROOT_;
    $this->skin_path_list['header'] = _SUX_PATH_.'modules/install/tpl/_header.tpl';
    $this->skin_path_list['footer'] = _SUX_PATH_.'modules/install/tpl/_footer.tpl';
    $this->skin_path_list['content'] = _SUX_PATH_ . 'modules/install/tpl/admin_setup.tpl';

    $this->output();
  } 

  function displayUninstall() {

    $this->checkInstall();

    $context = Context::getInstance();
    $this->request_data['action'] = 'uninstall';

    $this->skin_path_list['root'] = _SUX_ROOT_;
    $this->skin_path_list['header'] = _SUX_PATH_.'modules/install/tpl/_header.tpl';
    $this->skin_path_list['footer'] = _SUX_PATH_.'modules/install/tpl/_footer.tpl';
    $this->skin_path_list['content'] = _SUX_PATH_ . 'modules/install/tpl/uninstall.tpl';

    $this->output();
  }
}