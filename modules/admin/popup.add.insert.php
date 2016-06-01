<?
include "../lib.php";

$popupname = $_POST['popupname'];
$popupchoice = $_POST['popupchoice'];
$popuptime1 = $_POST['popuptime1'];
$popuptime2 = $_POST['popuptime2'];
$popuptime3 = $_POST['popuptime3'];
$popuptime4 = $_POST['popuptime4'];
$popuptime5 = $_POST['popuptime5'];
$popuptime6 = $_POST['popuptime6'];
$popuptitle = $_POST['popuptitle'];
$popupwidth = $_POST['popupwidth'];
$popupheight = $_POST['popupheight'];
$popuptop = $_POST['popuptop'];
$popupleft = $_POST['popupleft'];
$popupurl = $_POST['skin'];
$skin_top = $_POST['skin_top'];
$skin_left = $_POST['skin_left'];
$skin_right = $_POST['skin_right'];
$pucomment = $_POST['pucomment'];

$dataList = array();
$msg = "";
$resultYN = "Y";

$table_name = $popup;
$result = mysql_query("select name from $table_name where name='$popupname'");
$numrows = mysql_num_rows($result);

if ($numrows > 0) {
	$msg = "팝업창 이름이 이미 존재합니다.";
	$resultYN = "N";
} else {
	$puinsert =mysql_query("insert into $table_name values('','$popupname','$popupchoice','$popuptime1','$popuptime2','$popuptime3','$popuptime4','$popuptime5','$popuptime6','$popuptitle','$popupwidth','$popupheight','$popuptop','$popupleft','$popupurl','$skin_top','$skin_left','$skin_right','$pucomment')");

	if (!$puinsert){
		$msg = "팝업창 입력 실패!";
		$resultYN = "N";
	}else{
		$msg = "팝업창 입력 성공";
	}
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
