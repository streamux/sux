<?
$resultStr = "Y";
$msg = "";

$result = mysql_query(	"create table $board_group". 
						"(id int not null auto_increment primary key,".
						"name varchar(30) not null,".
						"width varchar(10) not null,".
						"include1 varchar(50) null,".
						"include2 varchar(50) null,".
						"include3 varchar(50) null,".
						"date datetime,".
						"w_admin char(1),".
						"r_admin char(1),".
						"rw_admin char(1),".
						"re_admin char(1),".
						"listnum char(2),".
						"tail char(2),".
						"download char(2),".
						"setup char(2),".
						"w_grade char(2),".
						"r_grade char(2),".
						"rw_grade char(2),".
						"re_grade char(2),".
						"log_key char(3),".
						"limit_choice varchar(10),".
						"limit_word varchar(255),".
						"board_name varchar(30),".
						"type char(4),". 
						"output char(3))");
if (!$result) {
	$msg .= "$board_group [게시판그룹] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$board_group [게시판그룹] 테이블 생성을 성공하였습니다.\n";
}

$result = mysql_query(	"create table $member_group". 
						"(id int not null auto_increment primary key,".
						"name varchar(30) not null,".
						"date datetime)");
if (!$result) {
	$msg .= "$member_group [멤버그룹] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$member_group [멤버그룹] 테이블 생성을 성공하였습니다.\n";
}

$result=mysql_query(	"create table $question".  
						"(id int not null auto_increment primary key,".
						"title varchar(200),".
						"jilmunno int,".
						"comment text,".
						"time1 int(2),".
						"time2 int(2),".
						"time3 int(2),".
						"time4 int(2),".
						"time5 int(2),".
						"time6 int(4),".
						"hit int,".
						"igroup int)");  
if (!$result) {
	$msg .= "$question [설문] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$question [설문] 테이블 생성을 성공하였습니다.\n";
}

$result=mysql_query(	"create table $questiont".  
						"(id int not null auto_increment primary key,".
						"jilmunno int,".
						"igroup int)");
if (!$result) {
	$msg .= "questiont [총 참가자 수] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "questiont [총 참가자 수] 테이블 생성을 성공하였습니다.\n";
}

$result=mysql_query(	"create table questionc".  
						"(title varchar(60),".
						"setup char(2),".
						"choice int(4),".
						"q_width int(4),".
						"q_height int(4),".
						"q_top int(4),".
						"q_left int(4))");  
if (!$result) {
	$msg .= "questionc [설문 설정] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "questionc [설문 설정] 테이블 생성을 성공하였습니다.\n";
}

$result=mysql_query(	"create table $popup".
						"(id int not null auto_increment primary key,".
						"name varchar(30) not null,".
						"choice char(1),".
						"time1 int(2),".
						"time2 int(2),".
						"time3 int(2),".
						"time4 int(2),".
						"time5 int(2),".
						"time6 int(4),".
						"title varchar(30),".
						"width int(4),".
						"height int(4),".
						"w_top int(4),".
						"w_left int(4),".
						"url varchar(30),".
						"skin_top int(4),".
						"skin_left int(4),".
						"skin_right int(4),".
						"comment text)");		
if (!$result) {
	$msg .= "$popup [팝업창] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$popup [팝업창] 테이블 생성을 성공하였습니다.\n";
}

$result = mysql_query(	"create table $calender".  
						"(id int not null auto_increment primary key,".
						"nyeon int(4),".
						"wol int(2),".
						"il int(2),".
						"comment text,".
						"ljs_memberid varchar(30),".
						"date date)");  
if (!$result) {
	$msg .= "dayman [일정관리] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
}

$result = mysql_query(	"create table $connecter_all". 
						"(hit int,".
						"checky char(1))");
if (!$result) {
	$msg .= "$connecter_all [전체 접속수분석] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {	
	$msg .= "$connecter_all [전체 접속수분석] 테이블 생성을 성공하였습니다.\n";

	$qresult = mysql_query("insert into $connecter_all values ('0','y')");
	if (!$qresult) {
		$msg .= "$connecter_real_all [전체 접속수분석] 레코드 등록을 실패하였습니다.\n";
	} else {
		$msg .= "$connecter_real_all [전체 접속수분석] 레코드 등록을 성공하였습니다.\n";
	}
}

$result = mysql_query(	"create table $connecter". 
						"(id int not null auto_increment primary key,".
						"ip varchar(30),".
						"date date)");
if (!$result) {
	$msg .= "$connecter [접속수분석] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$connecter [접속수분석] 테이블 생성을 성공하였습니다.\n";
}

$result = mysql_query(	"create table $connecter_real_all". 
						"(hit int,".
						"checky char(1))");

if (!$result) {
	$msg .= "$connecter_real_all [전체 실접속자분석] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$connecter_real_all [전체 실접속자분석] 테이블 생성을 성공하였습니다.\n";

	$qresult = mysql_query("insert into $connecter_real_all values ('0','y')");
	if (!$qresult) {
		$msg .= "$connecter_real_all [전체 실접속자분석] 레코드 등록을 실패하였습니다.\n";
	} else {
		$msg .= "$connecter_real_all [전체 실접속자분석] 레코드 등록을 성공하였습니다.\n";
	}
}

$result = mysql_query(	"create table $connecter_real". 
						"(id int not null auto_increment primary key,".
						"ip varchar(30),".
						"date date)");
if (!$result) {
	$msg .= "$connecter_real [실접속자분석] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$connecter_real [실접속자분석] 테이블 생성을 성공하였습니다.\n";
}

$result=mysql_query(	"create table $connecter_site".
						"(id int not null auto_increment primary key,".
						"name varchar(12) not null,".
						"date datetime,".
						"hit int)");
if (!$result) {
	$msg .= "$connecter_site [접속경로분석] 테이블 생성을 실패하였습니다.\n";
	$resultStr = "N";
} else {
	$msg .= "$connecter_site [접속경로분석] 테이블 생성을 성공하였습니다.\n";
}

$result = mysql_query(	"create table $pageview".
						"(id int not null auto_increment primary key,".
						"name varchar(12) not null,".
						"date datetime,".
						"hit int)");
if (!$result) {
	$msg .= "$pageview [페이지뷰분석] 테이블 생성을 실패하였습니다.\n\n";
	$resultStr = "N";
} else {
	$msg .= "$pageview [페이지뷰분석] 테이블 생성을 성공하였습니다.\n\n";
}

if ($resultStr == "N") {
	$msg .= "확인을 누르면 3초 후 관리자 로그인 페이지로 자동 이동합니다.";
} else {
	$msg .= "데이터베이스 테이블  생성을 완료하였습니다.";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = json_encode($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
?>