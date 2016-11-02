<?php
class UIError extends Object {

	static $uierror_instance = null;	
	private $msg_list = '';
	private $useHtml = FALSE;

	static function &getInstance() {

		if (!self::$uierror_instance) {
			self::$uierror_instance = new self();
		}

		return self::$uierror_instance;
	}

	private function getHtmlLayout( $str ) {

		$htmlUI = "<!doctype>
		<html>
		<head>
			<title>UI 경고 - StreamUX</title>
			<meta charset='utf-8' />
			</head>
		<body>
			{$str}
		</body>
		</html>";

		$htmlUI = preg_replace('/\t|/', '', $htmlUI);

		return $htmlUI;
	}

	public function __get( $prop ) {

		 if (property_exists($this, $prop)) {
                return $this->$prop;
            }
	}

	public function __set( $prop, $value ) {

		 if (property_exists($this, $prop)) {
	            $this->$prop = $value;
	        }
	}

	public function add( $msg ) {

		$this->msg_list .= $msg . '<br>';
	}

	public function output() {

		$htmlUI = '%s';

		if ($this->useHtml === TRUE) {
			$htmlUI = $this->getHtmlLayout($htmlUI);
		}

		printf($htmlUI, $this->msg_list);

		$this->$msg_list = '';
	}

	static function alert( $msg, $useHtml = TRUE ) {

		$htmlUI = 	'<script>
						alert(\'%s\');
					</script>';

		if ($useHtml === TRUE) {
			$htmlUI = self::getHtmlLayout( $htmlUI );
		}
		printf($htmlUI, $msg);
	}

	static function alertToBack( $msg, $useHtml = TRUE ) {

		$htmlUI =	'<script>
						alert(\'%s\');
						history.go(-1);
					</script>';

		if ($useHtml === TRUE) {
			$htmlUI = self::getHtmlLayout( $htmlUI );
		}
		printf($htmlUI, $msg);
	}

	static function alertTo( $msg, $url = NULL, $useHtml = TRUE ) {

		$htmlUI =	'<script>
						alert(\'%s\');
						location.href=\'%s\';
					</script>';

		if ($useHtml === TRUE) {
			$htmlUI = self::getHtmlLayout( $htmlUI );
		}
		printf($htmlUI, $msg, $url);
	}
}
?>