<?php

class BoardModel extends Model {

	var $class_name = 'board_model';
	var	$board;
	var $id;

	var	$user_name;
	var	$password;
	var	$title;
	var	$comment;
	var	$email_address;	
	var	$content_type;
	var $igroup_count;
	var $space_count;
	var $ssunseo_count;
	var	$wall;
	var	$wallok;
	var	$wallwd;

	var	$imgup_name;
	var	$imgup_size;
	var	$imgup_type;
	var	$imgup_tmpname;

	function __construct() {

		parent::__construct();
	}

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$sesstions = $context->getSessionAll();
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->board = 'sux_board';		
		$this->comment = 'sux_comment';
		$this->id = $posts['id'];
		$this->user_id = $posts['user_id'];
		$this->user_name = $posts['user_name'];
		$this->nick_name = $posts['nick_name'];
		$this->password = $context->getPassowrdHash($posts['password']);

		$this->email_address = $posts['email_address'];	
		$this->content_type = $posts['content_type'];
		$this->title = $posts['title'];
		$this->contents = $posts['contents'];	
		$this->igroup_count = $posts['igroup_count'];	
		$this->space_count = $posts['space_count'];	
		$this->ssunseo_count = $posts['ssunseo_count'];	
		$this->wall = trim($posts['wall']);
		$this->wallok = trim($posts['wallok']);
		$this->wallwd = $posts['wallwd'];

