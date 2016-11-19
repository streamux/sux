<?php

class BoardAdminModel extends Model {

	var $class_name = 'board_admin_model';

	function  __construct() {

		parent::__construct();
	}

	function init() {
		
	}

	function showTables() {

		$context = Context::getInstance();
		$db = $context->getDB();

		$query = new Query();
		$query->setDB($db);
		$result = parent::showTables($query);
		
		return $result;
	}

	function searchTables($table) {

		$result = $this->showTables();
		$numrow = $this->getNumRows();

		for ($i=0; $i<$numrow; $i++) {			
			if (mysql_tablename($result, $i) == $table) {
				return true;
			}
		}

		return false;
	}

	function selectFromBoardGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');

		$query = new Query();
		$field = 'id';
		$query->setField($field);
		$query->setTable($group);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardGroupLimit() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$passover = $context->get('passover');
		$limit = $context->get('limit');

		$query = new Query();
		$query->setField('*');
		$query->setTable($group);
		$query->setOrderBy('id desc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoard() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$board = $context->getRequest('table_name');

		$query = new Query();
		$query->setField('*');
		$query->setTable($group);
		$query->setWhere(array('name'=>$board));

		$result = parent::select($query);
		return $result;
	}

	function createTableBoard() {

		$context = Context::getInstance();
		$board = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($board);

		$schema = new QuerySchema();
		$schema->add('id','int',null,'notnull', 'autoincrement');
		$schema->add('name','varchar',30,'notnull');
		$schema->add('pass','varchar',20,'notnull');
		$schema->add('title','varchar',120,'notnull');
		$schema->add('comment','text',null,'notnull');
		$schema->add('email','varchar',30);
		$schema->add('date','timestamp');
		$schema->add('ip','varchar',30);
		$schema->add('see','int');
		$schema->add('opkey','char',12);
		$schema->add('igroup','int');
		$schema->add('space','int');
		$schema->add('ssunseo','int');
		$schema->add('wall','char',1);
		$schema->add('filename','varchar',50);
		$schema->add('filesize','varchar',50);
		$schema->add('filetype','varchar',50);
		$schema->add('type','char',4);
		$schema->setPrimarykey('id');
		$query->setSchema($schema);

		$result = parent::createTable($query);
		return $result;
	}

	function insertIntoBoard() {

		$context = Context::getInstance();
		$board = $context->getRequest('table_name');

		$testPwd = '12';
		$testPwd = substr(md5(trim($testPwd)),0,8);
		$testPwd = substr(md5(trim($testPwd)),0,8);

		$query = new Query();
		$query->setTable($board);
		$query->setColumn(array(
			'','운영자',$testPwd,
			'게시판 시동 테스트',
			'본 게시물은 게시판 시동을 위해 자동 등록된 것입니다.<br> 본 게시물을 삭제하기 전에 반드시 하나를 등록하시기 바랍니다.',
			'','now()',$context->getServer('REMOTE_ADDR'),
			0,'',1,0,0,'a','','','','html'
		));

		$result = parent::insert($query);
		return $result;
	}

	function insertIntoBoardGroup() {

		$str = '';

		$context = Context::getInstance();
		$group = $context->get('db_board_group');		
		$board = $context->getRequest('table_name');
		$posts = $context->getPostAll();
		foreach ($posts as $key => $value) {
			${$key} = $value;
		}

		$query = new Query();
		$query->setTable($group);
		$query->setColumn(array(
			'', 
			$board, $width, $include1, $include2, $include3, 'now()',
			$w_admin, $r_admin, $rw_admin, $re_admin,
			$listnum, $tail, $download, $setup,
			$w_grade, $r_grade, $rw_grade, $re_grade,
			$log_key, $limit_choice, $limit_word,
			$board_name, $type, $output
		));

		$result = parent::insert($query);
		return $result;
	}

	function createTableComment() {

		$context = Context::getInstance();
		$board = $context->getRequest('table_name');
		$board_comment = $board . '_grg';

		$query = new Query();
		$query->setTable($board_comment);

		$schema = new QuerySchema();
		$schema->add('id','int',null,'notnull', 'autoincrement');
		$schema->add('storyid','varchar',15);
		$schema->add('nickname','varchar',12);
		$schema->add('pass','varchar',30);		
		$schema->add('comment','text');
		$schema->add('date','timestamp');
		$schema->setPrimarykey('id');
		$query->setSchema($schema);

		$result = parent::createTable($query);
		return $result;
	}

	function insertIntoBoardComment() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$board = $context->getRequest('table_name');

		$posts = $context->getPostAll();
		foreach ($posts as $key => $value) {
			${$key} = $value;
		}

		$query = new Query();
		$query->setTable($group);
		$query->setColumn(array(
			'', 
			$board, $width, $include1, $include2, $include3, 'now()',
			$w_admin, $r_admin, $rw_admin, $re_admin,
			$listnum, $tail, $download, $setup,
			$w_grade, $r_grade, $rw_grade, $re_grade,
			$log_key, $limit_choice, $limit_word,
			$board_name, $type, $output
		));

		$result = parent::insert($query);
		return $result;
	}

	function updateRecordModify() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$posts = $context->getPostAll();
		$column = array();
		foreach ($posts as $key => $value) {			
			if (!($key == 'id' || $key == 'table_name')) {
				$column[$key] = $value;
			}			
		}

		$query = new Query();
		$query->setTable($group);
		$query->setColumn($column);
		$query->setWhere(array(
			'id' => $posts['id']
		));

		$result = parent::update($query);
		return $result;
	}

	function dropTableBoard() {

		$context = Context::getInstance();
		$board = $context->getRequest('table_name');

		$query = new Query();
		$query->setTable($board);

		$result = parent::dropTable($query);
		return $result;
	}

	function deleteBoardFromGroup() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$board = $context->getRequest('table_name');
		$id = $context->getRequest('id');

		$query = new Query();
		$query->setTable($group);
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::delete($query);
		return $result;
	}

	function dropTableComment() {

		$context = Context::getInstance();
		$board = $context->getRequest('table_name');
		$board_comment = $board . '_grg';

		$query = new Query();
		$query->setTable($board_comment);

		$result = parent::dropTable($query);
		return $result;
	}

	function deleteCommentFromBoard() {

		$context = Context::getInstance();
		$group = $context->get('db_board_group');
		$board = $context->getRequest('table_name');
		$id = $context->getRequest('id');

		$query = new Query();
		$query->setTable($group);
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::delete($query);
		return $result;	
	}
}
?>