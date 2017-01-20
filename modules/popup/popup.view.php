<?php

class PopupView extends View {

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
		$this->request_data = $context->getRequestAll();

		$skin_name = $this->request_data['skin'];
		$action = $this->request_data['action'];
		$this->document_data['jscode'] = $action;
		$this->document_data['module_code'] = 'popup';
		
		$skinPath = _SUX_PATH_ . 'modules/popup/skin/' . $skin_name;

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

		$this->document_data['contents'] = $contentData;

		$this->output();
	}
}
?>