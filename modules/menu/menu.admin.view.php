<?php

class MenuAdminView extends View
{
	function displayListJson() {
		
		$msg = '';
		$resultYN = 'Y';
		$json = array('data'=>array());

		$context = Context::getInstance();
		$id = $context->getRequest('id');

		if (empty($id)) {
			$result = $this->model->select('menu', '*');
		} else {
			$where = new QueryWhere();
			$where->set('id', $id);
			$result = $this->model->select('menu', '*', $where);
		}
		
		if (!$result) {
			$msg .= '메뉴 테이블 선택을 실패하였습니다.';
			$resultYN = 'N';
		} else {
			$json['data']['list'] = $this->model->getRows();
		}

		//$msg .= Tracer::getInstance()->getMessage();
		$json['result'] = $resultYN;
		$json['msg'] = $msg;

		$this->callback($json);
	}

	function displayGnbList() {

		$gnburl = './files/gnb/gnb.php';
		$gnburl = FileHandler::getRealPath($gnburl);	
		include $gnburl;
	}
}