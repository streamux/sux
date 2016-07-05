<?php

define(_SUX_PATH_, str_replace('config/config.inc.php', '', str_replace('\\','/', __FILE__)));

$GLOBALS['__sux_autoload_file_map'] = array_change_key_case(array(
	'JsonEncoder'=>'/classes/utils/jsonencoder.class.php'
), CASE_LOWER);

$GLOBALS['__sux_autoload_file_map_directory'] = array('modules', 'classes');

function __sux_autoload($class_name) {

	 if(isset($GLOBALS['__sux_autoload_file_map'][strtolower($class_name)])) {

		require _SUX_PATH_ . $GLOBALS['__sux_autoload_file_map'][strtolower($class_name)];
		
	} else if(preg_match('/^([a-zA-Z0-9_]+?)(View|Controller|Model|Api|Wap|Mobile)?$/', $class_name, $matches)) {

		for ($i=0; $i<count($GLOBALS['__sux_autoload_file_map_directory']); $i++) {
			$candidate_filename = array();
			$candidate_filename[] = $GLOBALS['__sux_autoload_file_map_directory'][$i] . '/' . strtolower($matches[1]) . '/' . strtolower($matches[1]);
			$candidate_filename[] = (isset($matches[2]) && $matches[2]) ? strtolower($matches[2]) : 'class';
			$candidate_filename[] = 'php';

			$candidate_filename = implode('.', $candidate_filename);
			if(file_exists(_SUX_PATH_ . $candidate_filename)) {
				require _SUX_PATH_ . $candidate_filename;
			}
		}		
	}
}
spl_autoload_register('__sux_autoload');
?>