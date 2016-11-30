<?php

/**
*  @class ModuleHandler
*/
class ModuleHandler
{	
	function display( $id)
	{
		$context = Context::getInstance();

		$uriMethod = URIToMethod::getInstance();
		$uriMethod->setURI($context->getServer('REQUEST_URI'));

		// Module Router 클래스 내에서 값이 세팅된다.
		$moduleKey = $uriMethod->getMethod('module-key');
		$category = $uriMethod->getMethod('category');
		$action = $uriMethod->getMethod('action');	

		if (empty($action)) {
			$className = 'home';
		} else {
			$className = $context->getModule($moduleKey);
		}
		
		if ($context->getDB() || strtolower($className) === 'install') {		
			
			$ModelClass = $className . 'Model';
			$ControllerClass = $className . 'Controller';
			$ViewClass = $className . 'View';

			if (strtolower($className) !== 'install') {
				$oDB = DB::getInstance();
			}

			$model = new $ModelClass();
			$controller = new $ControllerClass( $model);
			$view = new $ViewClass( $model, $controller);

			$context->setParameter('category', $category);
			$context->setParameter('action', $action);
			$context->setParameter('id', $id);

			// @var httpMethod is 'create' || 'insert' || 'put' || 'update' || 'delete'
			$httpMethod = strtolower($context->getRequest('_method'));
			//echo 'method : [' . $httpMethod . '] ' . $className . ' => /' . $category . '/' . $action . "<br>";
			if (preg_match('/^(create|insert|put|update|delete)+/', $httpMethod)) {		
				$controller->{$httpMethod.ucfirst($action)}();
				//$controller->tester($httpMethod . ucfirst($action), 'js');
			} else {
				if (preg_match('/^(board|document)+/i', $className)) {					
					if (empty($category)) {
						$category = $action;
						$context->setParameter('category', $category);						
						$action = isset($id) ? 'read' : 'list';
					}
				}		
				$view->display($action, $category, $id);
			}

			if (strtolower($className) !== 'install') {
				$oDB->close();
			}
		} else {
			Utils::goURL('/sux/install');
		}
	}
}

class HomeModel extends Model
{
	function init() {}
}

class HomeController extends Controller
{

}

/**
* @class HomeView
*/
class HomeView extends View
{	
	function __construct() {

		echo '<a href="/sux/">home</a><br><a href="/sux/login">로그인</a><br><a href="/sux/notice">공지사항</a>';
	}
}