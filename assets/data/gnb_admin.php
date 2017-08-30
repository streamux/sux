<?
	$data = '
		{ "data":
			[
				{"id": 1, "sid": 0, "name": "메뉴관리", "router_link": "menues", "sub": null},
				{"id": 2, "sid": 0, "name": "회원관리", "router_link": "member-group", "sub": null},
				{"id": 3, "sid": 0, "name": "게시판관리", "router_link": "board-group", "sub": null},
				{"id": 4, "sid": 0, "name": "페이지관리", "router_link": "document", "sub": null},
				{"id": 5, "sid": 0, "name": "팝업관리", "router_link": "popup", "sub": null},
				{"id": 6, "sid": 0, "name": "통계관리", "router_link": "analytics", "sub": [
					{"id": 6, "sid":1, "name": "접속경로", "router_link": "analytics-connectpath"},
					{"id": 6, "sid":2, "name": "페이지뷰", "router_link": "analytics-pageview"}
				]}
			]
		}';

	echo $_GET['callback'] . '(' . $data . ')';
?>