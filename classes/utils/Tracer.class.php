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

    $this->message .= $message . PHP_EOL;
  }

  function getMessage() {

    return $this->message;
  }

  function output() {

    parent::output( $this->message );
  }

  function reset() {
    $this->message = '';
  }
}
?>