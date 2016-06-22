<?
include "../lib.php";

$table_name = $_POST['table_name'];
$id = $_POST['id'];
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

$pwd1=substr(md5($pwd1),0,8);
$pwd2=substr(md5($pwd2),0,8);

$dataObj	= "";
$msg = "";
$resultYN = "Y";

$result2 = mysql_query("update $table_name set ljs_pass1='$pwd1', ljs_pass2='$pwd2',name='$name',jumin1='$jumin1',jumin2='$jumin2',email='$email',tel1='$tel1',tel2='$tel2',tel3='$tel3',hp1='$hp1',hp2='$hp2',hp3='$hp3',post1='$post1',post2='$post2',addres='$addres',company='$companyname', ctel1='$ctel1', ctel2='$ctel2', ctel3='$ctel3',ctel3='$ctel3',fax1='$fax1',fax2='$fax2',fax3='$fax3',home='$home',recordnum='$recordnum',job='$job',hobby='$hobby', path='$path', proposeid='$proposeid', writer='$writer',point='$point',grade='$grade' where id=$id");

if (!$result2) {
	$msg = "$name 회원정보 수정을 실패하였습니다.";
	$resultYN = "N";	
} else {
	$msg = "$name 회원정보 수정을 성공하였습니다.";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>