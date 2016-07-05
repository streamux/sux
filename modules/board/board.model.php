<?php

class BoardModel extends BaseModel {

	var $name = 'board_model';

	function __construct() {

		parent::__construct();
	}	

	function boardInfo() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');

		$query = array();
		$query['select'] = '*';
		$query['from'] = $context->get('db_board_group');
		$query['where'] = 'name=\'' . $board . '\'';
		parent::select($query);
	}

	function limitWord() {

		$context = Context::getInstance();
		$rows = $context->get('board_info');
		$board = $context->getRequest('board');

		$limit_word = $rows['limit_word'];
		if (!isset($limit_word)) {
			return;
		}

		$limit_word_arr = split(',',$limit_word);
		for ($i=0; $i<count($limit_word_arr); $i++) {

			$limit_str = trim($limit_word_arr[$i]);
			$query = array();
			$query['from'] = $board;		
			$query['where'] = $rows['limit_choice'] . ' LIKE \'%' . $limit_str . '%\'';

			parent::delete($query);
		}		
	}

	function rowInfo() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');
		$id = $context->getRequest('id');

		$query = array();
		$query['select'] = '*';
		$query['from'] = $board;
		$query['where'] = 'id=\'' . $id . '\'';
		parent::select($query);
	}

	function wallInfo() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');

		$query = array();
		$query['select'] = 'wall';
		$query['from'] = $board;
		$query['where'] = 'space=0';
		$query['orderBy'] = 'id desc';
		$query['limit'] = '1';
		parent::select($query);
	}

	function idInfo() {

		$context = Context::getInstance();
		$board = $context->getRequest('board');

		$query = array();
		$query['select'] = 'id';
		$query['from'] = $board;
		$query['where'] = 'space=0';
		$query['orderBy'] = 'id desc';
		$query['limit'] = '1';
		parent::select($query);
	}

	function recordWrite() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$posts = $context->getPostAll();

		$board = $requests['board'];
		$board_grg = $board . '_grg';

		$m_name = $posts['m_name'];
		$pass = $posts['pass'];
		$storytitle = $posts['storytitle'];
		$storycomment = $posts['storycomment'];
		$email = $posts['email'];
		$igroup = $posts['igroup'];
		$name = $posts['type'];
		$wall = trim($posts['wall']);
		$wallok = trim($posts['wallok']);
		$wallwd = $posts['wallwd'];

		$imgup_name = $files['imgup']['name'];
		$imgup_size = $files['imgup']['size'];
		$imgup_type = $files['imgup']['type'];
		$imgup_tmpname = $files['imgup']['tmp_name'];

		if ($wall != $wallok) {
			Error::alertToBack('경고! 잘못된 등록키입니다.');
			exit;
		}

		$save_dir = _SUX_PATH_ . 'board_data/' . $board;

		if (is_uploaded_file($imgup_tmpname )) {
			$mktime = mktime();
			$imgup_name =$mktime."_".$imgup_name;
			$dest = $save_dir.$imgup_name;

			if (!move_uploaded_file($imgup_tmpname , $dest)) {
				Error::alertToBack("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$this->idInfo();
		$rows = $this->getRows();
		$igroup = $rows['id']+1; 

		$query = array();
		$query['tables'] = $board;
		$query['values'] = array();
		$query['values'][] = '';
		$query['values'][] = $m_name;
		$query['values'][] = $pass;
		$query['values'][] = $storytitle;
		$query['values'][] = $storycomment;
		$query['values'][] = $email;
		$query['values'][] = date('Y-m-d H:i:s', mktime());
		//$query['values'][] = 'now()';
		$query['values'][] = $_SERVER['REMOTE_ADDR'];
		$query['values'][] = 0;
		$query['values'][] = '';
		$query['values'][] = $igroup;
		$query['values'][] = 0;
		$query['values'][] = 0;
		$query['values'][] = $wallwd;
		$query['values'][] = $imgup_name;
		$query['values'][] = $imgup_size;
		$query['values'][] = $imgup_type;
		$query['values'][] = $type;

		$result = parent::insert($query);

		if (!isset($result)) {
			Error::alertToBack('데이터를 저장하는데 실패했습니다.');
		}
	}

	function recordReply() {


	}

	function recordModify() {


	}
}
?>