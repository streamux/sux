<?php

class PopupAdminView extends BaseView {

	var $class_name = 'popup_view';

	// display function is defined in parent class 
}

class PopupAdminModule extends BaseView {

	var $class_name = 'popup_admin_module';
	var $file_name = 'defualt.html';

	function init() {

		$this->defaultSetting();

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$table_name = $requests['table_name'];
		$memberid = $requests['memberid'];
		$id = $requests['id'];
		$popup_name = $requests['popup_name'];	
		$page_type = $requests['pagetype'];
		$page_type = $page_type ? $page_type : "main";

		$top_path = _SUX_PATH_ . 'modules/admin/top.html';
		if (is_readable($top_path)) {
			$contents = new Template($top_path);
			$contents->set('page_type', $page_type);
			$contents->load();
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_path = _SUX_PATH_ . 'modules/popup/tpl/' . $this->file_name;
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

		$bottom_path = _SUX_PATH_ . 'modules/admin/bottom.html';
		if (is_readable($bottom_path)) {
			include $bottom_path;
		} else {
			echo '하단 파일경로를 확인하세요.<br>';
		}

		$this->display();
	}

	function defaultSetting() {}
	function display() {}
}

class ListPanel extends PopupAdminModule {

	var $class_name = 'popup_admin_list';

	function defaultSetting() {

		$this->file_name = 'admin_list.html';
	}
}

class ListdataPanel extends BaseView {

	var $class_name = 'popup_admin_listdata';

	function init() {

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
				for ($i=0; $i<count($rows); $i++) {

					$timeList = array();
					$dataList = array('no'=>($i+1));
					foreach ($rows[$i] as $key => $value) {

						if (preg_match('/(time+)/i', $key)) {
							$timeList[$key] = $value;
						} else {
							$dataList[$key] = $value;
						}
						
					}
					$dataList['date'] = $timeList['time6'] . '-' . $timeList['time4'] . '-' . $timeList['time5'];
					$dataList['time'] = $timeList['time1'] . ':' . $timeList['time2'] . ':' . UtilsString::digit($timeList['time3']);
					$dataObj[] = $dataList;
				}				
			} else {
				$msg = "등록된 팝업이 없습니다.";
				$resultYN = "N";
			}
		} 

		$output = array(	"data"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}

class AddPanel extends PopupAdminModule {

	var $class_name = 'popup_admin_add';

	function defaultSetting() {

		$this->file_name = 'admin_add.html';
	}
}

class AdddataPanel extends BaseView {

	var $class_name = 'popup_admin_adddata';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$path = _SUX_PATH_ . "modules/popup/skin/";
		
		$msg = "";
		$resultYN = "Y";

		$skinList = Utils::getInstance()->readDir($path);
		if (!$skinList) {
			$msg = "스킨폴더가 존재하지 않습니다.";
			$resultYN = "N";
		}

		$data = array(	"data"=>array("list"=>$skinList),
						"result"=>$resultYN,
						"msg"=>$msg);

		echo parent::callback($data);
	}
}

class ModifyPanel extends PopupAdminModule {

	var $class_name = 'popup_admin_modify';

	function defaultSetting() {

		$this->file_name = 'admin_modify.html';
	}
}

class ModifydataPanel extends BaseView {

	var $class_name = 'popup_admin_modifydata';

	function init() {

		$id = $_POST['id'];

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

			$skinList = Utils::getInstance()->readDir($path);
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

		echo parent::callback($data);
	}
}

class DelpassPanel extends PopupAdminModule {

	var $class_name = 'popup_admin_delpass';

	function defaultSetting() {

		$this->file_name = 'admin_delpass.html';
	}
}

class RecordAddPanel extends BaseView {

	var $class_name = 'popup_admin_delete';

	function init() {

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->select('nameFromPopupWhere');
		$numrow = $this->model->getNumRows();
		if ($numrow > 0) {
			$msg = "팝업창 이름이 이미 존재합니다.";
			$resultYN = "N";
		} else {
			$result = $this->controller->insert('intoPopup');
			if ($result){
				$msg = "팝업창 입력을 완료하였습니다.";
				$resultYN = "Y";				
			}else{
				$msg = "팝업창 입력을 실패하였습니다.";
				$resultYN = "N";
			}
		}
		$output = array(	"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}

}

class RecordModifyPanel extends BaseView {

	var $class_name = 'popup_admin_modify';

	function init() {		

		$msg = "";
		$resultYN = "Y";

		$result = $this->controller->update('fromPopupWhere');
		if ($result){
			$msg = "팝업창 수정을 성공하였습니다.";
			$resultYN = "Y";			
		}else{
			$msg = "팝업창 수정을 실패하였습니다.";
			$resultYN = "N";
		}

		$output = array(	"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}
}

class RecordDeletePanel extends BaseView {

	var $class_name = 'popup_admin_delete';

	function init() {

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

		$output = array(	"data"=>$dataObj,
							"result"=>$resultYN,
							"msg"=>$msg);

		echo parent::callback($output);
	}

}
?>