<?php

class BoardModel extends Model {

	var $class_name = 'board_model';
	var	$board;
	var	$board_grg;
	var $id;
	var $grgid;
	var	$igroup;
	var $space;
	var $ssunseo;

	var	$name;
	var	$pass;
	var	$title;
	var	$storycomment;
	var	$email;	
	var	$type;
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

		$this->board = $requests['board'];
		$this->board_grg = $this->board . '_grg';
		$this->id = $requests['id'];
		$this->grgid = $requests['grgid'];
		$this->igroup = $requests['igroup'];
		$this->space = $requests['space'];
		$this->ssunseo = $requests['ssunseo'];

		$this->name = $posts['name'];
		$this->pass = substr(md5(trim($posts['pass'])),0,8);

		$ljs_name = $sesstions['ljs_name'];
		if (!isset($ljs_name) && $ljs_name == '') { 
			$this->pass = substr(md5($this->pass),0,8);
		}

		$this->title = $posts['title'];
		$this->comment = $posts['comment'];
		$this->email = $posts['email'];		
		$this->type = $posts['type'];
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
		$group = $context->get('db_board_group');
		$field = '*';
		$where = array('name'=>$this->board);

		$query = new Query();
		if ($field != '') $query->setField($field);
		$query->setTable($group);
		if ($where != '') $query->setWhere($where);

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

	function selectFromBoard($query) {

		$query = new Query();
		$query->setField('*');
		$query->setTable($this->board);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardLimit() {

		$context = Context::getInstance();		
		$passover = $context->get('passover');
		$limit = $context->get('limit');

		$query = new Query();
		$query->setField('*');
		$query->setTable($this->board);
		$query->setOrderBy('igroup desc, ssunseo asc');
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardSearch() {

		$context = Context::getInstance();
		$find = $context->getRequest('find');
		$search = $context->getRequest('search');

		$where = new QueryWhere();
		$where->set($find, $search, 'like');

		$query = new Query();
		$query->setField('*');
		$query->setTable($this->board);
		$query->setWhere( $where );

		$result = parent::select($query);
		return $result;
	}

	function selectFromBoardSearchLimit() {

		$context = Context::getInstance();
		$find = $context->getRequest('find');
		$search = $context->getRequest('search');		
		$passover = $context->get('passover');
		$limit = $context->get('limit');
		
		$where = new QueryWhere();
		$where->set($find, $search, 'like');

		$query = new Query();
		$query->setField('*');
		$query->setTable($this->board);
		$query->setWhere( $where );
		$query->setLimit($passover, $limit);

		$result = parent::select($query);
		return $result;
	}

	function selectFieldFromBoardWhereId($field) {

		$query = new Query();
		$query->setField($field);
		$query->setTable($this->board);
		$query->setWhere(array(
			'id' => $this->id
		));

		$result = parent::select($query);
		return $result;
	}

	function selectIdFromBoardWhere() {

		$query = new Query();
		$query->setField('id');
		$query->setTable($this->board);
		$query->setWhere(array(
			'igroup' => $this->igroup
		));

		$result = parent::select($query);
		return $result;
	}

	function selectFieldFromBoardLimit($field ) {

		$query = new Query();
		$query->setField($field);
		$query->setTable($this->board);
		$query->setOrderBy('id desc');
		$query->setLimit(1);
		$result = parent::select($query);
		return $result;
	}

	function updateBoardSetSee( $value ) {

		$context = Context::getInstance();
		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'see' => $value
		));

		$query->setWhere(array(
			'id' => $this->id
		));

		$result = parent::update($query);
		return $result;
	}

	function selectfieldFromTailCommentId($field) {

		$query = new Query();
		$query->setField($field);
		$query->setTable($this->board_grg);
		$query->setWhere(array(
			'id' => $this->grgid
		));
		$result = parent::select($query);
		return $result;
	}
	function selectidFromTailCommentWhere($sid) {

		$query = new Query();
		$query->setField('id');
		$query->setTable($this->board_grg);
		$query->setWhere(array(
			'storyid' => $sid
		));
		$result = parent::select($query);
		return $result;
	}

