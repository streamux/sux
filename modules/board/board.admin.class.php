<?php
class BoardAdmin
{
  /**
   * @var  categories, action
   * They're value is used as a route uri of get method and a name of class's method
   */
  static $categories = array('board-admin');
  //static $action = array('list','add','modify','delete','list-json','modify-json','skin-json','check-board');
  static $action = array('list','add','modify','delete','list-json','modify-json','group', 'group-list','group-add','group-modify','group-delete','group-list-json','group-modify-json','skin-json','check-board', 'news-list-json');
}