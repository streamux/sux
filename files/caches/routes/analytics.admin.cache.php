<?php
$result = array();
$categories = array('analytics-admin');
$result['categories'] = $categories;
$action = array('connect-site','connect-site-list','connect-site-list-json','connect-site-add','connect-site-reset','connect-site-delete','pageview','pageview-list','pageview-list-json','pageview-add','pageview-reset','pageview-delete');
$result['action'] = $action;
return $result;