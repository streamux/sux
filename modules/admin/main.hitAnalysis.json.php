<?
include "../lib.php"; 

$mod = $_POST["mod"];
$passover = $_POST["passover"];
$limit = $_POST["limit"];

$dataObj = null;
$promotionArr = null;
$serviceConfig = null;

$msg = "";
$resultYN = "Y";

if ($mod == "pageview") {

	$result = mysql_query("select * from $pageview ORDER BY id asc");

	if ($result){
		$totalhit = 0;

		while ($row = mysql_fetch_array($result)){
			$hit = $row['hit'];
			$totalhit += $hit;
			number_format($totalhit);
		}
	} else {
		$msg .= "페이지뷰등록 테이블이 존재하지 않습니다.\n";
		$resultYN = "N";
	}

	$resultpv=mysql_query("select * from $pageview ORDER BY id asc");

	if ($resultpv){
		$numrows=mysql_num_rows($resultpv);	

		$msg_war = "";
		$pageViewList = array();

		if ($numrows > 0){

			if (!$limit) {
				$limit = 5;
			}			

			if (!$passover) {
				$passover = 0;
			}

			$resultpv2 = mysql_query("select * from $pageview ORDER BY id desc limit $passover, $limit");
			$a = $numrows-$passover;

			while($rowpv = mysql_fetch_array($resultpv2)){
				$pvname = $rowpv['name'];
				$rowpv = $rowpv['hit'];

				array_push($pageViewList, array(	"no"=>$a,
													"name"=>$pvname,
													"hit"=>$rowpv,
													"total"=>$totalhit));
				
				$a--;
			}
		} else {
			$msg_warn = "페이지뷰 키워드가 존재하지 않습니다.";
		}

		$promotionArr = array("list"=>$pageViewList, "total_num"=>$numrows,"limit_num"=>$limit,"msg"=>$msg_warn);

	}else{
		$msg .= "페이지뷰테이블이 존재하지 않습니다.\n";
		$resultYN = "N";
	}
} else if ($mod == "analysis") {

	$result = mysql_query("select * from $connecter_site ORDER BY id asc");

	if ($result){
		$totalhit = 0;
		while ($row = mysql_fetch_array($result)){
			$hit = $row[hit];
			$totalhit += $hit;
			number_format($totalhit);
		}
	}else{
		$msg .= "프로모션등록 테이블이 존재하지 않습니다.\n";
		$resultYN = "N";
	}

	$resultct = mysql_query("select * from $connecter_site ORDER BY id asc");

	if ($resultct){
		$numrows = mysql_num_rows($resultct);	

		$msg_warn = "";
		$connecterList = array();

		if ($numrows > 0){

			if (!$limit) {
				$limit = 5;
			}

			if (!$passover) {
				$passover = 0;
			}

			$resultct2 = mysql_query("select * from $connecter_site ORDER BY id asc limit $passover, $limit");
			$a = $numrows - $passover;

			while($rowct = mysql_fetch_array($resultct2)){
				$ctname = $rowct['name'];
				$rowct = $rowct['hit'];

				array_push($connecterList, array(	"no"=>$a,
													"name"=>$ctname,
													"hit"=>$rowct,
													"total"=>$totalhit));
				
				$a--;
			}		
		}else{
			$msg_warn = "접속경로분석 키워드가 존재하지 않습니다.";
		}

		$promotionArr = array("list"=>$connecterList, "total_num"=>$numrows, "limit_num"=>$limit,"msg"=>$msg_warn);

	}else{
		$msg = "페이지뷰테이블이 존재하지 않습니다.\n";
		$resultYN = "N";
	}
}

$json_data = array(	"data"=>$promotionArr,
					"mod"=>$mod,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
