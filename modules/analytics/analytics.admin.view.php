<?php

class AnalyticsAdminView extends ModuleAdminView {

	function displayConnectSite() {

		$this->displayConnectSiteList();
	}

	function displayConnectSiteList() {

		$context = Context::getInstance();

		$this->document_data['jscode'] = 'connectSiteList';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connect_site_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayConnectSiteAdd() {

		$context = Context::getInstance();

		$this->document_data['jscode'] = 'connectSiteAdd';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connect_site_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayConnectSiteReset() {

		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$this->document_data['jscode'] ='connectSiteReset';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->selectFromConnectSite('id, name', $where);

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connect_site_reset.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayConnectSiteDelete() {

		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$this->document_data['jscode'] = 'connectSiteDelete';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->selectFromConnectSite('id, name', $where);	

		/*while($rows = $this->model->getMySqlFetchArray($result)) {
			foreach ($rows as $key => $value) {
				echo $key . ' : ' . $value;
			}
		}*/

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_connect_site_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayConnectSiteListJson() {

		$context = Context::getInstance();

		$dataObj = null;
		$dataList = array();
		$msg = "";
		$resultYN = "Y";	 

		$result = $this->model->selectFromConnectSite('*', null, 'id desc');//Orderby', 'id desc');
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
		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function displayPageview() {

		$this->displayPageviewList();
	}

	function displayPageviewList() {

		$context = Context::getInstance();

		$this->document_data['jscode'] = 'pageviewList';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_list.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayPageviewAdd() {

		$context = Context::getInstance();

		$this->document_data['jscode'] = 'pageviewAdd';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_add.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayPageviewReset() {

		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$this->document_data['jscode'] = 'pageviewReset';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->selectFromPageview('id, name', $where);

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_reset.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayPageviewDelete() {

		$context = Context::getInstance();
		$id = $context->getParameter('id');

		$this->document_data['jscode'] = 'pageviewDelete';
		$this->document_data['module_code'] = 'analytics';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/analytics/tpl";

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->selectFromPageview('id, name', $where);

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_pageview_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";

		$this->output();
	}

	function displayPageviewListJson() {

		$dataObj = null;
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$result = $this->model->selectFromPageview('*', null, 'id desc');
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
		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
}
