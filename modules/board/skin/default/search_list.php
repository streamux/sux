<?
$limit =10;

if (!$passover) {
	 $passover=0;
}

$query = mysql_query("select * from $board where $find like '%$search%' order by id desc limit $passover,$limit");
$numrows2 = mysql_num_rows($query);
?>

<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/common.css">
<link rel="stylesheet" type="text/css" href="<? echo ${skin_dir}; ?>/css/layout.css">

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

		$sid = $row['id'];
		$name = htmlspecialchars($row['name']); 
		$storytitle = htmlspecialchars($row['title']);
		$opkey = $row['opkey'];
		$day = $row['date'];
		$space = $row['space'];
		$type=$row['filetype'];
		$filename = $row['filename'];
		$hit = $row['see'];
		$today = date("Y-m-d");
		
		$find_key = strtolower($find);
		switch ($find_key) {
			case 'title':
				$storytitle = str_replace("$search","<span class=\"color-red\">$search</span>",$storytitle);
				break;
			case 'name':
				$name = str_replace("$search","<span class=\"color-red\">$search</span>",$name);
				break;
			default:
				break;
		}		
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

		echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp";

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

			echo "<img src=\"${skin_dir}/images/${imgname}\">&nbsp;";
		}

		echo "<a href=board.php?board=$board&board_grg=$board_grg&id=$row[id]&igroup=$row[igroup]&passover=$passover&page=$page&sid=$sid&find=$find&search=$search&action=searchread>${storytitle}</a>";

		$grgresult = mysql_query("select id from $board_grg where storyid = $sid");
		$grgnums = mysql_num_rows($grgresult);

		if($grgnums) {
			echo "(".$grgnums.")";
		}

		if($day == $today){
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
		<form action="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&sid=<? echo sid; ?>&find=<? echo $find; ?>&search=<? echo $search; ?>&action=searchlist" method="post" name="musimsl" onSubmit="return musimsl_check(this);">
									
			<select name="find">
				<option value="title">제 목</option>
				<option value="name">작성자</option>                      
				<option value="comment">내 용</option>
			</select>
			<input type="text" name="search" size="15">
			<input name="imageField" type="image" src="<? echo ${skin_dir}; ?>/images/btn_search.gif" width="51" height="23" border="0">

		</form>
	</div>
	<div class="buttons ui-inlineblock">
		<a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&action=list"><img src="<? echo ${skin_dir}; ?>/images/btn_list.gif" width="51" height="23" border="0"></a>&nbsp;<a href="board.php?board=<? echo $board; ?>&board_grg=<? echo $board_grg; ?>&id=<? echo $row[id]; ?>&igroup=<? echo $row[igroup]; ?>&passover=<? echo $passover; ?>&page=<? echo $page; ?>&sid=<? echo $sid; ?>&action=write"><img src="<? echo ${skin_dir}; ?>/images/btn_write.gif" width="62" height="23" border="0"></a>
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

