<?php

class  PopupAdminModule extends BaseView {
	
	var $class_name = 'popup_admin_module';
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

class PopupAdminView extends PopupAdminModule {

	var $class_name = 'popup_admin_view';

	function displayList() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayAdd() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayModify() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_modify.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayDelete() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$action = $requestData['action'];
		$requestData['jscode'] = $action;
		$pageType = $requestData['pagetype'];

		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/popup/tpl";

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;

		$this->output();
	}

	function displayListJson() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$dataObj = array();		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('fromPopup');
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
					$dataList['date'] = $timeList['time6'] . '-' . $timeList['time4'] . '-' . $timeList['time5'];
					$dataList['time'] = $timeList['time1'] . ':' . $timeList['time2'] . ':' . $timeList['time3'];
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

		echo $this->callback($data);
	}

	function displayAddJson() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$path = _SUX_PATH_ . "modules/popup/skin/";
		
		$msg = "";
		$resultYN = "Y";

		$skinList = Utils::readDir($path);
		if (!$skinList) {
			$msg = "스킨폴더가 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>array("list"=>$skinList),
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayModifyJson() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

		$path = _SUX_PATH_ . "modules/popup/skin/";

		$dataObj = array();
		$skinList = array();
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('fromPopupWhere');
		if ($result) {

			$row = $this->model->getRow();
			foreach ($row as $key => $value) {
				$dataObj[$key] = $value;
			}

			$skinList = Utils::readDir($path);
			if (!$skinList) {
				$msg = "스킨폴더가 존재하지 않습니다.";
				$resultYN = "N";
			}

			$dataObj['skinList'] = $skinList;

		} else {
			$msg = "팝업이 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordAdd() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$skinName = $posts['skin'];
		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('nameFromPopupWhere');
		$numrow = $this->model->getNumRows();
		if ($numrow > 0) {
			$msg = "팝업창 이름이 이미 존재합니다.";
			$resultYN = "N";
		} else {

			$skinImagePath = "skin/{$skinName}/images/bg.jpg";
			$imageInfo = getimagesize($skinImagePath);
		      $imageType = $imageInfo[2];

		      if ( $imageType == IMAGETYPE_JPEG ) {
		      	$image = imagecreatefromjpeg($skinImagePath);
		      } elseif( $imageType == IMAGETYPE_GIF ) {
		       	$image = imagecreatefromgif($skinImagePath);
		      } elseif( $imageType == IMAGETYPE_PNG ) {
		     		$image = imagecreatefrompng($skinImagePath);
			}

			$popupWidth = imagesx($image) + 16;
			$popupHeight = imagesy($image) + 52;

			if (is_readable($skinImagePath) && $posts['popup_width'] < $popupWidth) {
				$context->setPost('popup_width', $popupWidth);
			}

			if (is_readable($skinImagePath) && $posts['popup_height'] < $popupHeight) {
				$context->setPost('popup_height', $popupHeight);
			}

			$result = $this->controller->insert('intoPopup');
			if ($result){
				$msg = "팝업창 입력을 완료하였습니다.";
				$resultYN = "Y";				
			}else{
				$msg = "팝업창 입력을 실패하였습니다.";
				$resultYN = "N";
			}
		}
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$skinName = $posts['skin'];

		$msg = "";
		$resultYN = "Y";

		$skinImagePath = "skin/{$skinName}/images/bg.jpg";
		$imageInfo = getimagesize($skinImagePath);
	      $imageType = $imageInfo[2];

	      if ( $imageType == IMAGETYPE_JPEG ) {
	      	$image = imagecreatefromjpeg($skinImagePath);
	      } elseif( $imageType == IMAGETYPE_GIF ) {
	       	$image = imagecreatefromgif($skinImagePath);
	      } elseif( $imageType == IMAGETYPE_PNG ) {
	     		$image = imagecreatefrompng($skinImagePath);
		}

		$popupWidth = imagesx($image) + 16;
		$popupHeight = imagesy($image) + 52;

		if (is_readable($skinImagePath) && $posts['popup_width'] < $popupWidth) {
			$context->setPost('popup_width', $popupWidth);
		}

		if (is_readable($skinImagePath) && $posts['popup_height'] < $popupHeight) {
			$context->setPost('popup_height', $popupHeight);
		}

		$result = $this->controller->update('fromPopupWhere');
		if ($result){
			$msg = "팝업창 수정을 성공하였습니다.";
			$resultYN = "Y";			
		}else{
			$msg = "팝업창 수정을 실패하였습니다.";
			$resultYN = "N";
		}

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function recordDelete() {

		$context = Context::getInstance();
		$title = $context->getRequest('title');

		$dataObj = array();		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->delete('fromPopup');
		if ($result) {
			$msg .= $title . '팝업 레코드를 삭제 완료하였습니다.';
			$resultYN = "Y";
		} else {
			$msg .= $title . '팝업 레코드를 삭제 실패하였습니다.';
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}
}
?>