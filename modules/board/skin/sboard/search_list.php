<?
$board = $_REQUEST[board];
$board_grg = $_REQUEST[board_grg];
$id = $_REQUEST[id];
$igroup = $_REQUEST[igroup];
$passover = $_REQUEST[passover];
$page = $_REQUEST[page];
$sid = $_REQUEST[sid];
$find = $_REQUEST[find];
$search = $_REQUEST[search];
$s_mod = $_REQUEST[ljs_mod];

$skin_path = "skin/${include2}";
$limit =10;

if (!$passover) {
	 $passover=0;
}

$query = mysql_query("select * from $board where $find like '%$search%' order by id desc limit $passover,$limit");
$numrows2 = mysql_num_rows($query);
?>

<link rel="stylesheet" type="text/css" href="<? echo ${skin_path}; ?>/css/layout.css">

<div class="board-list" style="width:<? echo ${width}; ?>">
	<table summary="게시판 리스트입니다.">
		<thead>
			<tr>
				<th class="author vertical-line">작성자</th>
				<th class="subject vertical-line">제목</th>
				<th class="date vertical-line">날자</th>
				<th class="hit">조회</th>
			</tr>
		</thead>
		<tbody>
<?
if ($numrows2) {

	while ($row = mysql_fetch_array($query)) {

		$sid = $row[id];
		$storytitle = htmlspecialchars($row[title]);
		$opkey = $row[opkey];
		$day = $row[date];
		$space = $row[space];
		$type=$row[filetype];
		$filename = $row[filename];
		$hit = $row[see];
		$today = date("Y-m-d");
		$string = $storytitle;

		if ($day == $today && $opkey){
			$num = 24;
		} else if ($day == $today || $opkey){
			$num = 28;
		} else {
			$num = 34;
		}

		$storytitle = trim($string, $num);
		$storytitle = str_replace("$search","<span class=\"color-red\">$search</span>",$storytitle);
		$name = htmlspecialchars($row[name]); 
		$name = str_replace("$search","<span class=\"color-red\">$search</span>",$name);
?>
			<tr>
				<td class="author"><span><? echo ${name} ?></span></td>
				<td class="subject">
<?
		if ($space){
			for($i=0; $i<$space; $i++){
				echo "&nbsp;&nbsp;";
			}
		}

		if($space) {
			$imgname = "icon_answer.gif";
		}else{
			$imgname = "text.gif";
		}

		echo "<img src=\"${skin_path}/img/${imgname}\">&nbsp";

		$imgname = "";

		if($filename){

			if ($type=="image/gif"){
				$imgname = "gif.gif";
			}else if($type=="image/pjpeg"){
				$imgname = "jpg.gif";
			}else if($type=="image/x-png"){
				$imgname = "png.gif";
			}else if($type=="image/bmp"){
				$imgname = "bmp.gif";
			}else if($type=="application/x-zip-compressed"){ 
				$imgname = "down.gif";
			}else {
				$imgname = "text.gif";
			}

			echo "<img src=\"${skin_path}/img/${imgname}\">&nbsp;";
		}

		echo "<a href=board.read.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&ljs_mod=s_mode>";
		echo "$storytitle ";
		echo "</a>";

		$grgresult = mysql_query("select id from $board_grg where storyid = $sid");
		$grgnums = mysql_num_rows($grgresult);

		if($grgnums) {
			echo "(".$grgnums.")";
		}

		if($day == $today){
			echo "&nbsp;<img src=\"${skin_path}/img/new.gif\">";
		}
		
		if ($opkey) {
			$img_list = array(	"f"=>"icon_finish.gif",
								"i"=>"icon_ing.gif",
								"c"=>"icon_cost.gif",
								"m"=>"icon_mail.gif",
								"n"=>"icon_no_cost.gif");
			echo "&nbsp;<img src=\"${skin_path}/img/$img_list[$opkey]\">";
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
				<td colspan="4" class="warn-subject color-red"><span >검색된 게시물이 없습니다.</span></td>
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
		<form action="board.search_list.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo sid; ?>&find=<? echo $find; ?>&search=<? echo $search; ?>" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
									
			<select name="find">
				<option value="title">제 목</option>
				<option value="name">이 름</option>                      
				<option value="comment">내 용</option>
			</select>
			<input type="text" name="search" size="15">
			<input name="imageField" type="image" src="<? echo ${skin_path}; ?>/img/btn_search.gif" width="51" height="23" border="0">

		</form>
	</div>
	<div class="buttons ui-inlineblock">
		<a href="board.list.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>"><img src="<? echo ${skin_path}; ?>/img/btn_list.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.write.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&ljs_mode=<? echo w_mode; ?>"><img src="<? echo ${skin_path}; ?>/img/btn_write.gif" width="62" height="23" border="0"></a>
	</div>
</div>


<script type="text/javascript">
	function musimsl_check(f) {

		searcho = f.search.value.length;

		if ( searcho < 1 ) {
			alert("검색어를 입력하세요.");
			f.search.focus();
			return (false);
		}
		return (true);
	}
</script>

