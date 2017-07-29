<?php
include "config/config.inc.php";

$context = Context::getInstance();
$context->init();

$router = ModuleRouter::getInstance();
if ($context->installed()) {
	$router->init(); 
} else {
	$router->install(); 
}
