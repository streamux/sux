<?php
/**
 * author streamux@naver.com
 * update 2017.08.22
 */

$dirPathList = array('files/','templates_c/');
$counter = 0;

function deleteDir($dirPath)
{
	global $dirPathList;
	global $counter;

	if (!is_dir($dirPath)) {
		if (file_exists($dirPath) !== false) {
			unlink($dirPath);
		}
		return;
	}

	if ($dirPath[strlen($dirPath) - 1] != '/') {
		$dirPath .= '/';
	}

	$files = glob($dirPath . '*', GLOB_MARK);
	foreach ($files as $file) {    	

		echo $file . "<br>";
		if (is_dir($file)) {
			deleteDir($file);
		} else {       	
			unlink($file);
		}
	}
	rmdir($dirPath);

	$counter++;
	if (isset($dirPathList[$counter]) && $dirPathList[$counter]) {
		deleteDir($dirPathList[$counter]);
	}
}
deleteDir($dirPathList[$counter]);
?>