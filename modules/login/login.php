<?
include "../lib.php";

$ljs_member = $_SESSION[ljs_member];
$ljs_memberid = $_SESSION[ljs_memberid];
$ljs_pass1 = $_SESSION[ljs_pass1];
$ljs_name = $_SESSION[ljs_name];

if (!$ljs_memberid  || !$ljs_pass1) {
	$result = mysql_query("select name from $member_group order by id asc limit 0,2");

	$json_data = array();
	while ($rows = mysql_fetch_array($result)) {
		$mg_name = $rows[name];
		array_push($json_data, array("label"=>$mg_name));
	}
	$strJson = JsonEncoder::getInstance()->parse($json_data);

	include "skin/default/login.php";
} else {

	echo $ljs_name;
	echo "&nbsp;";
	echo "님";

	$result = mysql_query("select * from $ljs_member where ljs_memberid='$ljs_memberid' ");
	$row = mysql_fetch_array($result);
	$hit = $row[hit];
	$point2 = $row[point];
	
	echo "<font color=red>".number_format($point2)."&nbsp;원</font>";

	echo $hit; 
	echo "&nbsp;번째 방문";

	include "skin/default/login.on.php";
}
?>