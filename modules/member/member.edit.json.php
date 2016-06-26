<? 
include "../lib.php";

$table_name = $_POST['table_name'];
$memberid = $_POST['memberid'];

$dataObj = null;
$msg = "";
$resultYN = "Y";

$result = mysql_query("select * from $table_name where ljs_memberid = '$memberid'");

if ($result) {

	$row = mysql_fetch_array($result);

	$id = $row['id'];
	$pwd1 = $row['pwd1'];
	$pwd2 = $row['pwd2'];
	$name = $row['name'];
	$email = $row['email'];
	$tel1 = $row['tel1'];
	$tel2 = $row['tel2'];
	$tel3 = $row['tel3'];
	$hp1 = $row['hp1'];
	$hp2 = $row['hp2'];
	$hp3 = $row['hp3'];
	$companyname = $row['company'];
	$job = $row['job'];
	$hobby = $row['hobby'];
	$path = $row['path'];
	$proposeid = $row['proposeid'];
	$date = $row['date'];
	$writer = $row['writer'];
	$point = $row['point'];
	$grade = $row['grade'];
	$ip = $row['ip'];

	$emailList = split("@", $email );

	$dataObj = array("table_name"=>$table_name,"id"=>$id,"memberid"=>$memberid,"pwd1"=>$pwd1,"pwd2"=>$pwd2,"name"=>$name,"email"=>$emailList[0],"email_tail2"=>$emailList[1],"tel1"=>$tel1,"tel2"=>$tel2,"tel3"=>$tel3,"hp1"=>$hp1,"hp2"=>$hp2,"hp3"=>$hp3,"companyname"=>$companyname,"job"=>$job,"hobby"=>$hobby,"path"=>$path,"proposeid"=>$proposeid,"date"=>$date,"writer"=>$writer,"point"=>$point,"grade"=>$grade,"ip"=>$ip);

} else {
	$msg = "$memberid 회원이 존재하지 않습니다.";
	$resultYN = "N";
}

$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>