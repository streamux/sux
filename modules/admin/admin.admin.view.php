<?php
class AdminAdminModule extends View {
	
	var $class_name = 'admin_admin_module';
	var $skin_path_list = array();
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = array();

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

	function displayAdminAdmin() {

		$this->displayMain();
	}

	function displayMain() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$action = $this->request_data['action'];
		$this->document_data['jscode'] = 'main';
		$this->document_data['module_code'] = 'admin';

		$rootPath = _SUX_ROOT_;
		$skinPath = _SUX_PATH_ . "modules/admin/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$skinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_main.tpl";
		$this->skin_path_list['footer'] = "{$skinPath}/_footer.tpl";

		$this->output();
	}

	function displayMainJson() {

		$connecterArr1 = $this->_getConnecterData();
		$connecterArr2 = $this->_getConnecterrealData();
		$connecterArr = array_merge($connecterArr1['data'], $connecterArr2['data']);
		$pageviewArr = $this->_getPageviewData();
		$connectsiteArr = $this->_getConnectsiteData();
		$serviceConfigArr = $this->_getServiceData();

		$dataObj  = array(	'connecter'=>$connecterArr,
							'pageview'=>$pageviewArr['data'],
							'connectersite'=>$connectsiteArr['data'],
							'serviceConfig'=>$serviceConfigArr['data']);

		$data = array(	'data'=>$dataObj,
						'msg'=>'출력완료' );
		
		$this->callback($data);
	}

	function displayConnecterJson() {

		$data = $this->_getConnecterData();
		$this->callback($data);
	}

	function displayConnecterrealJson() {

		$data = $this->_getConnecterrealData();
		$this->callback($data);
	}

	function displayPageviewJson() {

		$data = $this->_getPageviewData();
		$this->callback($data);
	}

	function displayConnectsiteJson() {

		$data = $this->_getConnectsiteData();
		$this->callback($data);
	}

	function displayServiceJson() {

		$data = $this->_getServiceData();
		$this->callback($data);
	}

	function _getConnecterData() {

		$msg = '';
		$resultYN = 'Y';
		$connecterArr = array('today'=>0, 'yester'=>0,'total'=>0,);
		
		$result = $this->model->selectFromConnecterday();
		if ($result) {
			$rows = $this->model->getRows();
			for ($i=0; $i<count($rows); $i++) {
				$connecterArr['total'] += $rows[$i]['total_count'];
			}			

			$where = new QueryWhere();
			$where->set('date', date('Y-m-d', time()-86400), '<');
			$result = $this->model->deleteFromConnecter($where);
			if (!$result) {
				$msg .= '24시 이전 접속통계 레코드 삭제를 실패하였습니다.';
				$resultYN = 'N';
			}

			// today
			$where->reset();
			$where->set('date', date('Y-m-d'), '=');
			$result = $this->model->selectFromConnecter('id', $where);
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

			// yester day
			$where->reset();
			$where->set('date', date('Y-m-d', time()-86400), '=');
			$result = $this->model->selectFromConnecter('id', $where);
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
		//Tracer::getInstance()->output();
		$data = array(	'data'=>$connecterArr,
						'result'=>$resultYN,
						'msg'=>$msg);	
		return $data;
	}

	function _getConnecterrealData() {

		$msg = '';
		$resultYN = 'Y';
		$connecterArr = array('real_today'=>0, 'real_yester'=>0,'real_total'=>0,);

		$result = $this->model->selectFromConnecterday();
		if ($result) {
			$rows = $this->model->getRows();
			for ($i=0; $i<count($rows); $i++) {
				$connecterArr['real_total'] += $rows[$i]['real_count'];
			}

			$where = new QueryWhere();
			$where->set('date', date('Y-m-d', time()-86400), '<');
			$result = $this->model->deleteFromConnecterreal($where);
			if (!$result) {
				$msg .= '24시 이전 실접속통계 레코드 삭제를 실패하였습니다.';
				$resultYN = 'N';
			}

			// today
			$where->reset();
			$where->set('date', date('Y-m-d'), '=');
			$result = $this->model->selectFromConnecterreal('id', $where);
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

			// yester day
			$where->reset();
			$where->set('date', date('Y-m-d', time()-86400), '=');
			$result = $this->model->selectFromConnecterreal('id', $where);
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
		//Tracer::getInstance()->output();
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

		$result = $this->model->selectFromPageview('*');
		if ($result) {
			
			$numrows = $this->model->getNumRows();
			if ($numrows) {

				$total = 0;
				$rows = $this->model->getRows();				
				for($i=0; $i<$numrows; $i++) {
					$total += $rows['hit_count'];
				}				

				if (!$limit) {
					$limit = 10;
				}				
				if (!$passover) {
					$passover = 0;
				}

				$result = $this->model->selectFromPageview('*', null, 'id desc', $passover, $limit);
				if ($result) {

					$a = $numrows - $passover;
					$rows_limit = $this->model->getRows();
					for ($i=0; $i<count($rows_limit); $i++) {

						$pageViewList[] = array(
							'no'=>$a,
							'name'=>$rows_limit[$i]['name'],
							'hit'=>$rows_limit[$i]['hit_count'],
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
		//Tracer::getInstance()->output();
		$data = array(	'data'=>$pageviewArr,
						'mode'=>'pageview',
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}

	function _getConnectsiteData() {

		$msg = '';
		$resultYN = 'Y';
		$analyticsArr = array();
		$connecterList = array();

		$context = Context::getInstance();
		$limit = $context->getPost('limit');
		$passover = $context->getPost('passover');

		$result = $this->model->selectFromConnectsite('*');
		if ($result) {
			
			$numrows = $this->model->getNumRows();
			if ($numrows) {

				$total = 0;
				$rows = $this->model->getRows();				
				for($i=0; $i<$numrows; $i++) {
					$total += $rows['hit_count'];
				}				

				if (!$limit) {
					$limit = 10;
				}	
				if (!$passover) {
					$passover = 0;
				}

				$result = $this->model->selectFromConnectsite('*', null, 'id desc', $passover, $limit);
				if ($result) {

					$a = $numrows - $passover;
					$rows_limit = $this->model->getRows();
					for ($i=0; $i<count($rows_limit); $i++) {

						$connecterList[] = array(
							'no'=>$a,
							'name'=>$rows_limit[$i]['name'],
							'hit'=>$rows_limit[$i]['hit_count'],
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
		//Tracer::getInstance()->output();
		$data = array(	'data'=>$analyticsArr,
						'mode'=>'connectsite',
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}

	function _getServiceData() {

		$msg = '';
		$resultYN = 'Y';
		$serviceConfig = array(	'popupIcon'=>'inactivate', 'popupNum'=>0,
								'boardIcon'=>'inactivate', 'boardNum'=>0,
								'memberIcon'=>'inactivate', 'memberNum'=>0,
								'pageviewIcon'=>'inactivate', 'pageviewNum'=>0,
								'analysisIcon'=>'inactivate', 'analysisNum'=>0);

		$where = new QueryWhere();
		$where->set('choice', 'y');
		$result = $this->model->selectFromPopup('id', $where);
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['popupIcon']		= 'activate';
				$serviceConfig['popupNum']	= $numrows;
			}
		}

		$result = $this->model->selectFromBoardgroup('id');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['boardIcon']	= 'activate';
				$serviceConfig['boardNum']	= $numrows;
			} 
		}

		$result = $this->model->selectFromMembergroup('id');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['memberIcon']	= 'activate';
				$serviceConfig['memberNum']	= $numrows;
			}
		}

		$result = $this->model->selectFromPageview('id');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['pageviewIcon']	= 'activate';
				$serviceConfig['pageviewNum']	= $numrows;
			}
		}

		$result = $this->model->selectFromConnectsite('id');
		if ($result) {
			$numrows = $this->model->getNumRows();
			if ($numrows > 0) {
				$serviceConfig['analysisIcon']	= 'activate';
				$serviceConfig['analysisNum']	= $numrows;
			}
		}
		//Tracer::getInstance()->output();
		$data = array(	'data'=>$serviceConfig,
						'result'=>$resultYN,
						'msg'=>$msg);
		return $data;
	}
}
?>