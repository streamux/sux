<?php
class MenuAdmin
{
  /**
   * @var  categories, action
   * They're value is used as a route uri of get method and a name of class's method
   */
  static $categories = array('menu-admin');
  static $action = array('menu', 'save-json', 'list-json', 'gnb-list');
}