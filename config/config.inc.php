<?php
define(_SUX_PATH_, str_replace('config/config.inc.php', '', str_replace('\\','/', __FILE__)));

$GLOBALS['__sux_autoload_file_map'] = array_change_key_case(array(
	
	'BaseController'=>'classes/base/base.controller.php',
	'BaseModel'=>'classes/base/base.model.php',
	'BaseView'=>'classes/base/base.view.php',
	'Context'=>'classes/context/context.class.php',
	'DB'=>'classes/db/db.class.php',
	'Query'=>'classes/db/query.class.php',
	'QueryWhere'=>'classes/db/query.where.class.php',
	'QuerySchema'=>'classes/db/query.schema.class.php',
	'UIError'=>'classes/error/ui.error.class.php',
	'Object'=>'classes/object/object.class.php',	
	'Navigator'=>'classes/plugin/navigator.class.php',
	'Template'=>'classes/template/template.class.php',
	'JsonEncoder'=>'classes/utils/jsonencoder.class.php',
	'Tracer'=>'classes/utils/tracer.class.php',	
	'Utils'=>'classes/utils/utils.class.php',
	'UtilsString'=>'classes/utils/utils.string.class.php',
	'Smarty'=>'libs/smarty/Smarty.class.php'
), CASE_LOWER);

function __sux_autoload($class_name) {

	$classLowerName = strtolower($class_name);

	if (isset($GLOBALS['__sux_autoload_file_map'][$classLowerName])) {	 
		require _SUX_PATH_ . $GLOBALS['__sux_autoload_file_map'][$classLowerName];
		
	} else if (preg_match('/(^[a-zA-Z0-9_]+?)(Admin)?(View|Controller|Model|Api|Wap|Mobile)?$/', $class_name, $matches)) {
		
		$candidate_filename = array();
		$candidate_filename[] = 'modules/' . strtolower($matches[1]) . '/' . strtolower($matches[1]);
		if (isset($matches[2]) && $matches[2]) $candidate_filename[] = 'admin';
		$candidate_filename[] = (isset($matches[3]) && $matches[3]) ? strtolower($matches[3]) : 'class';
		$candidate_filename[] = 'php';

		$candidate_filename = implode('.', $candidate_filename);
		if(file_exists(_SUX_PATH_ . $candidate_filename)) {
			require _SUX_PATH_ . $candidate_filename;
		}	
	}
}
spl_autoload_register('__sux_autoload');
?>