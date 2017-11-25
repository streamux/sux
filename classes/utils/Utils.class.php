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
  
  function alertTo( $msg, $url) {

    $msg = preg_replace('/<br>/', '\n',$msg);   
    $context = Context::getInstance();
    if ($context->ajax()) {
          
      $data = array(  'url'=>$url,
              'msg'=>$msg,
              'result'=>'Y');

      Object::callback($data);
    } else {
      $htmlUI = '<script>
              alert(\'%s\');
              location.href=\'%s\';
            </script>';

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
   * method convertJsonToArray
   * @params $json
   * @ conver json to Array
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

  function getRealPath($source)
  {
    if(strlen($source) >= 2 && substr_compare($source, './', 0, 2) === 0) {
      return _SUX_PATH_ . substr($source, 2);
    }

    return $source;
  }

  /**
   * @param $convert_url '외부에서 불러지는 상대경로 주소'
   * @param $skin_dir 'Real Path'
   **/
  function convertAbsolutePath( $convert_url, $skin_dir ) {

    $result = $convert_url;

    if (preg_match('/(\.\.\/)+/', $convert_url)) {

      preg_match('/(^[\.\.\/]+)([a-zA-Z0-9_\.\/]*)?$/', $convert_url, $matches);
      $absoluteDir = preg_split('/[\/]+/',$skin_dir);
      $headerDir = preg_split('/[\.\.]+/', $matches[1]);
      
      $dirLength = count($headerDir)-1;
      for ($i=0; $i<$dirLength; $i++) {
        array_pop($absoluteDir);
      }
      $result = join($absoluteDir, '/') . '/' . $matches[2];      
    } else {

      $rootDirArr = preg_split('/[\/]+/',$convert_url);
      $rootDirLabel = $rootDirArr[1];

      if ($rootDirArr[0] != '') {
        $rootDirLabel = $rootDirArr[0];
      }
      $rootDirLabel =  '\/' . $rootDirLabel;

      $skinDirArr = preg_split('/' . $rootDirLabel . '/',$skin_dir);
      $result = $skinDirArr[0] . $convert_url;
    }
    return $result;
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
  }

  //----- String
  ///////////////////////////////////////////////

  function digit( $num ) {

    if ($num < 10) {
      $num = "0" . $num;
    }
    return $num;
  }

  function trimText( $text, $size, $etcstr="..") { 

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

  //----- Time
  ///////////////////////////////////////////////

  function getMicrotimeInt() {

    list($usec, $sec) = explode(' ', microtime());

    return ((float)$usec + (float)$sec) * 100;
  }
}