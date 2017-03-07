<?php
class Analytics
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	static $categories = array('analytics');
	static $action = array('counter','pageview');
}