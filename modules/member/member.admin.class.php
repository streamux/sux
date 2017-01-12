<?php
class MemberAdmin
{
	/**
	 * @var  categories, action
	 * They're value is used as a route uri of get method and a name of class's method
	 */
	static $categories = array('member-admin');
	static $action = array('group', 'group-json', 'group-add','group-modify','group-delete','group-checkid', 'list','add','modify', 'delete', 'list-json', 'modify-json');
}