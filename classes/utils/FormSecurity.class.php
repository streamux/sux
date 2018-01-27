<?php

class FormSecurity extends Object {

  // validate
  ///////////////////////////////////////////////
  
  public static function encode($input) {
    
    $input = self::encodeSpecialchars($input); 
    $input = self::encodeScriptTag($input);
    $input = self::encodeImageTag($input);
            
    return $input;
  }

  public static function encodes($inputs) {

    foreach ($inputs as $key => $value) {
      $inputs[$key] = self::encode($value);
    }

    return $inputs;
  }

  public static function encodeByInteger($input, $fields_list = array()) {

    foreach ($fields_list as $key => $value) {
      $input[$value] = (int) $input[$value];
    }

    return $input;
  }

  public static function encodeByNonTags($input, $fields_list = array()) {
    
    return self::encodeStripTags($input, $fields_list);
  }

  public static function encodeBySimpleTags($input, $fields_list = array() , $allowed_tags = array()) {

    $allowed_tags = count($allowed_tags) > 0 ? $allowed_tags : array('b', 'span','strong');
    
    return self::encodeStripTags($input, $fields_list, $allowed_tags);
  }

  public static function decode($output, $contents_type='html') {

    $output = strcmp($contents_type,'html') === 0 ? self::decodeSpecialchars($output) : $output;  
    $output = self::decodeScriptTag($output);
    $output = self::encodeImageTag($output);
    
    return $output;
  }

  public static function decodeByText($output) {
    
    $output = stripslashes($output); 
    $output = self::decode($output, 'text');

    return $output;
  }

  public static function decodeByHtml($output) {
    
    // trim white space in video tag      
    $reg = '/(<|&lt;div data-oembed-url=\\\?&quot;)+(.*)?(\\\?&quot;&gt;|>)+(\s*)?(<|&lt;div)+/m';
    if (preg_match($reg, $output)) {
      $output = preg_replace($reg, '$1$2$3$5', $output); 
    } 
    $output = self::decode($output, 'html');     

    return $output;
  }
  
  public static function decodeByNonTags($output, $fields_list = array()) {
    
    return self::decodeStripTags($output, $fields_list);
  }

  public static function decodeBySimpleTags($output, $fields_list = array()) {

    $allowed_tags = array('b', 'span','strong');
    
    return self::decodeStripTags($output, $fields_list, $allowed_tags);
  }

  private static function encodeStripTags($input, $fields_list = array(), $allowed_tags = array()) {

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

  private static function flameStripTags($output, $allowed_tags = array()) { 


    $allowed_tags = array_map( strtolower, $allowed_tags);
    $routput = preg_replace_callback('/<\s*\/?\s*([^>\s]+)[^>]*\s*>/i', function ($matches) use (&$allowed_tags) {        
      return in_array(strtolower($matches[1]), $allowed_tags) ? $matches[0] : '';
    },$output);
    return $routput;
  }

  private function encodeSpecialchars($input) {

    $input = trim($input);
    $input = addslashes($input);
    //$input = self::flameStripTags($input);
    $input = htmlspecialchars($input);

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

  private function decodeSpecialchars($output) {
    
    $output = trim($output);
    $output = stripslashes($output);
    $output = htmlspecialchars_decode($output);
    
    return $output;
  }

  private function decodeScriptTag( $output ) {
    
    $reg_list = array('script','style');
    $prefix_format = '/(<|&lt;)-%s%s/m';
    $surfix_format = '/%s(>|&gt;)/m';

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