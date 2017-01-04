<?php
include "config/config.inc.php";

$context = Context::getInstance();
$context->init();

$router = ModuleRouter::getInstance();
$router->init();

