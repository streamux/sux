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

	function JsonEncoder() {}

	public static function getInstance() {

		if (empty(self::$je_instance)) {
			self::$je_instance = new self;
		}

		return self::$je_instance;
	}

	public function parse( $data = NULL) {

		$data = ($data === NULL) ? $this->json_data : $data;

		if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
			return json_encode($data, JSON_UNESCAPED_UNICODE);	
		} else {
			return json_encode($data);	
		}
	}

}
/* End of file JsonEncoder.class.php */

?>

