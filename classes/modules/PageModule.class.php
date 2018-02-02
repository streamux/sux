<?php

/**
*  @class ModuleHandler
*/
class PageModule
{
	function display( $id, $sid)
	{
		$context = Context::getInstance();
		$returnURL = $context->getServer('REQUEST_URI');

		// URI 값을 이용해 모듈, 카테고리, 액션 값을 생성한다.
		$uriMethod = URIToMethod::getInstance();
		$uriMethod->setURI($returnURL);
		$moduleKey = $uriMethod->getMethod('module-key');
		$category = $uriMethod->getMethod('category');
		$action = $uriMethod->getMethod('action');			

		/**
		 * @route uri structure
		 * type 1 - your site / action
		 * type 2 - your site / category /:mid/action /:id
		 */		

		// action값이 uri 값에 없을 때 document 클래스의 Home 화면을 보여준다. 
		if ($action === null) {
			$className = 'Document';
		} else {
			$className = $context->getModule($moduleKey);
		}

		if ($context->getDB() || strtolower($className) === 'install') {
			$ModelClass = ucfirst($className) . 'Model';
			$ControllerClass = ucfirst($className) . 'Controller';			
			$ViewClass = ucfirst($className) . 'View';
			$toLowerClassName = strtolower($className);

			if ($toLowerClassName !== 'install') {
				$oDB = DB::getInstance();
			}

			$model = new $ModelClass();
			$controller = new $ControllerClass($model);
			$view = new $ViewClass( $model, $controller);
			
			/**
			 * @var httpMethod
			 * receive 'create' || 'insert' || 'put' || 'update' || 'delete'
			 */			
			$httpMethod = strtolower($context->getRequest('_method'));
			$regMethod = preg_match('/^(create|insert|put|update|delete)+/', $httpMethod);
			//echo 'method : [' . $httpMethod . '] ' . $className . ' => /' . $category . '/' . $action . "<br>";

			if ($regMethod) {

				// 값을 저장할 때 올바른 경로를 통해서 유입되는지 체크
				$referURL = $_SERVER['HTTP_REFERER'];
				if (empty($returnURL)) {
					Utils::goURL(_SUX_ROOT_, 3, 'N', 'Your Access URL is not valid');
					exit;
				}

				$yourdomain = $context->getServer('HTTP_HOST');
				if (isset($yourdomain) && $yourdomain) {
					if (preg_match('/(www)+', $yourdomain)) {
						str_replace('www.', '',$yourdomain);
					}
					
					$urlReg = sprintf('/^(http(s)?\:\/\/)?(www.)?(%s)/', $yourdomain);
					if (!preg_match($urlReg, $referURL)) {
						Utils::goURL(_SUX_ROOT_, 3, 'N', 'Your Access Domain is not valid');
						exit;
					}
				}

				$referURL = null;
				$yourdomain = null;

				$controller->{$httpMethod.ucfirst($action)}();
				//$controller->tester($httpMethod . ucfirst($action), 'js');
			} else {

				//-- Check Login  of Admin Page  start
				$isLogged = $context->getSession('admin_ok');
				if (empty($isLogged)) {
					if (!preg_match('/^(loginadmin)+/', $toLowerClassName) && preg_match('/(admin)+$/', $toLowerClassName)) {
						Utils::goURL(_SUX_ROOT_ . 'login-admin', 0, 'N', 'Login is required');
						exit;
					}
				}

				if (empty($category)) {
					if (preg_match('/^(board|document)+/i', $className)) {
								
						// when user connect from Base URL
						if (empty($action)) {
							$category = 'home';
							$action = 'content';
						} else {
							$category = $action;
							$context->setParameter('category', $category);
							if (preg_match('/^(board|documentadmin)+/i', $className)) {
								$action = isset($id) ? 'read' : 'list';
							} else {
								$action = 'content';
							}
						}
					}
				}

				$context->setParameter('category', $category);
				$context->setParameter('action', $action);
				$context->setParameter('id', $id);
				$context->setParameter('sid', $sid);

				$view->display($action, $category, $id, $sid);
			}

			if (strtolower($className) !== 'install') {
				$oDB->close();
			}
		} else {
			Utils::goURL(_SUX_ROOT_ . 'install', 0, 'N', 'SUX cannot connect to DB');			
		}
	}
}