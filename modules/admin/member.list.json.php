<?
include "../lib.php";


$table_name = $_POST["table_name"];
$table_group = $member_group;


$dataObj = array();
$dataList = array();
$msg = "";
$resultYN = "Y";

$cmresult = mysql_query("select * from $table_group ORDER BY id asc limit 0,1");

if ($cmresult){
	$cmnumrows = mysql_num_rows($cmresult);

	if ($cmnumrows > 0) {

		while ($row = mysql_fetch_array($cmresult)){
			$cm_name = $row["name"];
			$cm_name = ucfirst($cm_name);
		}

		if (!$table_name) {
			$table_name = $cm_name;
		}

		$result = mysql_query("select * from $table_group where name = '$table_name'");

		if ($result){
			$row = mysql_fetch_array($result);
			$m_name = $row["name"];
			$numresults = mysql_query("select id from $m_name");	

			if ($numresults){
				$numrows = mysql_num_rows($numresults);
			
				$limit = 10;   

				if (!$passover) {
					$passover = 0;
				}	

				$a = $numrows-$passover;

				if ($numrows > 0){

					$ml_name = ucfirst($m_name);
					$result2 = mysql_query("select * from $m_name ORDER BY id desc limit $passover, $limit");

					if ($result2) {

						while ($row = mysql_fetch_array($result2)) {
							$adm_id = $row["id"];
							$adm_name = $row["name"];
							$adm_memberid = $row["ljs_memberid"];
							$adm_company = $row["company"];
							$adm_day = $row["date"];
							$adm_point = $row["point"];
							$adm_grade = $row["grade"];
							$adm_hit = $row["hit"];
							$adm_ip = $row["ip"];

							array_push($dataList, array("no"=>$a,"id"=>$adm_id,"memberid"=>$adm_memberid,"name"=>$adm_name,"date"=>$adm_day,"hit"=>$adm_hit,"grade"=>$adm_grade,"table_name"=>$m_name));

							$a--;
						}

						$dataObj = array("table_name"=>$m_name, "list"=>$dataList);
					}				
				} else {

					$dataObj = array("table_name"=>$m_name, "list"=>$dataList);

					$msg = "현재 등록된 회원이 없습니다.";
				}
			}
		}
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
