<?php

/**
*  @class ModuleHandler
*/
class ModuleHandler
{

	function display( $id, $sid)
	{
		$context = Context::getInstance();
		$returnURL = $context->getServer('REQUEST_URI');

		$uriMethod = URIToMethod::getInstance();
		$uriMethod->setURI($returnURL);

		// Module Router 클래스 내에서 값이 세팅된다.
		$moduleKey = $uriMethod->getMethod('module-key');
		$category = $uriMethod->getMethod('category');
		$action = $uriMethod->getMethod('action');	

		$errorKey = '';
		$isInvalid = null;
		if ($moduleKey && !preg_match("/^([a-z0-9\_\-]+)$/i", $moduleKey)) {
			$errorKey = 'module_key';
			$isInvalid = true;
		}
		if ($category && !preg_match("/^([a-z0-9\_\-]+)$/i", $category)) {
			$errorKey = 'category_key';
			$isInvalid = true;
		}
		if ($action && !preg_match("/^([a-z0-9\_\-]+)$/i", $action)) {
			$errorKey = 'action_key';
			$isInvalid = true;
		}

		if ($isInvalid) {
			$msg = $errorKey . ' is not available';
			UIError::alertToBack($msg, true, array('url'=>$returnURL, 'delay'=>3));
			exit;
		}

		/**
		 * @route uri's construct
		 * type 1 - your ste / action
		 * type 2 - your site / category / action 
		 */		

		// action값이 uri 값에 없을 때 document 클래스의 index 화면을 보여준다. 
		if (empty($action)) {
			$className = 'Document';
		} else {
			// ModuleRouter Class 에서 등록된 값 
			$className = $context->getModule($moduleKey);
		}

		if ($context->getDB() || strtolower($className) === 'install') {

			$ModelClass = $className . 'Model';
			$ControllerClass = $className . 'Controller';
			$ViewClass = $className . 'View';

			$toLowerClassName = strtolower($className);
			if ($toLowerClassName !== 'install') {
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
			$regMethod = preg_match('/^(create|insert|put|update|delete)+/', $httpMethod);
			//echo 'method : [' . $httpMethod . '] ' . $className . ' => /' . $category . '/' . $action . "<br>";
			if ($regMethod) {
				$controller->{$httpMethod.ucfirst($action)}();
				//$controller->tester($httpMethod . ucfirst($action), 'js');
			} else {
				// 로그인 체크 
				$isLogged = $context->getSession('admin_ok');
				if (empty($isLogged) && $toLowerClassName !== 'loginadmin') {
					Utils::goURL(_SUX_ROOT_ . 'login-admin', 0, 'N', 'Login is required');
				}

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
			Utils::goURL(_SUX_ROOT_ . 'install', 0, 'N', 'SUX cannot connect to DB');			
		}
	}
}