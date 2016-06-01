s<?
include "../lib.php";

if (eregi("php|php3|htm|html|js|exe|phtml|inc|jsp|asp|swf",$imgup_name)) {
	echo ("
		<script>
		alert('실행파일(php,php3,htm,html,js,exe,phtml,inc,jsp,asp,swf...)은 등록 할 수 없습니다.')
		history.go(-1)
		</script>
	");
	exit;
}

$file_dir='../popup/skin/';


$save_dir = $file_dir;

if (is_uploaded_file($_FILES["imgup"]["tmp_name"])) {
	$imgup_name = $imgup_name;
	$dest = $save_dir . "/" . $imgup_name;
	
	if(!move_uploaded_file($imgup, $dest)) {
		die("파일을 지정한 디렉토리에 저장하는데 실패했습니다.");
	}else{
		echo "파일 업로드 성공";
	}
}
?>