	function selectFromTailCommentWhere($sid) {

		$query = new Query();
		$query->setField('*');
		$query->setTable($this->board_grg);
		$query->setWhere(array(
			'storyid' => $sid
		));
		$result = parent::select($query);
		return $result;
	}

	function insertRecordWrite() {

		$context = Context::getInstance();
		$this->SelectFieldFromBoardLimit('id');
		$row = $this->getRow();
		$igroup = $row['id']+1; 

		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'', 
			$this->name,
			$this->pass,
			$this->title,
			$this->comment,
			$this->email,
			'now()',
			$_SERVER['REMOTE_ADDR'],
			0,
			'',
			$igroup,
			0,
			0,
			$this->wallwd,
			$context->get('fileup_name'),
			$this->imgup_size,
			$this->imgup_type,
			$this->type
		));

		$result = parent::insert($query);
		return $result;
	}

	function updateRecordSsunseo() {

		$where = new QueryWhere();
		$where->set('ssunseo', $this->ssunseo, '>');
		$where->set('igroup', $this->igroup, '=','and');

		$context = Context::getInstance();
		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'ssunseo' => '(ssunseo+1)'
		));
		$query->setWhere($where);

		$result = parent::update($query);
		return $result;
	}

	function insertRecordReply() {

		$context = Context::getInstance();
		
		$this->igroup = $this->igroup;
		$this->space = $this->space + 1;
		$this->ssunseo = $this->ssunseo + 1;

		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'', 
			$this->name, 
			$this->pass, 
			$this->title, 
			$this->comment,
			$this->email, 
			'now()', 
			$_SERVER['REMOTE_ADDR'],
			0, 
			'', 
			$this->igroup, 
			$this->space, 
			$this->ssunseo, 
			$this->wallwd,
			$context->get('fileup_name'), 
			$this->imgup_size, 
			$this->imgup_type, 
			$this->type
		));

		$result = parent::insert($query);
		return $result;
		
	}

	function updateRecordModify() {

		$context = Context::getInstance();
		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'name' => $this->name, 
			'title' => $this->title, 
			'comment' => $this->comment,
			'email' => $this->email, 
			'filename' => $context->get('fileup_name'),
			'filesize' => $this->imgup_size, 
			'filetype' => $this->imgup_type, 
			'type' => $this->type
		));

		$query->setWhere(array(
			'id' => $this->id
		));

		$result = parent::update($query);
		return $result;
	}

	function deleteRecordDelete() {

		$query = new Query();
		$query->setTable($this->board);
		$query->setWhere(array(
			'id'=>$this->id
		));

		$result = parent::delete($query);
		return $result;
	}

	function updateRecordOpkey() {

		$context = Context::getInstance();
		$opkey = $context->getPost('opkey');

		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'opkey'=>$opkey
		));
		$query->setWhere(array(
			'id'=>$this->id
		));
		$result = parent::update($query);
		return $result;
	}

	function insertRecordWriteTailComment() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$posts = $context->getPostAll();
		$board_grg = $requests['board_grg'];
		$id = $requests['id'];

		$name = $posts['nickname'];
		$pass = $posts['pass'];
		$comment = $posts['comment'];

		$query = new Query();
		$query->setTable($board_grg);
		$query->setColumn(array(
			'',
			$id,
			$name,
			$pass,
			$comment,
			'now()'
		));
		$result = parent::insert($query);
		return $result;
	}

	function deleteRecordDeleteTailComment() {

		$context = Context::getInstance();
		$grgid = $context->getRequest('grgid');
		$board_grg = $context->getRequest('board_grg');	

		$query = new Query();
		$query->setTable($board_grg);
		$query->setWhere(array(
			'id'=>$grgid
		));
		$result = parent::delete($query);
		return $result;
	}
}
?>