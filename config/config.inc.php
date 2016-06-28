<?php

define(_SUX_PATH_, str_replace('config/config.inc.php', '', str_replace('\\','/', __FILE__)));

$GLOBALS['__sux_autoload_file_map'] = array_change_key_case(array(
	'BaseModel'=>'classes/base/base.model.php',
	'BaseView'=>'classes/base/base.view.php',
	'BaseController'=>'classes/base/base.controller.php',
	'Context'=>'classes/context/context.class.php',
	"Error"=>'classes/error/error.class.php',
	"Object"=>'classes/object/object.class.php',
	"TemplateLoader"=>'classes/template/template.loader.php'
), CASE_LOWER);

function __sux_autoload($class_name) {

	if(isset($GLOBALS['__sux_autoload_file_map'][strtolower($class_name)])) {

		require _SUX_PATH_ . $GLOBALS['__sux_autoload_file_map'][strtolower($class_name)];	
	} else if(preg_match('/^([a-zA-Z0-9_]+?)(View|Controller|Model|Api|Wap|Mobile)?$/', $class_name, $matches)) {

		$candidate_filename = array();
		$candidate_filename[] = 'modules/' . strtolower($matches[1]) . '/' . strtolower($matches[1]);
		$candidate_filename[] = (isset($matches[2]) && $matches[2]) ? strtolower($matches[2]) : 'class';
		$candidate_filename[] = 'php';

		$candidate_filename = implode('.', $candidate_filename);

		if(file_exists(_SUX_PATH_ . $candidate_filename)) {

			require _SUX_PATH_ . $candidate_filename;
		}
	}
}
spl_autoload_register('__sux_autoload');
?>