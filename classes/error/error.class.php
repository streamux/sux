<?php

class Error {

	static function alert($msg) {

		echo '	<script>
					alert(\''.${msg}.'\');
				</script>';
	}

	static function alertToBack($msg) {

		echo '	<script>
					alert(\''.${msg}.'\');
					history.go(-1);
				</script>';
	}

	static function alertTo($msg, $url=null) {

		echo '	<script>
					alert(\'' . $msg . '\');
					location.href=\'' . $url . '\';
				</script>';
	}
}
?>