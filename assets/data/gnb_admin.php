<?php
header('Access-Control-Allow-Origin: *');

$data = array('data'=>array(
    array('id'=>1,'sid'=>0, 'name'=>'메뉴 관리','router_link'=>'menus','sub'=>null),
    array('id'=>2,'sid'=>0, 'name'=>'회원 관리','router_link'=>'member-group','sub'=>null),
    array('id'=>3,'sid'=>0, 'name'=>'게시판 관리','router_link'=>'board-group','sub'=>null),
    array('id'=>4,'sid'=>0, 'name'=>'페이지 관리','router_link'=>'document','sub'=>null)
  )
);

$callback = $_REQUEST['callback'];
$strcallback = strtolower($callback);

if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
  $strJson = json_encode($data, JSON_UNESCAPED_UNICODE); 
} else {
  array_walk_recursive($data, function (&$item, $key) {    
    if (is_string($item)) {
      $item = mb_encode_numericentity($item, array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
    }
  });
  $strJson = mb_decode_numericentity(json_encode($data), array (0x80, 0xffff, 0, 0xffff), 'UTF-8');
}

if (preg_match('/(jsonp|jquery)+/', $strcallback) === 1) {
  echo $callback . '('.$strJson.')';        
} else {
  echo $strJson;    
}