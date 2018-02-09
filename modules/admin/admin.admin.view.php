<?php

class AdminAdminView extends View
{
  function displayAdminAdmin() {

    $this->displayMain();
  }

  function displayMain() {

    $context = Context::getInstance();
    $action = $this->request_data['action'];

    $this->document_data['jscode'] = 'main';
    $this->document_data['module_code'] = 'admin';

    $rootPath = _SUX_ROOT_;
    $skinPath = _SUX_ROOT_ . "modules/admin/tpl/";
    $skinRealPath = _SUX_PATH_."modules/admin/tpl/";

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['skinPath'] = $skinPath;
    $this->skin_path_list['skinRealPath'] = $skinRealPath;
    $this->skin_path_list['header'] = "{$skinRealPath}/_header.tpl";
    $this->skin_path_list['content'] = "{$skinRealPath}/admin_main.tpl";
    $this->skin_path_list['footer'] = "{$skinRealPath}/_footer.tpl";

    $this->output();
  }

  function displayMainJson() {

    $resultYN = 'Y';
    $msg = '';

    $connecterArr1 = $this->_getConnecterData();
    if ($connecterArr1['resultYN'] === 'N') {
      $resultYN = $connecterArr1['resultYN'];
      $msg .= $connecterArr1['msg'];
    }

    $connecterArr2 = $this->_getConnecterrealData();
    if ($connecterArr2['resultYN'] === 'N') {
      $resultYN = $connecterArr2['resultYN'];
      $msg .= $connecterArr2['msg'];
    }
    $connecterArr = array_merge($connecterArr1['data'], $connecterArr2['data']);

    $newMemberArr = $this->_getNewmemberData();
    if ($newMemberArr['resultYN'] === 'N') {
      $resultYN = $newMemberArr['resultYN'];
      $msg .= $newMemberArr['msg'];
    }

    $newCommentArr = $this->_getNewcommentData();
    if ($newCommentArr['resultYN'] === 'N') {
      $resultYN = $newCommentArr['resultYN'];
      $msg .= $newCommentArr['msg'];
    }

    $pageviewArr = $this->_getPageviewData();
    if ($pageviewArr['resultYN'] === 'N') {
      $resultYN = $pageviewArr['resultYN'];
      $msg .= $pageviewArr['msg'];
    }

    $connectsiteArr = $this->_getConnectsiteData();
    if ($connectsiteArr['resultYN'] === 'N') {
      $resultYN = $connectsiteArr['resultYN'];
      $msg .= $connectsiteArr['msg'];
    }

    $serviceConfigArr = $this->_getServiceData();
    if ($serviceConfigArr['resultYN'] === 'N') {
      $resultYN = $serviceConfigArr['resultYN'];
      $msg .= $serviceConfigArr['msg'];
    }

    $dataObj  = array(  'connecter'=>$connecterArr,
              'newmember'=>$newMemberArr['data'],
              'latestcomment'=>$newCommentArr['data'],
              'pageview'=>$pageviewArr['data'],
              'connectersite'=>$connectsiteArr['data'],
              'serviceConfig'=>$serviceConfigArr['data']);

    $data = array(  'data'=>$dataObj,
            'result'=>$resultYN,
            'msg'=>$msg );
    
    $this->callback($data);
  }

  function displayConnecterJson() {

    $data = $this->_getConnecterData();
    $this->callback($data);
  }

  function displayConnecterrealJson() {

    $data = $this->_getConnecterrealData();
    $this->callback($data);
  }

  function displayPageviewJson() {

    $data = $this->_getPageviewData();
    $this->callback($data);
  }

  function displayConnectdayJson() {

    /*$context = Context::getInstance();
    $passover = $context->getRequest('passover');
    $limit = $context->getRequest('limit');*/

    $data = $this->_getConnectdayData();
    $this->callback($data);
  }

