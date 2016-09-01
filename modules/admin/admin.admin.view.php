<?php

class AdminAdminView extends BaseView {
	
	var $class_name = 'admin_admin_view';

	// display function is defined in parent class 
}

class MainPanel extends BaseView {

	var $class_name = 'main';
	var $file_name = 'main.html';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();		
		$page_type = $requests['pagetype'];
		$page_type = $page_type ? $page_type : 'main';

		$top_path = _SUX_PATH_ . 'modules/admin/tpl/top.html';
		if (is_readable($top_path)) {
			$contents = new Template($top_path);
			$contents->set('page_type', $page_type);
			$contents->load();
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_path = _SUX_PATH_ . 'modules/admin/tpl/' . $this->file_name;
		if (is_readable($skin_path)) {
			$contents = new Template($skin_path);
			foreach ($requests as $key => $value) {
				$contents->set($key, $value);
			}
			$contents->load();		
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}

		$bottom_path = _SUX_PATH_ . 'modules/admin/tpl/bottom.html';
		if (is_readable($bottom_path)) {
			include $bottom_path;
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}

		$this->display();
	}
}

class MaindataPanel extends BaseView {

	var $class_name = 'main_data';

	function init() {

		$connecter_data = new ConnecterData($this->model, $this->controller);
		$connecter_data->init();
		$connecterArr1 = $connecter_data->get()['data'];

		$connecterreal_data = new ConnecterrealData($this->model, $this->controller);
		$connecterreal_data->init();
		$connecterArr2 = $connecterreal_data->get()['data'];
		$connecterArr = array_merge($connecterArr1, $connecterArr2);

		$pageview_data = new PageviewData($this->model, $this->controller);
		$pageview_data->init();
		$pageviewArr = $pageview_data->get()['data'];

		$connectersite_data = new ConnectersiteData($this->model, $this->controller);
		$connectersite_data->init();
		$connectersiteArr = $connectersite_data->get()['data'];

		$servie_data = new ServiceData($this->model, $this->controller);
		$servie_data->init();
		$serviceConfigArr = $servie_data->get()['data'];

		$dataObj  = array(	'connecter'=>$connecterArr,
							'pageview'=>$pageviewArr,
							'connectersite'=>$connectersiteArr,
							'serviceConfig'=>$serviceConfigArr);

		$data = array(	'data'=>$dataObj );

		echo parent::callback($data);
	}
}

class ConnecterData extends BaseView {

	var $class_name = 'connecter_data';
	var $model = null;
	var $controller = null;
	var $data = null;

	function init() {
		
		$msg = '';
		$resultYN = 'Y';
		$connecterArr = array();

		$result = $this->controller->select('fromConnecterall');
		if ($result) {
			$row = $this->model->getRow();
			$connecterArr['total'] = $row['hit'];

			$result = $this->controller->delete('fromConnecterWhereDelday');
			if (!$result) {
				$msg .= '24시 이전 접속통계 레코드 삭제를 실패하였습니다.';
				$resultYN = 'N';
			}		

			$result = $this->controller->select('idFromConnecterWhereNow');
			if ($result) {
				$today = $this->model->getNumRows();
				if (!$today) {
					$today = 0;
				}
				$connecterArr['today'] = $today;
			} else {
				$msg .= '오늘 접속통계 레코드 선택을 실패하였습니다.';
				$resultYN = 'N';
			}

			$result = $this->controller->select('idFromConnecterWhereYesterday');
			if ($result) {
				$yesterday = $this->model->getNumRows();
				if (!$yesterday) {
					$yesterday = 0;
				}
				$connecterArr['yester'] = $yesterday;
			} else {
				$msg .= '어제 접속통계 레코드 선택을 실패하였습니다.';
				$resultYN = 'N';
			}

		} else {
			$msg .= '접속통계 테이블 접근을 실패하였습니다.';
			$resultYN = 'N';
		}

		$this->data = array(	'data'=>$connecterArr,
								'result'=>$resultYN,
								'msg'=>$msg);		
	}

	function get() {

		return $this->data;
	}
}

class ConnecterdataPanel extends BaseView {

	var $class_name = 'connecter_data';
	var $data = null;

	function init() {

		$connecter_data = new ConnecterData($this->model, $this->controller);
		$connecter_data->init();
		$data = $connecter_data->get();

		echo parent::callback($data);
	}
}

