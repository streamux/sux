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
		$fileupPath = "<img src=\"../../board_data/$board/$fileupname\" width=\"100%\" border=\"0\">";
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
		<p style="max-width:<? echo $img_width; ?>"><? echo ${fileupPath}; ?></p>
		<p><? echo ${storycomment}; ?></p>
	</div>
	<div class="panel-buttons">
		<a href="board.php?board=<? echo ${board} ?>&board_grg=<? echo ${board_grg} ?>&passover=<? echo ${passover} ?>&page=<? echo ${page} ?>&action=list"><img src="<? echo ${skin_dir} ?>/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
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

<?
$limit =3; 

if (!$passover){
	$passover = 0;
}

if ($action == 'search' || $action == 'searchread'){
	$option = "where $find like '%$search%'";
}else{
	$option = "";
}

$result0 = mysql_query("select * from $board $option");
$numrows = mysql_num_rows($result0);

$result = mysql_query("select * from $board $option order by igroup desc,ssunseo asc limit $passover,$limit");
$numrows2 = mysql_num_rows($result);
?>
<div class="board-list">
	<table style="width:<? echo ${width}; ?>">
		<thead>
			<tr>
				<th class="author">작성자</th>
				<th class="subject">제목</th>
				<th class="date">날자</th>
				<th class="hit">조회</th>
			</tr>
		</thead>
		<tbody>
<?
if ($numrows2) {

	while ($row=mysql_fetch_array($result)) {
		$m_name = $row[name];
		$sid = $row[id];
		$title = nl2br($row[title]);
		$name = htmlspecialchars($name); 
		$opkey = $row[opkey];
		$day = $row[date];
		$type=$row[filetype];
		$space = $row[space];
		$hit = $row[see];
		$filename = $row[filename];
		$today = date("Y-m-d");

		$compareDay = split(' ', $day)[0];
?>
			<tr>
				<td class="author"><span><? echo ${m_name} ?></span></td>
				<td class="subject">
<?
		$imgname = "";

		if ($space){

			for($i=0; $i<$space; $i++){
				echo "&nbsp;&nbsp;";
			}
		}

		if($space) {
			$imgname = "icon_answer.gif";
			echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp";
		}		

		$imgname = "";
		if($filename){
			if ($type =="image/gif" || $type =="image/jpeg" || $type =="image/x-png" || $type =="image/png" || $type =="image/bmp") {
				$imgname = "icon_img.png";
			} else if ($download == 'y'  && ($type =="application/x-zip-compressed" || $type =="application/zip")) { 
				$imgname = "icon_down.png";
			}

			if ($imgname != '') {
				echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp;";
			}
		}

		$find_key = strtolower($find);
		switch ($find_key) {
			case 'title':
				$title = str_replace("$search","<span class=\"color-red\">$search</span>",$title);
				break;
			case 'name':
				$name = str_replace("$search","<span class=\"color-red\">$search</span>",$name);
				break;
			default:
				break;
		}

		echo "<a href=board.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&action=$action><span>${title}</span></a>";

		$grgresult = mysql_query("select id from $board_grg where storyid=$sid");
		$grgnums = mysql_num_rows($grgresult);

		if ($grgnums) {
			echo "(".$grgnums.")";
		}

		if ($compareDay == $today){
			echo "&nbsp;<img src=\"${skin_dir}/images/new.gif\">";
		}
		
		if ($opkey) {
			$img_list = array(	"f"=>"icon_finish.gif",
								"i"=>"icon_ing.gif",
								"c"=>"icon_cost.gif",
								"m"=>"icon_mail.gif",
								"n"=>"icon_no_cost.gif");

			echo "&nbsp;<img src=\"${skin_dir}/images/$img_list[$opkey]\">";
		}
?>
				</td>				
				<td class="date"><span><? echo ${compareDay}; ?></span></td>
				<td class="hit"><span><? echo ${hit}; ?></span></td>
			</tr>
<?
	}
} else {
?>
			<tr>
				<td colspan="4" class="warn-subject color-red"><span>등록된 게시물이 없습니다.</span></td>
			</tr>
<?
}
?>
		</tbody>
	</table>	
</div>

<div class="board-page-navi">
	<?
		include $skin_dir . "/navi.php";
	?>
</div>

<div class="board-search ui-inlineblock">
	<form action="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&igroup=<? echo $igroup; ?>&sid=<? echo $sid; ?>&action=searchlist" method="post" name="musimsl" onSubmit="return musimsearch_check(this);">
		<select name='find'>
			<option value='title'>제 목</option>
			<option value='name'>이 름</option>
			<option value='comment'>내 용</option>
		</select>
		<input type="text" name="search" size="15">
		<input name="imageField" type="image" src="<? echo ${skin_dir}; ?>/images/btn_search.gif" width="51" height="23" border="0">
	</form>
</div>

<div class="board-buttons ui-inlineblock">
<?
if($action == "searchread") {
?>

	<a href="board.php?board=<? echo ${board} ?>&board_grg=<? echo ${board_grg} ?>&find=<? echo ${find} ?>&search=<? echo ${search} ?>&passover=<? echo ${passover} ?>&page=<? echo ${page} ?>&action=searchlist"><img src="<? echo ${skin_dir} ?>/images/btn_list.gif" width="51px" height="23px" border="0"></a>
<?
}else{
?>
	<a href="board.php?board=<? echo ${board} ?>&board_grg=<? echo ${board_grg} ?>&passover=<? echo ${passover} ?>&page=<? echo ${page} ?>&action=list"><img src="<? echo ${skin_dir} ?>/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
<?
}		
?>
	<a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&action=write"><img src="<? echo ${skin_dir}; ?>/images/btn_write.gif" width="62" height="23" border="0"></a>
</div>

<script type="text/javascript" src="<? echo ${skin_dir}; ?>/js/board.read.js"></script>
