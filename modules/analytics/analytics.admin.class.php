<?php
class AnalyticsAdmin
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */

	static $categories = array('analytics-admin');
	static $action = array('connect-site','connect-site-list','connect-site-list-json','connect-site-add','connect-site-reset','connect-site-delete','pageview','pageview-list','pageview-list-json','pageview-add','pageview-reset','pageview-delete');
}