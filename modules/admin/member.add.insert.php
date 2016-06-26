<?
include "../lib.php";

$table_name = $_POST['table_name'];
$memberid = $_POST['memberid'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];
$name = $_POST['name'];
$email = $_POST['email'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];
$tel3 = $_POST['tel3'];
$hp1 = $_POST['hp1'];
$hp2 = $_POST['hp2'];
$hp3 = $_POST['hp3'];
$companyname = $_POST['companyname'];
$recordnum = $_POST['recordnum'];
$job = $_POST['job'];
$hobby = $_POST['hobby'];
$path = $_POST['path'];
$proposeid = $_POST['proposeid'];
$writer = $_POST['writer'];
$point = $_POST['point'];
$grade = $_POST['grade'];


$dataObj = "";
$msg = "";
$resultYN = "Y";

if(!ereg('@',$email)) {
	 $msg = "잘못된 E-mail 주소입니다.";
	 $resultYN = "N";
} else {

	$result1=mysql_query("select ljs_memberid from $table_name where ljs_memberid='$memberid'");
	$num1=mysql_num_rows($result1);

	if ($num1 > 0){
		 $msg = "같은 아이디가 존재합니다.";
		 $resultYN = "N";		
	} else {

		if ($companyname) {
			$queryy2="select company from $table_name where company='$companyname'";
			$result2=mysql_query($queryy2);
			$num2=mysql_num_rows($result2);

			if ($num2 > 0) {
				$msg = "같은 회사명이 존재합니다.";
				 $resultYN = "N";

				 $json_data = array("result"=>$resultYN,
									 "msg"=>$msg);

				$strJson = json_encode($json_data);

				echo $_REQUEST['callback'].'('.$strJson.')';
				exit;
			} 
		}

		$pwd1 = substr(md5($pwd1),0,8);
		$pwd2 = substr(md5($pwd2),0,8);

		$result = mysql_query("insert into $table_name values('','$memberid','$pwd1','$pwd2','$name','$jumin1','$jumin2','$email','$tel1','$tel2','$tel3','$hp1','$hp2','$hp3','$post1','$post2','$addres','$companyname','$ctel1','$ctel2','$ctel3','$fax1','$fax2','$fax3','$home','$recordnum','$job','$hobby','$path','$proposeid',now(),0,'$writer','$point','$grade','$_SERVER[REMOTE_ADDR]')");

		if(!$result) {
			$msg = "회원등록을 실패하였습니다.";
			$resultYN = "N";				
		}else{
			$msg = "회원등록이 완료되었습니다.";
		}		
	}	
}

$json_data = array(	"member"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>