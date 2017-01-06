<?php
class DocumentAdmin
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	static $categories = array('document-admin');
	static $action = array('list','list-json','add','modify','modify-json','delete','check-page');
}