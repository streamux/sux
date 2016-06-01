<? 
include "../lib.php";

$id = $_POST['id'];

$dir = "../popup/skin/";

$dataObj = null;
$skinList = array();
$msg = "";
$resultYN = "Y";

$result = mysql_query("select * from $popup where id = '$id'");

if ($result) {

	$row = mysql_fetch_array($result);

	$popupname = $row['name'];
	$popupchoice = $row['choice'];
	$popuptime1 = $row['time1'];
	$popuptime2 = $row['time2'];
	$popuptime3 = $row['time3'];
	$popuptime4 = $row['time4'];
	$popuptime5 = $row['time5'];
	$popuptime6 = $row['time6'];
	$popuptitle = $row['title'];
	$popupwidth = $row['width'];	
	$popupheight = $row['height'];
	$popuptop = $row['w_top'];
	$popupleft = $row['w_left'];
	$skin = $row['url'];
	$skin_top = $row['skin_top'];
	$skin_left = $row['skin_left'];
	$skin_right = $row['skin_right'];
	$pucomment = $row['comment'];

	//$msg .= urlencode($pucomment);

	if ($handle = opendir($dir)) { 

		while (false !== ($file = readdir($handle))) { 

				if ($file != "." && $file != "..") {
					array_push($skinList, array("file_name"=>$file));					
				} 
		} 
		closedir($handle); 
	} 

	$dataObj = array("popupname"=>$popupname,"popupchoice"=>$popupchoice,"popuptime1"=>$popuptime1,"popuptime2"=>$popuptime2,"popuptime3"=>$popuptime3,"popuptime4"=>$popuptime4,"popuptime5"=>$popuptime5,"popuptime6"=>$popuptime6,"popuptitle"=>$popuptitle,"popupwidth"=>$popupwidth,"popupheight"=>$popupheight,"popuptop"=>$popuptop,"popupleft"=>$popupleft,"skin"=>$skin,"skin_top"=>$skin_top,"skin_left"=>$skin_left,"skin_right"=>$skin_right,"pucomment"=>$pucomment,"skinList"=>$skinList);

} else {
	$msg = "팝업이 존재하지 않습니다.";
	$resultYN = "N";
}

$json_data = array(	"data"=>$dataObj,
					"result"=>$resultYN,
					"msg"=>$msg);

$strJson = JsonEncoder::getInstance()->parse($json_data);
echo $_REQUEST['callback'].'('.$strJson.')';
mysql_close();
?>