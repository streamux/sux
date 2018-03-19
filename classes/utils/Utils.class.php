<?php

class Utils extends Object {

  private static $aInstance = NULL;

  function &getInstance() {

    if (empty(self::$aInstance)) {
      self::$aInstance = new self;
    }
    return self::$aInstance;
  }

  // Alert
  ///////////////////////////////////////////////
  function alert( $msg ) {

    $msg = preg_replace('/<br>/', '\n',$msg);   
    $context = Context::getInstance();
    if ($context->ajax()) {
          
      $data = array( 'msg'=>$msg,
                              'result'=>'Y');

      Object::callback($data);
    } else {
      $htmlUI = '';
      $htmlUI .= '<script>';
      $htmlUI .= '  alert(\'%s\');';
      $htmlUI .= '</script>';

      if ($useHtml === TRUE) {
        $htmlUI = self::getHtmlLayout( $htmlUI );
      }
      printf($htmlUI, $msg, $url);
    }
  }

  function alertTo( $msg, $url) {

    $msg = preg_replace('/<br>/', '\n',$msg);   
    $context = Context::getInstance();
    if ($context->ajax()) {
          
      $data = array( 'url'=>$url,
                              'msg'=>$msg,
                              'result'=>'Y' );

      Object::callback($data);
    } else {
      $htmlUI = '';
      $htmlUI .= '<script>';
      $htmlUI .= '  alert(\'%s\');';
      $htmlUI .= '  location.href=\'%s\';';
      $htmlUI .= '</script>';

      if ($useHtml === TRUE) {
        $htmlUI = self::getHtmlLayout( $htmlUI );
      }
      printf($htmlUI, $msg, $url);
    }
  }

  //----- Array
  ///////////////////////////////////////////////

  /**
   * method convertJsonToArray
   * @params $json
   * @ conver json to Array
   */
  function convertJsonToArray($json) {

    if (empty($json)) {
      return null;
    }

    $lists = array();
    $dataes = $json;

    if (gettype($json) === 'string' && preg_match('/(\{|\[)+([.\d,:\'"_])*/', $json)) {
      $dataes = json_decode($json);
    }

    foreach ($dataes as $key => $value) {

      if (gettype($key) === 'interger') {
        $lists[] = $value;
      } else {
        $lists[$key] = $value;
      }
    } // end of foreach

    return $lists;
  }

  /**
  *
  * @param array $json
  */
  function convertArrayToObject($arr) {
    
    if (empty($arr) || count($arr) === 0) {
      return null;
    }    

    if (!is_array($arr)) {
      return null;
    }

    $lists = array();
    $dataes = $arr;
    
    for ($i=0; $i<count($dataes); $i++) {
      $lists[$i] = array();

      foreach ($dataes[$i] as $key => $value) {
        $lists[$i][$key] = $value;
      } 
    } // end of key type

    return $lists;
  }

  //----- File
  ///////////////////////////////////////////////

  function getRealPath($path) {

    if(strlen($path) >= 2 && substr_compare($path, './', 0, 2) === 0) {
      return _SUX_PATH_ . substr($path, 2);
    }

    return $path;
  }

  /**
  * @param string $path same of './, ../, /, ../../ etc...'
  * @return string
  */
  function convertRealPath($path) {

    if (strlen($path) >= 1) {
      $path = preg_replace('/^((\.)*\\/)*/', '', $path);
    }

    $splits = explode('/', $path);
    $fistFolder = $splits[0];

    $realSplits = explode('/', _SUX_PATH_);
    $len = count($realSplits);
    $dir = array();

    for ($i=0; $i<$len; $i++) {
      if (isset($realSplits[$i]) && $realSplits[$i]) {
         if ($realSplits[$i] === $fistFolder) {
          break;
        }
        $dir[] = $realSplits[$i];
      }     
    }
    $realPath = '/' . implode('/', $dir) . '/' . $path;

    return $realPath;
  }

  /**
   * @param string $convert_url Path of directory
   * @param string $real_path _SUX_PAPH_
   **/
  function convertAbsolutePath( $convert_url, $real_path ) {

    return self::convertRealPath($convert_url);
  }

  function deleteDir($path) {

    if (!is_dir( $path )) {
      return false;
    }

    @chmod($path,0777);
    $directory = dir($path);

    return false;
    
    while(($entry = $directory->read()) !== false) { 
      
      if ($entry != "." && $entry != "..") { 
        
        if (is_dir($path."/".$entry)) { 
          deleteDir($path."/".$entry); 
        } else { 
          @chmod($path."/".$entry,0777);
          @UnLink ($path."/".$entry); 
        }
      } 
    } 
    
    $directory->close(); 
    @rmdir($path);

    return true;
  }

