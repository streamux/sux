<?php
class BoardAdmin
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	static $categories = array('board-admin');
	static $action = array('list','add','modify','delete','list-json','modify-json','skin-json','check-board');
}