		$this->imgup_name = $files['imgup']['name'];
		$this->imgup_size = $files['imgup']['size'];
		$this->imgup_type = $files['imgup']['type'];
		$this->imgup_tmpname = $files['imgup']['tmp_name'];
	}

	function selectFromBoardGroup() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board_group');
		$category = $context->getParameter('category');

		$where = new QueryWhere();
		$where->set('category',$category,'=');

		$query = new Query();
		$query->setField('*');
		$query->setTable($tableName);
		$query->setWhere($where);

		$result = parent::select($query);
		return $result;
	}

	function deleteLimitwordFromBoard() {

		$row = $this->getRow();
		$limit_word = $row['limit_word'];
		if (isset($limit_word) && $limit_word != '') {

			$where = new QueryWhere();
			$limit_word_arr = split(',',$limit_word);

			for ($i=0; $i<count($limit_word_arr); $i++) {
				$limit_temp_str = trim($limit_word_arr[$i]);
				$where->set($row['limit_choice'], $limit_temp_str, 'like', 'or');
			}

			$query = new Query();
			$query->setTable($this->board);
			$query->setWhere($where);

			$result = parent::delete($query);
			return $result;			
		}		
	}

	function selectFromBoard($field) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$category = $context->getParameter('category');
		//$id = $context->getParameter('id');	

		$where = new QueryWhere();
		if (isset($category)) $where->set('category',$category,'=');
		//if (isset($id)) $where->set('user_id',$userId,'=','and');

		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);
		$query->setWhere($where);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardWhere($field, $where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);
		$query->setWhere($where);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardLimit($field ) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$category = $context->getParameter('category');		
		$passover = $context->getParameter('passover');
		$limit = $context->getParameter('limit');	

		$where = new QueryWhere();
		$where->set('category', $category, '=');

		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);
		$query->setWhere($where);
		$query->setOrderBy('igroup_count desc, ssunseo_count asc');
		$query->setLimit($passover, $limit);
		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardLatestLimit($field) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$category = $context->getParameter('category');	

		$where = new QueryWhere();
		$where->set('category', $category, '=');

		$query = new Query();		
		$query->setTable($tableName);
		$query->setField($field);
		$query->setWhere($where);
		$query->setOrderBy('id desc');
		$query->setLimit(0,1);
		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardSearch() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$category = $context->getParameter('category');	
		$find = $context->getRequest('find');
		$search = $context->getRequest('search');

		$where = new QueryWhere();
		$where->set($find, $search, 'like');
		$where->set('category', $category, '=');

		$query = new Query();
		$query->setField('*');
		$query->setTable($tableName);
		$query->setWhere( $where );

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardSearchLimit() {

		$context = Context::getInstance();
		$find = $context->getRequest('find');
		$search = $context->getRequest('search');	

		$tableName = $context->getTable('board');
		$category = $context->getParameter('category');		
		$passover = $context->getParameter('passover');
		$limit = $context->getParameter('limit');
		
		$where = new QueryWhere();
		$where->set($find, $search, 'like');
		$where->set('category', $category, '=');

		$query = new Query();
		$query->setField('*');
		$query->setTable($this->board);
		$query->setWhere( $where );
		$query->setOrderBy('igroup_count desc, ssunseo_count asc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function updateFromBoard( $value ) {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$id = $context->getParameter('id');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'readed_count' => $value
		));

		$query->setWhere(array(
			'id' => $id
		));

		$result = parent::update($query);
		return $result;
	}

	function selectFromComment($field) {

		$context = Context::getInstance();
		$tableName = $context->getTable('comment');
		$id = $context->getParameter('id');

		$where = new QueryWhere();
		$where->set('content_id', $id, '=');

		$query = new Query();
		$query->setField($field);
		$query->setTable($tableName);
		$query->setWhere($where);
		$result = parent::select($query);
		return $result;
	}

	function selectFromCommentWhere($filed, $where) {

		$context = Context::getInstance();
		$tableName = $context->getTable('comment');
		$id = $context->getParameter('id');

		$query = new Query();
		$query->setField($filed);
		$query->setTable($tableName);
		$query->setWhere($where);
		$result = parent::select($query);
		return $result;
	}

	function insertWrite() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$category = $context->getParameter('category');
		$fileName = $context->get('fileup_name');

		$this->selectFromBoardLatestLimit('id');
		$row = $this->getRow();
		$igroup_count = $row['id']+1; 

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'', 
			$category,
			'n',
			$this->user_id,
			$this->user_name,
			$this->nick_name,
			$this->password,
			$this->title,
			$this->contents,
			$this->email_address,
			'now()',
			$_SERVER['REMOTE_ADDR'],			
			0,
			0,
			0,
			'',
			$igroup_count,
			0,
			0,
			$this->wallwd,
			$fileName,
			$this->imgup_size,
			$this->imgup_type,
			$this->content_type
		));

		$result = parent::insert($query);
		return $result;
	}

	function updateSsunseoCount() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');

		$where = new QueryWhere();
		$where->set('ssunseo_count', $this->ssunseo_count, '>');
		$where->set('igroup_count', $this->igroup_count, '=','and');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'ssunseo_count' => '(ssunseo_count+1)'
		));
		$query->setWhere($where);

		$result = parent::update($query);
		return $result;
	}

	function insertReply() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$serverIp = $context->getServer('REMOTE_ADDR');
		$category = $context->getParameter('category');
		$fileName = $context->get('fileup_name');
		
		$this->space_count = $this->space_count + 1;
		$this->ssunseo_count = $this->ssunseo_count + 1;

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'', 
			$category,
			'n',
			$this->user_id,
			$this->user_name,
			$this->nick_name,
			$this->password,
			$this->title,
			$this->contents,
			$this->email_address,
			'now()',
			$serverIp,			
			0,
			0,
			0,
			'',
			$this->igroup_count,
			$this->space_count,
			$this->ssunseo_count,
			$this->wallwd,
			$fileName,
			$this->imgup_size,
			$this->imgup_type,
			$this->content_type
		));

		$result = parent::insert($query);
		return $result;
		
	}

	function updateModify() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$id = $context->getParameter('id');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'user_name' => $this->user_name, 
			'title' => $this->title, 
			'contents' => $this->contents,
			'email_address' => $this->email_address, 
			'filename' => $context->get('fileup_name'),
			'filesize' => $this->imgup_size, 
			'filetype' => $this->imgup_type, 
			'contents_type' => $this->contents_type
		));

		$query->setWhere(array(
			'id' => $id
		));

		$result = parent::update($query);
		return $result;
	}

	function deleteDelete() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');
		$id = $context->getParameter('id');

		$query = new Query();
		$query->setTable($tableName);
		$query->setWhere(array(
			'id'=>$id
		));

		$result = parent::delete($query);
		return $result;
	}

	function updateProgressStep() {

		$context = Context::getInstance();
		$tableName = $context->getTable('board');		
		$id = $context->getParameter('id');
		$progressStep = $context->getPost('progress_step');

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'progress_step'=>$progressStep
		));
		$query->setWhere(array(
			'id'=>$id
		));
		$result = parent::update($query);
		return $result;
	}

	function insertComment() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();

		$tableName = $context->getTable('comment');
		$contentId = $context->getParameter('id');

		$name = $posts['nickname'];
		$pass = $posts['password'];
		$comment = $posts['comment'];

		$query = new Query();
		$query->setTable($tableName);
		$query->setColumn(array(
			'',
			$contentId,
			$name,
			$pass,
			$comment,
			0,
			0,
			'now()'
		));
		$result = parent::insert($query);
		return $result;
	}

	function deleteComment() {

		$context = Context::getInstance();
		$tableName = $context->getTable('comment');
		$id = $context->getParameter('sid');

		$query = new Query();
		$query->setTable($tableName);
		$query->setWhere(array(
			'id'=>$id
		));
		$result = parent::delete($query);
		return $result;
	}
}
?>