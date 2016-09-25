<?php

class InstallModules  extends BaseView {

	var $class_name = 'install_module';
	var $skin_dir = '';
	var $skin_path = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;
	var $copyright_path = '';

	/**
	 * @method display
	 * 현재 상위 클래스에서 'display'메서드에서 DB연결 클래스를 사용하고 있기 때문에
	 * 아직 DB설정 전 단계인 install 클래스에서는 오버라이드해서 사용한다.
	 */
	function display($methodName=NULL) {

		$methodName = 'display' . ucfirst($methodName);
		$this->defaultSetting();
		$this->$methodName();
	}

	function defaultSetting() {

		$this->copyright_path = _SUX_PATH_ . 'modules/admin/tpl/copyright.tpl';
	}

	function output() {

		$smarty = new Smarty;
		if (is_readable($this->skin_path)) {
			$smarty->assign('copyrightPath', $this->copyright_path);
			$smarty->assign('skinDir', $this->skin_dir);
			$smarty->assign('sessionData', $this->session_data);
			$smarty->assign('requestData', $this->request_data);
			$smarty->assign('postData', $this->post_data);
			$smarty->assign('documentData', $this->document_data);
			$smarty->display( $this->skin_path );
		} else {
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
	}
}

class InstallView extends InstallModules {

	function displayTerms() {

		$this->skin_dir = _SUX_PATH_ . 'modules/install/tpl/';
		$this->skin_path = $this->skin_dir . 'terms.tpl';

		$this->output();
	}

	function displayDbsetup() {

		$context = Context::getInstance();
		$this->request_data =$context->getRequestAll();

		$this->skin_dir = _SUX_PATH_ . 'modules/install/tpl/';
		$this->skin_path = $this->skin_dir . 'db_setup.tpl';

		$this->output();
	}

	function displayAdminSetup() {

		$context = Context::getInstance();
		$this->request_data =$context->getRequestAll();

		$this->skin_dir = _SUX_PATH_ . 'modules/install/tpl/';
		$this->skin_path = $this->skin_dir . 'admin_setup.tpl';

		$this->output();
	}

	function displayRecordDbsetup() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$db_hostname	= trim($posts['db_hostname']);
		$db_userid		= trim($posts['db_userid']);
		$db_password	= trim($posts['db_password']);
		$db_database 	= trim($posts['db_database']);

		$resultYN = 'Y';
		$msg = '';

		$file_name = 'config.db.php';
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

			$msg = "데이터베이스 설정을 완료하였습니다.\n";
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

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayRecordAdminsetup() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$admin_id		= trim($posts['admin_id']);
		$admin_pwd	= trim($posts['admin_pwd']);
		$admin_email	= trim($posts['admin_email']);
		$yourhome		= trim($posts['yourhome']);

		$resultYN = 'Y';
		$msg = '';

		$file_name = 'config.admin.php';
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

			$msg = "관리자계정 설정을 완료하였습니다.\n";
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

		$data = array(	'result'=>$resultYN,
						'msg'=>$msg);

		echo $this->callback($data);
	}

	/**
	 * @method displayRecordCreatetable
	 * 차 후 xml구조 스키마연동 구현 예정 
	 */
	function displayRecordCreatetable() {

		$context = Context::getInstance();
		$context->init();

		$oDB = DB::getInstance();

		$table_list = $context->getTableList();
		for($i=0; $i < count($table_list); $i++) {
			${$table_list[$i]} = $table_list[$i];
		}

		$skin_dir = _SUX_PATH_ . 'modules/install/schemas/';
		$skin_path = $skin_dir . 'create_table.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}

		for($i=0; $i < count($table_list); $i++) {
			unset(${$table_list[$i]});
		}
		
		$oDB->close();
	}
}
?>