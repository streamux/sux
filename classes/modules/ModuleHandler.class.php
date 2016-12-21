<?php

/**
*  @class ModuleHandler
*/
class ModuleHandler
{

	function display( $id, $sid)
	{
		$context = Context::getInstance();

		$uriMethod = URIToMethod::getInstance();
		$uriMethod->setURI($context->getServer('REQUEST_URI'));

		// Module Router 클래스 내에서 값이 세팅된다.
		$moduleKey = $uriMethod->getMethod('module-key');
		$category = $uriMethod->getMethod('category');
		$action = $uriMethod->getMethod('action');	

		/**
		 * @route uri's construct
		 * type 1 - your ste / action
		 * type 2 - your site / category / action 
		 */

		// action값이 uri 값에 없을 때 document 클래스의 index 화면을 보여준다. 
		if (empty($action)) {
			$className = 'Document';
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

			/**
			 * @var httpMethod
			 * receive 'create' || 'insert' || 'put' || 'update' || 'delete'
			 */
			$httpMethod = strtolower($context->getRequest('_method'));
			//echo 'method : [' . $httpMethod . '] ' . $className . ' => /' . $category . '/' . $action . "<br>";
			if (preg_match('/^(create|insert|put|update|delete)+/', $httpMethod)) {
				$controller->{$httpMethod.ucfirst($action)}();
				//$controller->tester($httpMethod . ucfirst($action), 'js');
			} else {

				if (preg_match('/^(board|document)+/i', $className)) {
					if (empty($category)) {
						if (empty($action)) {
							$category = 'home';
							$action = 'contents';
						} else {
							$category = $action;
							$context->setParameter('category', $category);
							if (preg_match('/^(board|documentadmin)+/i', $className)) {
								$action = isset($id) ? 'read' : 'list';
							} else {
								$action = 'contents';
							}
						}
					}
				}

				$context->setParameter('category', $category);
				$context->setParameter('action', $action);
				$context->setParameter('id', $id);
				$context->setParameter('sid', $sid);

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