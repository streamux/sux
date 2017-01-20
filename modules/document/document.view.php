<?php
class DocumentView extends View
{

	function displayContents() {

		$this->model->selectFromDocument();
		$groupData = $this->model->getRow();
		$headerPath = $groupData['header_path'];
		$contentsPath = $groupData['contents_path'];
		$footerPath = $groupData['footer_path'];

		/**
		 * css, js file path handler
		 */
		$rootPath = _SUX_ROOT_;
		$skinDir = _SUX_ROOT_ . "modules/document/";
		$skinPath = _SUX_PATH_ . "modules/document/";
		$this->document_data['category'] = $category;
		$this->document_data['uri'] = $rootPath.$category;

		/**
		 * @var headerPath
		 * @descripttion
		 * smarty include 상대경로 접근 방식이 달라서 convertAbsolutePath()함수에 절대경로 처리 함.
		 */		
		$headerPath = Utils::convertAbsolutePath($headerPath, $skinPath);
		$contentsPath = Utils::convertAbsolutePath($contentsPath, $skinPath);
		$footerPath = Utils::convertAbsolutePath($footerPath, $skinPath);

		if (!is_readable($headerPath)) {
			$headerPath = "{$skinPath}/_header.tpl";
			$UIError->add("상단 파일경로가 올바르지 않습니다.");
		}

		if (!is_readable($footerPath)) {
			$footerPath = "{$skinPath}/_footer.tpl";
			$UIError->add("하단 파일경로가 올바르지 않습니다.");
		}

		$this->document_data['group'] = $groupData;
		$this->document_data['contents'] = $contentData;
		
		$this->skin_path_list['root'] = $rootPath;
		$this->skin_path_list['dir'] = $skinDir;
		$this->skin_path_list['header'] = $headerPath;
		$this->skin_path_list['contents'] = $contentsPath;
		$this->skin_path_list['footer'] = $footerPath;

		$this->output();
	}
}