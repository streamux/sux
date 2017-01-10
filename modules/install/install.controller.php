<?php

class InstallController extends Controller {

	function insertSetupDb() {

		$context = Context::getInstance();
		$posts =$context->getPostAll();

		$db_info = array('db_hostname', 'db_userid', 'db_password', 'db_database','db_table_prefix');
		
		$resultYN = 'Y';
		$msg = '';

		$rootPath = _SUX_ROOT_;
		$filePath = './files/config/config.db.php';

		$buffer = array();
		foreach ($db_info as $key => $value) {
			$buffer['db_info'][$value] = $posts[$value];
		}
		$result = CacheFile::writeFile($filePath, $buffer);
		if (!$result) {
			$msg .= 'DB 설정을 실패했습니다.';
			$resultYN = 'N';
		} else {
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

		$admin_info = array('admin_id','admin_pwd','admin_email','yourhome');

		$resultYN = 'Y';
		$msg = '';

		$rootPath = _SUX_ROOT_;
		$filePath = 'files/config/config.admin.php';
		$buffer = array();
		foreach ($admin_info as $key => $value) {
			$buffer['admin_info'][$value] = $posts[$value];
		}
		$result = CacheFile::writeFile($filePath, $buffer);
		if(!$result) {
			$msg = "관리자 설정을 실패했습니다.";
			$resultYN = "N";
		} else {
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

		$realPath = _SUX_PATH_;
		$rootPath = _SUX_ROOT_;
		$resultYN = 'Y';
		$msg = '';

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
						} // end of foreach

						// setup query's columns-cache-file
						$queryCachePath = './files/caches/queries/' . $tableXml['name'] . '.getColumns.cache.php';

						$buffer = array();
						$buffer['columns'] = $cacheColumn;
						$cacheFile->writeFile($queryCachePath, $buffer);

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
			} // end of foreach

			// add start's value'
			$queryDir = './modules/' . $module . '/queries';				
			$queryList = FileHandler::readDir($queryDir);
			if ($queryList) {

				foreach ($queryList as $key => $value) {
					if (preg_match('/(.xml+)$/', $value['file_name'] )) {
						$xmlPath = $queryDir . '/' . $value['file_name'];
						if (file_exists($xmlPath)) {
							$query = new Query();
							$columns = array();				
							$queryXml = simplexml_load_file($xmlPath);	

							$moduleType = (string) gettype($queryXml['module']);					
							if (strpos(strtolower($moduleType),'install') !== false) {
								continue;
							}

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
								$numrows = $oDB->getNumRows();
							}

							if (isset($numrows) && $numrows == 0) {
								$query->setColumn($columns);
								$oDB->insert($query);

								// write template'file to file's dir to read from module's template file
								if ($module == 'document') {
									$cachePath = Utils::convertAbsolutePath($contentsPath, $realPath);
									//$msg .= $tplPath;
									//  read and write contents
									$contentsPath = $realPath . 'modules/document/tpl/home.tpl';
									$buff = FileHandler::readFile($contentsPath);

									$result = FileHandler::writeFile($cachePath, $buff);
									if (!$result) {
										$msg .= "${category} 페이지 등록을 실패하였습니다.<br>";
									} else {
										$msg .= "${category} 페이지가 정상적으로 등록되었습니다.<br>";
									}
								}								
							}	
						}
					}
				} // end of foreach		
			}
		} // end of foreach

		//$msg .= Tracer::getInstance()->getMessage();
		// write table list
		$tableDir = './files/config/config.table.php';
		$pathinfo = pathinfo($tableDir);

		$buffer = array();
		$buffer['table_list'] = $tableList;		
		$result = CacheFile::writeFile($tableDir, $buffer);
		if (!$result) {
			$msg .= $pathinfo['filename'] . ' 파일을 저장하는데 실패했습니다.<br>';
			$resultYN = 'N';
		} else {
			$msg .= $pathinfo['filename'] . " 설정을 완료하였습니다.<br>";
			$resultYN = 'Y';
		}

		$data = array(	'msg'=>$msg,
						'result'=>$resultYN,
						'url'=>$rootPath);

		$this->callback($data);

		//$oDB->close();
	}
}