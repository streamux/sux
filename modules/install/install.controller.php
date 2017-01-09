<?php

class InstallController extends Controller {

	function insertSetupDb() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$db_hostname	= trim($posts['db_hostname']);
		$db_userid		= trim($posts['db_userid']);
		$db_password	= trim($posts['db_password']);
		$db_database 	= trim($posts['db_database']);
		$db_table_prefix = trim($posts['db_table_prefix']);
		
		$resultYN = 'Y';
		$msg = '';

		$rootPath = _SUX_ROOT_;
		$dirPath = 'files/config';
		$file_name = 'config.db.php';
		$dir = $dirPath . '/'. $file_name;

		$fp = fopen($dir, 'w');

		$msg .= $db_hostname;
		if (!$fp) {
			$msg .= '파일을 여는데 실패했습니다.';
			$resultYN = 'N';
		} else {

			$content = array();	
			$content[] = "<?php";
			$content[] = "\$db_hostname = '$db_hostname';";
			$content[] = "\$db_userid = '$db_userid';";
			$content[] = "\$db_password = '$db_password';";
			$content[] = "\$db_database = '$db_database';";
			$content[] = "\$db_table_prefix = '$db_table_prefix';";
			$content[] = "?>";

			$buffer = implode(PHP_EOL, $content);
			fwrite($fp, $buffer, strlen($buffer));
			fclose($fp);

			$msg .= " DB 설정을 완료하였습니다.<br>";
			$resultYN = 'Y';
		}

