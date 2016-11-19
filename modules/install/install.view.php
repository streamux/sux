<?php

class InstallModule  extends View {

	var $class_name = 'install_module';
	var $skin_path_list = array();
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

		if (preg_match('/^record+/i', $methodName)) {
			$methodName = $methodName;
		} else {
			$methodName = 'display' . ucfirst($methodName);
		}
		$this->defaultSetting();
		$this->$methodName();
	}

	function output() {

		$UIError = UIError::getInstance();
		/**
		 * @class Template
		 * @brief Template is a Wrapper Class based on Smarty
		 */
		$__template = new Template();
		if (is_readable($this->skin_path_list['contents'])) {
			$__template->assign('copyrightPath', $this->copyright_path);
			$__template->assign('skinPathList', $this->skin_path_list);
			$__template->assign('sessionData', $this->session_data);
			$__template->assign('requestData', $this->request_data);
			$__template->assign('postData', $this->post_data);
			$__template->assign('documentData', $this->document_data);
			$__template->display( $this->skin_path_list['contents'] );
		} else {
			$UIError->add('스킨 파일경로가 올바르지 않습니다.');
			$UIError->useHtml = TRUE;
		}
		$UIError->output();	
	}
}

class InstallView extends InstallModule {

	function displayInstall() {

		$this->displayTerms();
	}

	function displayTerms() {

		$this->skin_path_list['root'] = _SUX_ROOT_;
		$this->skin_path_list['skin_dir'] = _SUX_PATH_.'modules/install/tpl/';
		$this->skin_path_list['contents'] = _SUX_PATH_ . 'modules/install/tpl/terms.tpl';

		$this->output();
	}

	function displayDbsetup() {

		$context = Context::getInstance();
		$this->request_data['action'] = $context->get('action');

		$this->skin_path_list['root'] = _SUX_ROOT_;
		$this->skin_path_list['skin_dir'] = _SUX_PATH_.'modules/install/tpl/';
		$this->skin_path_list['contents'] = _SUX_PATH_ . 'modules/install/tpl/db_setup.tpl';

		$this->output();
	}

	function displayAdminSetup() {

		$context = Context::getInstance();
		$this->request_data['action'] = $context->get('action');

		$this->skin_path_list['root'] = _SUX_ROOT_;
		$this->skin_path_list['skin_dir'] = _SUX_PATH_.'modules/install/tpl/';
		$this->skin_path_list['contents'] = _SUX_PATH_ . 'modules/install/tpl/admin_setup.tpl';

		$this->output();
	}

	function recordDBSetup() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$db_hostname	= trim($posts['db_hostname']);
		$db_userid		= trim($posts['db_userid']);
		$db_password	= trim($posts['db_password']);
		$db_database 	= trim($posts['db_database']);
		$db_table_prefix = trim($posts['db_table_prefix']);
		
		$resultYN = 'Y';
		$msg = '';
		
		$file_name = 'config.db.php';
		$file = 'config/' . $file_name;
		$fp = fopen($file, 'w');

		$msg .= $db_hostname;	

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
			$str .= "\$db_table_prefix = '$db_table_prefix';\n";
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

	function recordAdminSetup() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$admin_id		= trim($posts['admin_id']);
		$admin_pwd	= trim($posts['admin_pwd']);
		$admin_email	= trim($posts['admin_email']);
		$yourhome		= trim($posts['yourhome']);

		$resultYN = 'Y';
		$msg = '';

		$file_name = 'config.admin.php';
		$file = 'config/' . $file_name;
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
	function recordCreateTable() {

		$resultYN = 'Y';
		$msg = '';
		$tableList = array();

		$file_name = 'config.table.php';
		$file = 'config/' . $file_name;

		if (file_exists($file)) {
			include_once $file;
			$tableList = $table_list;
		}

		$tracer = Tracer::getInstance();
		$context = Context::getInstance();
		$context->init();


		$query = new Query();
		$schemas = new QuerySchema();

		// 반응이 없을 땐 DB계정 정보가 바른지 확인한다.
		$oDB = DB::getInstance();

		$tablePrefix = $context->getPrefix();
		$moduleList = Utils::readDir('./modules');
		foreach ($moduleList as $key => $value) {
			$module = $value['file_name'];
			$dir = './modules/' . $module . '/schemas';

			$fileList = Utils::readDir($dir);
			foreach ($fileList as $key => $value) {

				if (preg_match('/(.xml+)$/', $value['file_name'] )) {

					$xmlPath = $dir . '/' . $value['file_name'];
					if (file_exists($xmlPath)) {

						$query->resetSchema();
						$schemas->reset();

						$table = simplexml_load_file($xmlPath);
						$tableName = $tablePrefix . '_' . $table['name'];
						$query->setTable($tableName);											

						$columns = $table[0]->column;
						foreach ($columns as $key => $value) {

							$name = $value['name'];
							$type = $value['type'];
							$size = $value['size'];
							$default = isset($value['default']) ? $value['default'] : null;
							$notnull = isset($value['notnull']) ? $value['notnull'] : null;					
							$autoincrement = isset($value['auto_increment']) ? $value['auto_increment'] : null;
							$primarykey = isset($value['primary_key']) ? $value['primary_key'] : null;
							$schemas->add($name, $type, $size, $default, $notnull, $autoincrement, $primarykey);
						}

						$query->setSchema($schemas);
						$result = $oDB->createTable($query);
						if (!$result) {
							$resultYN = 'N';
							$msg .= '@ table->' . $tableName . " [ result : fail ] ----\n";
							//$msg .= $tracer->getMessage();
						} else {
							$keyName = (string) $table['name'];
							$tableList[$keyName] = $tableName;
							//$context->setTable($table['name'], $tableName);
							$msg .= '@ table->' . $tableName . " [ result : success ] ----\n";
						}
					}
				}
			}
		}
		
		$fp = fopen($file, 'w');
		if (!$fp) {
			$msg .= '파일을 여는데 실패했습니다.';
			$resultYN = 'N';
		} else {
			$index = 0;
			$str = "";
			$str .= "<?\n";
			$str .= "\$table_list = array(\n";
			foreach ($tableList as $key => $value) {
				$str .= ($index === 0) ? "" : ",\n";
				$str .= "'".$key."'=>'".$value."'";
				$index++;
			}
			$str .= "\n);\n";
			$str .= "?>";

			fwrite($fp, $str, strlen($str));
			fclose($fp);

			$msg .= "테이블 리스트 설정을 완료하였습니다.\n";

			if (file_exists($file)) {
				$result = @chmod($file,0777);
				if (!$result) {
					$msg .= $file_name . ' 권한설정을 실패하였습니다.';
					$resultYN = 'N';
				}
			} else {
				$msg .= $file_name . ' 파일이 이미 존재하지 않습니다.';
				$resultYN = 'N';
			}			
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);
		
		echo $this->callback($data);

		$oDB->close();
	}
}
?>