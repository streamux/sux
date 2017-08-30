<?php
$result = array();
$categories = array('admin-admin');
$result['categories'] = $categories;
$action = array('main','main-json','connecter-json','connecterreal-json','pageview-json','connectsite-json','connectday-json','newmember-json','newcomment-json','service-json');
$result['action'] = $action;
return $result;