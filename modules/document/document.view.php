<?php
class DocumentView extends View
{

  function displayContent() {

    $context = Context::getInstance();
    $category = $context->getParameter('category');

    $where = new QueryWhere();
    $where->set('category',$category,'=');    
    $this->model->select('document', '*', $where);    
    $groupData = $this->model->getRow();

    $headerPath = $groupData['header_path'];
    $templateType = $groupData['template_type'];
    $templateMode = $groupData['template_mode'];
    $footerPath = $groupData['footer_path'];

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $realPath = _SUX_PATH_;
    
    $templateDir = array();    
    $templateDir['o'] = 'modules/document/templates/';
    $templateDir['p'] = 'files/document/';    
    $templateName = $templateMode === 'o' ? $templateType : $category;
    $templatePath = $templateDir[$templateMode] . $templateName . '/';

    $this->document_data['jscode'] = 'content';
    $this->document_data['module_code'] = 'default';
    $this->document_data['module_name'] = $groupData['document_name'];
    $this->document_data['module_type'] = 'document';

    /**
     * @var headerPath, contentPath, footerPath
     * @descripttion
     * smarty include 상대경로 접근 방식이 달라서 convertAbsolutePath()함수를 이용해 절대경로 처리 함.
     */   

    $headerPath = Utils::convertAbsolutePath($headerPath, $realPath);
    $templateRealPath = Utils::convertAbsolutePath($templatePath, $realPath);
    $footerPath = Utils::convertAbsolutePath($footerPath, $realPath);

    if (!is_readable($headerPath)) {
      $headerPath = $realPath . "modules/document/tpl/_header.tpl";
      $UIError->add("상단 파일경로가 올바르지 않습니다.");
    }

    if (!is_readable($footerPath)) {

      $footerPath = $realPath . "modules/document/tpl/_footer.tpl";
      $UIError->add("하단 파일경로가 올바르지 않습니다.");
    }

    $templateRealPath = $templateRealPath . 'default.tpl';

    //$msg .= Tracer::getInstance()->getMessage() . "<br>";
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;
    $this->document_data['category'] = $category;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $templatePath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;
    $this->skin_path_list['content'] = $templateRealPath;
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }
}