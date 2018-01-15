<?php
/**
 * @class Analytics
 * @description
 * 페이지뷰 클릭 수 조회 분석기능 
 * @pageview url - http://streamux.com/sux/modules/analytics/analytics.php?action=recordPageview&keyword=history
 * @counter url -  http://streamux.com/sux/modules/analytics/analytics.php?action=recordCounter
 */

class AnalyticsView extends View
{ 
  function displayCounter() {

    $context = Context::getInstance();
    $now = date('Y-m-d');
    $msg = '';
    $resultYN = 'Y';

    $this->controller->addCounter();

    //  오늘 접속자 수 
    $where = new QueryWhere();
    $where->set('date',$now,'=');
    $result = $this->model->select('connecter', 'id', $where);
    if ($result) {
      $today_num = $this->model->getNumRows();
    } else {
      $msg .= "오늘 접속자 선택을 실패하였습니다.\n";
    }   

    // 어제 접속자 수 
    $where->reset();
    $where->set('date',$now,'<');
    $result = $this->model->select('connecter', 'id', $where);
    if ($result) {
      $yesterday_num = $this->model->getNumRows();
    } else {
      $msg .= "어제 접속자 선택을 실패하였습니다.\n";
    }
    
    $result = $this->model->select('connect_day', 'total_count');
    if ($result) {
      $total_num =  0;
      $rows = $this->model->getRows();
      for ($i=0; $i < count($rows); $i++) { 
        $total_num += $rows[$i]['total_count'];   
      }   
    } else {
      $msg .= "전체 접속자 선택을 실패하였습니다.\n";
    }   

    // 실 접속자 수 
    $where->reset();
    $where->set('date',$now,'=');
    $result = $this->model->select('connecter_real', 'id', $where);
    if (!$result) {
      $msg .= "오늘 실접속자 수 선택을 실패하였습니다.\n";
    }
    $real_today_num = $this->model->getNumRows();

    $where->reset();
    $where->set('date',$now,'<');
    $result = $this->model->select('connecter_real', 'id', $where);
    if (!$result) {
      $msg .= "어제 실접속자 수 선택을 실패하였습니다.\n";
    }
    $real_yesterday_num = $this->model->getNumRows();

    $result = $this->model->select('connect_day', 'real_total_count');
    if ($result) {
      $real_total_num = 0;
      $rows = $this->model->getRows();
      for ($i=0; $i < count($rows); $i++) { 
        $real_total_num += $rows[$i]['real_total_count'];
      }
    } else {
      $msg .= "전체 실접속자 수 선택을 실패하였습니다.\n";
    }   

    echo 'today : ' . $today_num . ', ' . 'yester : ' . $yesterday_num . ', ' . 'total : ' . $total_num . '<br>real_today : ' . $real_today_num . ', ' . 'real_yester : ' . $real_yesterday_num . ', ' . 'real total : ' . $real_total_num . '<br>';
  }

  function displayConnecter() {
    $this->controller->addConnecter();
  }

  function displayPageview() {

    $this->controller->addPageview();
  }
}