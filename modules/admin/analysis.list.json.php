<?
include "../lib.php";

$dataObj = null;
$dataList = array();
$msg = "";
$resultYN = "Y";

$table_name = "$connecter_site";
$result = mysql_query("select * from $table_name ORDER BY id asc");

if ($result){
	$totalhit = 0;

	while ($row = mysql_fetch_array($result)){
		$hit = $row['hit'];
		$totalhit += $hit;
		number_format($totalhit);
	}
  
	$result = mysql_query("select * from $table_name ORDER BY id desc");

	if ($result){	  
		$numrows = mysql_num_rows($result);	

		if ($numrows){
			$a = $numrows;

			while ($row = mysql_fetch_array($result)){
				$id = $row['id'];
				$name = $row['name'];
				$day = $row['date'];
				$hit = $row['hit'];

				if(!$hit || $hit<1) {
					$percent = 0;
					$percent_length = 1;
				}else{
					$percent = (int)(100 * $hit/$totalhit);
					$percent_length = (int)(280 * $hit/$totalhit);
				}

				array_push($dataList, array("no"=>$a,"id"=>$id,"name"=>$name,"hit"=>$hit,"percent"=>$percent));

				$a--;
			}

			$dataObj = array("list"=>$dataList);
		} else {
			$msg = "등록된 접속키워드가 존재하지 않습니다.";
			$resultYN = "N";
		}
	}
} else {		
	$msg = "접속키워드 테이블이 존재하지 않습니다.";
	$resultYN = "N";
}


$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';

mysql_close();
?>