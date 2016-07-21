<?php

class PromotionView extends BaseView {

	var $class_name = 'promotion_view';

	// display function is defined in parent class 
}

class PageviewPanel extends BaseView {

	var $class_name = 'pageview';

	function init() {

		$context = Context::getInstance();
		$keyword = $context->getRequest('keyword');

		if (isset($keyword) && $keyword != '') {

			$result = $this->controller->select('fieldFromPageview', 'id');
			if ($result) {

				$rownum = $this->model->getNumRows();				
				if ($rownum > 0) {

					$result = $this->controller->select('fieldFromPageview', 'hit');
					$rows = $this->model->getRows();
					if($result) {
						$rows['hit'] += 1;
						$result = $this->controller->update('pageviewSetValue', array('hit'=>$rows['hit']));
						if (!$result) {
							Error::alertToBack('조회수 업데이트를 실패하였습니다.');
						}
					}					
				} else {

					$result = $this->controller->insert('insertIntoPageview');
					if (!$result) {
						Error::alertToBack('조회수 업데이트를 실패하였습니다.');
					}
				}
			}
		}
	}
}

class CounterPanel extends BaseView {

	var $class_name = 'count';

	function init() {

		$context = Context::getInstance();
		$ip = $context->getServer('REMOTE_ADDR');
		$now = date('Y-m-d');

		$connect_check = $context->getSession('connectcheck');
		if (!$connect_check || $connect_check == '') {

			// 총 접속수
			$result = $this->controller->select('fieldFromConnecterAll', 'hit');
			if ($result) {
				$rows = $this->model->getRows();			
				$hit = $rows['hit']+1;
				$column = array('hit'=>$hit);				
				$result = $this->controller->update('connecterAllSetValues', $column);
				if (!$result) {
					Error::alertToBack('조회수 업데이트를 실패하였습니다.');
				}
			}

			// 접속자 수
			$result = $this->controller->delete('fromConnecter');
			if (!$result) {
				Error::alertToBack('접속자 삭제를 실패하였습니다.');
			}

			$result = $this->controller->insert('intoConnecter');
			if (!$result) {
				Error::alertToBack('접속자 추가를 실패하였습니다.');
			}

			// 실접속자 수
			$where = new QueryWhere();
			$where->set('ip',$ip,'=','and');
			$where->set('date',$now,'=','and');

			$query = array();
			$query['field'] = '*';
			$query['where'] = $where;

			$result = $this->controller->select('fieldFromConnecterReal', $query);
			if (!$result) {
				Error::alertToBack('실접속자 조회를 실패하였습니다.');
			}

			$numrow = $this->model->getNumRows();
			if (!$numrow) {
				$result = $this->controller->delete('fromConnecterReal');
				if (!$result) {
					Error::alertToBack('실접속자 삭제를 실패하였습니다.');
				}

				$result = $this->controller->insert('intoConnecterReal');
				if (!$result) {
					Error::alertToBack('실접속자 추가를 실패하였습니다.');
				}

				// 전체 실접속자 수
				$result = $this->controller->select('fieldFromConnecterRealAll', 'hit');
				if (!$result) {
					Error::alertToBack('전체 실접속자 조회를 실패하였습니다.');
				}

				$rows = $this->model->getRows();
				$hit = $rows['hit']+1;
				$column = array('hit'=>$hit);
				$result = $this->controller->update('connecterRealAllSetValues', $column);
				if (!$result) {
					Error::alertToBack('전체 실접속자 조회수 업데이트를 실패하였습니다.');
				}
			}

			$context->setSession('connectcheck', 'yes');
		}

		// 접속자 수 
		$where = new QueryWhere();
		$where->set('date',$now,'=');

		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;
		$result = $this->controller->select('fieldFromConnecter', $query);
		if (!$result) {
			Error::alertToBack('접속자 선택을 실패하였습니다.');
		}
		$today_num = $this->model->getNumRows();

		$where = new QueryWhere();
		$where->set('date',$now,'<');

		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;
		$result = $this->controller->select('fieldFromConnecter', $query);
		if (!$result) {
			Error::alertToBack('접속자 선택을 실패하였습니다.');
		}
		$yesterday_num = $this->model->getNumRows();

		$result = $this->controller->select('fieldFromConnecterAll', '*');
		if (!$result) {
			Error::alertToBack('접속자 선택을 실패하였습니다.');
		}
		$rows = $this->model->getRows();
		$total_num = $rows['hit'];

		// 실 접속자 수 
		$where = new QueryWhere();
		$where->set('date',$now,'=');

		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;
		$result = $this->controller->select('fieldFromConnecterReal', $query);
		if (!$result) {
			Error::alertToBack('실접속자 수 선택을 실패하였습니다.');
		}
		$real_today_num = $this->model->getNumRows();

		$where = new QueryWhere();
		$where->set('date',$now,'<');

		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;
		$result = $this->controller->select('fieldFromConnecterReal', $query);
		if (!$result) {
			Error::alertToBack('실접속자 수 선택을 실패하였습니다.');
		}
		$real_yesterday_num = $this->model->getNumRows();

		$result = $this->controller->select('fieldFromConnecterRealAll', '*');
		if (!$result) {
			Error::alertToBack('전체 실접속자 수 선택을 실패하였습니다.');
		}
		$rows = $this->model->getRows();
		$real_total_num = $rows['hit'];

		echo 'today : ' . $today_num . ', ' . 'yester : ' . $yesterday_num . ', ' . 'total : ' . $total_num . '<br>';
		echo 'real_today : ' . $real_today_num . ', ' . 'real_yester : ' . $real_yesterday_num . ', ' . 'real total : ' . $real_total_num . '<br>';
	}
}
?>