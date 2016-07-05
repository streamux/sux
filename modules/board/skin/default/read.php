<?
/**
	@테스트 용  
	$tail = "y";
	$setup = "y";
	$_SESSION[grade] = 10;
*/

$board = $_REQUEST[board];
$board_grg = $_REQUEST[board_grg];
$id = $_REQUEST[id];
$igroup = $_REQUEST[igroup];
$passover = $_REQUEST[passover];
$page = $_REQUEST[page];
$sid = $_REQUEST[sid];
$find = $_REQUEST[find];
$search = $_REQUEST[search];
$ljs_mod = $_REQUEST[ljs_mod];

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

$fileupPath = "";

if ($fileupname) {

	if ($download == 'y') {
		$fileupPath = "<a href=\"board.down.php?board=<? echo $board; ?>&fileupname=<? echo $fileupname; ?>&filepath=<? echo $filesize; ?>\"><? echo $fileupname; ?>&nbsp;&nbsp;<b>[다운로드]</b></a>";
	} else {
		$fileupPath = "<img src='../../board_data/$board/$fileupname' border='0'>";

	}
}
?>

<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/layout.css">

<div class="board-read" style="width:<? echo $width; ?>">
	<div class="panel-heading">
		<h1><? echo ${storytitle}; ?></h1>
		<p><? echo ${m_name}; ?> | <? echo ${date}; ?> | hit-<? echo ${hit}; ?></p>
	</div>
	<div class="panel-body">
		<? echo ${fileupPath}; ?>
		<p><? echo ${storycomment}; ?></p>
	</div>

<?
if ($tail == 'y') {
	$result2 = mysql_query("select * from $board_grg where storyid=$id order by id");
	$numrow2 = mysql_num_rows($result2);
?>
	<div class="board-tail" style="width:<? echo ${width}; ?>">
		<div class="panel-list">
			<dl>
				<dt>댓글 <? echo $numrow2; ?></dt>
<? 
	

	while ($row2 = mysql_fetch_array($result2)) {

		$day = $row2[date];
		$nickname = htmlspecialchars($row2[nickname]);
		$iyggrcomment =  nl2br($row2[comment]);
		$grgid = $row2[id];
?>
				<dd>
					<? echo "${nickname} - <span class=\"grgcomment\">${iyggrcomment}</span><span class=\"date\">${day}</span>"; ?> 
					<a href="board_grg.delpass.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&grgid=<? echo $grgid; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>">[삭제]</a>
				</dd>
<?
	}
?>
			</dl>
		</div>
		<div class="panel-write">
			<form action="board_grg.insert.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&igroup=<? echo $igroup; ?>&passover=<? echo $passover; ?>&sid=<? echo $sid; ?>" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
			<ul>		
				<li class="form-heading">
					<span>이름</span>
					<input type="text" name="ljs_name" size="10" maxlength="20" value="<? echo $ljs_nickname; ?>">&nbsp;
					<span>비밀번호</span>
					<input type="password" name="ljs_pass" size="8" maxlength="8" value="<? echo $ljs_pass1; ?>">
				</li>
				<li class="form-comment">
					<textarea name="comment" cols="64" rows="5"></textarea>
				</li>
				<li class="form-buttons">
					<input type="submit" name="Submit" value="댓글등록">
					<input type="reset" name="Submit2" value="다시쓰기">
				</li>
			</ul>
			</form>
		</div>
	</div>
<?
}
?>

	<div class="panel-buttons">
<?
		if($ljs_mod=="s_mode") {
?>

			<a href="board.php?board=<? echo ${board} ?>&board_grg=<? echo ${board_grg} ?>&find=<? echo ${find} ?>&search=<? echo ${search} ?>&action=searchlist"><img src="<? echo ${skin_dir} ?>/images/btn_list.gif" width="51px" height="23px" border="0"></a>
<?
		}else{
?>
			<a href="board.php?board=<? echo ${board} ?>&board_grg=<? echo ${board_grg} ?>&action=list"><img src="<? echo ${skin_dir} ?>/images/btn_list.gif" width="51px" height="23px" border="0px"></a>
<?
		}		
?>
		<a href="board.php?&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=write"><img src="<? echo ${skin_dir}; ?>/images/btn_write.gif" width="62" height="23" border="0"></a> <a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>&action=reply"><img src="<? echo ${skin_dir}; ?>/images/btn_answer.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&action=modify"><img src="<? echo ${skin_dir}; ?>/images/btn_edit.gif" border="0"></a>&nbsp;<a href="board.php?id=<? echo $id; ?>&board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=delpass"><img src="<? echo ${skin_dir}; ?>/images/btn_del.gif" width="51" height="23" border="0"></a>
	</div>
