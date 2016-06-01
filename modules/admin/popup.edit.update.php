<?
include "../lib.php";

$edit_id = $_POST['id'];
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

$result = mysql_query("update $popup set name='$popupname',choice='$popupchoice',time1='$popuptime1',time2='$popuptime2',time3='$popuptime3',time4='$popuptime4',time5='$popuptime5',time6='$popuptime6',title='$popuptitle',width='$popupwidth',height='$popupheight',w_top='$popuptop',w_left='$popupleft',url='$popupurl',skin_top='$skin_top',skin_left='$skin_left',skin_right='$skin_right',comment='$pucomment' where id=$edit_id");

if (!$result){
	$msg = "팝업창 수정을 실패하였습니다.";
}else{
	$msg = "팝업창 수정을 성공하였습니다.";
}

$json_data = array(	"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>
