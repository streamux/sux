<?php

class  PopupAdminModule extends View
{
	
	var $class_name = 'popup_admin_module';
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

class PopupAdminView extends PopupAdminModule
{

	var $class_name = 'popup_admin_view';

	function displayPopupAdmin() {

		$this->displayList();
	}

	function displayList() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$this->document_data['jscode'] = 'list';
		$this->document_data['module_code'] = 'popup';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayAdd() {

		$context = Context::getInstance();
		$this->request_data = $context->getRequestAll();

		$this->document_data['jscode'] = 'add';
		$this->document_data['module_code'] = 'popup';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$path = _SUX_PATH_ . "modules/popup/skin/";
		$skinList = Utils::readDir($path);
		if (!$skinList) {
			$skinList['file_name'] = 'not exists';
		}		
		$this->document_data['skin_list'] = $skinList;

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayModify() {

		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$this->document_data['jscode'] = 'modify';
		$this->document_data['module_code'] = 'popup';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$path = _SUX_PATH_ . "modules/popup/skin/";
		$skinList = Utils::readDir($path);
		if (!$skinList) {
			$skinList['file_name'] = 'not exists';
		}
		$this->document_data['id'] = $id;
		$this->document_data['skin_list'] = $skinList;

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_modify.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayDelete() {

		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$this->document_data['jscode'] = 'delete';
		$this->document_data['module_code'] = 'popup';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->selectFromPopup('id, popup_name', $where);

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}		

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayListJson() {

		$dataObj = array();		
		$msg = "";
		$resultYN = "Y";

		$result = $this->model->selectFromPopup('*', null, 'id desc');
		if ($result){

			$numrow = $this->model->getNumRows();
			if ($numrow > 0) {

				$rows = $this->model->getRows();
				for ($i=0; $i<$numrow; $i++) {

					$timeList = array();
					$dataList = array('no'=>($numrow - $i));
					foreach ($rows[$i] as $key => $value) {

						if (preg_match('/(time+)/i', $key)) {
							$timeList[$key] = UtilsString::digit($value);
						} else {
							$dataList[$key] = $value;
						}
						
					}
					$dataList['date'] = $timeList['time_year'] . '-' . $timeList['time_month'] . '-' . $timeList['time_day'];
					$dataList['time'] = $timeList['time_hours'] . ':' . $timeList['time_minutes'] . ':' . $timeList['time_seconds'];
					$dataObj[] = $dataList;
				}				
			} else {
				$msg = "등록된 팝업이 없습니다.";
				$resultYN = "N";
			}
		} 

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function displayModifyJson() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

		$path = _SUX_PATH_ . "modules/popup/skin/";

		$dataObj = array();
		$skinList = array();
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->selectFromPopup('*', $where);
		if ($result) {

			$row = $this->model->getRow();
			foreach ($row as $key => $value) {
				$dataObj[$key] = $value;
			}
		} else {
			$msg = "팝업이 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}	
}
