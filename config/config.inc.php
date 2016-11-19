<?php
define(_SUX_PATH_, str_replace('config/config.inc.php', '', str_replace('\\','/', __FILE__)));
define(_SUX_ROOT_, str_replace($_SERVER['DOCUMENT_ROOT'], '', _SUX_PATH_));

$GLOBALS['__sux_autoload_file_map'] = array_change_key_case(array(
	
	'Controller'=>'classes/mvc/Controller.php',
	'Model'=>'classes/mvc/Model.php',
	'View'=>'classes/mvc/View.php',
	'Context'=>'classes/context/Context.class.php',
	'DB'=>'classes/db/DB.class.php',
	'Query'=>'classes/db/Query.class.php',
	'QueryWhere'=>'classes/db/Query.where.class.php',
	'QuerySchema'=>'classes/db/Query.schema.class.php',
	'UIError'=>'classes/error/UI.error.class.php',
	'ModuleHandler'=>'classes/modules/ModuleHandler.class.php',
	'ModuleURIToMethod'=>'classes/modules/ModuleURIToMethod.class.php',
	'Object'=>'classes/object/Object.class.php',	
	'Navigator'=>'classes/plugin/Navigator.class.php',
	'Template'=>'classes/template/Template.class.php',
	'JsonEncoder'=>'classes/utils/JsonEncoder.class.php',
	'Tracer'=>'classes/utils/Tracer.class.php',	
	'Utils'=>'classes/utils/Utils.class.php',
	'UtilsString'=>'classes/utils/Utils.string.class.php',
	'Epi'=>'libs/epiphany/Epi.php',
	'Smarty'=>'libs/smarty/Smarty.class.php'
), CASE_LOWER);

function __sux_autoload($class_name) {

	$classLowerName = strtolower($class_name);

	if (isset($GLOBALS['__sux_autoload_file_map'][$classLowerName])) {
		//echo $classLowerName . "<br>";
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