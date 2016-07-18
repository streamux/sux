<?php

class BoardModel extends BaseModel {

	var $class_name = 'board_model';
	var	$board;
	var	$board_grg;
	var $id;

	var	$m_name;
	var	$pass;
	var	$storytitle;
	var	$storycomment;
	var	$email;
	var	$igroup;
	var	$name;
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
		$posts = $context->getPostAll();
		$files = $context->getFiles();

		$this->board = $requests['board'];
		$this->board_grg = $this->board . '_grg';
		$this->id = $requests['id'];
		$this->grgid = $requests['grgid'];

		$this->m_name = $posts['m_name'];
		$this->pass = $posts['pass'];
		$this->storytitle = $posts['storytitle'];
		$this->storycomment = $posts['storycomment'];
		$this->email = $posts['email'];
		$this->igroup = $posts['igroup'];
		$this->name = $posts['type'];
		$this->wall = trim($posts['wall']);
		$this->wallok = trim($posts['wallok']);
		$this->wallwd = $posts['wallwd'];

		$this->imgup_name = $files['imgup']['name'];
		$this->imgup_size = $files['imgup']['size'];
		$this->imgup_type = $files['imgup']['type'];
		$this->imgup_tmpname = $files['imgup']['tmp_name'];
	}

	function boardFromGroup() {

		$context = Context::getInstance();
		$query = new Query();
		$query->setField('*');
		$query->setTable($context->get('db_board_group'));
		$query->setWhere( array(
			'name' => $this->board
		));
		$result = parent::select($query);
		return $result;
	}

	function limitWord($values) {

		$rows = $this->getRows();
		$limit_word = $values;
		if (!isset($limit_word)) {
			return;
		}

		$where = new QueryWhere();
		$limit_word_arr = split(',',$limit_word);
		for ($i=0; $i<count($limit_word_arr); $i++) {

			$limit_temp_str = trim($limit_word_arr[$i]);
			$where->set($rows['limit_choice'], $limit_temp_str, 'like', 'or');
		}

		$query = new Query();
		$query->setTable($this->board);
		$query->setWhere($where);

		$result = parent::delete($query);
		return $result;
	}

	function fieldFromId($field) {

		$query = new Query();
		$query->setField($field);
		$query->setTable($this->board);
		$query->setWhere(array(
			'id' => $this->id
		));

		$result = parent::select($query);
		return $result;
	}

	function fieldFromLimit($field ) {

		$query = new Query();
		$query->setField($field);
		$query->setTable($this->board);
		$query->setWhere(array(
			'space' => 0
		));
		$query->setOrderBy('id desc');
		$query->setLimit(1);
		$result = parent::select($query);
		return $result;
	}

	function fieldFromCommentId($field) {

		$query = new Query();
		$query->setField($field);
		$query->setTable($this->board_grg);
		$query->setWhere(array(
			'id' => $this->grgid
		));
		$result = parent::select($query);
		return $result;
	}

	function recordWrite() {

		$this->fieldFromLimit('id');
		$rows = $this->getRows();
		$igroup = $rows['id']+1; 

		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'', 
			$this->m_name,
			$this->pass,
			$this->storytitle,
			$this->storycomment,
			$this->email,
			'now()',
			$_SERVER['REMOTE_ADDR'],
			0,
			'',
			$igroup,
			0,
			0,
			$this->wallwd,
			$this->imgup_name,
			$this->imgup_size,
			$this->imgup_type,
			$this->type
		));

		$result = parent::insert($query);
		return $result;
	}

	function recordReply() {

		$this->fieldFromId('igroup, space, ssunseo');
		$rows = $this->getRows();
		$igroup = $rows['igroup']; 
		$space = $rows['space']+1;
		$ssunseo = $rows['ssunseo']+1;

		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'', 
			$this->m_name, 
			$this->pass, 
			$this->storytitle, 
			$this->storycomment,
			$this->email, 
			'now()', 
			$_SERVER['REMOTE_ADDR'],
			0, 
			'', 
			$igroup, 
			$space, 
			$ssunseo, 
			$this->wallwd,
			$this->imgup_name, 
			$this->imgup_size, 
			$this->imgup_type, 
			$this->type
		));

		$result = parent::insert($query);
		return $result;
		
	}

	function recordModify() {

		$query = new Query();
		$query->setTable($this->board);
		$query->setColumn(array(
			'name' => $this->m_name, 
			'title' => $this->storytitle, 
			'comment' => $this->storycomment,
			'email' => $this->email, 
			'filename' => $this->imgup_name, 
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

	function recordDelete() {

		$query = new Query();
		$query->setTable($this->board);
		$query->setWhere(array(
			'id'=>$this->id
		));

		$result = parent::delete($query);
		return $result;
	}

	function recordOpkey() {

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

	function recordWriteComment() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();

		$board_grg = $requests['board_grg'];
		$id = $requests['id'];

		$ljs_name = $posts['ljs_name'];
		$ljs_pass = $posts['ljs_pass'];
		$comment = $posts['comment'];

		$query = new Query();
		$query->setTable($board_grg);
		$query->setColumn(array(
			'',
			$id,
			$ljs_name,
			$ljs_pass,
			$comment,
			'now()'
		));
		$result = parent::insert($query);
		return $result;
	}

	function recordDeleteComment() {

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