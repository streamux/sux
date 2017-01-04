<?php
include "config/config.inc.php";
include "classes/context/context.class.php";

$context = Context::getInstance();
$context->init();

$router = ModuleRouter::getInstance();
$router->init();

echo _SUX_PATH_;

