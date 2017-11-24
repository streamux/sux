<?php

class Forms extends Object {

  // validate
  ///////////////////////////////////////////////
  
  function validateFile($file) {

    $img_name = $file['imgup']['name'];
    $msg = '[ jpg, jpeg, gif, png, zip ] 형식의 이미지 파일과 압축 파일만 등록이 가능합니다.';

    $context = Context::getInstance();
    $return_url = $context->getServer('REQUEST_URI');

    $is_matched = 0;

    if (isset($img_name) && $img_name) {
      
      $is_matched += preg_match('/(php|php3|html|htm|cgi|pl)+/', $img_name);
      $is_matched += !preg_match('/(jpg|jpeg|gif|png|zip)+$/', $img_name);

      if ($is_matched > 0) {
        UIError::alertToBack($msg, true, array('url'=>$return_url, 'delay'=>3));
        exit;
      }
    }
  }

  function validates($input, $check_list=array()) {

    $context = Context::getInstance();
    $return_url = $context->getServer('REQUEST_URI');
    $bool = true;
    $index = 0;

    if (count($check_list) > 0) {
      foreach ($check_list as $key => $value) {

        if (empty($input[$value['key']])) {
          $msg .= $value['msg'] . ' 입력해주세요';
          UIError::alertToBack($msg, true, array('url'=>$return_url, 'delay'=>3));
          $bool = false;
          exit;
        }

        $index++;
      } // end of foreach
    }
  }
}