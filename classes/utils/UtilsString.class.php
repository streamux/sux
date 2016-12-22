<?php

class UtilsString extends Object {
	
	var $class_name = 'utils_string';

	public static function digit( $num ) {

		if ($num < 10) {
			$num = "0" . $num;
		}
		return $num;
	}
}
?>