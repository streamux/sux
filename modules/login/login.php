<?
session_start();

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
	$result = mysql_query("select * from $ljs_member where ljs_memberid='$ljs_memberid' ");
	$row = mysql_fetch_array($result);
	$hit = $row[hit];
	$mypoint = number_format($row[point]);

	include "skin/default/login.on.php";
}
?>