<?php

class PopupAdminController extends Controller
{

	function insertAdd() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$popupName = $posts['popup_name'];
		$skinName = $posts['skin'];
		
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('popup_name', $popupName);
		$result = $this->model->selectFromPopup('id',$where);

		$numrow = $this->model->getNumRows();
		if ($numrow > 0) {
			$msg = "팝업창 이름이 이미 존재합니다.";
			$resultYN = "N";
		} else {

			$skinImagePath = "skin/{$skinName}/images/bg.jpg";
			$imageInfo = getimagesize($skinImagePath);
		      $imageType = $imageInfo[2];

		      if ( $imageType === IMAGETYPE_JPEG ) {
		      	$image = imagecreatefromjpeg($skinImagePath);
		      } elseif( $imageType === IMAGETYPE_GIF ) {
		       	$image = imagecreatefromgif($skinImagePath);
		      } elseif( $imageType === IMAGETYPE_PNG ) {
		     		$image = imagecreatefrompng($skinImagePath);
			}

			$popupWidth = imagesx($image) + 16;
			$popupHeight = imagesy($image) + 52;

			if (is_readable($skinImagePath) && ($posts['popup_width'] < $popupWidth)) {
				$posts['popup_width'] = $popupWidth;
			}

			if (is_readable($skinImagePath) && ($posts['popup_height'] < $popupHeight)) {
				$posts['popup_height'] = $popupHeight;
			}

			$column = array('');
			$items	= array_slice($posts, 1);
			foreach ($items as $key => $value) {
				$column[] = $value;
			}
			$column[] = 'now()';

			$result = $this->model->insertIntoPopup($column);
			if ($result){
				$msg = "팝업창 입력을 완료하였습니다.";
				$resultYN = "Y";				
			}else{
				$msg = "팝업창 입력을 실패하였습니다.";
				$resultYN = "N";
			}
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function updateModify() {

		$context = Context::getInstance();
		$posts = $context->getPostAll();
		$id = $posts['id'];
		$skinName = $posts['skin'];

		$msg = "";
		$resultYN = "Y";

		$skinImagePath = "skin/{$skinName}/images/bg.jpg";
		$imageInfo = getimagesize($skinImagePath);
	      $imageType = $imageInfo[2];

	      if ( $imageType === IMAGETYPE_JPEG ) {
	      	$image = imagecreatefromjpeg($skinImagePath);
	      } elseif( $imageType === IMAGETYPE_GIF ) {
	       	$image = imagecreatefromgif($skinImagePath);
	      } elseif( $imageType === IMAGETYPE_PNG ) {
	     		$image = imagecreatefrompng($skinImagePath);
		}

		$popupWidth = imagesx($image) + 16;
		$popupHeight = imagesy($image) + 52;

		if (is_readable($skinImagePath) && $posts['popup_width'] < $popupWidth) {
			$posts['popup_width'] = $popupWidth;
		}

		if (is_readable($skinImagePath) && $posts['popup_height'] < $popupHeight) {
			$posts['popup_height'] = $popupHeight;
		}

		$where = new QueryWhere();
		$where->set('id', $id);

		$column = array();
		$items = array_slice($posts, 2);
		foreach ($items as $key => $value) {
			$column[$key] = $value;
		}

		$result = $this->model->updatePopup($column, $where);
		if ($result){
			$msg = "팝업정보 수정을 성공하였습니다.";
			$resultYN = "Y";			
		}else{
			$msg = "팝업정보 수정을 실패하였습니다.";
			$resultYN = "N";
		}
		//$msg = Tracer::getInstance()->getMessage();
		$data = array(	"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}

	function deleteDelete() {

		$context = Context::getInstance();
		$id = $context->getPost('id');
		$popupName = $context->getPost('popup_name');

		$dataObj = array();		
		$msg = "";
		$resultYN = "Y";

		$where = new QueryWhere();
		$where->set('id', $id);
		$result = $this->model->deleteFromPopup($where);
		if ($result) {
			$msg .= $popupName . ' 팝업삭제를 성공하였습니다.';
			$resultYN = "Y";
		} else {
			$msg .= $popupName . ' 팝업삭제를 실패하였습니다.';
			$resultYN = "N";
		}
		//$msg .= Tracer::getInstance()->getMessage();
		$data = array(	"data"=>$dataObj,
						"result"=>$resultYN,
						"msg"=>$msg);

		$this->callback($data);
	}
}
?>