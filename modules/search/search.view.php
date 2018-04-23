<?php

class SearchView extends View
{
  function displaySearch() {

    $this->displayList();
  }

  function displayList() {

    $msg = '';
    $resultYN = 'Y';
    $json = array('data'=>array());

    $context = Context::getInstance();
    $requestData = $context->getRequestAll(); 
    $this->session_data = $context->getSessionAll();

    $returnURL = $context->getServer('REQUEST_URI'); 
    $domain = $context->getServer('HTTP_HOST'); 
    $search = $context->getRequest('search');
    $passover = $context->getRequest('passover');
    $limit = $context->getParameter('limit');

    if (empty($limit)) {
      $limit = 10;
    }
    
    if (empty($passover)) {
      $passover = 0;
    }

    $this->document_data['jscode'] = '';
    $this->document_data['module_code'] = 'search';
    $this->document_data['module_name'] = '검색 목록';      

    /**
     * css, js file path handler
     */
    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/search/tpl/";
    $skinRealPath = _SUX_PATH_ . "modules/search/tpl/"; 

    $headerPath = 'common/_header.tpl';
    $footerPath = 'common/_footer.tpl';

    /**
     * @var headerPath
     * @descripttion
     * smarty include 상대경로 접근 방식이 달라서 convertAbsolutePath()함수에 절대경로 처리 함.
     */   
    $headerPath =Utils::convertAbsolutePath($headerPath, _SUX_PATH_);
    $footerPath = Utils::convertAbsolutePath($footerPath, _SUX_PATH_);

    $where = new QueryWhere();
    $where->set('is_active', true);
    $this->model->select('menu', '*', $where);
    $menuRows = $this->model->getRows();
    
    $this->model->select('board_group', '*');
    $rows = $this->model->getRows();
    $groupData = $rows[0];

    $where->reset();
    $where->add('(');

    for ($i=0; $i < count($menuRows); $i++) { 
      $where->set('category', $menuRows[$i]['category'],'=', 'or');
    }

    $where->add(')');
    $where->add('and');
    $where->add('(');
    $where->set('user_name', $search, 'like', '');
    $where->set('title', $search, 'like', 'or');
    $where->set('content', $search, 'like', 'or');
    $where->add(')');    
    $result = $this->model->select('board', '*', $where);

    if (isset($search) && $search) {
      $where->add('and');
      $where->add('(');
      $where->set('user_name', $search, 'like', '');
      $where->set('title', $search, 'like', 'or');
      $where->set('content', $search, 'like', 'or');
      $where->add(')'); 
    }

    $result = $this->model->select('board', '*', $where);    
    $numrows = $this->model->getNumRows();
    $result = $this->model->select('board', '*', $where, 'id desc', $passover, $limit);    

    if ($result) {
      $contentData['list'] = $this->model->getRows();
      $today = date("Y-m-d");

      for ($i=0; $i<count($contentData['list']); $i++) {
        $category = $contentData['list'][$i]['category'];
        $id = $contentData['list'][$i]['id'];
        $user_id = $contentData['list'][$i]['user_id'];
        $name =htmlspecialchars($contentData['list'][$i]['user_name']); 
        $title = trim(htmlspecialchars($contentData['list'][$i]['title']));
        $contents = trim(htmlspecialchars($contentData['list'][$i]['content']));
        $contents = Utils::ignoreNewline($contents);
        $contents = Utils::trimText($contents, 120, '..');

        $progressStep =$contentData['list'][$i]['progress_step'];
        $hit =htmlspecialchars($contentData['list'][$i]['readed_count']);
        $space = $contentData['list'][$i]['space_count'];
        $filename = $contentData['list'][$i]['filename'];
        $filetype = trim($contentData['list'][$i]['filetype']);
        $date =$contentData['list'][$i]['date'];        
        $compareDayArr = preg_split(' ', $date);
        $compareDay = $compareDayArr[0];
        
        $subject = array();
        $subject['category'] = $category;
        $subject['id'] = $id;
        $subject['title'] = $title;      
        $subject['img_name'] = '';
        $subject['progress_step_name'] = '';

        // 'hide' in value is a class name of CSS
        $subject['space'] = 0;
        $subject['prefix_icon'] = '';
        $subject['prefix_icon_type'] = 0;
        $subject['icon_img'] = 'sx-hide';
        $subject['css_comment'] = 'sx-hide';
        $subject['comment_num'] = 0;
        $subject['icon_new'] = 'sx-hide';
        $subject['icon_opkey'] = 'sx-hide';

        if (isset($space) && $space) {
          $subject['space'] = $space*10;
          $subject['prefix_icon'] = '답변';
          $subject['prefix_icon_color'] = 'sx-bg-replay';
        }

        if (isset($filename) && $filename){
          if (preg_match('/(image\/gif|image\/jpeg|image\/x-png|image\/bmp)+/', $filetype)) {             
            $imgname = "icon_img.png";
          } else if ($download === 'y'  && preg_match('/(application/x-zip-compressed|application/zip)+/', $filetype)) { 
            $imgname = "icon_down.png";
          }

          if (isset($imgname) && $imgname) {
            $subject['icon_img'] = 'sx-show-inline';
            $subject['img_name'] = $imgname;
          } 
        }        

        if ($compareDay == $today){
          $subject['icon_new'] = 'sx-show';
          $subject['icon_new_title'] = 'new';
        }
        
        $subject['progress_step_name'] = ($progressStep === '초기화') ? '' : $progressStep;
        $subject['icon_progress_color'] = 'sx-bg-progress';

        $contentData['list'][$i]['name'] = $name;
        $contentData['list'][$i]['content'] = $contents;
        $contentData['list'][$i]['hit'] = $hit;
        $contentData['list'][$i]['space'] = $space;
        $dateArr = preg_split(' ', $date);
        $contentData['list'][$i]['date'] = $dateArr[0];
        $contentData['list'][$i]['subject'] = $subject;
        $subject = null;
      }
    } else {
      $msg .= '검색을 실패하였습니다.';
      $resultYN = 'N';      
    }

    $navi = New Navigator();
    $navi->passover = $passover;
    $navi->limit = $limit;
    $navi->total = $numrows;
    $navi->init();

    $this->request_data = $requestData;
    $this->document_data['pagination'] = $navi->get();
    $this->document_data['group'] = $groupData;
    $this->document_data['content'] = $contentData;
    $this->document_data['category'] = $category;
    $this->document_data['categories'] = $categories;
    $this->document_data['total_num'] = $numrows;
    $this->document_data['domain'] = $domain;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['path'] = $skinPath;
    $this->skin_path_list['realPath'] = $skinRealPath;
    $this->skin_path_list['header'] = $headerPath;

    $this->skin_path_list['content'] = "{$skinRealPath}/list.tpl";    
    $this->skin_path_list['footer'] = $footerPath;

    $this->output();
  }
}