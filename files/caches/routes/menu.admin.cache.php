<?php
$result = array();
$categories = array('menu-admin');
$result['categories'] = $categories;
$action = array('menu','save-json','list-json','gnb-list');
$result['action'] = $action;
return $result;