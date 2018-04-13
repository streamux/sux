<?php
/* Copyright (C) StreamUX <http://www.streamux.com > */

/**
 * JsonEncoder class for sux
 *
 * @author StreamUX
 * @Location : ./classes/utils/JsonEncoder.class.php
 */
class JsonEncoder {

  private $json_data = array("msg"=>"데이터가 존재하지 않습니다.");
  private static $je_instance = NULL;

  public static function &getInstance() {

    if (empty(self::$je_instance)) {
      self::$je_instance = new self;
    }
    return self::$je_instance;
  }

  public function parse( $data = NULL) {

    $data = ($data === NULL) ? $this->json_data : $data;
    $result = NULL;

    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
      $result = json_encode($data, JSON_UNESCAPED_UNICODE); 
    } else {
      array_walk_recursive($data, function (&$item, $key) {
        if (is_string($item)) {
          $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
        }
      });
      return mb_decode_numericentity(json_encode($data), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
    }

    return $result;
  }

}
/* End of file JsonEncoder.class.php */
?>

