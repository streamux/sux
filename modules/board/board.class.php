<?php
class Board
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	static $categories = array('notice','faq');
	static $action = array('list', 'read', 'write', 'modify', 'reply', 'delete', 'delete-tail');
}