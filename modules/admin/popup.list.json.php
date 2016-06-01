<?
include "../lib.php";


$dataObj = null;
$dataList = array();
$msg = "";
$resultYN = "Y";


$table_name = $popup;
$numresults = mysql_query("select * from $table_name");

if ($numresults){
	$numrows = mysql_num_rows($numresults);

	if ($numrows > 0){

		$limit = 30;  

		if (!$passover) {
			$passover = 0;
		}

		$result = mysql_query("select * from $table_name ORDER BY id desc limit $passover,$limit");

		$a = $numrows - $passover;

		while ($row = mysql_fetch_array($result)){
			$pu_id = $row["id"];
			$pu_name = $row["name"];
			$pu_title = $row["title"];
			$pu_choice = $row["choice"];
			$time1 = $row["time1"];
			$time2 = $row["time2"];
			$time3 = $row["time3"];
			$time4 = $row["time4"];
			$time5 = $row["time5"];
			$time6 = $row["time6"];
			$pu_width = $row["width"];
			$pu_height = $row["height"];
			$pu_url = $row["url"];

			$date = $time6."-".$time4."-".$time5;
			$times = $time1.":".$time2.":".$time3;

			array_push($dataList, array("no"=>$a,"id"=>$pu_id,"name"=>$pu_name,"title"=>$pu_title,"date"=>$date,"time"=>$times,"usable_key"=>$cb_log_key,"skin"=>$pu_url));

			$a--;
		}

		$dataObj = array("list"=>$dataList);
	} else {
		$msg = "등록된 팝업이 존재하지 않습니다.";
		$resultYN = "N";
	}
}else{
	$msg = "팝업 테이블이 존재하지 않습니다";
	$resultYN = "N";
}


$json_data = array("data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
