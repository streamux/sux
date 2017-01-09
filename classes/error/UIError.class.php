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

		if (strtolower($this->useHtml) == true) {
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
			if (strtolower($useHtml) == true) {
				$html = self::htmlHeader();
				$html .= $script;
				$html .= self::htmlFooter();
			}
			printf($html, $msg, $msg);
		}		
	}

	static function alertToBack( $msg, $useHtml=true, $options=null) {

		$msg = preg_replace('/<br>/', '\n',$msg);
		$url = isset($options['url']) ? $options['url'] : null;
		$delay = isset($options['delay']) ? $options['delay'] : 3;

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
							%s<br>
							[ %s ]초 후에 이전 페이지로 자동 전환됩니다.
							<meta http-equiv="Refresh" content="%s; URL=%s">
						</noscript>';

			$html = $script;
			if (strtolower($useHtml) == true) {
				$html = self::htmlHeader();
				$html .= $script;
				$html .= self::htmlFooter();
			}
			printf($html, $msg, $msg, $delay, $delay, $url);
		}
	}

	static function alertTo( $msg, $useHtml=true, $options=null) {

		$msg = preg_replace('/<br>/', '\n',$msg);
		$url = isset($options['url']) ? $options['url'] : null;
		$delay = isset($options['delay']) ? $options['delay'] : 3;
		
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
						%s<br>
						[ %s ]초 후에 이전 페이지로 자동 전환됩니다.
						<meta http-equiv="Refresh" content="%s; URL=%s">
					</noscript>';

			$html = $script;	
			if (strtolower($useHtml) == true) {
				$html = self::htmlHeader();
				$html .= $script;
				$html .= self::htmlFooter();
			}
			printf($html, $msg, $url, $msg, $delay, $delay, $url);
		}
	}
}