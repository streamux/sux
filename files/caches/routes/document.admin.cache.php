<?php
$result = array();
$categories = array('document-admin');
$result['categories'] = $categories;
$action = array('list','list-json','add','modify','modify-json','delete','check-page');
$result['action'] = $action;
return $result;