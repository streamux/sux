<?
$limit =3;   

if (!$passover) {
	 $passover=0;
}
$result0 = mysql_query("select * from $board");
$numrows = mysql_num_rows($result0);

$result = mysql_query("select * from $board order by igroup desc,ssunseo asc limit $passover,$limit");
$numrows2 = mysql_num_rows($result);
?>

<link rel="stylesheet" type="text/css" href="<? echo $skin_dir; ?>/css/layout.css">

<div class="board-list" style="width:<? echo ${width}; ?>">
	<table summary="게시판 리스트입니다.">
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
		} else if ($day == $today || $opkey){
			$num = 28;
		} else {
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

		if ($space) {
			$imgname = "icon_answer.gif";
			echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp";
		}		

		$imgname = "";

		if ($filename){

			if ($type =="image/gif" || $type =="image/jpeg" || $type =="image/x-png" || $type =="image/png" || $type =="image/bmp"){
				$imgname = "icon_img.png";
			} else if ($type=="application/x-zip-compressed"){ 
				$imgname = "icon_down.png";
			}

			echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp;";
		}

		echo "<a href=board.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&action=read><span>${title}</span></a>&nbsp;";

		$grgresult=mysql_query("select id from $board_grg where storyid=$sid");
		$grgnums=mysql_num_rows($grgresult);

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
			echo "<img src=\"${skin_dir}/images/$img_list[$opkey]\">";
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
		<form action="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo $sid; ?>&find=<? echo $find; ?>&search=<? echo $search; ?>&action=searchlist" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
			<select name=find>
				<option value='title'>제 목</option>
				<option value='name'>이 름</option>
				<option value='comment'>내 용</option>
			</select>
			<input type=text name=search size=15>
			<input name="imageField" type="image" src="<? echo ${skin_dir}; ?>/images/btn_search.gif" width="51" height="23" border="0">
		</form>
	</div>	
	<div class="buttons ui-inlineblock">
		<a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=list"><img src="<? echo ${skin_dir}; ?>/images/btn_list.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&action=write"><img src="<? echo ${skin_dir}; ?>/images/btn_write.gif" width="62" height="23" border="0"></a>
	</div>
</div>

<script type="text/javascript" src="<? echo ${skin_dir}; ?>/js/board.list.js"></script>