class ConnecterrealData extends BaseView {

	var $class_name = 'connecterreal_data';

	function init() {

		$msg = '';
		$resultYN = 'Y';
		$connecterArr = array();

		$result = $this->controller->select('fromConnecterrealall');
		if ($result) {
			$row = $this->model->getRow();
			$connecterArr['real_total'] = $row['hit'];

			$result = $this->controller->delete('fromConnecterrealWhereDelday');
			if (!$result) {
				$msg .= '24시 이전 실접속통계 레코드 삭제를 실패하였습니다.';
				$resultYN = 'N';
			}		

			$result = $this->controller->select('idFromConnecterrealWhereNow');
			if ($result) {
				$real_totay = $this->model->getNumRows();
				if (!$real_totay) {
					$real_totay = 0;
				}

				$connecterArr['real_today'] = $real_totay;
			} else {
				$msg .= '오늘 실접속통계 레코드 선택을 실패하였습니다.';
				$resultYN = 'N';
			}			

			$result = $this->controller->select('idFromConnecterrealWhereYesterday');
			if ($result) {
				$real_yester = $this->model->getNumRows();
				if (!$real_yester) {
					$real_yester = 0;
				}
				$connecterArr['real_yester'] = $real_yester;
			} else {
				$msg .= '어제 실접속통계 레코드 선택을 실패하였습니다.';
				$resultYN = 'N';
			}			

		} else {
			$msg .= '실접속통계 테이블 접근을 실패하였습니다.';
			$resultYN = 'N';
		}

		$this->data = array('data'=>$connecterArr,
							'result'=>$resultYN,
							'msg'=>$msg);
	}

	function get() {

		return $this->data;
	}
}

class ConnecterrealdataPanel extends BaseView {

	var $class_name = 'connecterreal_data';
	var $data = null;

	function init() {
		
		$connecterreal_data = new ConnecterrealData($this->model, $this->controller);
		$connecterreal_data->init();
		$data = $connecterreal_data->get();

		echo parent::callback($data);
	}
}

class PageviewData extends BaseView {

	var $class_name = 'pageview_data';
	var $data = null;

	function init() {
		
		$msg = '';
		$resultYN = 'Y';
		$pageviewArr = array();
		$pageViewList = array();

		$context = Context::getInstance();
		$limit = $context->getPost('limit');
		$passover = $context->getPost('passover');

		$result = $this->controller->select('fromPageview');
		if ($result) {
			
			$numrows = $this->model->getNumRows();
			if ($numrows) {

				$total = 0;
				$rows = $this->model->getRows();				
				for($i=0; $i<$numrows; $i++) {
					$total += $rows['hit'];
				}				

				if (!$limit) {
					$limit = 10;
				}				
				if (!$passover) {
					$passover = 0;
				}

				$context->set('limit', $limit);
				$context->set('passover', $passover);

				$result = $this->controller->select('fromPageviewLimit');
				if ($result) {

					$a = $numrows - $passover;
					$rows_limit = $this->model->getRows();
					for ($i=0; $i<count($rows_limit); $i++) {

						$pageViewList[] = array(
							'no'=>$a,
							'name'=>$rows_limit[$i]['name'],
							'hit'=>$rows_limit[$i]['hit'],
							'total'=>$total
						);
						$a--;
					}
				}

			} else {				
				$pageviewArr['msg'] = '페이지뷰 키워드가 존재하지 않습니다.';
			}

			$pageviewArr['list'] = $pageViewList;
			$pageviewArr['total_num'] = $numrows;
			$pageviewArr['limit_num'] = $limit;
		} else {
			$msg = '페이지뷰등록 테이블이 존재하지 않습니다.\n';
			$resultYN = 'N';
		}

		$this->data = array('data'=>$pageviewArr,
							'mode'=>'pageview',
							'result'=>$resultYN,
							'msg'=>$msg);
	}

	function get() {

		return $this->data;
	}
}

class PageviewdataPanel extends BaseView {

	var $class_name = 'pageview_data';

	function init() {

		$pageview_data = new pageviewData($this->model, $this->controller);
		$pageview_data->init();
		$data = $pageview_data->get();

		echo parent::callback($data);
	}
}

