<?
include "../lib.php"; 

$passover = $_POST["passover"];
$limit = $_POST["limit"];

$dataObj = null;
$connecterArr = null;
$memberArr = null;
$boardArr = null;
$pageviewArr = null;
$promotionArr = null;
$serviceConfig = null;

$msg = "";
$resultYN = "Y";


$result15 = mysql_query("select * from $connecter_all");

if ($result15){
	$row15 = mysql_fetch_array($result15);
	$totalhit = $row15['hit'];

	$jsjdeldate = date("Y-m-d", time()-86400); 
	$delresult1 = mysql_query("delete from $connecter where date < '$jsjdeldate'");

	$jnumresults16 = mysql_query("select id from $connecter where date  =  now()");
	$jnumrows16 = mysql_num_rows($jnumresults16);
	$todaycon = $jnumrows16;

	$jnumresults17 = mysql_query("select id from $connecter where date < now()");
	$jnumrows17 = mysql_num_rows($jnumresults17);
	$yescon = $jnumrows17;

	$realdeldate2 = date("Y-m-d", time()-86400);
	$delresult2 = mysql_query("delete from $connecter_real where date < '$realdeldate2'");

	$jnumresults18 = mysql_query("select id from $connecter_real where date  =  now()");
	$jnumrows18 = mysql_num_rows($jnumresults18);
	$todaycon_real = $jnumrows18;

	$jnumresults19 = mysql_query("select id from $connecter_real where date < now()");
	$jnumrows19 = mysql_num_rows($jnumresults19);
	$yescon_real = $jnumrows19;
	
	$result20 = mysql_query("select * from $connecter_real_all");
	$row20 = mysql_fetch_array($result20);
	$totalhit20 = $row20['hit'];


	$connecterArr = array(	"today"=>$todaycon,
							"yester"=>$yescon,
							"total"=>$totalhit,
							"real_today"=>$todaycon_real,
							"real_yester"=>$yescon_real,
							"real_total"=>$totalhit20);
} else {
	$msg .= "접속통계 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$result7 = mysql_query("select name from $member_group");

if ($result7){
	$copyrows7 = mysql_num_rows($result7);

	if ($copyrows7 > 0) {

		$msg_warn = "";
		$groupList = array();

		while ($rows = mysql_fetch_array($result7)){			
			
			$cm_name = $rows['name'];
			$numresults7 = mysql_query("select id from $cm_name where date = now()");

			if ($numresults7){
				$numrows = mysql_num_rows($numresults7); 
			}else{
				$msg .= "멤버 테이블이 존재하지 않습니다.\n";
				$resultYN = "N";
			}

			if (!$limit) {
				$limit = 10; 
			}
			
			if (!$passover) {
				 $passover = 0;
			}
			$lm_name = ucfirst($cm_name);

			$result = mysql_query("select * from $cm_name where date = now() ORDER BY id desc limit $passover,$limit");

			if ($result) {
				$numrows2 = mysql_num_rows($result);
			}
			$a = $numrows - $passover;

			if ($numrows2 > 0){
				$memberList = array();
		
				while ($row = mysql_fetch_array($result)){
					$adm_id = $row['id'];
					$adm_memberid = $row['ljs_memberid'];
					$adm_name = $row['name'];
					$adm_day = $row['date'];
					$adm_hit = $row['hit'];
					$adm_grade = $row['grade'];

					array_push($memberList, array(	"no"=>$a,
														"id"=>$adm_id,
														"memberid"=>$adm_memberid,
														"name"=>$adm_name,
														"date"=>$adm_day,
														"hit"=>$adm_hit,
														"grade"=>$adm_grade));

					$a--;
				}
			}else{
				$msg_warn = "$cm_name 회원이 존재하지 않습니다.";
			}
			array_push($groupList, array(	"name"=>$cm_name,
											"list"=>$memberList,
											"msg"=>$msg_warn));			
		}

		$memberArr = array("group"=>$groupList);
	} else {
		$msg .= "회원게시판이 존재하지 않습니다.\n";
		$resultYN = "N";
	}
}else{
	$msg .= "회원그룹 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}


$result = mysql_query("select * from $board_group where output = 'yes'");

if ($result){
	$copyrows = mysql_num_rows($result);
	$rows = mysql_fetch_array($result);

	if ($rows > 0) {

		$msg_warn = "";
		$groupList = array();

		while ($rows){			

			$cb_name = $rows['name'];
			$board = $cb_name;
			$board_grg = $board."_grg";
			$cb_board_name = $rows['board_name'];			
			$lb_board_name = ucfirst($cb_board_name);
			$skin = $rows['include2'];

			$results20 = mysql_query("select * from $cb_name where date = now()");

			if ($results20){
				$numrows20 = mysql_num_rows($results20);
			}

			if ($numrows20 > 0){

				$boardList = array();

				if (!$limit) {
					$limit = 10; 
				}

				if (!$passover) {
					 $passover = 0;
				} 
		 
				$result30 = mysql_query("select * from $cb_name where date = now() order by igroup desc,ssunseo asc limit $passover,$limit");

				if ($result30) {
					$numrows30 = mysql_num_rows($result30);
				}

				$a = $numrows20-$passover;
				
				while ($row = mysql_fetch_array($result30)) {
					$sid = $row['id'];
					$title = nl2br($row['title']);
					$hit = $row['see'];
					$opkey = $row['opkey'];
					$day = $row['date'];
					$today = date("Y-m-d");					

					$space = $row['space'];

					$icon_space = "";

					if ($space){
						$icon_space = "./img/icon_answer.gif";
					} else {
						$icon_space = "./img/text.gif";
					}
					
					$icon_type = "";
					$type = $row['filetype'];

					if ($row['filename']) {
						if ($type == "image/gif") {
							$icon_type = "./img/gif.gif";
						} else if ($type == "image/pjpeg") {
							$icon_type = "./img/jpg.gif";
						} else if ($type == "image/x-png") {
							$icon_type = "./img/png.gif";
						} else if ($type == "image/bmp") {
							$icon_type = "./img/bmp.gif";
						} else if ($type == "application/x-zip-compressed") { 
							$icon_type = "./img/down.gif";
						} else {
							$icon_type = "./img/text.gif";
						}
					}

					$grgresult = mysql_query("select id from $board_grg where storyid=$sid");

					if ($grgresult){
						$grgnums = mysql_num_rows($grgresult);
					}

					$icon_new = "";

					if ($day == $today){
						$icon_new = "./img/new.gif";
					}

					$icon_opkey = "";

					switch ($opkey) {
						case 'f';
							$icon_opkey =  "./img/icon_finish.gif";
							break;
						case 'i';
							$icon_opkey =  "./img/icon_ing.gif";
							break;
						case 'c';
							$icon_opkey =  "./img/icon_cost.gif";
							break;
						case 'm';
							$icon_opkey =  "./img/icon_mail.gif";
							break;
						case 'n';
							$icon_opkey =  "./img/icon_no_cost.gif";
							break;
					}

					array_push($boardList, array(	"no"=>$a,
													"id"=>$sid,
													"title"=>$title,												
													"day"=>$day,
													"hit"=>$hit,
													"space"=>$space,
													"icon_space"=>$icon_space,
													"icon_type"=>$icon_type,
													"icon_new"=>$icon_new,
													"icon_opkey"=>$icon_opkey));

					$a--;
				}
			}else{
				$msg_warn = "${cb_name}에 게시물이 존재하지 않습니다.";
			}

			array_push($groupList, array(	"table_name"=>$cb_name,
											"board_name"=>$cb_board_name,
											"skin"=>$skin,
											"list"=>$boardList,
											"msg"=>$msg_warn));
		}

		$boardArr = array("group"=>$groupList);
	} else {
		$msg .= "노출 설정된 게시판이 존재하지 않습니다.\n";
		$resultYN = "N";
	}
}else{
	$msg .= "게시판 그룹이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$result = mysql_query("select * from $pageview ORDER BY id asc");

if ($result){
	$totalhit = 0;

	while ($row = mysql_fetch_array($result)){
		$hit = $row['hit'];
		$totalhit += $hit;
		number_format($totalhit);
	}
} else {
	$msg .= "페이지뷰등록 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$resultpv=mysql_query("select * from $pageview ORDER BY id asc");

if ($resultpv){
	$numrows=mysql_num_rows($resultpv);	

	$msg_war = "";
	$pageViewList = array();

	if ($numrows > 0){

		if (!$limit) {
			$limit = 10; 
		}

		if (!$passover) {
			$passover = 0;
		}

		$resultpv2 = mysql_query("select * from $pageview ORDER BY id desc limit $passover, $limit");
		$a = $numrows-$passover;

		while($rowpv = mysql_fetch_array($resultpv2)){
			$pvname = $rowpv['name'];
			$rowpv = $rowpv['hit'];

			array_push($pageViewList, array(	"no"=>$a,
												"name"=>$pvname,
												"hit"=>$rowpv,
												"total"=>$totalhit));
			
			$a--;
		}
	} else {
		$msg_warn = "페이지뷰 키워드가 존재하지 않습니다.";
	}

	$pageviewArr = array("list"=>$pageViewList, "total_num"=>$numrows,"limit_num"=>$limit,"msg"=>$msg_warn);

}else{
	$msg .= "페이지뷰테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$result = mysql_query("select * from $connecter_site ORDER BY id asc");

if ($result){
	$totalhit = 0;
	while ($row = mysql_fetch_array($result)){
		$hit = $row[hit];
		$totalhit += $hit;
		number_format($totalhit);
	}
}else{
	$msg .= "프로모션등록 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$resultct = mysql_query("select * from $connecter_site ORDER BY id asc");

if ($resultct){
	$numrows = mysql_num_rows($resultct);	

	$msg_warn = "";
	$connecterList = array();

	if ($numrows > 0){
		$limit = 5;

		if (!$passover) {
			$passover = 0;
		}

		$resultct2 = mysql_query("select * from $connecter_site ORDER BY id asc limit $passover, $limit");
		$a = $numrows - $passover;

		while($rowct = mysql_fetch_array($resultct2)){
			$ctname = $rowct['name'];
			$rowct = $rowct['hit'];

			array_push($connecterList, array(	"no"=>$a,
												"name"=>$ctname,
												"hit"=>$rowct,
												"total"=>$totalhit));
			
			$a--;
		}		
	}else{
		$msg_warn = "접속경로분석 키워드가 존재하지 않습니다.";
	}

	$promotionArr = array("list"=>$connecterList, "total_num"=>$numrows,"limit_num"=>$limit,"msg"=>$msg_warn);

}else{
	$msg = "페이지뷰테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}


$numresults5=mysql_query("select id from $member_group");

if ($numresults5){
	$numrows5 = mysql_num_rows($numresults5);

	if ($numrows5) {
		$memberActivate = "activate";
		$memberNum = $numrows5;
	}else{
		$memberActivate = "inactivate";
		$memberNum = 0;
	}
}else{
	$msg = "회원그룹 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$numresults4 = mysql_query("select id from $board_group");

if ($numresults4){
	$numrows4=mysql_num_rows($numresults4);

	if ($numrows4) {
		$boardActivate = "activate";
		$boardNum = $numrows4;
	}else{
		$boardActivate = "inactivate";
		$boardNum = 0;
	}
}else{
	$msg = "게시판그룹 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}


$numresults = mysql_query("select id from $popup where choice = 'y'");

if ($numresults){
	$numrows = mysql_num_rows($numresults);

	if ($numrows) {
		$popupActivate = "activate";
		$popupNum = $numrows;
	}else{
		$popupActivate = "inactivate";
		$popupNum = 0;
	}

}else{
	$msg = "팝업 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$numresults6=mysql_query("select id from $pageview");

if ($numresults6){
	$numrows6 = mysql_num_rows($numresults6);

	if ($numrows6) {
		$pageviewActivate = "activate";
		$pageviewNum = $numrows6;
	} else {
		$pageviewActivate = "inactivate";
		$pageviewNum = 0;		
	}
} else {
	$msg = "페이비뷰 테이블이 존재하지 않습니다.";
	$resultYN = "N";
}

$numresults3 = mysql_query("select id from $connecter_site");

if ($numresults3){
	$numrows3 = mysql_num_rows($numresults3);

	if ($numrows3) {
		$promotionActivate = "activate";
		$promotionNum = $numrows3;
	} else {
		$promotionActivate = "inactivate";
		$promotionNum = 0;
	}
}else{
	$msg = "접속키워드 테이블이 존재하지 않습니다.\n";
	$resultYN = "N";
}

$serviceConfig = array("memberIcon"=>$memberActivate,
						"memberNum"=>$memberNum,
						"boardIcon"=>$boardActivate,
						"boardNum"=>$boardNum,
						"popupIcon"=>$popupActivate,
						"popupNum"=>$popupNum,
						"pageviewIcon"=>$pageviewActivate,
						"pageviewNum"=>$pageviewNum,
						"analysisIcon"=>$promotionActivate,
						"analysisNum"=>$promotionNum);

$dataObj  = array(	"connecter"=>$connecterArr,
					"member"=>$memberArr,
					"board"=>$boardArr,
					"pageview"=>$pageviewArr,
					"analysis"=>$promotionArr,
					"serviceConfig"=>$serviceConfig);

$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>