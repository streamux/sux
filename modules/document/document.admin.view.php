<?php
class DocumentAdminView extends View
{

	function displayDocumentAdmin() {

		$this->displayList();
	}

	function displayList() {

		$context = Context::getInstance();

		$this->document_data['jscode'] = 'list';
		$this->document_data['module_code'] = 'document';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/document/tpl";

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
		$this->document_data['module_code'] = 'document';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/document/tpl";

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
		$this->document_data['module_code'] = 'document';

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/document/tpl";

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('document', 'category, id', $where);

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}

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
		$this->document_data['module_code'] = 'document';
		
		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('document', 'id, category', $where);

		$row = $this->model->getRow();
		foreach ($row as $key => $value) {
			$this->document_data[$key] = $value;
		}

		$rootPath = _SUX_ROOT_;
		$adminSkinPath = _SUX_PATH_ . "modules/admin/tpl";
		$skinPath = _SUX_PATH_ . "modules/document/tpl";

		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = '';
		$this->skin_path_list['header'] = "{$adminSkinPath}/_header.tpl";
		$this->skin_path_list['contents'] = "{$skinPath}/admin_delete.tpl";
		$this->skin_path_list['footer'] = "{$adminSkinPath}/_footer.tpl";
		
		$this->output();
	}

	function displayListJson() {

		$dataObj = array();
		$dataList = array();
		$msg = "";
		$resultYN = "Y";

		$this->model->select('document', '*', null, 'id desc');
		$numrows = $this->model->getNumRows();
		if ($numrows > 0){

			$a = $numrows;
			$rows = $this->model->getRows();
			foreach ($rows as $key => $row) {

				$fields = array('no'=>$a);
				foreach ($row as $key => $value) {
					$fields[$key] = $value;
				}

				$dataList[] = $fields;
				$a--;
			}

			$dataObj['list'] =$dataList;
		} else {
			$msg = "페이지가 존재하지 않습니다.";
			$resultYN = "N";
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function displayModifyJson() {

		$context = Context::getInstance();
		$id = $context->getPost('id');

		$dataObj = array();
		$msg = "";
		$resultYN = "Y";
		$contentsPath = _SUX_PATH_ . 'modules/document/contents/';

		$where = new QueryWhere();
		$where->set('id', $id);
		$this->model->select('document', '*', $where);

		$numrows = $this->model->getNumRows();
		if ($numrows > 0) {
			$row = $this->model->getRow();
			foreach ($row as $key => $value) {
				$dataObj[$key] = $value;
			}
			$contentsPath =Utils::convertAbsolutePath($row['contents_path'], $contentsPath);
			$handle = fopen($contentsPath, "r");
			$dataObj['contents'] = fread($handle, filesize($contentsPath));
			//$dataObj['contents'] = $contentsPath;
			fclose($handle);

			$resultYN = "Y";
		} else {
			$resultYN = "N";
			$msg = '페이지가 존재하지 않습니다.';
		}

		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function displayCheckPage() {

		$context = Context::getInstance();
		$category = $context->getPost('category');

		$dataObj	= "";
		$msg = "";
		$resultYN = "Y";

		$msg = "추가 생성 페이지 : ".$category."\n";

		if (empty($category)) {

			$msg = "카테고리명을 넣고 중복체크를 하십시오.";
			$resultYN = "N";

			$data = array(	"result"=>$resultYN,
							"msg"=>$msg);

			$this->callback($data);
			exit;
		}

		if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]{3,12}$/i', $category)) {

			$msg = "카테고리명은 영문+숫자+특수문자('_')로 조합된 단어만 사용가능\n첫글자가 영문 또는 특수문자로 시작되는 4글자 이상 사용하세요.";

			$data = array(	"msg"=>$msg);			
			$this->callback($data);
			exit;
		} 

		$where = new QueryWhere();
		$where->set('category', $category);
		$this->model->select('document', 'id', $where);

		$numrows = $this->model->getNumRows();
		if ($numrows> 0) {
			$msg = "${category}는 이미 존재하는 페이지입니다.";
			$resultYN = "N";
		} else {
			$this->model->select('board_group', 'id', $where);

			$numrows = $this->model->getNumRows();
			if ($numrows> 0) {
				$msg = "${category}는 게시판에서 이미 사용하고 있습니다.";
				$resultYN = "N";
			} else {
				$msg = "${category}는 생성할 수 있는 페이지입니다.";
				$resultYN = "Y";
			}
		}		

		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
}