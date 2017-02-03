<?php
class Board
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	static $categories = array('notice');
	static $action = array('list','read','write','modify','reply','delete','comment','delete-comment','progress-step');
}