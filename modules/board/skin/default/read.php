<?
/**
	@테스트 용  
	$tail = "y";
	$setup = "y";
	$_SESSION['grade'] = 10;
*/

$result0 = mysql_query("select see from $board where id=$id");
$row0 = mysql_fetch_array($result0);
$see = $row0[see]+1;
$sql = mysql_query("update $board set see = $see where id=$id");

$result = mysql_query("select * from $board where id=$id");
$row = mysql_fetch_array($result);
$storycomment = str_replace("$search","<span class=\"color-red\">$search</span>",$storycomment);
$m_name = htmlspecialchars($row[name]);
$pass = $row[pass];
$hit = $row[see];
$storytitle = nl2br($row[title]);
$storytitle = htmlspecialchars($storytitle);
$email = $row[email];
$fileupname = $row[filename];
$filesize = $row[filesize];
$filetype = $row[filetype];
$type = trim($row[type]);
$date = $row[date]; 

$grade = $_SESSION[grade];

if ($admin_type == 'all'){

	if ($type =='html'){
		$storycomment = $row[comment];
	}else if ($type == 'text'){
		$storycomment = nl2br($row[comment]);
	}
} else if ($admin_type == 'html') {
	$storycomment = $row[comment];
} else {
	$storycomment = nl2br($row[comment]);
}

$img_display = 'none';

if ($fileupname) {
	if ($download == 'y' && ($filetype =="application/x-zip-compressed" || $filetype =="application/zip")) {
		//$fileupPath = "<a href=\"board.php?board=$board&fileupname=$fileupname&filesize=$filesize&filetype=$filetype&&action=down\">${fileupname}&nbsp;<b>[ 다운로드 ]</b></a>";

		$fileupPath = "<a href=\"../../board_data/$board/$fileupname\">${fileupname}&nbsp;<b>[ 다운로드 ]</b></a>";
	} else if (!($filetype =="application/x-zip-compressed" || $filetype =="application/zip")){

		$imgpath = '../../board_data/'.$board.'/'.$fileupname;
		$image_info = getimagesize($imgpath);
	      $image_type = $image_info[2];

	      if ( $image_type == IMAGETYPE_JPEG ) {
	      	$image = imagecreatefromjpeg($imgpath);
	      } elseif( $image_type == IMAGETYPE_GIF ) {
	       	$image = imagecreatefromgif($imgpath);
	      } elseif( $image_type == IMAGETYPE_PNG ) {
	     		$image = imagecreatefrompng($imgpath);
		}

		$img_width = imagesx($image) . 'px';
		$fileup_path = "$board/$fileupname";
		$img_display = 'block';
	}
}
?>

<link rel="stylesheet" type="text/css" href="../../common/css/common.css">
<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/layout.css">

<div class="board-read" style="width:<? echo $width; ?>">
	<div class="panel-heading">
		<h1><? echo ${storytitle}; ?></h1>
		<p><? echo ${m_name}; ?> &nbsp; <? echo ${date}; ?> &nbsp; 조회 <? echo ${hit}; ?></p>
	</div>
	<div class="panel-body">
		<p style="display:<? echo $img_display; ?>;max-width:<? echo $img_width; ?>"><img src="../../board_data/<? echo $fileup_path; ?>" width="100%" border="0"></p>
		<p><? echo ${storycomment}; ?></p>
	</div>
	<div class="panel-buttons">
		<a href="board.php?board=<? echo ${board} ?>&board_grg=<? echo ${board_grg} ?>&passover=<? echo ${passover} ?>&page=<? echo ${page} ?>&find=<? echo $find; ?>&search=<? echo $search; ?>&action=list"><img src="<? echo ${skin_dir} ?>/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
		<a href="board.php?&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=write"><img src="<? echo ${skin_dir}; ?>/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&action=reply"><img src="<? echo ${skin_dir}; ?>/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&action=modify"><img src="<? echo ${skin_dir}; ?>/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=deletepass"><img src="<? echo ${skin_dir}; ?>/images/btn_del.gif" width="51" height="23" border="0"></a>
	</div>	
</div>

<?
if ($setup == "y" && $grade > 9) {
	include 'opkey.php';
}

// board-tail
if ($tail == 'y') {
	include 'comment.php';
}
?>

<script type="text/javascript" src="<? echo ${skin_dir}; ?>/js/board.read.js"></script>
