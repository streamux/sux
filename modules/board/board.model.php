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

		$this->init();
	}

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();

		$this->board = $requests['board'];
		$this->board_grg = $this->board . '_grg';
		$this->id = $requests['id'];

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
		$query = Query::getInstance();
		$query->setField('*');
		$query->setTable($context->get('db_board_group'));
		$query->setWhere( array(
			'name' => $this->board
		));
		parent::select($query);
	}

	function limitWord($values) {

		$limit_word = $values;
		if (!isset($limit_word)) {
			return;
		}

		$limit_word_arr = split(',',$limit_word);
		for ($i=0; $i<count($limit_word_arr); $i++) {

			$limit_str = trim($limit_word_arr[$i]);
			$query = Query::getInstance();
			$query->setTable($this->board);		
			$query->setWhere($rows['limit_choice'] . ' LIKE \'%' . $limit_str . '%\' ');

			parent::delete($query);
		}		
	}

	function fieldFromId($field) {

		$query = Query::getInstance();
		$query->setField($field);
		$query->setTable($this->board);
		$query->setWhere(array(
			'id' => $this->id
		));
		parent::select($query);
	}

	function fieldFromLimit($field ) {

		$query = array();
		$query->setField($field);
		$query->setTable($this->board);
		$query->setWhere(array(
			'space' => 0
		));
		$query->setOrderBy('id desc');
		$query->setLimit(1);
		parent::select($query);
	}

	function recordWrite() {

		if ($this->wall != $this->wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$save_dir = _SUX_PATH_ . 'board_data/' . $this->board;

		if (is_uploaded_file($this->imgup_tmpname )) {
			$mktime = mktime();
			$this->imgup_name =$mktime . "_" . $this->imgup_name;
			$dest = $save_dir . $this->imgup_name;

			if (!move_uploaded_file($this->imgup_tmpname , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$this->fieldFromLimit('id');
		$rows = $this->getRows();
		$igroup = $rows['id']+1; 

		$query = Query::getInstance();
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
		if (!isset($result)) {
			Error::alertToBack('데이터를 저장하는데 실패했습니다.');
		}
	}

	function recordReply() {

		if ($this->wall != $this->wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$save_dir = _SUX_PATH_ . 'board_data/' . $this->board;

		if (is_uploaded_file($this->imgup_tmpname )) {
			$mktime = mktime();
			$this->imgup_name = $mktime . "_" . $this->imgup_name;
			$dest = $save_dir . $this->imgup_name;

			if (!move_uploaded_file($this->imgup_tmpname , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$this->fieldFromId('id, igroup, space, ssunseo');
		$rows = $this->getRows();
		$igroup = $rows['id']; 
		$space = $row['space']+1;
		$ssunseo = $row['ssunseo']+1;

		$query = Query::getInstance();
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
		if (!isset($result)) {
			Error::alertToBack('데이터를 저장하는데 실패했습니다.');
		}
	}

	function recordModify() {

		$context = Context::getInstance();
		$this->fieldFromId('pass, igroup, filename');
		$rows = $this->getRows();

		if ($this->pass == $rows['pass'] || $this->pass == $context->get('db_admin_pwd')) {

			$del_filename = $rows['filename'];

			if ($del_filename) {
				$del_filename = $save_dir . $del_filename;

				if(!@unlink($del_filename)) {
					echo "파일삭제에 실패했습니다.";
				} else {
					echo "파일 삭제에 성공했습니다.";
				}
			}

			if (is_uploaded_file($this->imgup_tmpname)) {
				$mktime = mktime();
				$this->imgup_name = $mktime."_".$this->imgup_name;
				$dest = $save_dir . $this->imgup_name;

				if (!move_uploaded_file($this->imgup_tmpname, $dest)) {
					die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
				}
			} 

			$query = Query::getInstance();
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
			if (!isset($result)) {
				Error::alertToBack('데이터를 저장하는데 실패했습니다.');
			}
		} else {
			Error::alertToBack('비밀번호가 틀립니다.\n비밀번호를 확인하세요.');
		}
	}

	function recordDelete() {

		$query = Query::getInstance();
		$query->setTable($this->board);
		$query->setWhere(array(
			'id'=>$this->id
		));

		$result = parent::delete($query);
		if (!isset($result)) {
			Error::alertToBack('데이터를 저장하는데 실패했습니다.');
		}
	}
}
?>