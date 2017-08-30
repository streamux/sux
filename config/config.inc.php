<?php
define(_SUX_PATH_, str_replace('config/config.inc.php', '', str_replace('\\','/', __FILE__)));
define(_SUX_ROOT_, str_replace($_SERVER['DOCUMENT_ROOT'], '', _SUX_PATH_));


/**
 * 참고 : Composer 1.0.3는 PHP 5.3.2 지원  이후 버전은 PHP 5.6 이상 지원 
 * Composer version 1.2.4
 * Server PHP version 5.3.2
 *
 * require _SUX_PATH_ . 'vendor/autoload.php';
 */

$GLOBALS['__sux_autoload_file_map'] = array_change_key_case(array(
	'CacheFile'=>'classes/caches/CacheFile.class.php',
	'Controller'=>'classes/mvc/Controller.php',
	'Model'=>'classes/mvc/Model.php',
	'View'=>'classes/mvc/View.php',
	'Context'=>'classes/context/Context.class.php',
	'DB'=>'classes/db/DB.class.php',	
	'UIError'=>'classes/error/UIError.class.php',
	'FileHandler'=>'classes/file/FileHandler.class.php',
	'ModuleHandler'=>'classes/modules/ModuleHandler.class.php',
	'RouterModule'=>'classes/modules/RouterModule.class.php',
	'PageModule'=>'classes/modules/PageModule.class.php',
	'Object'=>'classes/object/Object.class.php',	
	'Navigator'=>'classes/plugin/Navigator.class.php',
	'Query'=>'classes/queries/Query.class.php',
	'QueryWhere'=>'classes/queries/QueryWhere.class.php',
	'QuerySchema'=>'classes/queries/QuerySchema.class.php',
	'Template'=>'classes/template/Template.class.php',
	'JsonEncoder'=>'classes/utils/JsonEncoder.class.php',
	'Tracer'=>'classes/utils/Tracer.class.php',	
	'URIToMethod'=>'classes/utils/URIToMethod.class.php',
	'Utils'=>'classes/utils/Utils.class.php',
	'UtilsString'=>'classes/utils/UtilsString.class.php',
	'Epi'=>'vendor/jmathai/epiphany/src/Epi.php',
	'Smarty'=>'vendor/smarty/smarty/libs/Smarty.class.php'
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
		//echo $candidate_filename . "<br>";

		if(file_exists(_SUX_PATH_ . $candidate_filename)) {
			require _SUX_PATH_ . $candidate_filename;
		}	
	}
}
spl_autoload_register('__sux_autoload');
?>