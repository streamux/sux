<?php

class QuestionView extends BaseView {

	var $class_name = 'popup_view';

	// display function is defined in parent class 
}

class OpenerPanel extends BaseView {

	var $class_name = 'opener';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skin_dir = _SUX_PATH_ . 'modules/question/tpl/';

		$skin_path = $skin_dir . 'header.html';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '헤더 파일경로를 확인하세요.<br>';
		}

		$result = $this->controller->select('fieldFromQuestionc', '*');
		if ($result) {

			$row = $this->model->getRow();
			$setup=$row['setup'];
			$left=$row['q_left'];
			$top=$row['q_top'];
			$width=$row['q_width'];
			$height=$row['q_height'];	

			if ($setup == "y") {

				$url = 'question.php?action=start&winname=survey';

				echo 	'<script type=\'text/javascript\'>
							openPopup(\'' . $url . '\', \'' . $winname . '\', \'' . $left . '\', \'' . $top . '\', \'' . $width . '\', \'' . $height . '\');
						</script>';
			}
		}
	} 
}

class StartPanel extends BaseView {

	var $class_name = 'start';

	function init() {

		$context = Context::getInstance();
		$requests = $context->getRequestAll();

		$skin_dir = _SUX_PATH_ . 'modules/question/tpl/';

		$skin_path = $skin_dir . 'start.php';
		if (is_readable($skin_path)) {
			include $skin_path;
		} else {
			echo '스킨 파일경로를 확인하세요.<br>';
		}
	}
}

class recordInsertPanel extends BaseView {

	var $class_name = 'record_insert';

	function init() {

		/*$query=mysql_query("select * from question where title !='' and igroup = '$igroup' order by id desc");
		$row=mysql_fetch_array($query);
		$qtime=mktime($row[time4],$row[time5],$row[time6],$row[time2],$row[time3],$row[time1]); //mktime(시4,분5,초6,월2,일3,년1);
		$nowtime=mktime();
		if($qtime > $nowtime) {
			if($bangji) {
				echo ("
					<script>
					alert('투표를 하셨군요.')
					history.go(-1)
					</script>
					");
					exit;
			} else {
				$bangji="yes";
				session_register("bangji");
				if($jilmunno) {
					$result1=mysql_query("select hit from question where jilmunno='$jilmunno' and igroup='$igroup' ");
					$row1=mysql_fetch_array($result1);
					$see=$row1[hit]+1;
					$sql1=mysql_query("update question set hit=$see where jilmunno=$jilmunno and igroup='$igroup' ");
				}
				mysql_close();
				if($ljs_mod=="mainjosa") {
					echo ("<meta http-equiv='Refresh' content='0; URL=$yourhome'>");
				}else {
					echo ("<meta http-equiv='Refresh' content='0; URL=question_start_02.php'>");
				}
			}
		} else {
			echo ("
				<script>
				alert('설문조사 기간이 지났습니다.')
				history.go(-1)
				</script>
				");
				exit;
		}*/
	}
}
?>