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

		$this->model->insert('counter');

		// 접속자 수 
		$where = new QueryWhere();
		$where->set('date',$now,'=');
		$result = $this->model->select('connecter', 'id', $where);
		if (!$result) {
			$msg .= "오늘 접속자 선택을 실패하였습니다.\n";
		}		
		$today_num = $this->model->getNumRows();

		$where = new QueryWhere();
		$where->set('date',$now,'<');
		$result = $this->model->select('connecter', 'id', $where);
		if (!$result) {
			$msg .= "어제 접속자 선택을 실패하였습니다.\n";
		}
		$yesterday_num = $this->model->getNumRows();

		$result = $this->model->select('connecter_all', '*');
		if (!$result) {
			$msg .= "전체 접속자 선택을 실패하였습니다.\n";
		}
		$row = $this->model->getRow();
		$total_num = $row['hit'];

		// 실 접속자 수 
		$where = new QueryWhere();
		$where->set('date',$now,'=');
		$result = $this->model->select('connecter_real', 'id', $where);
		if (!$result) {
			$msg .= "오늘 실접속자 수 선택을 실패하였습니다.\n";
		}
		$real_today_num = $this->model->getNumRows();

		$where = new QueryWhere();
		$where->set('date',$now,'<');
		$result = $this->model->select('connecter_real', 'id', $where);
		if (!$result) {
			$msg .= "어제 실접속자 수 선택을 실패하였습니다.\n";
		}
		$real_yesterday_num = $this->model->getNumRows();

		$result = $this->model->select('connecter_real_all', '*');
		if (!$result) {
			$msg .= "전체 실접속자 수 선택을 실패하였습니다.\n";
		}
		$row = $this->model->getRow();
		$real_total_num = $row['hit'];

		echo 'today : ' . $today_num . ', ' . 'yester : ' . $yesterday_num . ', ' . 'total : ' . $total_num . '<br>real_today : ' . $real_today_num . ', ' . 'real_yester : ' . $real_yesterday_num . ', ' . 'real total : ' . $real_total_num . '<br>';
	}

	function displayPageview() {

		$this->model->insert('pageview');
	}
}