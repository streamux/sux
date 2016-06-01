<script language="JavaScript">
<!--

function setCookie( name, value, expiredays )
{
	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}
function getCookie( name )
{
	var smxpopCookie = name + "=";
	var i = 0;
	while ( i <= document.cookie.length )
	{
		var e = (i+smxpopCookie.length);
		if ( document.cookie.substring( i, e ) == smxpopCookie ) {
			if ( (popendCookie=document.cookie.indexOf( ";", e )) == -1 )
				popendCookie = document.cookie.length;
			return unescape( document.cookie.substring( e, popendCookie ) );
		}
		i = document.cookie.indexOf( " ", i ) + 1;
		if ( i == 0 )
			break;
	}
	return "";
}
//--></script>
<?
$num=0;
$query="select * from popup";
$result=mysql_query($query);
while($row=mysql_fetch_array($result)) {
	$sjtime=mktime($row[time1],$row[time2],$row[time3],$row[time4],$row[time5],$row[time6]);
	$nowtime=mktime();
	$popupwidth=$row[width];
	$popupheight=$row[height];
	$popuptop=$row[w_top];
	$popupleft=$row[w_left];
	$popwinname=smxpop.$num;
	if (($row[choice] == "y") && ($nowtime < $sjtime)) {
?>
<script language="JavaScript">
if ( getCookie( "<? echo $popwinname; ?>" ) != "nooppop" )
{
	SmxpopWindow  =  window.open('../board/popup.php?id=<? echo $row[id]; ?>&popwinname=<? echo $popwinname; ?>','<? echo $popwinname; ?>','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=auto,resizable=no,left=<? echo $popupleft; ?>,top=<? echo $popuptop; ?>,width=<? echo $popupwidth; ?>,height=<? echo $popupheight; ?>');
	SmxpopWindow.opener = self;
}
//--></script>
<?
}
$num++;
}
?>
<?
$query2=mysql_query("select * from questionc");
$row2=mysql_fetch_array($query2);
$qsetup=$row2[setup];
$qwidth=$row2[q_width];
$qheight=$row2[q_height];
$qtop=$row2[q_top];
$qleft=$row2[q_left];
if($qsetup == "y") {
?>
<script language="JavaScript">
if ( getCookie( "questionpop" ) != "nooppop2" )
{
	SmxpopWindow  =  window.open('../board/question_start.php','questionpop','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=auto,resizable=no,left=<? echo $qleft; ?>,top=<? echo $qtop; ?>,width=<? echo $qwidth; ?>,height=<? echo $qheight; ?>');
	SmxpopWindow.opener = self;
}
//--></script>
<?
}
?>