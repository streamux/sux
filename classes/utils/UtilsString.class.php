<?php

class UtilsString extends Object {
  
  public static function digit( $num ) {

    if ($num < 10) {
      $num = "0" . $num;
    }
    return $num;
  }

  public static function cutText( $text, $size, $etcstr="..") { 

    $resultStr = '';
    $len = strlen($text);
    $resultStr = iconv_substr($text, 0, $size, "utf-8");
    
    if ($size < $len) {
      $resultStr .= $etcstr;
    }
    return $resultStr;
  }
}
?>