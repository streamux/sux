<?php
$result = array();
$action = array('list','read','write','modify','reply','delete','comment','delete-comment','progress-step');
$result['action'] = $action;
$categories = array('bugreporting');
$result['categories'] = $categories;
return $result;