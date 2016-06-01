<?
include "../lib.php";

$table_name = $_POST['table_name'];
$id = $_POST['id'];

$dir="../../board_data/$table_name";

$resultYN = "Y";
$msg = "";

$result = mysql_query("drop table $table_name");

if (!$result) {
	$msg .= "${table_name} 테이블 삭제를 실패하였습니다.\n";
} else {
	$msg .= "${table_name} 테이블 삭제를 성공하였습니다.\n";
}

$result = mysql_query("delete from $board_group where id='$id'");

if (!$result) {
	$msg .= "게시판그룹의 ${table_name} 레코드 삭제를 실패하였습니다.\n";
} else {
	$msg .= "게시판그룹의 ${table_name} 레코드 삭제를 성공하였습니다.\n";
}

$table_name_grg =$table_name."_grg";
$result=mysql_query("drop table $table_name_grg");

if (!$result) {
	$msg .= "${table_name_grg} 꼬리글 테이블 삭제를 실패하였습니다.\n";
} else {
	$msg .= "${table_name_grg} 꼬리글 테이블 삭제를 성공하였습니다.\n";
}

function deleteDir( $path ) {

	if (trim($GLOBALS['table_name']) == "") {
		$GLOBALS['msg'] .= "폴더명을 입력해주세요.\n";
		return false;
	}

	if (!is_dir( $path )) {
		$GLOBALS['msg'] .= "해당 폴더가 존재하지 않습니다.\n";
		return false;
	}

	@chmod($path,0777);
	$directory = dir($path);
	
	while(($entry = $directory->read()) !== false) { 
		
		if ($entry != "." && $entry != "..") { 
			
			if (is_dir($path."/".$entry)) { 
				deleteDir($path."/".$entry); 
			} else { 
				@chmod($path."/".$entry,0777);
				@UnLink ($path."/".$entry); 
			}
		} 
	} 
	
	$directory->close(); 
	@rmdir($path);

	return true;
}

$resultDir = deleteDir($dir);

if ($resultDir) {
	$msg .= "${table_name} 폴더 삭제를 성공하였습니다.";
} else {
	$msg .= "${table_name} 폴더 삭제를 실패하였습니다.";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
