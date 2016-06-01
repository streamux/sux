<?
session_start();
include "lib.php";

$result=mysql_query("select * from control_box where name='$board'");
$row=mysql_fetch_array($result);
$name=$row[name];
$width=$row[width];
$include1=$row[include1];
$include2=$row[include2];
$include3=$row[include3];
$day=$row[date];
$w_admin=$row[w_admin];
$r_admin=$row[r_admin];
$rw_admin=$row[rw_admin];
$re_admin=$row[re_admin];
$listnum=$row[listnum];
$limit_word=$row[limit_word];
$tail=$row[tail];
$download=$row[download];
$setup=$row[setup];
$w_grade=$row[w_grade];
$r_grade=$row[r_grade];
$rw_grade=$row[rw_grade];
$re_grade=$row[re_grade];
$log_key=$row[log_key];
$admin_type=$row[type];


if($log_key == yes){
	if(!$HTTP_SESSION_VARS[grade]){
		$level = 1;
	}else{
		$level=$HTTP_SESSION_VARS[grade];
	}
	if($level > $r_grade){
		if($r_admin == n){
			include "admin_check.php"; // 관리자 체크
			}
			if($include1){
				include "$include1"; // 상단 출력
			}else{
				echo "상단 파일경로를 입력해 해주세요! 예)파일명.php";
			}
			if($include2){
				include "skin"."/"."$include2"."/"."read.php";
			}else{
				echo " 스킨을 선택해주세요!";
			}
			if($include3){
				include "$include3"; // 하단 출력
			}else{
				echo "하단 파일경로를 입력해 해주세요! 예)파일명.php";
			}
	}else{
		echo ("
		<script>
			alert('죄송합니다! 읽기권한이 없습니다.')
			history.go(-1)
		</script>
			");
		exit;
	}
}else{
	if(!$HTTP_SESSION_VARS[ljs_name] || !$HTTP_SESSION_VARS[ljs_pass1]){
		if($include1){
			include "$include1"; // 상단 출력
		}else{
			echo "상단 파일경로를 입력해 해주세요! 예)파일명.php";
		}
		include "login_no.php";
		if($include3){
			include "$include3"; // 하단 출력
		}else{
			echo "하단 파일경로를 입력해 해주세요! 예)파일명.php";
		}
	}else{
		if($HTTP_SESSION_VARS[grade] > $r_grade){
			if($r_admin == n){
				include "admin_check.php"; // 관리자 체크
			}
			if($include1){
				include "$include1"; // 상단 출력
			}else{
				echo "상단 파일경로를 입력해 해주세요! 예)파일명.php";
			}
			if($include2){
				include "skin"."/"."$include2"."/"."read.php";
			}else{
				echo " 스킨을 선택해주세요!";
			}
			if($include3){
				include "$include3"; // 하단 출력
			}else{
				echo "하단 파일경로를 입력해 해주세요! 예)파일명.php";
			}
		}else{
			echo ("
			<script>
				alert('죄송합니다! 읽기권한이 없습니다.')
				history.go(-1)
			</script>
				");
			exit;
		}
	}
}
?>