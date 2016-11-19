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

		$newline = "<br>"; 
		$uri = $_SERVER['REQUEST_URI'];
		if (strstr($uri, 'callback') != -1) {
			$newline = "\n"; 
		}
		$this->message .= $message . $newline;
	}

	function getMessage() {

		return $this->message;
	}

	function output() {

		parent::output( $this->message );
	}
}
?>