  function deleteFile($path) {

    if (!is_file( $path )) {
      return false;
    }

    @chmod($path,0777);
    @UnLink ($path);

    return true; 
  }

  function readDir( $dir ) {

    $temArr = array();
    if ($handle = opendir($dir)) { 
      while (false !== ($file = readdir($handle))) { 

          if ($file != "." && $file != "..") {
            array_push($temArr, array("file_name"=>$file));       
          } 
      } 
      closedir($handle); 

      return $temArr;
    }  else {

      return false;
    }
  }

  function getImageInfo($path) {

    $bgimgPath = self::getRealPath($path);
    $image_info = getimagesize($bgimgPath);
    $image_type = $image_info[2];

    if ( $image_type == IMAGETYPE_JPEG ) {
      $image = imagecreatefromjpeg($bgimgPath);
    } else if ( $image_type == IMAGETYPE_GIF ) {
      $image = imagecreatefromgif($bgimgPath);
    } else if ( $image_type == IMAGETYPE_PNG ) {
      $image = imagecreatefrompng($bgimgPath);
    }

    $imageInfo = array();
    $imageInfo['type'] = $image_type;
    $imageInfo['width'] = imagesx($image);
    $imageInfo['height'] = imagesy($image);

    return $imageInfo;
  }

  // Location
  ///////////////////////////////////////////////

  function goURL( $url, $delay=0,$resultYN='Y',$msg='') {
    
    $data = array(  'url'=>$url,
            'delay'=>$delay,
            'result'=>$resultYN,
            'msg'=>$msg);

    Object::callback($data);
    exit;
  }

  //----- String
  ///////////////////////////////////////////////

  function digit( $num ) {

    if ($num < 10) {
      $num = "0" . $num;
    }
    return $num;
  }

  function trimText( $text, $size, $etcstr='..') { 

    $resultStr = '';
    $len = strlen($text);
    $resultStr = iconv_substr($text, 0, $size, "utf-8");
    
    if ($size < $len) {
      $resultStr .= $etcstr;
    }
    return $resultStr;
  }

  function ignoreNewline($str) {

    return preg_replace('/[\\n\\r]+/', ' ', $str );
  }

  function getRandomStr( $str, $str_len=0, $charset='utf-8') {

    if (!$str) {
      UIError::alert('Utils::getRandomStr : Not available Param Value');
    }

    $resultStr = '';
    $maxLen = mb_strlen($str)-1;    
    $i =0;

    while ($i<$str_len) {
      $randNum = rand(0, $maxLen);
      $resultStr .= mb_substr($str, $randNum, 1, $charset);
      $i++;
    }

    return $resultStr;
  }

  function getRandomPassword($len=8) {

    $words = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $words .=self::getMicrotimeInt();
    $tempPassword = self::getRandomStr($words, $len-1);
    $tempPassword .= '!';
    $tempPassword = str_shuffle($tempPassword);

    return $tempPassword;
  }

  function stripBRInPreTag( $target ) {

    $target = str_replace('$', '&#36;', $target);
    $search = "(<pre[^>]*>)((.|\n)*?)(<.*pre[^>]*>)";
    $replace = '"$1".preg_replace("/(<br[^>]*>\r\n|<br[^>]*>\n|<br[^>]*>)/", "\n", "$2")."$4"';
    $target = preg_replace("/$search/ie", $replace, $target);
    $target = str_replace("\\'", "'", $target);

    return $target;
  }

  function br2nl( $str) {

    return preg_replace('/<br(\s*)?\/?\>/i', "\n", $str);
  }

  function getWallKey() {

    $wallWords = 'ABCDEFGHIJKLMNOPQRSTUVWXYG1234567890';
    return self::getRandomStr($wallWords, 6);
  }

  function getDomain($url){

      $pieces = parse_url($url);
      $domain = isset($pieces['host']) ? $pieces['host'] : '';
      
      if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)){
          return $regs['domain'];
      }
      return FALSE;
  }

  //----- Time
  ///////////////////////////////////////////////

  function getMicrotimeInt() {

    list($usec, $sec) = explode(' ', microtime());

    return ((float)$usec + (float)$sec) * 100;
  }
}