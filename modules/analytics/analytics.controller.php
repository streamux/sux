<?php

class AnalyticsController extends Controller
{

	function addCounter() {

		$context = Context::getInstance();

		$connectCheck = $context->getSession('connectcheck');
		if (empty($connectCheck)) {

			$ip = $context->getServer('REMOTE_ADDR');
			$now = date('Y-m-d');
			$delDate = date("Y-m-d", time() - 86400);

			// 총 접속수	
			$where = new QueryWhere();
			$where->set('date', $now, '=');
			$this->model->select('connect_day', '*', $where);

			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$row = $this->model->getRow();			
				$hit = $row['total_count']+1;
				$column = array('total_count'=>$hit);

				$where->reset();
				$where->set('date', $now, '=');
				$this->model->update('connect_day', $column, $where);
			} else {
				$columns = array('', 1, 0, $now);
				$this->model->insert('connect_day', $columns);
			}

			// 접속자 수
			$where->reset();
			$where->set('date',$delDate,'<');
			$this->model->delete('connecter', $where);

			$columns = array('', $ip, 'now()');
			$this->model->insert('connecter', $columns);

			// 실접속자 수
			$where->reset();
			$where->set('ip',$ip,'=','and');
			$where->set('date',$now,'=','and');
			$this->model->select('connecter_real', '*', $where);

			$numrows = $this->model->getNumRows();
			if (!$numrows) {

				$where->reset();
				$where->set('date',$delDate,'<');
				$this->model->delete('connecter_real', $where);

				$columns = array('', $ip, 'now()');
				$this->model->insert('connecter_real', $columns);

				// 전체 실접속자 수
				$where->set('date', $now, '=');
				$this->model->select('connect_day', '*', $where);
				$row = $this->model->getRow();
				$hit = $row['real_total_count']+1;
				$columns = array('real_total_count'=>$hit);

				$where->reset();
				$where->set('date', $now, '=');
				$this->model->update('connect_day', $columns, $where);
			}

			$context->setSession('connectcheck', 'yes');
		}		
	}

	function addConnecter() {

		$context = Context::getInstance();
		$keyword = $context->getRequest('keyword');
		if (isset($keyword) && $keyword) {

			$where = new QueryWhere();
			$where->set('name', $keyword);
			$result = $this->model->select('connect_site', '*', $where);
			if ($result) {

				$rownum = $this->model->getNumRows();
				if ($rownum > 0) {

					$row = $this->model->getRow();
					$row['hit_count'] += 1;						

					$columns = array('hit_count'=>$row['hit_count']);
					$this->model->update('connect_site', $columns, $where);					
				} else {
					$cachePath = './files/caches/queries/connect_site.getColumns.cache.php';
					$columnCaches = CacheFile::readFile($cachePath, 'columns');
					if (!$columnCaches) {
						$msg .= "QueryCacheFile Do Not Exists<br>";
						UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
						exit;
					}

					$queryDataes = array('name'=>$keyword, 'hit_count'=>0);
					$columns = array();
					for($i=0; $i<count($columnCaches); $i++) {
						$key = $columnCaches[$i];
						$value = $queryDataes[$key];

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

					$this->model->insert('connect_site', $columns);
				}
			}
		}
	}

	function addPageview() {

		$context = Context::getInstance();
		$keyword = $context->getRequest('keyword');

		if (isset($keyword) && $keyword) {

			$where = new QueryWhere();
			$where->set('name', $keyword, '=');
			$result = $this->model->select('pageview', '*', $where);
			if ($result) {

				$rownum = $this->model->getNumRows();
				if ($rownum > 0) {

					$row = $this->model->getRow();
					$row['hit_count'] += 1;

					$columns = array('hit_count'=>$row['hit_count']);
					$this->model->update('pageview', $columns, $where);					
				} else {
					$cachePath = './files/caches/queries/pageview.getColumns.cache.php';
					$columnCaches = CacheFile::readFile($cachePath, 'columns');
					if (!$columnCaches) {
						$msg .= "QueryCacheFile Do Not Exists<br>";
						UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
						exit;
					}

					$queryDataes = array('name'=>$keyword, 'hit_count'=>0);
					$columns = array();
					for($i=0; $i<count($columnCaches); $i++) {
						$key = $columnCaches[$i];
						$value = $queryDataes[$key];

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

					$this->model->insert('pageview', $columns);
				}
			}
		}
	}
}