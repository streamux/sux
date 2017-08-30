<?php
$result = array();
$categories = array('popup-admin');
$result['categories'] = $categories;
$action = array('list','add','modify','delete','list-json','modify-json','skin-json');
$result['action'] = $action;
return $result;