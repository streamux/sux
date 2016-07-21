<?php

class PopupView extends BaseView {

	var $class_name = 'popup_view';

	// display function is defined in parent class 
}

class OpenerPanel extends BaseView {

	var $class_name = 'opener';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skin_dir = _SUX_PATH_ . 'modules/popup/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}

		$result = $this->controller->select('fieldFromPopup', '*');
		if ($result) {

			$rows = $this->model->getRowList();

			echo count($rows);

			for($i=0; $i<$numrow; $i++) {
				$id = $rows['id'];				
				$name = $rows['name'];
				$period = mktime($rows['time1'],$rows['time2'],$rows['time3'],$rows['time4'],$rows['time5'],$rows['time6']);
				$nowtime = mktime();
				$left = $row['w_left'];
				$top = $row['w_top'];
				$width = $row['width'];
				$height = $row['height'];				
				$winname = 'sux_'.$name;

				echo $name . '<br>';

				if (($rows['choice'] == "y") && ($nowtime < $period)) {

					$url = '../board/popup.php?action=event&id='+$id+'&winname='+$winname;

					echo 	'<script type="text/javascript">
								openPopup(<? echo ${url}; ?>, <? echo ${left}; ?>, <? echo ${top}; ?>, <? echo ${width}; ?>, <? echo ${height}; ?>);
							</script>';
				}
			}
		}
	} 
}

class EventPanel extends BaseView {

	var $class_name = 'event';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skin_dir = _SUX_PATH_ . 'modules/popup/skin/default/';

		$skin_path = $skin_dir . 'index.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}
	}
}
?>