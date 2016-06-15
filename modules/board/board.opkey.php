<?
include "../../lib.php";

if ($ch == "y"){ 	
	$dbup = "update $board set opkey='$opkey' where id=$id ";
	$result=mysql_query($dbup);
	echo ("<meta http-equiv='Refresh' content='0; URL=board_list.php?board=$board&board_grg=$board_grg'>");
}
mysql_close();
?>