  function displayConnectsiteJson() {

    /*$context = Context::getInstance();
    $passover = $context->getRequest('passover');
    $limit = $context->getRequest('limit');*/

    $data = $this->_getConnectsiteData();
    $this->callback($data);
  }

  function displayNewmemberJson() {

    $data = $this->_getNewmemberData();
    $this->callback($data);
  }

  function displayNewcommentJson() {

    $data = $this->_getNewcommentData();
    $this->callback($data);
  }

  function displayServiceJson() {

    $data = $this->_getServiceData();
    $this->callback($data);
  }

  function _getConnecterData() {

    $msg = '';
    $resultYN = 'Y';
    $connecterArr = array('today'=>0, 'yester'=>0,'total'=>0);
    
    $result = $this->model->select('connect_day', '*');
    if ($result) {
      $rows = $this->model->getRows();

      for ($i=0; $i<count($rows); $i++) {
        $connecterArr['total'] += (int) $rows[$i]['total_count'];
      }     

      $where = new QueryWhere();
      $where->set('date', date('Y-m-d', time()-86400), '<');
      $this->model->delete('connecter' , $where);

      // today
      $where->reset();
      $where->set('date', date('Y-m-d'), '=');
      $result = $this->model->select('connecter', 'id', $where);

      if ($result) {
        $today = $this->model->getNumRows();
        if (!$today) {
          $today = 0;
        }
        $connecterArr['today'] = $today;
      } else {
        $msg .= '오늘 접속통계 레코드 선택을 실패하였습니다.';
        $resultYN = 'N';
      }

      // yester day
      $where->reset();
      $where->set('date', date('Y-m-d', time()-86400), '=');
      $result = $this->model->select('connecter', 'id', $where);

      if ($result) {
        $yesterday = $this->model->getNumRows();

        if (!$yesterday) {
          $yesterday = 0;
        }

        $connecterArr['yester'] = $yesterday;
      } else {
        $msg .= '어제 접속통계 레코드 선택을 실패하였습니다.';
        $resultYN = 'N';
      }
    } else {
      $msg .= '접속통계 테이블 접근을 실패하였습니다.';
      $resultYN = 'N';
    }

    //Tracer::getInstance()->output();
    $data = array(  'data'=>$connecterArr,
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getConnecterrealData() {

    $msg = '';
    $resultYN = 'Y';
    $connecterArr = array('real_today'=>0, 'real_yester'=>0,'real_total'=>0);
    $result = $this->model->select('connect_day','*');

    if ($result) {
      $rows = $this->model->getRows();

      for ($i=0; $i<count($rows); $i++) {
        $connecterArr['real_total'] += $rows[$i]['real_total_count'];
      }

      $where = new QueryWhere();
      $where->set('date', date('Y-m-d', time()-86400), '<');
      $result = $this->model->delete('connecter_real', $where);

      if (!$result) {
        $msg .= '24시 이전 실접속통계 레코드 삭제를 실패하였습니다.';
        $resultYN = 'N';
      }

      // today
      $where->reset();
      $where->set('date', date('Y-m-d'), '=');
      $result = $this->model->select('connecter_real', 'id', $where);

      if ($result) {
        $real_totay = $this->model->getNumRows();

        if (!$real_totay) {
          $real_totay = 0;
        }

        $connecterArr['real_today'] = $real_totay;
      } else {
        $msg .= '오늘 실접속통계 레코드 선택을 실패하였습니다.';
        $resultYN = 'N';
      }     

      // yester day
      $where->reset();
      $where->set('date', date('Y-m-d', time()-86400), '=');
      $result = $this->model->select('connecter_real', 'id', $where);

      if ($result) {
        $real_yester = $this->model->getNumRows();

        if (!$real_yester) {
          $real_yester = 0;
        }
        $connecterArr['real_yester'] = $real_yester;
      } else {
        $msg .= '어제 실접속통계 레코드 선택을 실패하였습니다.';
        $resultYN = 'N';
      }     

    } else {
      $msg .= '실접속통계 테이블 접근을 실패하였습니다.';
      $resultYN = 'N';
    }
    //Tracer::getInstance()->output();
    $data = array(  'data'=>$connecterArr,
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getPageviewData() {

    $msg = '';
    $resultYN = 'Y';
    $pageviewArr = array();
    $pageViewList = array();

    $context = Context::getInstance();
    $limit = $context->getRequest('limit');
    $passover = $context->getRequest('passover');
    $result = $this->model->select('pageview', '*');

    if ($result) {      
      $numrows = $this->model->getNumRows();

      if ($numrows) {
        $total = 0;
        $rows = $this->model->getRows();

        for($i=0; $i<$numrows; $i++) {
          $total += $rows['hit_count'];
        }       

        if (!$limit) {
          $limit = 10;
        }

        if (!$passover) {
          $passover = 0;
        }

        $result = $this->model->select('pageview', '*', null, 'id desc', $passover, $limit);
        if ($result) {
          $a = $numrows - $passover;
          $rows_limit = $this->model->getRows();

          for ($i=0; $i<count($rows_limit); $i++) {
            $pageViewList[] = array(
              'no'=>$a,
              'name'=>$rows_limit[$i]['name'],
              'hit'=>$rows_limit[$i]['hit_count'],
              'total'=>$total
            );
            $a--;
          }
        }

      } else {        
        $pageviewArr['msg'] = '페이지뷰 키워드가 존재하지 않습니다.';
      }

      $pageviewArr['list'] = $pageViewList;
      $pageviewArr['total_num'] = $numrows;
      $pageviewArr['limit_num'] = $limit;
    } else {
      $msg = '페이지뷰등록 테이블이 존재하지 않습니다.\n';
      $resultYN = 'N';
    }
    //Tracer::getInstance()->output();
    $data = array(  'data'=>$pageviewArr,
            'mode'=>'pageview',
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getConnectsiteData() {

    $msg = '';
    $resultYN = 'Y';
    $analyticsArr = array();
    $connecterList = array();

    $context = Context::getInstance();
    $limit = $context->getRequest('limit');
    $passover = $context->getRequest('passover');
    $result = $this->model->select('connect_site', '*');

    if ($result) {      
      $numrows = $this->model->getNumRows();

      if ($numrows) {
        $total = 0;
        $rows = $this->model->getRows();

        for($i=0; $i<$numrows; $i++) {
          $total += $rows['hit_count'];
        }       

        if (!$limit) {
          $limit = 10;
        }

        if (!$passover) {
          $passover = 0;
        }

        $result = $this->model->select('connect_site', '*', null, 'id desc', $passover, $limit);
        if ($result) {
          $a = $numrows - $passover;
          $rows_limit = $this->model->getRows();

          for ($i=0; $i<count($rows_limit); $i++) {
            $connecterList[] = array(
              'no'=>$a,
              'name'=>$rows_limit[$i]['name'],
              'hit'=>$rows_limit[$i]['hit_count'],
              'total'=>$total
            );
            $a--;
          }
        }

      } else {        
        $analyticsArr['msg'] = '접속경로분석 키워드가 존재하지 않습니다.';
      }

      $analyticsArr['list'] = $connecterList;
      $analyticsArr['total_num'] = $numrows;
      $analyticsArr['limit_num'] = $limit;
    } else {
      $msg = '접속경로분석 테이블이 존재하지 않습니다.';
      $resultYN = 'N';
    }
    //Tracer::getInstance()->output();
    $data = array(  'data'=>$analyticsArr,
            'mode'=>'connectsite',
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getConnectdayData() {

    $context = Context::getInstance();
    $passover = $context->getRequest('passover');
    $limit = $context->getRequest('limit');

    $msg = '';
    $resultYN = 'Y';
    $connectdayArr = array();

    function getDateFormat($d) {

      $d=str_replace(".","-",$d);
      $d=str_replace("/","-",$d);
      $d = date('Y-m-d', strtotime($d));

      return $d;
    }

    if (isset($limit) && $limit){
      $result = $this->model->select('connect_day', '*', null, 'id desc', $passover, $limit);
    } else {
      $result = $this->model->select('connect_day', '*');
    }
    
    if ($result) {
      $rows = $this->model->getRows();

      for($i=0; $i<count($rows); $i++) {
        $connectdayArr[] = array('date'=>getDateFormat($rows[$i]['date']), 'real_total_count'=>$rows[$i]['real_total_count'], 'total_count'=>$rows[$i]['total_count']);
      }
    }

    //Tracer::getInstance()->output();
    $data = array(  'data'=>$connectdayArr,
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getNewmemberData() {

    $msg = '';
    $resultYN = 'Y';
    $newmember = array('list'=>array());

    $where = new QueryWhere();
    $where->set('date', date('Y-m-d'), '>=', 'and');
    $where->set('date', date('Y-m-d', time() + 86400), '<');
    $result = $this->model->select('member', '*', $where);

    if ($result) {
      $newmember['list'] = array();
      $rows = $this->model->getRows();
      $newmember['total_num'] = count($rows);

      if (count($rows) > 0) {
        for($i=0; $i<count($rows); $i++) {
          $field = array();

          foreach ($rows[$i] as $key => $value) {
            $field[$key] = $value;
          }
          $newmember['list'][] = $field;
        }
      } else {
        $msg .= '신규회원이 존재하지 않습니다.';
        $newmember['msg'] .= $msg;
        $newmember['result'] = $resultYN;
      }      
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data= array( 'data'=>$newmember,
            'mode'=>'newmember',
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getNewcommentData() {

    $msg = '';
    $resultYN = 'Y';
    $newcomment = array('list'=>array());

    $where = new QueryWhere();
    $where->set('date', date('Y-m-d'), '>=', 'and');
    $where->set('date', date('Y-m-d', time() + 86400), '<');
    $result = $this->model->select('board', '*', $where, 'id desc');

    if ($result) {
      $newcomment['list'] = array();
      $rows = $this->model->getRows();
      $newcomment['total_num'] = count($rows);
      $len = count($rows);

      if ($len > 0) {

        for($i=0; $i<$len; $i++) {
          $field = array();
          $field['no'] = $len-$i;

          foreach ($rows[$i] as $key => $value) {
            $field[$key] = $value;
          }

          $newcomment['list'][] = $field;
          $newcomment['result'] = $resultYN;
        }
      } else {        
          $newcomment['msg'] = '최근 게시물이 존재하지 않습니다.';
      }      
    }

    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  'data'=>$newcomment,
            'mode'=>'latestcomment',
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }

  function _getServiceData() {

    $msg = '';
    $resultYN = 'Y';
    $serviceConfig = array(
      'popupNum'=>0,
      'boardNum'=>0,
      'memberNum'=>0,
      'pageviewNum'=>0,
      'analysisNum'=>0 );

    $where = new QueryWhere();
    $where->set('choice', 'y');    
    $result = $this->model->select('popup', 'id', $where);

    if ($result) {
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
        $serviceConfig['popupNum']  = $numrows;
      }
    }

    $result = $this->model->select('board_group', 'id');

    if ($result) {
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
        $serviceConfig['boardNum']  = $numrows;
      } 
    }

    $result = $this->model->select('member_group', 'id');

    if ($result) {
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
        $serviceConfig['memberGroupNum'] = $numrows;
      }
    }

    $result = $this->model->select('pageview', 'id');

    if ($result) {
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
        $serviceConfig['pageviewNum'] = $numrows;
      }
    }

    $result = $this->model->select('connect_site', 'id');

    if ($result) {
      $numrows = $this->model->getNumRows();

      if ($numrows > 0) {
        $serviceConfig['analysisNum'] = $numrows;
      }
    }
    //Tracer::getInstance()->output();
    $data = array(  'data'=>$serviceConfig,
            'result'=>$resultYN,
            'msg'=>$msg);

    return $data;
  }
}