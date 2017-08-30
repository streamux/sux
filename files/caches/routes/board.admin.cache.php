<?php
$result = array();
$categories = array('board-admin');
$result['categories'] = $categories;
$action = array('list','add','modify','delete','list-json','modify-json','skin-json','check-board');
$result['action'] = $action;
return $result;