<?php

class AnalyticsController extends Controller
{

	function insertCounter() {

		$context = Context::getInstance();

		$connectCheck = $context->getSession('connectcheck');
		if (empty($connectcheck)) {

			$ip = $context->getServer('REMOTE_ADDR');
			$now = date('Y-m-d');
			$delDate = date("Y-m-d", time() - 86400);

			// 총 접속수			
			$result = $this->model->select('connecter_day', 'total_count', $now);
			if ($result) {
				$row = $this->model->getRow();			
				$hit = $row['total_count']+1;
				$column = array('total_count'=>$hit);

				$where = new QueryWhere();
				$where->set('date', $now, '=');
				$this->model->update('connecter', $column, $where);
			}

			// 접속자 수
			$where = new QueryWhere();			
			$where->set('date',$delDate,'<');
			$this->model->delete('connecter', $where);

			$colums = array('', $ip, 'now()');
			$this->model->insert('connecter', $columns);

			// 실접속자 수
			$where = new QueryWhere();
			$where->set('ip',$ip,'=','and');
			$where->set('date',$now,'=','and');
			$result = $this->model->select('connecter_real', '*', $where);
			if ($result) {
				
				$numrow = $this->model->getNumRows();
				if (!$numrow) {

					$where = new QueryWhere();
					$where->set('date',$delDate,'<');
					$this->model->delete('connecter_real', $where);

					$colums = array('', $ip, 'now()');
					$this->model->insert('connecter_real', $column);

					// 전체 실접속자 수
					$this->model->select('connecter_day', 'real_count');
					$row = $this->model->getRow();
					$hit = $row['real_count']+1;
					$column = array('real_count'=>$hit);

					$where = new QueryWhere();
					$where->set('date', $now, '=');
					$this->model->update('connecter_day', $column, $where);
				}
			}			

			$context->setSession('connectcheck', 'yes');
		}		
	}

	function insertPageview() {

		$context = Context::getInstance();
		$keyword = $context->getRequest('keyword');

		if (isset($keyword) && $keyword != '') {

			$result = $this->controller->select('pageview', 'id');
			if ($result) {

				$rownum = $this->model->getNumRows();
				if ($rownum > 0) {

					$result = $this->controller->select('pageview', 'hit');					
					if($result) {

						$row = $this->model->getRow();
						$row['hit'] += 1;

						$where = new QueryWhere();
						$where->set('keyword',$keyword,'=');
						$this->controller->update('pageview', array('hit'=>$row['hit']), $where);
					}					
				} else {
					$cachePath = './files/caches/queries/pageview.getColumns.cache.php';
					$columnCaches = CacheFile::readFile($cachePath, 'columns');
					if (!$columnCaches) {
						$msg .= "QueryCacheFile Do Not Exists<br>";
						UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
						exit;
					}

					$columns = array();
					for($i=0; $i<count($columnCaches); $i++) {
						$key = $columnCaches[$i];
						$value = $posts[$key];

						if (isset($value) && $value) {
							$columns[] = $value;
						} else {
							if ($key === 'date') {
								$columns[] = 'now()';
							} else if ($key === 'ip') {
								$columns[] = $_SEVER['REMOTE_ADDR'];
							}  else {
								$columns[] = '';
							}				
						}						
					}

					$this->controller->insert('pageview', $columns);
				}
			}
		}
	}
}