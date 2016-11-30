<?php
class Install extends Object 
{
	/**
	 * @var  action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	public static $action = array('install','terms', 'setup-db', 'setup-admin', 'create-table');
}