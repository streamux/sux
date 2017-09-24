<?php

class AnalyticsAdminController extends Controller
{

  function insertConnectSiteAdd() {

    $msg = "";
    $resultYN = "Y";

    $context = Context::getInstance();
    $posts = $context->getPostAll();
    
    $returnURL = $context->getServer('REQUEST_URI');
    $keyword = $posts['keyword'];   
    if (empty($keyword)) {
      $msg = '접속워드 이름을 입력하세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }   

    $where = new QueryWhere();
    $where->set('name', $keyword);
    $this->model->select('connect_site', 'id', $where);

    $numrow = $this->model->getNumRows();
    if ($numrow > 0) {
      $msg = "접속키워드가 이미 존재합니다.";
      $resultYN = "N";
    } else {

      $column = array('', $keyword, 0, 'now()');
      $result = $this->model->insert('connect_site', $column);
      if ($result) {
        $msg = "$keyword 접속키워드 추가를 성공하였습니다.";
        $resultYN = "Y";

        $this->model->select('connect_site', '*', $where); 
        $dataObj['list'] = $this->model->getRows();
      } else {
        $msg = "$keyword 접속키워드 추가를 실패하였습니다.";
        $resultYN = "N";
      }     
    } 
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  'data'=>$dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function updateConnectSiteReset() {
    
    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $keyword = $posts['keyword'];

    $msg = "";
    $resultYN = "Y";

    $column = array('hit_count'=>0);
    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('connect_site', $column, $where);
    if ($result) {
      $msg = "$keyword 접속키워드 초기화를 성공하였습니다.";
      $resultYN = "Y";      
    } else {
      $msg = "$keyword 접속키워드 초기화를 실패하였습니다.";
      $resultYN = "N";
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function deleteConnectSiteDelete() {
    
    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $keyword = $posts['keyword'];

    $msg = "";
    $resultYN = "Y";

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->delete('connect_site', $where);
    if (!$result) {
      $msg = "$keyword 접속키워드 삭제를 실패하였습니다.";
      $resultYN = "N";
    } else {
      $msg = "$keyword 접속키워드 삭제를 성공하였습니다."; 
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  } 


  function insertPageviewAdd() {

    $msg = "";
    $resultYN = "Y";
    $dataObj = array();

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $returnURL = $context->getServer('REQUEST_URI');
    $keyword = $posts['keyword'];
    if (empty($keyword)) {
      $msg = '페이지 키워드 이름을 입력하세요.';
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    } 

    $where = new QueryWhere();
    $where->set('name', $keyword);
    $this->model->select('pageview', 'id',$where);

    $numrow = $this->model->getNumRows();
    if ($numrow > 0) {
      $msg = "페이지뷰 키워드가 이미 존재합니다.";
      $resultYN = "N";
    } else {

      $column = array('', $keyword, 0, 'now()');
      $result = $this->model->insert('pageview', $column);
      if ($result) {
        $msg = "페이지뷰 키워드 추가를 성공하였습니다.";
        $resultYN = "Y";

        $result = $this->model->select('pageview', '*', $where, '');
        if ($result) {
          $dataObj['list'] = $this->model->getRows();
        }
      } else {
        $msg = "페이지뷰 키워드 추가를 실패하였습니다.";
        $resultYN = "N";
      }
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  'data'=>$dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function updatePageviewReset() {
    
    $msg = "";
    $resultYN = "Y";
    $dataObj = array();

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $keyword = $posts['keyword'];

    $column = array('hit_count'=>0);
    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('pageview', $column, $where);
    if ($result) {
      $msg = "페이지뷰 초기화를 성공하였습니다.";
      $resultYN = "Y";
    } else {
      $msg = "페이지뷰 초기화를 실패하였습니다.";
      $resultYN = "N";      
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function deletePageviewDelete() {
  
    $msg = "";
    $resultYN = "Y";
    $dataObj = array();

    $context = Context::getInstance();    
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $keyword = $posts['keyword'];   

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->delete('pageview', $where);
    if ($result) {
      $msg = "$keyword 페이지뷰 키워드 삭제를 성공하였습니다.";  
      $resultYN = "Y";      
    } else {
      $msg = "$keyword 페이지뷰 키워드 삭제를 실패하였습니다.";
      $resultYN = "N";
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data); 
  }
}