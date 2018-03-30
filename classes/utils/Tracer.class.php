<?php

class Tracer extends Object{
  
  static $otInstance = null;
  var $message = '';

  static function &getInstance() {

    if (!self::$otInstance) {
      self::$otInstance = new self;
    }
    return self::$otInstance;
  }

  function setMessage( $message, $type=null ) {

    $this->message .= $message . "<br>";
  }

  function getMessage() {

    return $this->message;
  }

  function debugging() {

    $msg = $this->getMessage();
    parent::callback(array('result'=>'N', 'msg'=>$msg));
    exit;
  }

  function output( $msg='' ) {

    if ($msg === '') {
     $msg =  $this->message;
    }

    parent::output( $msg );
  }

  function reset() {
    $this->message = '';
  }

  function getString() {

    return 'Tracer';
  }
}
?>