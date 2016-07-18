<?php

if (!$page) {
	$page = 1;
}

$passoverpage = $limit * 10;
$nextpage = $page+1;
$befopage = $page-1;
$prevpassover = ($befopage * $passoverpage)-$passoverpage; 
$hanpassoverpage = $page*$passoverpage;
$newpassover = ($nextpage * $passoverpage)-$passoverpage; 
$nowpage = ($page*10)-9;
$nowpageend = $page*10;

if ($page ==1) {
	$okpage ="yes";
}

if ($okpage !== "yes"){
	echo  "<a href=$PHP_SELF?board=$board&board_grg=$board_grg&sid=$sid&id=$id&passover=$prevpassover&page=$befopage&find=$find&search=$search&action=$action>이전</a>";			
}

for ($i=$nowpage; $i<=$nowpageend; $i++) {
	$nowpassover=$limit*($i-1);

	if ($numrows > $nowpassover) {
		if ($passover != $nowpassover ){
			echo "<a href=$PHP_SELF?board=$board&board_grg=$board_grg&sid=$sid&id=$id&passover=$nowpassover&page=$page&find=$find&search=$search&action=$action>[${i}]</a>";
		} else {
			echo "&nbsp;<font color=blue>${i}</font>&nbsp;";
		}
	}
}

if ($numrows >= $hanpassoverpage) {
	echo  "<a href=$PHP_SELF?board=$board&board_grg=$board_grg&sid=$sid&id=$id&passover=$newpassover&page=$nextpage&find=$find&search=$search&action=$action>다음</a>";
}
?>