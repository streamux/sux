<?php

define(_SUX_PATH_, str_replace('config/config.inc.php', '', str_replace('\\','/', __FILE__)));

$GLOBALS['__sux_autoload_file_map'] = array_change_key_case(array(
	'JsonEncoder'=>'classes/utils/JsonEncoder.class.php',
	'Navigator'=>'classes/plugin/navigator.class.php',
	'Query'=>'classes/db/query.class.php',
	'QueryWhere'=>'classes/db/query.where.class.php',
	'QuerySchema'=>'classes/db/query.schema.class.php',
	'Smarty'=>'libs/smarty/Smarty.class.php',
	'Utils'=>'classes/utils/utils.class.php',
	'UtilsString'=>'classes/utils/utils.string.class.php'
), CASE_LOWER);

$GLOBALS['__sux_autoload_file_map_directory'] = array('modules', 'classes');

function __sux_autoload($class_name) {

	 if(isset($GLOBALS['__sux_autoload_file_map'][strtolower($class_name)])) {
		require _SUX_PATH_ . $GLOBALS['__sux_autoload_file_map'][strtolower($class_name)];
		
	} else if(preg_match('/(^[a-zA-Z0-9_]+?)(Admin)?(View|Controller|Model|Api|Wap|Mobile)?$/', $class_name, $matches)) {

		for ($i=0; $i<count($GLOBALS['__sux_autoload_file_map_directory']); $i++) {
			$candidate_filename = array();
			$candidate_filename[] = $GLOBALS['__sux_autoload_file_map_directory'][$i] . '/' . strtolower($matches[1]) . '/' . strtolower($matches[1]);
			if (isset($matches[2]) && $matches[2]) $candidate_filename[] = 'admin';
			$candidate_filename[] = (isset($matches[3]) && $matches[3]) ? strtolower($matches[3]) : 'class';
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