

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

<script type="text/javascript">
if ( getCookie( "questionpop" ) != "___sux_question" ) {

	SmxpopWindow  =  window.open('../board/question_start.php','questionpop','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=auto,resizable=no,left=<? echo $qleft; ?>,top=<? echo $qtop; ?>,width=<? echo $qwidth; ?>,height=<? echo $qheight; ?>');
	SmxpopWindow.opener = self;
}
//--></script>
<?
}
?>