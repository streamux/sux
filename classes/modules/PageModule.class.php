<?php
/**
*  @ class ModuleHandler
*/
class PageModule
{
  static public function display($id=null, $sid=null)
  {
    $context = Context::getInstance();
    $returnURL = $context->getServer('REQUEST_URI');

    /**
     * Create Module, Category, Action Key of URIFrom Value made
     * in ModuleRouter Class
     * @route uri's construct
     * - /action/:id
     * - /category/:id/action /:sid
     */
    $uriMethod = URIToMethod::getInstance();
    $uriMethod->setURI($returnURL);   
    $moduleKey = $uriMethod->getMethod('module-key');
    $category = $uriMethod->getMethod('category');
    $action = $uriMethod->getMethod('action'); 

    // Base Router Key is  HomeClass of Document Module
    $className = ($action === null) ? 'Document' : $context->getModule($moduleKey);
    $classLowerName = strtolower($className);

    if ($context->getDB() || strtolower($className) === 'install') {
      if ($classLowerName !== 'install') {
        $oDB = DB::getInstance();
        $oDB->connect();
      }
      
      $ModelClass = ucfirst($className) . 'Model';
      $ControllerClass = ucfirst($className) . 'Controller';      
      $ViewClass = ucfirst($className) . 'View';
      $model = new $ModelClass();
      $controller = new $ControllerClass($model);
      $view = new $ViewClass( $model, $controller);
          
      $httpMethod = $context->getRequest('_method');
      $httpMethod = strtolower($httpMethod);
      $regMethod = '/^(insert|select|update|delete)+$/';

      // Check admin login for Dashboard
      preg_match('/(^[a-z][a-z0-9]+)(-)?(admin)+$/i', $className, $regAdmin);
      if (isset($regAdmin) && $regAdmin && strtolower($regAdmin[1]) !== 'login') {
        $isAdminLogin = $context->isAdminLogin();

        if (empty($isAdminLogin)) {
          $context->setSession('return_url', $returnURL);
          Utils::goURL(_SUX_ROOT_ . 'login-admin', 0, 'N', 'Admin Login is required');
        }
      }

      if (preg_match($regMethod, $httpMethod)) {
        if ($context->isCrossDomain() === false) {
          Utils::goURL(_SUX_ROOT_, 3, 'N', 'Your Access Domain is not valid');
        }

        $controller->{$httpMethod . ucfirst($action)}();
      } else {
        
        if (preg_match('/^(board|document|documentadmin)$/i', $className)) {          
          if (empty($category)) {
            $category = $action;

            if (preg_match('/^(board|documentadmin)$/i', $className)) {
              $action = isset($id) ? 'read' : 'list';
            } else if (preg_match('/^(document)$/i', $className)) {
              $category = 'home';
              $action = 'content';
            }
          }
        }   // end of if

        $context->setParameter('category', $category);
        $context->setParameter('action', $action);
        $context->setParameter('id', $id);
        $context->setParameter('sid', $sid);

        $view->display($action, $category, $id, $sid);
      }
    } else {
      Utils::goURL(_SUX_ROOT_ . 'install', 0, 'N', 'SUX cannot connect to DB');     
    }
  }
}
?>