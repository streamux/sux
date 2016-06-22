<?
$result = mysql_query("select name from $member_group order by id asc");

$json_data = array();
while ($rows = mysql_fetch_array($result)) {
	$mg_name = $rows[name];
	array_push($json_data, array("label"=>$mg_name));
}
$strJson = JsonEncoder::getInstance()->parse($json_data);
?>