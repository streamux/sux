<?
$data = '{
	"data": [
		{"id": 1, "sid": 0, "name": "메뉴관리", "url": "/menues", "depth": 0, "isClicked": false, "isModified": false, "isDragging": false, "state": "default", "badge": 0, "sub": [], "posy": 0, "top": "0"},
		{"id": 2, "sid": 0, "name": "회원관리", "url": "/member-group", "depth": 0, "isClicked": false, "isModified": false, "isDragging": false, "state": "default", "badge": 0, "sub": [], "posy": 0, "top": "0"},
		{"id": 3, "sid": 0, "name": "게시판관리", "url": "/board-group", "depth": 0, "isClicked": false, "isModified": false, "isDragging": false, "state": "default", "badge": 0, "sub": [], "posy": 0, "top": "0"},
		{"id": 4, "sid": 0, "name": "페이지관리", "url": "/document", "depth": 0, "isClicked": false, "isModified": false, "isDragging": false, "state": "default", "badge": 0, "sub": [], "posy": 0, "top": "0"},
		{"id": 5, "sid": 0, "name": "팝업관리", "url": "/popup", "depth": 0, "isClicked": false, "isModified": false, "isDragging": false, "state": "default", "badge": 0, "sub": [], "posy": 0, "top": "0"},
		{"id": 6, "sid": 0, "name": "통계관리", "url": "/analytics", "depth": 0, "isClicked": false, "isModified": false, "isDragging": false, "state": "default", "badge": 0, "sub": [], "posy": 0, "top": "0"}
	]
}';

echo $_GET['callback'] . '(' . $data . ')';
?>