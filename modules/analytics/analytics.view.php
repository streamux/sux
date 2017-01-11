<?php
/**
 * @class Analytics
 * @description
 * 페이지뷰 클릭 수 조회 분석기능 
 * @pageview url - http://streamux.com/sux/modules/analytics/analytics.php?action=recordPageview&keyword=history
 * @counter url -  http://streamux.com/sux/modules/analytics/analytics.php?action=recordCounter
 */
class AnalyticsView extends View
{ 

	var $class_name = 'analytics_view';

	function displayCounter() {

		$context = Context::getInstance();
		$now = date('Y-m-d');
		$msg = '';
		$resultYN = 'Y';

		// 접속자 수 
		$where = new QueryWhere();
		$where->set('date',$now,'=');
		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;

		$result = $this->controller->select('fieldFromConnecter', $query);
		if (!$result) {
			$msg .= "오늘 접속자 선택을 실패하였습니다.\n";
		}		
		$today_num = $this->model->getNumRows();

		$where = new QueryWhere();
		$where->set('date',$now,'<');
		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;

		$result = $this->controller->select('fieldFromConnecter', $query);
		if (!$result) {
			$msg .= "어제 접속자 선택을 실패하였습니다.\n";
		}
		$yesterday_num = $this->model->getNumRows();

		$result = $this->controller->select('fieldFromConnecterAll', '*');
		if (!$result) {
			$msg .= "전체 접속자 선택을 실패하였습니다.\n";
		}
		$row = $this->model->getRow();
		$total_num = $row['hit'];

		// 실 접속자 수 
		$where = new QueryWhere();
		$where->set('date',$now,'=');
		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;

		$result = $this->controller->select('fieldFromConnecterReal', $query);
		if (!$result) {
			$msg .= "오늘 실접속자 수 선택을 실패하였습니다.\n";
		}
		$real_today_num = $this->model->getNumRows();

		$where = new QueryWhere();
		$where->set('date',$now,'<');
		$query = array();
		$query['field'] = 'id';
		$query['where'] = $where;

		$result = $this->controller->select('fieldFromConnecterReal', $query);
		if (!$result) {
			$msg .= "어제 실접속자 수 선택을 실패하였습니다.\n";
		}
		$real_yesterday_num = $this->model->getNumRows();

		$result = $this->controller->select('fieldFromConnecterRealAll', '*');
		if (!$result) {
			$msg .= "전체 실접속자 수 선택을 실패하였습니다.\n";
		}
		$row = $this->model->getRow();
		$real_total_num = $row['hit'];

		echo 'today : ' . $today_num . ', ' . 'yester : ' . $yesterday_num . ', ' . 'total : ' . $total_num . '<br>real_today : ' . $real_today_num . ', ' . 'real_yester : ' . $real_yesterday_num . ', ' . 'real total : ' . $real_total_num . '<br>';
	}

	function recordPageview() {

		$context = Context::getInstance();
		$keyword = $context->getRequest('keyword');

		if (isset($keyword) && $keyword != '') {

			$result = $this->controller->select('fieldFromPageview', 'id');
			if ($result) {

				$rownum = $this->model->getNumRows();
				if ($rownum > 0) {

					$result = $this->controller->select('fieldFromPageview', 'hit');					
					if($result) {

						$row = $this->model->getRow();
						$row['hit'] += 1;

						$this->controller->update('pageviewSetValue', array('hit'=>$row['hit']));
					}					
				} else {
					$this->controller->insert('intoPageview');
				}
			}
		}
	}

	function recordCounter() {

		$context = Context::getInstance();
		$ip = $context->getServer('REMOTE_ADDR');
		$now = date('Y-m-d');	

		$connectCheck = $context->getSession('connectcheck');
		if (empty($connectcheck)) {

			// 총 접속수
			$result = $this->controller->select('fieldFromConnecterAll', 'hit');
			if ($result) {

				$row = $this->model->getRow();			
				$hit = $row['hit']+1;
				$column = array('hit'=>$hit);

				$this->controller->update('connecterAllSetValues', $column);
			}

			// 접속자 수
			$this->controller->delete('fromConnecter');
			$this->controller->insert('intoConnecter');

			// 실접속자 수
			$where = new QueryWhere();
			$where->set('ip',$ip,'=','and');
			$where->set('date',$now,'=','and');
			$query = array();
			$query['field'] = '*';
			$query['where'] = $where;

			$result = $this->controller->select('fieldFromConnecterReal', $query);
			if ($result) {
				
				$numrow = $this->model->getNumRows();
				if (!$numrow) {

					$this->controller->delete('fromConnecterReal');
					$this->controller->insert('intoConnecterReal');

					// 전체 실접속자 수
					$this->controller->select('fieldFromConnecterRealAll', 'hit');
					$row = $this->model->getRow();
					$hit = $row['hit']+1;
					$column = array('hit'=>$hit);

					$this->controller->update('connecterRealAllSetValues', $column);
				}
			}			

			$context->setSession('connectcheck', 'yes');
		}		
	}
}
?>