<?
$htmlData = $_POST['comment'];

if (isset($htmlData)) {
	$result = '';
	$fp = fopen("sux_main_contents.tpl", "w");

	fwrite($fp, $htmlData);
	fclose($fp);
}
?>
