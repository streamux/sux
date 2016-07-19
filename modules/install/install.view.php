<?php

class InstallView  extends Object {

	var $class_name = 'install_view';

	function display($className=NULL) {

		if (strlen(stristr($className, '_')) > 0) {
			$tempName = '';
			$str_arr = split('_', $className);

			for ($i=0; $i<count($str_arr); $i++) {
				$tempName .= ucfirst($str_arr[$i]);
			}
			$className = $tempName . "Panel";
		} else {
			$className = ucfirst($className) . "Panel";
		}
		
		$view = new $className();
		$view->init();
	}
}

class TermsPanel extends Object {

	var $class_name = 'terms';

	function init() {

		$skin_dir = _SUX_PATH_ . 'modules/install/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
		
		$skin_path = $skin_dir . 'terms.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$skin_path = $skin_dir . 'footer.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '푸터 파일경로를 확인하세요.<br>';
		}
	}
}

class DBSetupPanel extends Object {

	var $class_name = 'dbsetup';

	function init() {

		$skin_dir = _SUX_PATH_ . 'modules/install/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
		
		$skin_path = $skin_dir . 'db_setup.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$skin_path = $skin_dir . 'footer.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '푸터 파일경로를 확인하세요.<br>';
		}
	}
}

class AdminSetupPanel extends Object {

	var $class_name = 'adminsetup';

	function init() {

		
		$skin_dir = _SUX_PATH_ . 'modules/install/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
		
		$skin_path = $skin_dir . 'admin_setup.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$skin_path = $skin_dir . 'footer.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '푸터 파일경로를 확인하세요.<br>';
		}
	}
}

class RecordDbsetupPanel extends Object {

	var $class_name = 'record_dbsetup';

	function init() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$db_hostname	= trim($posts['db_hostname']);
		$db_userid		= trim($posts['db_userid']);
		$db_password	= trim($posts['db_password']);
		$db_database 	= trim($posts['db_database']);

		$resultYN = 'Y';
		$msg = '';

		$file_name = 'db.config.php';
		$file = '../../config/' . $file_name;
		$fp = fopen($file, 'w');

		if(!$fp) {

			$msg .= '파일을 여는데 실패했습니다.';
			$resultYN = 'N';
		}else{

			$str = "";
			$str .= "<?\n";
			$str .= "\$db_hostname = '$db_hostname';\n";
			$str .= "\$db_userid = '$db_userid';\n";
			$str .= "\$db_password = '$db_password';\n";
			$str .= "\$db_database = '$db_database';\n";
			$str .= "?>";

			fwrite($fp, $str, strlen($str));
			fclose($fp);

			$msg = '데이터베이스 설정을 완료하였습니다.\n';
			$resultYN = 'Y';

			if (file_exists($file)) {
				$result = @chmod($file,0777);
				if (!$result) {
					$msg .= $file_name . ' 권한설정을 실패하였습니다.';
					$resultYN = 'N';
				}
			} else {
				$msg .= $file_name . ' 파일이 존재하지 않습니다.';
				$resultYN = 'N';
			}			
		}

		$json_data = array(	"result"=>$resultYN,
							"msg"=>urlencode($msg));

		$strJson = json_encode($json_data);
		echo $_REQUEST['callback'].'('.urldecode($strJson).')';
	}
}

class RecordAdminsetupPanel extends Object {

	var $class_name = 'record_adminsetup';

	function init() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$admin_id		= trim($posts['admin_id']);
		$admin_pwd	= trim($posts['admin_pwd']);
		$admin_email	= trim($posts['admin_email']);
		$yourhome		= trim($posts['yourhome']);

		$resultYN = 'Y';
		$msg = '';

		$file_name = 'admin.inc.php';
		$file = '../../config/' . $file_name;
		$fp = fopen($file, 'w');

		if(!$fp) {
			$msg = "파일을 여는데 실패했습니다.";
			$resultYN = "N";
		} else {

			if (strlen(stristr($yourhome, 'http://')) == 0) {
				$yourhome	 = 'http://'.$yourhome	;
			}

			$str = "";
			$str .= "<?\n";
			$str .= "\$admin_id = '$admin_id';\n";
			$str .= "\$admin_pwd = '$admin_pwd';\n";
			$str .= "\$admin_email = '$admin_email';\n";	
			$str .= "\$yourhome = '$yourhome';\n";
			$str .= "?>";

			fwrite($fp, $str, strlen($str));
			fclose($fp);

			$msg = '관리자계정 설정을 완료하였습니다.\n';
			$resultYN = 'Y';

			if (file_exists($file)) {
				$result = @chmod($file,0777);
				if (!$result) {
					$msg .= $file_name . ' 권한설정을 실패하였습니다.';
					$resultYN = 'N';
				}
			} else {
				$msg .= $file_name . ' 파일이 존재하지 않습니다.';
				$resultYN = 'N';
			}
		}

		$json_data = array(	'result'=>$resultYN,
							'msg'=>urlencode($msg));

		$strJson = json_encode($json_data);
		echo $_REQUEST['callback'].'('.urldecode($strJson).')';
	}
}

class RecordCreatetablePanel extends Object {

	var $class_name = 'record createtable';

	function init() {

		$skin_dir = _SUX_PATH_ . 'modules/install/schemas/';

		$skin_path = $skin_dir . 'create_table.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}
	}
}
?>