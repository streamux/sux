<?php

class PopupModule extends BaseView {
	
	var $class_name = 'popup_module';
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

class PopupView extends PopupModule {

	var $class_name = 'popup_view';

	function displayOpenerJson() {

		$dataObj = array();		
		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('fieldFromPopup', '*');
		if ($result) {

			$rows = $this->model->getRows();
			for($i=0; $i<count($rows); $i++) {

				$timeList = array();
				foreach ($rows[$i] as $key => $value) {

					if (preg_match('/(time)+/', $key)) {
						$timeList[$key] = $value;
					} else {
						$dataList[$key] = $value;
					}					
				}
				$dataList['period'] = mktime($timeList['time1'],$timeList['time2'],$timeList['time3'],$timeList['time4'],$timeList['time5'],$timeList['time6']);
				$dataList['nowtime'] = mktime();

				$dataObj[] = $dataList;
			}
			$resultYN = "Y";
		} else {
			$msg = "등록된 이벤트가 없습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		echo $this->callback($data);
	}

	function displayEvent() {

		$context = Context::getInstance();
		$requestData = $context->getRequestAll();
		$skin_name = $requestData['skin'];

		$skinPath = _SUX_PATH_ . 'modules/popup/skin/' . $skin_name;

		$this->skin_path_list = array();
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$skinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/index.tpl";
		$this->skin_path_list['footer'] = "{$skinPath}/_footer.tpl";

		$bgimgPath = "skin/{$skin_name}/images/bg.jpg";
		$image_info = getimagesize($bgimgPath);
	      $image_type = $image_info[2];

	      if ( $image_type == IMAGETYPE_JPEG ) {
	      	$image = imagecreatefromjpeg($bgimgPath);
	      } elseif( $image_type == IMAGETYPE_GIF ) {
	       	$image = imagecreatefromgif($bgimgPath);
	      } elseif( $image_type == IMAGETYPE_PNG ) {
	     		$image = imagecreatefrompng($bgimgPath);
		}

		$result = $this->controller->select('fieldFromPopupWhere', '*');
		if ($result) {			
			$contentData = $this->model->getRow();
			$contentData['comment'] = nl2br($contentData['comment']);
		}
		$contentData['imagesx'] = imagesx($image);
		$contentData['imagesy'] = imagesy($image);

		$this->request_data = $requestData;
		$this->document_data = array();
		$this->document_data['pagetype'] = $pageType;
		$this->document_data['contents'] = $contentData;

		$this->output();
	}
}
?>