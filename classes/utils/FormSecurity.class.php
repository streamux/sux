<?php

class FormSecurity extends Object {

  public static $allowed_content_tags = array('pre', 'strong', 'em', 'u', 'sup', 'sub', 's', 'span', 'img', 'iframe', 'hr', 'br', 'ul', 'li', 'div', 'p','a');
  public static $allowed_simple_tags = array('b', 'span','strong');
  public static $limitChars = array(
    array('special'=>'+', 'entity'=>'&#43'),
    array('special'=>'|', 'entity'=>'&#124'),
    array('special'=>'*', 'entity'=>'&#42')
  );

  // validate
  ///////////////////////////////////////////////
  
  public static function encodes($inputs) {

    foreach ($inputs as $key => $value) {
      $inputs[$key] = self::encode($value, $allowed_tags);
    }

    return $inputs;
  }

  public static function encode($input) {
    
    $input = self::encodeSpecialchars($input); 
    $input = self::encodeScriptTag($input);
    $input = self::encodeImageTag($input);
            
    return $input;
  }

  public static function encodeToInteger($input, $fields_list = array()) {

    foreach ($fields_list as $key => $value) {
      $input[$value] = (int) $input[$value];
    }

    return $input;
  }

  public static function encodeWithoutTags($input, $fields_list = array()) {
    
    return self::encodeStripTags($input, $fields_list);
  }

  public static function encodeWithSimpleTags($input, $fields_list = array() ,$allowed_tags = array()) {

    $allowedTags = count($allowed_tags) > 0 ? $allowed_tags : self::$allowed_simple_tags;
    
    return self::encodeStripTags($input, $fields_list, $allowedTags);
  }

  public static function decode($output, $contents_type='html') {

    $output = strcmp($contents_type, 'html') === 0 ? self::decodeSpecialchars($output) : $output;     
    $output = self::decodeScriptTag($output);
    $output = self::encodeImageTag($output);    
    
    return $output;
  }

  public static function decodeToText($output) {
    
    $output = stripslashes($output); 
    $output = self::decode($output, 'text');

    return $output;
  }

  public static function decodeToHtml($output) {
    
    // trim white space in video tag      
    $reg = '/(<|&lt;div data-embed-url=\\\?&quot;)+(.*)?(\\\?&quot;&gt;|>)+(\s*)?(<|&lt;div)+/m';
    if (preg_match($reg, $output)) {
      $output = preg_replace($reg, '$1$2$3$5', $output); 
    }    
    $output = self::decode($output, 'html');

    return $output;
  }

  public static function decodeForForm($output) {

    $output = trim($output);
    $output = stripslashes($output);

    return $output;
  }
  
  public static function decodeWithoutTags($output, $fields_list = array()) {
    
    return self::decodeStripTags($output, $fields_list);
  }

  public static function decodeWithSimpleTags($output, $fields_list = array(), $allowed_tags = array()) {

    $allowedTags = count($allowed_tags) > 0 ? $allowed_tags : self::$allowed_simple_tags;
    
    return self::decodeStripTags($output, $fields_list, $allowedTags);
  }  

  private static function decodeStripTags($output, $fields_list = array(), $allowed_tags = array()) {

    if (count($fields_list) > 0) {
      foreach ($fields_list as $key => $value) {
        $output[$value] = trim($output[$value]);
        $output[$value] = stripslashes($output[$value]);
        $output[$value] = htmlspecialchars_decode($output[$value]);
        $output[$value] = self::flameStripTags($output[$value], $allowed_tags);
      }
    } else {
      $output = trim($output);
      $output = stripslashes($output);
      $output = htmlspecialchars_decode($output);
      $output = self::flameStripTags($output, $allowed_tags);
    }

    return $output;
  }

  private function encodeSpecialchars($input) {

    $len = count(self::$limitChars);

    for ($i=0; $i<$len; $i++) {
      $special = self::$limitChars[$i]['special'];
      $entity = self::$limitChars[$i]['entity'];
      $input = str_replace($special, $entity, $input);
    }

    $input = trim($input);
    $input = addslashes($input);
    $input = self::flameStripTags($input, self::$allowed_content_tags);

    // trim white space inside hr tag
    $input = preg_replace('/(\s)+(<.*hr[^>]+>)(\s)+/m', '$2', $input);
    $input = preg_replace('/(&lt;\/pre&gt;)(\s)+$/', '$1',$input);
    $input = htmlspecialchars($input);

    return $input;
  }

  private function encodeStripTags($input, $fields_list = array(), $allowed_tags = array()) {

    if (count($fields_list) > 0) {

      foreach ($fields_list as $key => $value) {
        $input[$value] = trim($input[$value]);
        $input[$value] = stripslashes($input[$value]);
        $input[$value] = self::flameStripTags($input[$value], $allowed_tags);
      }
    } else {
      $input = trim($input);
      $input = stripslashes($input);
      $input = self::flameStripTags($input, $allowed_tags);
    }

    return $input;
  }

  private function encodeScriptTag( $input ) {

    $reg_list = array('script','style');
    $prefix_format = '/(<|&lt;)%s%s/m';
    $surfix_format = '/%s(&gt;|>)/m';

    for($i=0; $i<count($reg_list); $i++) {
      $reg_prefix1 = sprintf($prefix_format, '', $reg_list[$i]);
      $reg_prefix2 = sprintf($prefix_format, '\/', $reg_list[$i]);
      $reg_surfix = sprintf($surfix_format, $reg_list[$i]);
      
      $input = self::convertTagTo($input, $reg_prefix1, '&lt;-'.$reg_list[$i]);
      $input = self::convertTagTo($input, $reg_prefix2, '&lt;-/'.$reg_list[$i]);
      $input = self::convertTagTo($input, $reg_surfix, $reg_list[$i].'&gt;');
    }

    return $input;
  }

