<?
$result0=mysql_query("select see from $board where id=$id");
$row0=mysql_fetch_array($result0);
$see=$row0[see]+1;
$sql=mysql_query("update $board set see=$see where id=$id");
$result=mysql_query("select * from $board where id=$id");
$row=mysql_fetch_array($result);
$storycomment=str_replace("$search","<font color=red>$search</font>",$storycomment);
$name=htmlspecialchars($row[name]);
$pass=$row[pass];
$storytitle=nl2br($row[title]);
$storytitle=substr(htmlspecialchars($storytitle),0,50);
$email=$row[email];
$fileupname=$row[filename];
$filesize=$row[filesize];
$type=$row[type];
if($admin_type == 'all'){
	if($type=='html'){
		$storycomment= $row[comment];
	}else if($type == 'text'){
		$storycomment= nl2br($row[comment]);
	}
}else if($admin_type == 'html') {
	$storycomment= $row[comment];
}else{
	$storycomment= nl2br($row[comment]);
}

include "read_inc.php"
?>