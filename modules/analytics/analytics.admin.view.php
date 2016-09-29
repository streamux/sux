<?php

class AnalyticsAdminModule extends BaseView {
	
	var $class_name = 'board_admin_module';
	var $skin_path_list = '';
	var $session_data = null;
	var $request_data = null;
	var $post_data = null;
	var $document_data = null;

	function output() {

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
			echo '<p>스킨 파일경로를 확인하세요.</p>';
		}
	}
}

class AnalyticsAdminView extends AnalyticsAdminModule {

	var $class_name = 'analytics_admin_view';

	function displayConnecterList() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connecter_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayConnecterAdd() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connecter_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayConnecterDelete() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connecter_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayConnecterReset() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connecter_reset.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayPageviewList() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayPageviewAdd() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayPageviewDelete() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayPageviewReset() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_reset.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayConnecterListJson() {

		$dataObj = null;
		$dataList = array();
		$msg = "";
		$resultYN = "Y";		
		  
		$result = $this->controller->select('fromConnecterSiteOrderby', 'id desc');
		if ($result){

			$numrows = $this->model->getNumRows();
			if ($numrows > 0){
				$a = $numrows;

				$rows = $this->model->getRows();
				for($i=0; $i<count($rows); $i++) {

					$fields = array('no'=>$a);
					$row = $rows[$i];
					foreach ($row as $key => $value) {
						$fields[$key] = $value;
					}

					$dataList[] = $fields;
					$a--;
				}

				$dataObj = array("list"=>$dataList);
			} else {
				$msg = "등록된 접속키워드가 존재하지 않습니다.";
				$resultYN = "N";
			}
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayPageviewListJson() {

		$dataObj = null;
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('fromPageviewOrderby', 'id desc');
		if ($result){

			$numrows = $this->model->getNumRows();
			if ($numrows > 0){
				$a = $numrows;

				$rows = $this->model->getRows();
				for($i=0; $i<count($rows); $i++) {

					$fields = array('no'=>$a);
					$row = $rows[$i];
					foreach ($row as $key => $value) {
						$fields[$key] = $value;
					}

					$dataList[] = $fields;
					$a--;
				}

				$dataObj = array("list"=>$dataList);
			} else {
				$msg = "등록된 페이지뷰가 존재하지 않습니다.";
				$resultYN = "N";
			}
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordConnecterAdd() {

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->insert('intoConnecterSite');
		if ($result) {
			$msg = "접속키워드 추가를 성공하였습니다.";
			$resultYN = "Y";		 	
		} else {
			$msg = "접속키워드 추가를 실패하였습니다.";
		 	$resultYN = "N";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordConnecterDelete() {
		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->delete('fromConnecterSiteWhere');
		if (!$result) {
			$msg = "접속키워드 삭제를 실패하였습니다.";
			$resultYN = "N";
		} else {
			$msg = "접속키워드 삭제를 성공하였습니다.";	
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordConnecterReset() {
		
		$context = Context::getInstance();
		$id = $context->getPost('id');

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->update('fromConnecterSiteWhere');
		if ($result) {
			$msg = "접속키워드 초기화를 성공하였습니다.";
			$resultYN = "Y";			
		} else {
			$msg = "접속키워드 초기화를 실패하였습니다.";
			$resultYN = "N";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordPageviewAdd() {

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->insert('intoPageview');
		if ($result) {
			$msg = "페이지뷰 키워드 추가를 성공하였습니다.";
			$resultYN = "Y";		 	
		} else {
			$msg = "페이지뷰 키워드 추가를 실패하였습니다.";
		 	$resultYN = "N";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordPageviewDelete() {
	
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->delete('fromPageviewWhere');
		if ($result) {
			$msg = "페이지뷰 키워드 삭제를 성공하였습니다.";	
			$resultYN = "Y";			
		} else {
			$msg = "페이지뷰 키워드 삭제를 실패하였습니다.";
			$resultYN = "N";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);	
	}

	function recordPageviewReset() {
		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->update('fromPageviewWhere');
		if ($result) {
			$msg = "페이지뷰 초기화를 성공하였습니다.";
			$resultYN = "Y";
		} else {
			$msg = "페이지뷰 초기화를 실패하였습니다.";
			$resultYN = "N";			
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}
}
?>