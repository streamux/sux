<?
include "../lib.php";


$id = $_REQUEST[id];
$board = $_REQUEST[board];
$board_grg = $_REQUEST[board_grg];

$m_name = $_POST[m_name];
$pass = $_POST[pass];
$storytitle = $_POST[storytitle];
$storycomment = $_POST[storycomment];
$email = $_POST[email];
$igroup = $_POST[igroup];
$wallwd = $_POST[wallwd];
$name = $_POST[type];
$wall = trim($_POST[wall]);
$wallok = trim($_POST[wallok]);
$wallwd = $_POST[wallwd];
$ljs_mod = $_POST[ljs_mod];

$imgup_name = $_FILES[imgup][name];
$imgup_size = $_FILES[imgup][size];
$imgup_type = $_FILES[imgup][type];
$imgup_tmpname = $_FILES[imgup][tmp_name];

$save_dir = "../../board_data/$board/";

if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imgup_name)) {
	echo ("	<script>
				alert('실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.');
				history.go(-1);
			</script>");
	exit;
}

if (!$m_name) {
	echo ("	<script>
				alert('이름을 입력해주세요.');
				history.go(-1);
			</script>");
	exit;
}

if (!$pass) {
	echo ("	<script>
				alert('비밀번호를 입력해주세요.');
				history.go(-1);
			</script>");
	exit;
}

if (!$storytitle) {
	echo ("	<script>
				alert('제목을 입력해주세요.');
				history.go(-1);
			</script>");
	exit;
}

if (!$storycomment) {
	echo ("	<script>
				alert('내용을 입력해주세요.');
				history.go(-1);
			</script>");
	exit;
}

if (ereg('@',$email)) {
	echo "";
} else {
	echo ("	<script>
				alert('잘못된 E-mail 주소입니다.');
				history.go(-1);
			</script>");
	exit;
}

if (!$wall) {
	echo ("	<script>
				alert('프로그램 등록방지 키를 입력해주세요.');
				history.go(-1);
			</script>");
	exit;
}

if ($ljs_mod=="writer" && $wall) {

	if ($wall == $wallok) { 		

		if (is_uploaded_file($imgup_tmpname )) {
			$mktime = mktime();
			$imgup_name =$mktime."_".$imgup_name;
			$dest = $save_dir.$imgup_name;

			if (!move_uploaded_file($imgup_tmpname , $dest)) {
				die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$queryy = "select id from $board order by id desc limit 1";
		$mysql_result = mysql_query($queryy);
		$row = mysql_fetch_array($mysql_result);
		$igroup = $row[id]+1; 

		$dbinsert = "insert into $board values ('','$m_name','$pass','$storytitle','$storycomment','$email',now(),'$REMOTE_ADDR',0,'',$igroup,0,0,'$wallwd','$imgup_name','$imgup_size','$imgup_type','$type')";
		$result=mysql_query($dbinsert);

		echo ("<meta http-equiv='Refresh' content='0; URL=board.list.php?board=$board&board_grg=$board_grg'>");
	} else { 
		echo ("	<script>
					alert('경고! 잘못된 등록키입니다.');
					history.go(-1);
				</script>");
		exit;	
	}
} else if ($ljs_mod=="reply" && $wall) {

	if ($wall == $wallok) { 
		$result = mysql_query("select id,igroup,space,ssunseo from $board where id='$id'");
		$row = mysql_fetch_array($result);
		$space = $row[space]+1;
		$ssunseot = $row[ssunseo]+1;

		if (is_uploaded_file($imgup_tmpname )) {

			$mktime = mktime();
			$imgup_name = $mktime."_".$imgup_name;
			$dest = $save_dir . $imgup_name;

			if (!move_uploaded_file($imgup_tmpname, $dest)) {
				die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$result = mysql_query("insert into $board values ('','$m_name','$pass','$storytitle','$storycomment','$email',now(),'$REMOTE_ADDR',0,'',$row[igroup],$space,$ssunseot,'$wallwd','$imgup_name','$imgup_size','$imgup_type','$type')");
		
		echo ("<meta http-equiv='Refresh' content='0; URL=board.list.php?board=$board&board_grg=$board_grg>");
	} else {
		echo ("	<script>
					alert('경고! 잘못된 등록키입니다.');
					history.go(-1);
				</script>");
		exit;
	}

} else if ($ljs_mod == "modify") {
	$result0 = mysql_query("select pass,igroup,filename from $board where id=$id");
	$row = mysql_fetch_array($result0);

	if ($pass == $row[pass] || $pass == $admin_pwd) {
		$deljfilename = $row[filename];

		if ($deljfilename) {
			$delfilename = $save_dir . $deljfilename;

			if(!@unlink($delfilename)) {
				echo "파일삭제에 실패했습니다.";
			} else {
				echo "파일 삭제에 성공했습니다.";
			}
		}

		if (is_uploaded_file($_FILES[imgup][tmp_name])) {
			$mktime = mktime();
			$imgup_name = $mktime."_".$imgup_name;
			$dest = $save_dir . $imgup_name;

			if (!move_uploaded_file($_FILES[imgup][tmp_name], $dest)) {
				die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");      
			}
		} 

		$result0 = mysql_query("update $board set name='$m_name',title='$storytitle',comment='$storycomment',email='$email', filename='$imgup_name',filesize='$imgup_size',filetype='$imgup_type',type='$type' where id=$id");

		echo ("<meta http-equiv='Refresh' content='0; URL=board.read.php?id=$id&board=$board&board_grg=$board_grg&sid=$sid&igroup=$row[igroup]'>");
	} else  {
		echo ("	<script>
					alert('비밀번호가 틀립니다!');
					history.go(-1);
				</script>");
		exit;
	}
}
mysql_close();
?>