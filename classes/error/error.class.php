<?php
class Error {

	function getHtmlLayout( $str ) {

		$htmlUI =	"<!doctype>
					<html>
					<head>
						<title>경고 메세지</title>
						<meta charset='utf-8' />
					</head>
					<body>
						{$str}	
					</body>
					</html>";

		return $htmlUI;
	}

	static function alert($msg) {

		$scriptForm = 	'<script>
							alert(\'%s\');
						</script>';

		$htmlUI = $this->getHtmlLayout( $scriptForm );
		printf($htmlUI, $msg);
	}

	static function alertToBack($msg) {

		$scriptForm =	'<script>
							alert(\'%s\');
							history.go(-1);
						</script>';

		$htmlUI = $this->getHtmlLayout( $scriptForm );
		printf($htmlUI, $msg);
	}

	static function alertTo($msg, $url=null) {

		$scriptForm =	'<script>
							alert(\'%s\');
							location.href=\'%s\';
						</script>';

		$htmlUI = $this->getHtmlLayout( $scriptForm );
		printf($htmlUI, $msg);
	}
}
?>