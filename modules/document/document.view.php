<?php
class DocumentView extends View
{

  function displayContents() {

    $context = Context::getInstance();
    $category = $context->getParameter('category');
    $this->session_data = $context->getSessionAll();

    $where = new QueryWhere();
    $where->set('category',$category,'=');
    
    $this->model->select('document', '*', $where);
    
    $groupData = $this->model->getRow();
    $headerPath = $groupData['header_path'];
    $contentsPath = $groupData['contents_path'];
    $footerPath = $groupData['footer_path'];

    $this->document_data['jscode'] = 'contents';
    $this->document_data['module_code'] = $category;
    $this->document_data['module_name'] = $groupData['document_name'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $realPath = _SUX_PATH_;
    $skinPath = _SUX_ROOT_ . $contentsPath . '/';
    $skinRealPath = _SUX_PATH_."modules/document/skin/";    
    $contentsPath = $contentsPath . '/' . $category . '.tpl';

    /**
     * @var headerPath, contentsPath, footerPath
     * @descripttion
     * smarty include 상대경로 접근 방식이 달라서 convertAbsolutePath()함수를 이용해 절대경로 처리 함.
     */   
    $headerPath = Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $contentsPath = Utils::convertAbsolutePath($contentsPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    if (!is_readable($headerPath)) {
      $headerPath = $realPath . "modules/document/tpl/_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    if (!is_readable($footerPath)) {
      $footerPath = $realPath . "modules/document/tpl/_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }

    $this->document_data['group'] = $groupData;
    $this->document_data['contents'] = $contentData;
    $this->document_data['category'] = $category;
    
    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['contents'] = $contentsPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }
}