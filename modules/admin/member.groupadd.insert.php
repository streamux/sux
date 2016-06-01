<?
include "../lib.php";

$table_name = $_POST["table_name"];

$dataObj	= "";
$msg = "";
$resultYN = "Y";

$result = mysql_query(	"create table $table_name". 
						"(id int not null auto_increment primary key,".
						"ljs_memberid varchar(12) not null,". 
						"ljs_pass1 varchar(12) not null,". 
						"ljs_pass2 varchar(12) not null,". 
						"name varchar(12) not null,".
						"jumin1 int(6) not null,".
						"jumin2 int(7) not null,".  
						"email varchar(30),". 
						"tel1 char(3),".
						"tel2 char(4),".
						"tel3 char(4),".
						"hp1 char(3),".
						"hp2 char(4),".
						"hp3 char(4),".
						"post1 varchar(3),".
						"post2 varchar(3),".
						"addres varchar(90),".  
						"company varchar(12) not null,".
						"ctel1 char(3),". 
						"ctel2 char(4),".
						"ctel3 char(4),".
						"fax1 char(3),".
						"fax2 char(4),".
						"fax3 char(4),".
						"home varchar(90),".
						"recordnum varchar(30),".
						"job char(20),". 
						"hobby varchar(40),". 
						"path char(20),". 
						"proposeid char(20),". 
						"date date,".
						"hit int,". 
						"writer varchar(5),".
						"point int(11),".
						"grade int(11),".
						"ip varchar(30))");

if (!$result) {
	$msg = "$table_name 테이블 생성을 실패하였습니다.";
	$resultYN = "N";
} else {
	$result2 = mysql_query("insert into $member_group values ('','$table_name',now())");

	if (!$result2) {
		$msg = "$table_name 테이블 생성을 실패하였습니다.";
		$resultYN = "N";		
	} else {
		$msg = "$table_name 테이블 생성을 완료하여였습니다.";
	}
}

$json_data = array(	"member"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>