class ConnectersiteData extends BaseView {

	var $class_name = 'connectersite_data';
	var $data = null;

	function init() {
		
		$msg = '';
		$resultYN = 'Y';
		$analyticsArr = array();
		$connecterList = array();

		$context = Context::getInstance();
		$limit = $context->getPost('limit');
		$passover = $context->getPost('passover');

		$result = $this->controller->select('fromConnectersite');
		if ($result) {
			
			$numrows = $this->model->getNumRows();
			if ($numrows) {

				$total = 0;
				$rows = $this->model->getRows();				
				for($i=0; $i<$numrows; $i++) {
					$total += $rows['hit'];
				}				

				if (!$limit) {
					$limit = 10;
				}	
				if (!$passover) {
					$passover = 0;
				}

				$context->set('limit', $limit);
				$context->set('passover', $passover);

				$result = $this->controller->select('fromConnectersiteLimit');
				if ($result) {

					$a = $numrows - $passover;
					$rows_limit = $this->model->getRows();
					for ($i=0; $i<count($rows_limit); $i++) {

						$connecterList[] = array(
							'no'=>$a,
							'name'=>$rows_limit[$i]['name'],
							'hit'=>$rows_limit[$i]['hit'],
							'total'=>$total
						);
						$a--;
					}
				}

			} else {				
				$analyticsArr['msg'] = '접속경로분석 키워드가 존재하지 않습니다.';
			}

			$analyticsArr['list'] = $connecterList;
			$analyticsArr['total_num'] = $numrows;
			$analyticsArr['limit_num'] = $limit;
		} else {
			$msg = '접속경로분석 테이블이 존재하지 않습니다.';
			$resultYN = 'N';
		}

		$this->data = array('data'=>$analyticsArr,
							'mode'=>'connectersite',
							'result'=>$resultYN,
							'msg'=>$msg);
	}

	function get() {

		return $this->data;
	}
}

class ConnectersitedataPanel extends BaseView {

	var $class_name = 'connectersite_data';

	function init() {

		$connectersite_data = new ConnectersiteData($this->model, $this->controller);
		$connectersite_data->init();
		$data = $connectersite_data->get();

		echo parent::callback($data);
	}
}

class ServiceData extends BaseView {

	var $class_name = 'Service_data';
	var $data = null;

	function init() {

		$msg = '';
		$resultYN = 'Y';
		$serviceConfig = array();

		$result = $this->controller->select('idFromPopupWhere');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['popupIcon']	= 'activate';
				$serviceConfig['popupNum']	= $numrows;
			} else {
				$serviceConfig['popupIcon']	= 'inactivate';
				$serviceConfig['popupNum']	= 0;
			}
		}

		$result = $this->controller->select('idFromBoardgroup');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['boardIcon']	= 'activate';
				$serviceConfig['boardNum']	= $numrows;
			} else {
				$serviceConfig['boardIcon']	= 'inactivate';
				$serviceConfig['boardNum']	= 0;
			}
		}

		$result = $this->controller->select('idFromMembergroup');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['memberIcon']	= 'activate';
				$serviceConfig['memberNum']	= $numrows;
			} else {
				$serviceConfig['memberIcon']	= 'inactivate';
				$serviceConfig['memberNum']	= 0;
			}
		}

		$result = $this->controller->select('idFromPageview');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['pageviewIcon']		= 'activate';
				$serviceConfig['pageviewNum']	= $numrows;
			} else {
				$serviceConfig['pageviewIcon']		= 'inactivate';
				$serviceConfig['pageviewNum']	= 0;
			}
		}

		$result = $this->controller->select('idFromConnectersite');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['analysisIcon']	= 'activate';
				$serviceConfig['analysisNum']	= $numrows;
			} else {
				$serviceConfig['analysisIcon']	= 'inactivate';
				$serviceConfig['analysisNum']	= 0;
			}
		}

		$this->data = array('data'=>$serviceConfig,
							'result'=>$resultYN,
							'msg'=>$msg);
	}

	function get() {

		return $this->data;
	}
}

class ServicedataPanel extends BaseView {

	var $class_name = 'service_data';

	function init() {

		$service_data = new ServiceData($this->model, $this->controller);
		$service_data->init();
		$data = $service_data->get();

		echo parent::callback($data);
	}
}

?>