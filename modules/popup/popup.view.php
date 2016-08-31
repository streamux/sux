<?php

class PopupView extends BaseView {

	var $class_name = 'popup_view';

	// display function is defined in parent class 
}

class OpenerdataPanel extends BaseView {

	var $class_name = 'opener';

	function init() {

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

		echo parent::callback($data);
	} 
}

class EventPanel extends BaseView {

	var $class_name = 'event';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$popup_name = $requests['winname'];
		$skin_name = $requests['skin'];

		$skin_dir = _SUX_PATH_ . 'modules/popup/skin/' . $skin_name . '/';

		$skin_path = $skin_dir . 'index.html';
		if (is_readable($skin_path)) {
			$contents = new Template($skin_path);			
			$contents->set('table_name', $table_name);
			$contents->set('memberid', $memberid);			
			$contents->set('id', $id);
			$contents->set('popup_name', $popup_name);
			$contents->load();			
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}
	}
}
?>