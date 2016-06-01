<?
include "../lib.php";


$table_name = $member_group;


$dataObj = null;
$dataList = array();
$msg = "";
$resultYN = "Y";

$cmresult = mysql_query("select * from $table_name");

if ($cmresult){

	$numrows = mysql_num_rows($cmresult );

	if ($numrows > 0) {

		while ($row = mysql_fetch_array($cmresult)) {
			$m_name = $row["name"];
			array_push($dataList , array("name"=>$m_name));
		}
		
		$dataObj  = array("list"=>$dataList);
	} else {
		$msg = "현재 회원그룹이 존재하지 않습니다.";
		$resultYN = "N";
	}
} 

$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