  private function swapToNl2br( $str ) {

    preg_match('/(<\s*br[^>]*\s*>)+/m', $str, $matches);

    if (isset($str) && $str && count($matches) == 0) {
      $str = nl2br($str);
    }

    return $str;
  }

  private function decodeSpecialchars($output) {

    $len = count(self::$limitChars);

    for ($i=0; $i<$len; $i++) {
      $special = self::$limitChars[$i]['special'];
      $entity = self::$limitChars[$i]['entity'];
      $output = str_replace($entity, $special, $output);
    }
    
    $output = trim($output);
    $output = stripslashes($output);
    $output = htmlspecialchars_decode($output);
    $output = self::flameStripTags($output, self::$allowed_content_tags);

    $regPrefix = "(&lt;pre\s*class=&quot;brush:)+";    
    $regSurfix = "&lt;\/pre&gt;";
    $tagPrefix = "&lt;pre class=&quot;brush:";
    $replacePrefixStr = "<pre class=\"brush:";
    $replaceSurfixStr = "</pre>";

    preg_match(sprintf('/%s/', $regPrefix), $output, $matchList);
    
    //*/ pre.brush: 클래스를 가진 태그가 있다면 
    if (count($matchList) > 0) {
      $tags = preg_split(sprintf('/%s/', $regPrefix), $output);

      for ($i=0; $i<count($tags); $i++) {
        $tagsMatches = array();

        if (isset($tags[$i]) && $tags[$i]) { 
          preg_match(sprintf("/(%s)+/m",$regSurfix), $tags[$i], $tagsMatches);

          if (count($tagsMatches) > 0) {
            $tagsSplit = preg_split(sprintf("/(%s)+/", $regSurfix), $tags[$i]);
            $splitItem = $tagsSplit[0];
            $splitItem = preg_replace('/(<\s*br[^>]*\s*>)+/m', '', $splitItem);
            $splitItem = preg_replace('/(<\s*\/?p[^>]*\s*>)+/m', '', $splitItem);

            $tagsSplit[1] = self::swapToNl2br($tagsSplit[1]);
            $tags[$i] = $tagPrefix . $splitItem. $replaceSurfixStr . $tagsSplit[1];
          } else {

            $tags[$i] = self::swapToNl2br($tags[$i]);
          }
        }   // end of if
      }   // end of for

      $output = implode($tags);

      // pre 열림 노드 부분의 [ class="brush: 언어"]로 검색해서 언어와 매칭 된 값으로 치환 
      $regPrefix = "(&lt;pre class=&quot;brush:(\s+))([a-z0-9-_\s]+)(&quot;&gt;)+";
      $matches = array();   
      preg_match_all(sprintf("/(%s)/m", $regPrefix), $output, $matches);

     if (count($matches) > 0 && isset($matches[4]) && $matches[4]) {

        for($i=0; $i<count($matches[4]); $i++) {
          $lang = $matches[4][$i];
          $regSearchPrefix = "&lt;pre\s*class=&quot;brush:\s*$lang&quot;&gt;";              
          $replacePrefixStr = "<pre class=\"brush: $lang\">";

          $output = preg_replace(sprintf("/%s/m", $regSearchPrefix), $replacePrefixStr, $output);
        }   // end of for
      }   // end of if
    }

    $output = self::swapToNl2br($output);

    return $output;
  }

  private function decodeScriptTag( $output ) {
    
    $reg_list = array('script','style');
    $prefix_format = '/(&lt;)-%s%s/m';
    $surfix_format = '/%s(&gt;)/m';

    for($i=0; $i<count($reg_list); $i++) {
      $reg_prefix1 = sprintf($prefix_format, '', $reg_list[$i]);      
      $reg_prefix2 = sprintf($prefix_format, '\/', $reg_list[$i]);      
      $reg_surfix = sprintf($surfix_format, $reg_list[$i]);

      $output = self::convertTagTo($output, $reg_prefix1, '&lt;'.$reg_list[$i]);
      $output = self::convertTagTo($output, $reg_prefix2, '&lt;/'.$reg_list[$i]);
      $output = self::convertTagTo($output, $reg_surfix, $reg_list[$i].'&gt;');
    }
    
    return $output;
  }

  private static function flameStripTags($output, $allowed_tags = array()) { 

    $allowed_tags = array_map( strtolower, $allowed_tags);
    $routput = preg_replace_callback('/<\s*\/?\s*([^>\s]+)[^>]*\s*>/i', function ($matches) use (&$allowed_tags) {        
      return in_array(strtolower($matches[1]), $allowed_tags) ? $matches[0] : '';
    }, $output);

    return $routput;
  }

  private function convertTagTo($input, $reg, $replace_reg) {

    if (preg_match($reg, $input)) {
      $input = preg_replace($reg, $replace_reg, $input);
    }

    return $input;
  }

  private function encodeImageTag( $input ) {

    $event_list = 'afterprint|beforeprint|beforeunload|error|hashchange|load|message|offline|line|pagehide|pageshow|popstate|resize|storage|unload';
    $_quot = '\\\&quot;';
    $reg = sprintf('/&lt;[a-zA-Z]+.+on(%s)=%s.*%s([\s]*)(\/?)&gt;/m', $event_list, $_quot, $_quot);

    if (preg_match($reg, $input, $matched)) {
      $reg = sprintf('/on(%s)=%s.*%s([\s]*)/m', $event_list, $_quot, $_quot);
      $input = preg_replace($reg, '',$input);
    }

    return $input;
  } 
}