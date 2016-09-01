<?php

class AnalyticsAdminView extends BaseView {

	var $class_name = 'analytics_admin_view';

	// display function is defined in parent class 
}

class AnalyticsAdminModule extends BaseView {

	var $class_name = 'analytics_admin_module';
	var $file_name = 'defualt.html';

	function init() {

		$this->defaultSetting();

		$context = Context::getInstance();
		$requests = $context->getRequestAll();
		$page_type = $requests['pagetype'];
		$page_type = $page_type ? $page_type : "main";

		$top_path = _SUX_PATH_ . 'modules/admin/tpl/top.html';
		if (is_readable($top_path)) {
			$contents = new Template($top_path);
			$contents->set('page_type', $page_type);
			$contents->load();
		} else {
			echo '상단 파일경로를 확인하세요.<br>';
		}

		$skin_path = _SUX_PATH_ . 'modules/analytics/tpl/' . $this->file_name;
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

	function defaultSetting() {}
	function display() {}
}

class ConnecterlistPanel extends AnalyticsAdminModule {

	var $class_name = 'analytics_admin_connecter';

	function defaultSetting() {

		$this->file_name = 'admin_connecter_list.html';
	}
}

class ConnecteraddPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_connecter_add';

	function defaultSetting() {

		$this->file_name = 'admin_connecter_add.html';
	}
}

class ConnecterdelpassPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_connecter_delpass';

	function defaultSetting() {

		$this->file_name = 'admin_connecter_delpass.html';
	}
}

class ConnecterresetpassPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_connecter_resetpass';

	function defaultSetting() {

		$this->file_name = 'admin_connecter_resetpass.html';
	}
}

class PageviewlistPanel extends AnalyticsAdminModule {

	var $class_name = 'analytics_admin_pageviewlist';

	function defaultSetting() {

		$this->file_name = 'admin_pageview_list.html';
	}
}

class PageviewaddPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_pageview_add';

	function defaultSetting() {

		$this->file_name = 'admin_pageview_add.html';
	}
}

class PageviewmodifyPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_pageview_modify';

	function defaultSetting() {

		$this->file_name = 'admin_pageview_modify.html';
	}
}

class PageviewdelpassPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_pageview_delpass';

	function defaultSetting() {

		$this->file_name = 'admin_pageview_delpass.html';
	}
}

class PageviewresetpassPanel extends AnalyticsAdminModule {

	var $class_name = 'admin_pageview_resetpass';

	function defaultSetting() {

		$this->file_name = 'admin_pageview_resetpass.html';
	}
}

class ConnecterlistdataPanel extends BaseView {

	var $class_name = 'connecter_listdata';

	function init() {

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

		echo parent::callback($data);
	}
}

class PageviewlistdataPanel extends BaseView {

	var $class_name = 'connecter_listdata';

	function init() {

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

		echo parent::callback($data);
	}
}

class ConnecterInsertPanel extends BaseView {

	var $class_name = 'connecter_insert';

	function init() {

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

		echo parent::callback($data);
	}
}

class ConnecterDeletePanel extends BaseView {

	var $class_name = 'connecter_delete';

	function init() {

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

		echo parent::callback($data);
	}
}

class ConnecterResetPanel extends BaseView {

	var $class_name = 'connecter_reset';

	function init() {

		$id = $_POST['id'];

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

		echo parent::callback($data);
	}
}

class PageviewInsertPanel extends BaseView {

	var $class_name = 'pageview_insert';

	function init() {

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

		echo parent::callback($data);
	}
}

class PageviewResetPanel extends BaseView {

	var $class_name = 'pageview_reset';

	function init() {

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

		echo parent::callback($data);
	}
}

class PageviewDeletePanel extends BaseView {

	var $class_name = 'pageview_delete';

	function init() {

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

		echo parent::callback($data);
	}
}

?>