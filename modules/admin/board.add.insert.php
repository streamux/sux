<?
include "../lib.php";

$table_name = $_POST['table_name'];
$width = $_POST['width'];
$include1 = $_POST['include1'];
$include2 = $_POST['skin'];
$include3 = $_POST['include3'];
$w_admin = $_POST['w_admin'];
$r_admin = $_POST['r_admin'];
$rw_admin = $_POST['rw_admin'];
$re_admin = $_POST['re_admin'];
$listnum = $_POST['listnum'];
$tail = $_POST['tail'];
$download = $_POST['download'];
$setup = $_POST['setup'];
$w_grade = $_POST['w_grade'];
$r_grade = $_POST['r_grade'];
$rw_grade = $_POST['rw_grade'];
$re_grade = $_POST['re_grade'];
$log_key = $_POST['log_key'];
$limit_choice = $_POST['limit_choice'];
$limit_word = $_POST['limit_word'];
$board_name = $_POST['board_name'];
$type = $_POST['type'];
$output = $_POST['output'];

$dir = "../../board_data/";

$resultYN = "Y";
$msg = "";

if (!is_dir($dir)) {
	if (@mkdir($dir, 0777)) {
		$msg = "게시판 자료저장  폴더를 생성하였습니다.\n";
		$resultYN = "Y";
	} else {
		$msg = "게시판 자료저장  폴더를 생성 실패하였습니다.\n";
		$resultYN = "N";
	}	
} 

$result = mysql_query(	"create table $table_name". 
						"(id int not null auto_increment primary key,".
						"name varchar(30) not null,".
						"pass varchar(20) not null,".
						"title varchar(120) not null,".
						"comment text not null,".
						"email varchar(30),".
						"date date,".
						"ip varchar(30),".
						"see int,".
						"opkey char(1),".
						"igroup int,".
						"space int,".
						"ssunseo int,".		
						"wall char(1),".
						"filename varchar(50),".
						"filesize varchar(50),".
						"filetype varchar(50),".
						"type char(4))");

if (!$result) {
	$msg .= "${table_name}테이블이 이미 생성 되었습니다.\n";
	$resultYN = "N";
} else {
	$qresult = mysql_query("insert into $table_name values ('','운영자','1234','게시판 시동 테스트','본 게시물은 게시판 시동을 위해 자동 등록된 것입니다.<br> 본 게시물을 삭제하기 전에 반드시 하나를 등록하시기 바랍니다.','',now(),'$REMOTE_ADDR',0,'',1,0,0,'a','','','','')");

	if (!$qresult) {
		$msg .= "${table_name}테이블에 시동 게시글 등록을 실패하였습니다.\n";		
	} else {
		$msg .= "${table_name}테이블이 정상적으로 생성 되었습니다.\n";
	}	

	$result2 = mysql_query("insert into $board_group values ('','$table_name','$width','$include1','$include2','$include3',now(),'$w_admin','$r_admin','$rw_admin','$re_admin','$listnum','$tail','$download','$setup',$w_grade,$r_grade,$rw_grade,$re_grade,'$log_key','$limit_choice','$limit_word','$board_name','$type','$output')");

	if (!$result2) {
		$msg .= "${table_name}을 그룹테이블 등록에 실패하였습니다.\n";
	}else{
		$msg .= "${table_name}을 그룹테이블 등록에 성공하였습니다.\n";		
	}

	$table_name_gg = $table_name."_grg";
	$result = mysql_query(	"create table $table_name_gg". 
							"(id int not null auto_increment primary key,".
							"storyid varchar(15),".
							"nickname varchar(12),".
							"pass varchar(30),".
							"comment text,".
							"date date)");
	if (!$result) {
		$msg .= "${table_name_gg}꼬리글 테이블 생성을 실패하였습니다.\n";
	} else {
		$msg .= "${table_name_gg}꼬리글 테이블 생성을 성공하였습니다.\n";
	}

	$dir = $dir.$table_name;

	if (!@mkdir( $dir, 0777)) {
		$msg .= "${table_name}디렉토리가 이미 생성 되었습니다.";
	} else {
		$msg .= "${table_name}디렉토리 폴더가 생성 되었습니다";
	}
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>