<?
$file_name = "config.php";
$result = @chmod($file_name,0777);

if (!$result) {
	echo "$file_name 권한설정 실패!";
	
}else{	
	echo "$file_name 권한설정 성공!";
}
?>