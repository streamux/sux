<?php
class Member
{
	static $steps = array('join', 'modify', 'group-list', 'search-id', 'search-corp');

	public static function display( $param )
	{
		$context = Context::getInstance();
		$context->init();

		$className = get_class();
		$ModelClass = $className . 'Model';
		$ControllerClass = $className . 'Controller';
		$ViewClass = $className . 'View';

		$model = new $ModelClass();
		$controller = new $ControllerClass($model);
		$views = new $ViewClass($model, $controller);

		$uriToMethod = ModuleURIToMethod::getInstance();

		// @var httpMethod is 'GET' || 'POST'
		$method = strtolower($context->getServer('REQUEST_METHOD'));
		if (isset($method) && $method === 'post') {
			$action = $context->getPost('action');
			$action = $uriToMethod->removeHyphen( $action);

			// @var httpMethod is 'create' || 'insert' || 'put' || 'update' || 'delete'
			/*$httpMethod = strtolower($context->getPost('_method'));
			switch ($httpMethod) {
				case 'create' || 'insert':
					echo 'insert';
					# code...
					break;
				case 'put' || 'update':
					echo 'update';
					# code...
					break;
				case 'delete':
					echo 'delete';
					# code...
					break;				
				default:
					# code...
					break;
			}*/
		} else {			
			$uriToMethod->setURI($context->getServer('REQUEST_URI'));
			$module = $uriToMethod->getMethod('module');
			$action = $uriToMethod->getMethod('action');

			if (empty($action)) {
				$action = $module;
			}
		}
		
		$context->set('module', $module);
		$context->set('action', $action);			

		if (isset($action) && $action) {
			$views->display($action);
		} else {
			UIError::alertToBack('파라미터 값을 확인해주세요.');
		}
	}
}