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

	public function __get( $prop) {

		 if (property_exists($this, $prop)) {
                return $this->$prop;
            }
	}

	public function __set( $prop, $value) {

		 if (property_exists($this, $prop)) {
	            $this->$prop = $value;
	        }
	}

	public function add( $msg ) {

		$this->msg_list .= $msg . '<br>';
	}

	public function output() {

		$htmlUI = '%s';

		if (strtolower($this->useHtml) === true) {
			$htmlUI = $this->getHtmlLayout($htmlUI);
		}

		printf($htmlUI, $this->msg_list);

		$this->$msg_list = '';
	}

	private function htmlHeader() {

		$html = '<!doctype>
		<html>
		<head>
			<title>UI 경고 - StreamUX</title>
			<meta charset="utf-8" />
		</head>
		<body>';

		$html = preg_replace('/\t|/', '', $html);
		return $html;
	}

	private function htmlFooter() {

		$html = '</body>
		</html>';
		$html = preg_replace('/\t|/', '', $html);
		return $html;
	}

	static function alert( $msg, $useHtml=true) {

		$msg = preg_replace('/<br>/', '\n',$msg);
		$context = Context::getInstance();
		if ($context->ajax()) {
			$data = array(	'result'=>'N',
							'msg'=>$msg);

			Object::callback($data);
		} else {
			$script = 	'<script>
							alert(\'%s\');
						</script>
						<noscript>
							%s
						</noscript>';

			$html = $script;
			if (strtolower($useHtml) === true) {
				$html = self::htmlHeader();
				$html .= $script;
				$html .= self::htmlFooter();
			}
			printf($html, $msg, $msg);
		}		
	}

	static function alertToBack( $msg, $useHtml=true) {

		$msg = preg_replace('/<br>/', '\n',$msg);
		$context = Context::getInstance();
		if ($context->ajax()) {
			$data = array(	'result'=>'N',
							'msg'=>$msg);

			Object::callback($data);
		} else {
			$script =	'<script>
							alert(\'%s\');
							history.go(-1);
						</script>
						<noscript>
							%s
						</noscript>';

			$html = $script;
			if (strtolower($useHtml) === true) {
				$html = self::htmlHeader();
				$html .= $script;
				$html .= self::htmlFooter();
			}
			printf($html, $msg, $msg);
		}
	}

	static function alertTo( $msg, $url = NULL, $useHtml=true) {

		$msg = preg_replace('/<br>/', '\n',$msg);
		$context = Context::getInstance();
		if ($context->ajax()) {
			$data = array(	'alertTo'=>$url,
							'result'=>'N',
							'msg'=>$msg);

			Object::callback($data);
		} else {
			$script ='<script>
						alert(\'%s\');
						location.href=\'%s\';
					</script>
					<noscript>
						%s
					</noscript>';

			$html = $script;	
			if (strtolower($useHtml) === true) {

				$html = self::htmlHeader();
				$html .= $script;
				$html .= self::htmlFooter();
			}
			printf($html, $msg, $url, $msg);
		}
	}
}