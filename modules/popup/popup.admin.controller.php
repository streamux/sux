<?php

class PopupAdminController extends Controller
{

  function insertAdd() {

    $msg = "";
    $resultYN = "Y";
    $dataObj = array();

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $popupName = $posts['popup_name'];
    $skinName = $posts['skin'];

    if (empty($popupName)) {
      $msg .= "Popup Name Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }
    
    $where = new QueryWhere();
    $where->set('popup_name', $popupName);
    $result = $this->model->select('popup', 'id',$where);

    $numrow = $this->model->getNumRows();
    if ($numrow > 0) {
      $msg .= "팝업창 이름이 이미 존재합니다.";
      $resultYN = "N";
    } else {

      $skinImagePath = "skin/{$skinName}/images/bg.jpg";
      $imageInfo = getimagesize($skinImagePath);
          $imageType = $imageInfo[2];

          if ( $imageType === IMAGETYPE_JPEG ) {
            $image = imagecreatefromjpeg($skinImagePath);
          } elseif( $imageType === IMAGETYPE_GIF ) {
            $image = imagecreatefromgif($skinImagePath);
          } elseif( $imageType === IMAGETYPE_PNG ) {
            $image = imagecreatefrompng($skinImagePath);
      }

      $popupWidth = imagesx($image) + 16;
      $popupHeight = imagesy($image) + 52;

      if (is_readable($skinImagePath) && ($posts['popup_width'] < $popupWidth)) {
        $posts['popup_width'] = $popupWidth;
      }

      if (is_readable($skinImagePath) && ($posts['popup_height'] < $popupHeight)) {
        $posts['popup_height'] = $popupHeight;
      }

      $cachePath = './files/caches/queries/popup.getColumns.cache.php';
      $columnCaches = CacheFile::readFile($cachePath, 'columns');
      if (!$columnCaches) {
        $msg .= "QueryCacheFile Do Not Exists<br>";
        UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
        exit;
      }

      $column = array();
      foreach ($columnCaches as $key => $value) {
        if (isset($posts[$value]) && $posts[$value]) {  
          $column[$key] = $posts[$value];
        }
      } //end of foreach

      $column['date'] = 'now()';

      $result = $this->model->insert('popup', $column);
      if ($result){
        $where->reset();
        $where->set('popup_name', $popupName);
        $result = $this->model->select('popup', '*', $where);
        if ($result) {
          $dataObj['list'] = $this->model->getRows();
        }
      }else{
        $msg .= "팝업창 입력을 실패하였습니다.";
        $resultYN = "N";
      }
    }

    //$msg = Tracer::getInstance()->getMessage();
    $data = array(  'data'=> $dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function updateModify() {

    $msg = "";
    $resultYN = "Y";
    $dataObj = array('list'=>null);

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $skinName = $posts['skin'];
    $popupName = $posts['popup_name'];

   if (empty($popupName)) {
    $resultYN = "N";
    $msg .= "Popup Name Do Not Exists<br>";
    UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
    exit;
    }

    $skinImagePath = "skin/{$skinName}/images/bg.jpg";
    $imageInfo = getimagesize($skinImagePath);
        $imageType = $imageInfo[2];

        if ( $imageType === IMAGETYPE_JPEG ) {
          $image = imagecreatefromjpeg($skinImagePath);
        } elseif( $imageType === IMAGETYPE_GIF ) {
          $image = imagecreatefromgif($skinImagePath);
        } elseif( $imageType === IMAGETYPE_PNG ) {
          $image = imagecreatefrompng($skinImagePath);
    }

    $popupWidth = imagesx($image) + 16;
    $popupHeight = imagesy($image) + 52;

    if (is_readable($skinImagePath) && $posts['popup_width'] < $popupWidth) {
      $posts['popup_width'] = $popupWidth;
    }

    if (is_readable($skinImagePath) && $posts['popup_height'] < $popupHeight) {
      $posts['popup_height'] = $popupHeight;
    }

    $cachePath = './files/caches/queries/popup.getColumns.cache.php';
    $columnCaches = CacheFile::readFile($cachePath, 'columns');
    if (!$columnCaches) {
      $msg .= "QueryCacheFile Do Not Exists<br>";
      UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
      exit;
    }

    $columns = array();
    foreach ($columnCaches as $key => $value) {
      if (isset($posts[$value]) && $posts[$value]) {  
        if (!preg_match('/^(id+)$/', $value)) {
          $columns[$value] = $posts[$value];
        }       
      } else {
        if (preg_match('/^(date+)$/', $value) && empty($value)) {
          $columns[$value] = 'now()';
        }
      }
    }


    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->update('popup', $columns, $where);
    if ($result){
      $msg = "팝업정보 수정을 성공하였습니다.";
      $resultYN = "Y";

      $this->model->select('popup', '*', $where); 
      $dataObj['list'] = $this->model->getRows();
    }else{
      $msg = "팝업정보 수정을 실패하였습니다.";
      $resultYN = "N";
    }
    $msg = Tracer::getInstance()->getMessage();
    $data = array(  'data'=> $dataObj,
            'result'=>$resultYN,
            'msg'=>$msg);

    $this->callback($data);
  }

  function deleteDelete() {

    $context = Context::getInstance();
    $posts = $context->getPostAll();

    $id = $posts['id'];
    $popupName = $posts['popup_name'];

    $dataObj = array();   
    $msg = "";
    $resultYN = "Y";

    $where = new QueryWhere();
    $where->set('id', $id);
    $result = $this->model->delete('popup', $where);
    if ($result) {
      $msg .= $popupName . ' 팝업삭제를 성공하였습니다.';
      $resultYN = "Y";
    } else {
      $msg .= $popupName . ' 팝업삭제를 실패하였습니다.';
      $resultYN = "N";
    }
    //$msg .= Tracer::getInstance()->getMessage();
    $data = array(  "data"=>$dataObj,
            "result"=>$resultYN,
            "msg"=>$msg);

    $this->callback($data);
  }
}
