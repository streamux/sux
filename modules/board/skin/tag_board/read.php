<?
$result0=mysql_query("select see from $board where id=$id");
$row0=mysql_fetch_array($result0);
$see=$row0[see]+1;
$sql=mysql_query("update $board set see=$see where id=$id");
$result=mysql_query("select * from $board where id=$id");
$row=mysql_fetch_array($result);
$storycomment=$row[comment];
$storycomment=str_replace("$search","<font color=red>$search</font>",$storycomment);
$name=htmlspecialchars($row[name]);
$pass=$row[pass];
$storytitle=$row[title];
$storytitle=substr(htmlspecialchars($storytitle),0,40);
$email=$row[email];
$fileupname=$row[filename];
$filesize=$row[filesize];

include "read_inc.php"
?>