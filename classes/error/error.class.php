<?php
class Error {

	static function alert($msg) {

		printf('	<meta charset="utf-8" />
				<script>
					alert(\'%s\');
				</script>', $msg);
	}

	static function alertToBack($msg) {

		printf('	<meta charset="utf-8" />
				<script>
					alert(\'%s\');
					history.go(-1);
				</script>', $msg);
	}

	static function alertTo($msg, $url=null) {

		printf('	<meta charset="utf-8" />
				<script>
					alert(\'%s\');
					location.href=\'%s\';
				</script>', $msg, $url);
	}
}
?>