<?php
include "config/config.inc.php";

$context = Context::getInstance();
$context->init();

$moduleHandler = ModuleHandler::getInstance(); 
$moduleHandler->init();