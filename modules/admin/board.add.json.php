<? 
include "../lib.php";

$dir = "../board/skin/";

$skinList = array();
$msg = "";
$resultYN = "Y";


if ($handle = opendir($dir)) { 

	while (false !== ($file = readdir($handle))) { 

			if ($file != "." && $file != "..") {

				array_push($skinList, array("file_name"=>$file));				
			} 
	} 
	closedir($handle); 
}  else {
	$msg = "스킨폴더가 존재하지 않습니다.";
	$resultYN = "N";
}

$json_data = array(	"data"=>array("list"=>$skinList),
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>