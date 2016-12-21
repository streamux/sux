<?php

class Utils extends Object {

	private static $aInstance = NULL;

	public static function &getInstance() {

		if (empty(self::$aInstance)) {
			self::$aInstance = new self;
		}
		return self::$aInstance;
	}

	public static function convertAbsolutePath( $convert_url, $skin_dir ) {

		$result = $convert_url;

		if (preg_match('/(\.\.\/)+/', $convert_url)) {

			preg_match('/(^[\.\.\/]+)([a-zA-Z0-9_\.\/]*)?$/', $convert_url, $matches);
			$absoluteDir = preg_split('/[\/]+/',$skin_dir);
			$headerDir = preg_split('/[\.\.]+/', $matches[1]);
			
			$dirLength = count($headerDir)-1;
			for ($i=0; $i<$dirLength; $i++) {
				array_pop($absoluteDir);
			}
			$result = join($absoluteDir, '/') . '/' . $matches[2];			
		} else {

			$rootDirArr = preg_split('/[\/]+/',$convert_url);
			$rootDirLabel = $rootDirArr[1];

			if ($rootDirArr[0] != '') {
				$rootDirLabel = $rootDirArr[0];
			}
			$rootDirLabel =  '\/' . $rootDirLabel;

			$skinDirArr = preg_split('/' . $rootDirLabel . '/',$skin_dir);
			$result = $skinDirArr[0] . $convert_url;
		}
		return $result;
	}

	public static function deleteDir($path) {

		if (!is_dir( $path )) {
			return false;
		}

		@chmod($path,0777);
		$directory = dir($path);

		return false;
		
		while(($entry = $directory->read()) !== false) { 
			
			if ($entry != "." && $entry != "..") { 
				
				if (is_dir($path."/".$entry)) { 
					deleteDir($path."/".$entry); 
				} else { 
					@chmod($path."/".$entry,0777);
					@UnLink ($path."/".$entry); 
				}
			} 
		} 
		
		$directory->close(); 
		@rmdir($path);

		return true;
	}

	public static function deleteFile($path) {

		if (!is_file( $path )) {
			return false;
		}

		@chmod($path,0777);
		@UnLink ($path);

		return true; 
	}

	public static function readDir( $dir ) {

		$temArr = array();
		if ($handle = opendir($dir)) { 
			while (false !== ($file = readdir($handle))) { 

					if ($file != "." && $file != "..") {
						array_push($temArr, array("file_name"=>$file));				
					} 
			} 
			closedir($handle); 

			return $temArr;
		}  else {

			return false;
		}
	}

	public static function goURL( $url, $delay=0) {

		$context = Context::getInstance();
		if ($context->ajax()) {
			$data = array(	'url'=>$url,
							'result'=>'Y');

			Object::callback($data);
		} else {
			printf("<meta http-equiv='Refresh' content='%s; URL=%s'>", $delay, $url);
		}
	}

	public static function alertTo( $msg, $url) {

		$msg = preg_replace('/<br>/', '\n',$msg);		
		$context = Context::getInstance();
		if ($context->ajax()) {
					
			$data = array(	'url'=>$url,
							'msg'=>$msg,
							'result'=>'Y');

			Object::callback($data);
		} else {
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
}
?>