</div>

<?
$limit =3; 

if (!$passover){
	$passover = 0;
}

if ($ljs_mod == "s_mode"){
	$option = "where $find like '%$search%'";
}else{
	$option = "";
}

$result0 = mysql_query("select * from $board");
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
		$opkey = $row[opkey];
		$day = $row[date];
		$type=$row[filetype];
		$space = $row[space];
		$hit = $row[see];
		$filename = $row[filename];
		$today = date("Y-m-d");
		$string = $title;

		if ($day == $today && $opkey){
			$num =20;
		}else if($day == $today || $opkey){
			$num = 28;
		}else{
			$num = 34;
		}
		$title = trim($string, $num);
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

			if ($type =="image/gif" || $type =="image/jpeg" || $type =="image/x-png" || $type =="image/png" || $type =="image/bmp"){
				$imgname = "icon_img.png";
			} else if ($type =="application/x-zip-compressed"){ 
				$imgname = "icon_down.png";
			}

			echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp;";
		}

		if ($action == "search") {
			$title = str_replace("$search","<span class=\"color-red\">$search</span>",$title);
			$name = htmlspecialchars($name); 
			$name = str_replace("$search","<span class=\"color-red\">$search</span>",$name);
		}

		echo "<a href=board.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&action=read><span>${title}</span></a>";

		$grgresult = mysql_query("select id from $board_grg where storyid=$sid");
		$grgnums = mysql_num_rows($grgresult);

		if ($grgnums) {
			echo "(".$grgnums.")";
		}

		if ($day == $today){
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
				<td class="date"><span><? echo ${day}; ?></span></td>
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
	<div class="navi">
		<? include "navi.php"; ?>
	</div>
	<div class="search ui-inlineblock">
		<form action="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&find=<? echo $find; ?>&search=<? echo $search; ?>&actoin=searchlist" method="post" name="musimsl" onSubmit="return musimsearch_check(this);">
			<select name=find>
				<option value='title'>제 목</option>
				<option value='name'>이 름</option>
				<option value='comment'>내 용</option>
			</select>
			<input type="text" name="search" size="15">
			<input name="imageField" type="image" src="<? echo ${skin_dir}; ?>/images/btn_search.gif" width="51" height="23" border="0">
		</form>
	</div>	
	<div class="buttons ui-inlineblock">
		<a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=list"><img src="<? echo ${skin_dir}; ?>/images/btn_list.gif" width="51" height="23" border="0"></a> <a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&action=write"><img src="<? echo ${skin_dir}; ?>/images/btn_write.gif" width="62" height="23" border="0"></a>
	</div>
</div>

 <? 
if ($setup == "y") {
	if ($grade > 9){
?>
<div class="board-adminsetup" style="width:<? echo ${width}; ?>">
	<form action="board.opkey.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $id; ?>" method="post"  name="musimso" onSubmit="return musimso_check(this);">
	<table summary="관리자 설정옵션입니다.">
		<tbody>
			<tr>
				<td>진행상황</td>
				<td>
					<input type="radio" name="opkey" value="f" checked> <span>진행완료</span>&nbsp;
					<input type="radio" name="opkey" value="i"> <span>진행중</span>
				</td>
			</tr>
			<tr>
				<td>입금상황</td>
				<td>
					<input type="radio" name="opkey" value="c"> <span>입금완료</span>&nbsp;
					<input type="radio" name="opkey" value="n"> <span>미입금</span>
				</td>
			</tr>
			<tr>
				<td>메일현황</td>
				<td><input type="radio" name="opkey" value="m"> <span>발송완료</span></td>
			</tr>
			<tr>
				<td>초기화</td>
				<td><input type="radio" name="opkey" value=""> <sapn>초기화</sapn></td>
			</tr>
		</tbody>
	</table>
	<div class="form-text-tip">※ 해당버튼을 선택하여 진행상황을 표시할 수 있습니다.</div>
	<div class="form-submit">		
		<input type="submit" name="submit" size="10" value=" 보내기 ">
	</div>
	</form>
</div>
<?
	}
}
?>

<script type="text/javascript" src="<? echo ${skin_dir}; ?>/js/board.read.js"></script>