		if ($resultYN == 'N') {
			UIError::alertToBack($msg);
		} else {
			$data = array(	'msg'=>$msg,
							'result'=>$resultYN,
							'url'=>$rootPath . 'setup-admin');

			$this->callback($data);
		}		
	}

	function insertSetupAdmin() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$admin_id		= trim($posts['admin_id']);
		$admin_pwd	= trim($posts['admin_pwd']);
		$admin_email	= trim($posts['admin_email']);
		$yourhome		= trim($posts['yourhome']);

		$resultYN = 'Y';
		$msg = '';

		$rootPath = _SUX_ROOT_;

		$dirPath = 'files/config';
		$file_name = 'config.admin.php';
		$dir = $dirPath . '/' . $file_name;
		$fp = fopen($dir, 'w');

		if(!$fp) {
			$msg = "파일을 여는데 실패했습니다.";
			$resultYN = "N";
		} else {

			if (strlen(stristr($yourhome, 'http://')) == 0) {
				$yourhome	 = 'http://'.$yourhome	;
			}

			$content = array();	
			$content[] = "<?";
			$content[] = "\$admin_id = '$admin_id';";
			$content[] = "\$admin_pwd = '$admin_pwd';";
			$content[] = "\$admin_email = '$admin_email';";	
			$content[] = "\$yourhome = '$yourhome';";
			$content[] = "?>";

			$buffer = implode(PHP_EOL, $content);
			fwrite($fp, $buffer, strlen($buffer));
			fclose($fp);

			@chmod($file,0644);

			$msg = "관리자계정 설정을 완료하였습니다.<br>";
			$resultYN = 'Y';
		}

		if ($resultYN == 'N') {
			UIError::alertToBack($msg);
		} else {
			$data = array(
				'msg'=>$msg,
				'result'=>$resultYN,
				'url'=>$rootPath . 'create-table' . '?_method=insert');

			$this->callback($data);
		}
	}

	/**
	 * @method createTable
	 *  스키마 데이터 xml  연동
	 */
	function insertCreateTable() {

		$rootPath = _SUX_ROOT_;
		$resultYN = 'Y';
		$msg = '';

		$file_name = 'config.table.php';
		$tableDir = 'files/config/' . $file_name;

		$tableList = array();
		$tracer = Tracer::getInstance();
		$context = Context::getInstance();
		$context->init();

		$query = new Query();
		$schemas = new QuerySchema();
		$cacheFile = CacheFile::getInstance();

		// 반응이 없을 땐 DB계정 정보가 바른지 확인한다.
		$oDB = DB::getInstance();		

		$tablePrefix = $context->getPrefix();
		$moduleList = FileHandler::readDir('./modules');
		foreach ($moduleList as $key => $value) {
			$module = $value['file_name'];

			// create table and make cache's column file'
			$shemasDir = './modules/' . $module . '/schemas';
			$schemasList = FileHandler::readDir($shemasDir);
			foreach ($schemasList as $key => $value) {
				if (preg_match('/(.xml+)$/', $value['file_name'] )) {

					$xmlPath = $shemasDir . '/' . $value['file_name'];
					if (file_exists($xmlPath)) {

						$query->resetSchema();
						$schemas->reset();

						$tableXml = simplexml_load_file($xmlPath);
						$tableName = $tablePrefix . '_' . $tableXml['name'];
						$query->setTable($tableName);											

						$cacheColumn = array();
						$columns = $tableXml[0]->column;
						foreach ($columns as $key => $value) {

							$name = $value['name'];
							$type = $value['type'];
							$size = $value['size'];
							$default = isset($value['default']) ? $value['default'] : null;
							$notnull = isset($value['notnull']) ? $value['notnull'] : null;					
							$autoincrement = isset($value['auto_increment']) ? $value['auto_increment'] : null;
							$primarykey = isset($value['primary_key']) ? $value['primary_key'] : null;
							$schemas->add($name, $type, $size, $default, $notnull, $autoincrement, $primarykey);

							$cacheColumn[] = $name;
						}

						// setup query's columns-cache-file
						$cachePath = _SUX_PATH_ . 'files/caches/queries/' . $tableXml['name'] . '.getColumns.cache.php';
						$cacheFile->writeColumnsForQuery($cachePath, $cacheColumn);

						$keyName = (string) $tableXml['name'];	
						$tableList[$keyName] = $tableName;

						$query->setSchema($schemas);
						$result = $oDB->createTable($query);
						if (!$result) {
							$resultYN = 'N';
							$msg .= '@ table->' . $tableName . " [ result : fail ] ----<br>";
							//$msg .= $tracer->getMessage();
						} else {																
							$msg .= '@ table->' . $tableName . " [ result : success ] ----<br>";
						}
					}
				}
			}

			// add start's value'
			$queryDir = './modules/' . $module . '/queries';				
			$queryList = FileHandler::readDir($queryDir);
			if ($queryList) {

				//$msg .= "${module}---------------<br>";
				foreach ($queryList as $key => $value) {
					if (preg_match('/(.xml+)$/', $value['file_name'] )) {
						$xmlPath = $queryDir . '/' . $value['file_name'];
						if (file_exists($xmlPath)) {
							$query = new Query();
							$columns = array();							
							$queryXml = simplexml_load_file($xmlPath);	
							$tableName = $tablePrefix . '_' . $queryXml[0]->tables[0]->table['name'];		
							$query->setTable($tableName);
							$queryColumns = $queryXml[0]->columns[0]->column;
							foreach ($queryColumns as $key => $value) {

								$nodeValue = (string) $value;
								if (preg_match('/((header|contents|footer)_path)+$/i', $value['name']) == true) {
									$nodeValue = $rootPath . $nodeValue;
								}

								if ($value['name'] == 'category') {
									$where = array('category'=>$nodeValue);
								}

								if ($value['name'] == 'contents_path') {
									$contentsPath = $nodeValue;					
								}

								$columns[] = $nodeValue;
							}							

							if (isset($where) && $where) {
								$query->setField('id');
								$query->setWhere($where);
								$oDB->select($query);
								$numrows = $oDB->getNumRows() . PHP_EOL;
							}

							if (isset($numrows) && $numrows == 0) {
								$query->setColumn($columns);
								$oDB->insert($query);

								if (file_exists($contentsPath)) {
									$tplPath = _SUX_PATH_ . $contentsPath;
								}
							}		
						}
					}
				} // end of foreach		
			} // end of if
		} // end of foreach

		//$msg .= Tracer::getInstance()->getMessage();
		// write table list
		$fp = fopen($tableDir, 'w');
		if (!$fp) {
			$msg .= '파일을 여는데 실패했습니다.';
			$resultYN = 'N';
		} else {
			$content = array();	
			$content[] = "<?php";

			$str = "\$table_list = array(";
			$index = 0;
			foreach ($tableList as $key => $value) {
				$str .= ($index === 0) ? "" : ",";
				$str .= "'".$key."'=>'".$value."'";
				$index++;
			}
			$str .= ");";
			$content[] = $str;

			$buffer = implode(PHP_EOL, $content);
			fwrite($fp, $buffer, strlen($buffer));
			fclose($fp);

			@chmod($tableDir,0644);

			$msg .= "테이블 리스트 설정을 완료하였습니다.<br>";		
		}

		$data = array(	'msg'=>$msg,
						'result'=>$resultYN,
						'url'=>$rootPath);

		$this->callback($data);

		$oDB->close();
	}
}