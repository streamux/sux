<?php
$result = array();
$categories = array('member-admin');
$result['categories'] = $categories;
$action = array('group','group-json','group-add','group-modify','group-delete','group-checkid','list','add','modify','delete','list-json','modify-json');
$result['action'] = $action;
return $result;