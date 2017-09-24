<?php

class PopupView extends View
{

  function displayOpenerJson() {

    $dataObj = array();   
    $msg = "";
    $resultYN = "Y";

    $skinDir = _SUX_PATH_ . 'modules/popup/skin/';

    $result = $this->model->select('popup', '*');
    if ($result) {

      $rows = $this->model->getRows();
      for($i=0; $i<count($rows); $i++) {

        $timeList = array();
        foreach ($rows[$i] as $key => $value) {

          if (preg_match('/^(time_)+/i', $key)) {
            $timeList[$key] = $value;
          }else {
            $dataList[$key] = $value;
          }       
        }

        $bgimgPath = $skinDir. $rows[$i]['skin'] . '/images/bg.jpg';
        $imgInfo = Utils::getImageInfo($bgimgPath);
        $imgWidth = $imgInfo['width'];
        $imgHeight = $imgInfo['height'];

        if ($dataList['popup_width'] <= $imgWidth ) {
          $dataList['popup_width'] = $imgWidth;
        }

        if ($dataList['popup_height'] <= $imgHeight ) {
          $dataList['popup_height'] = $imgHeight;
        }

        $dataList['popup_width'] += 15;
        $dataList['popup_height'] += 53;

        $dataList['period'] = mktime($timeList['time_hours'],$timeList['time_minutes'],$timeList['time_seconds'],$timeList['time_month'],$timeList['time_day'],$timeList['time_year']);
        $dataList['nowtime'] = mktime();
        $dataObj[] = $dataList;
      }
      $resultYN = "Y";
    } else {
      $msg = "등록된 이벤트가 없습니다.";
      $resultYN = "N";
    }

    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }

  function displayPopupEvent() {

    $context = Context::getInstance();
    $this->request_data = $context->getRequestAll();

    $id = $this->request_data['id'];

    $rootPath = _SUX_ROOT_;
    $skinDir = _SUX_PATH_ . 'modules/popup/skin/';

    $this->document_data['jscode'] = 'event';
    $this->document_data['module_code'] = 'popup';    

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->select('popup', '*', $where);
    if ($result) {      
      $contentData = $this->model->getRow();
      $contentData['comment'] = nl2br($contentData['comment']);
    }

    $skinPath = $skinDir . $contentData['skin'];
    $bgimgPath = $skinDir. $contentData['skin'] . '/images/bg.jpg';

    $imgInfo = Utils::getImageInfo($bgimgPath);
    $contentData['bg_width'] = $imgInfo['width'];
    $contentData['bg_height'] = $imgInfo['height'];

    $this->document_data['contents'] = $contentData;

    $this->skin_path_list['root'] = $rootPath;
    $this->skin_path_list['header'] = "{$skinPath}/_header.tpl";
    $this->skin_path_list['contents'] = "{$skinPath}/index.tpl";
    $this->skin_path_list['footer'] = "{$skinPath}/_footer.tpl";

    $this->output();
  }
}
