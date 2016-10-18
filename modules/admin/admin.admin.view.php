<?php
class AdminAdminModule extends BaseView {
	
	var $class_name = 'admin_admin_module';
	var $skin_path_list = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

	function output() {

		$UIError = UIError::getInstance();

		/**
		 * @class Template
		 * @brief Template is a Wrapper Class based on Smarty
		 */
		$__template = new Template();
		if (is_readable($this->skin_path_list['contents'])) {
			$__template->assign('copyrightPath', $this->copyright_path);
			$__template->assign('skinPathList', $this->skin_path_list);
			$__template->assign('sessionData', $this->session_data);
			$__template->assign('requestData', $this->request_data);
			$__template->assign('postData', $this->post_data);
			$__template->assign('documentData', $this->document_data);
			$__template->display( $this->skin_path_list['contents'] );	
		} else {
			$UIError->add('스킨 파일경로가 올바르지 않습니다.');
			$UIError->useHtml = TRUE;
		}
		$UIError->output();	
	}
}

class AdminAdminView extends AdminAdminModule {

	var $class_name = 'admin_admin_view';	

	function displayMain() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();		
		$page_type = $requestData['pagetype'];
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$requestData['pagetype'] = (isset($page_type) || $page_type != '') ? $page_type : 'admin';

		$skinPath = _SUX_PATH_ . "modules/admin/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$skinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_main.tpl";
		$this->skin_path_list['footer'] = "{$skinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['page_type'] = $page_type;

		$this->output();
	}

	function displayConnecterJson() {

		$data = $this->_getConnecterData();
		echo $this->callback($data);
	}

	function displayMainJson() {

		$connecterArr1 = $this->_getConnecterData();
		$connecterArr2 = $this->_getConnecterrealData();
		$connecterArr = array_merge($connecterArr1['data'], $connecterArr2['data']);
		$pageviewArr = $this->_getPageviewData();
		$connectersiteArr = $this->_getConnectersiteData();
		$serviceConfigArr = $this->_getServiceData();

		$dataObj  = array(	'connecter'=>$connecterArr,
							'pageview'=>$pageviewArr['data'],
							'connectersite'=>$connectersiteArr['data'],
							'serviceConfig'=>$serviceConfigArr['data']);

		$data = array(	'data'=>$dataObj );
		
		echo $this->callback($data);
	}

	function displayConnecterrealJson() {

		$data = $this->_getConnecterrealData();
		echo $this->callback($data);
	}

	function displayPageviewJson() {

		$data = $this->_getPageviewData();
		echo $this->callback($data);
	}

	function displayConnectersiteJson() {

		$data = $this->_getConnectersiteData();
		echo $this->callback($data);
	}

	function displayServiceJson() {

		$data = $this->_getServiceData();
		echo $this->callback($data);
	}

	function _getConnecterData() {

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

		$data = array(	'data'=>$connecterArr,
						'result'=>$resultYN,
						'msg'=>$msg);	
		return $data;
	}

	function _getConnecterrealData() {

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

		$data = array(	'data'=>$connecterArr,
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}

	function _getPageviewData() {

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

		$data = array(	'data'=>$pageviewArr,
						'mode'=>'pageview',
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}

	function _getConnectersiteData() {

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

		$data = array(	'data'=>$analyticsArr,
						'mode'=>'connectersite',
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}

	function _getServiceData() {

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

		$data = array(	'data'=>$serviceConfig,
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}
}
?>