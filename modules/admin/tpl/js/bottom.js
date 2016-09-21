var menuList = null,
	visualList = null;

menuList = [{
	label: "회원관리",
	link: "#none",
	//link: "member_01.html",
	sub: [	{label: "그룹목록", link:"../member/member.admin.php?action=grouplist&pagetype=member"},
			{label: "그룹추가", link:"../member/member.admin.php?action=groupadd&pagetype=member"}]
},
{
	label: "게시판관리",
	link: "#none",
	//link:"board_01.html",
	sub: [	{label: "게시판목록",  link:"../board/board.admin.php?action=list&pagetype=board"},
			{label: "게시판추가",  link:"../board/board.admin.php?action=add&pagetype=board"}]
},
{
	label: "팝업관리",
	link: "#none",
	//link: "popup_01.html",
	sub: [	{label: "팝업목록",  link:"../popup/popup.admin.php?action=list&pagetype=popup"},
			{label: "팝업추가",  link:"../popup/popup.admin.php?action=add&pagetype=popup"}]
			//{label: "팝업스킨", link:"popup.skin.php?pagetype=popup"}]
},
{
	label: "통계관리",
	link: "#none",
	//link: "totallog_01.html",
	sub: [	{label: "접속키워드목록",  link:"../analytics/analytics.admin.php?action=connecterlist&pagetype=analytics"},
			{label: "접속키워드추가",  link:"../analytics/analytics.admin.php?action=connecteradd&pagetype=analytics"},
			{label: "페이지뷰목록", link:"../analytics/analytics.admin.php?action=pageviewlist&pagetype=analytics"},
			{label: "페이지뷰추가", link:"../analytics/analytics.admin.php?action=pageviewadd&pagetype=analytics"}]
}];

visualList = [{
	label: "이미지1",
	img_url: "image.jpg",
	link:"#none"
},
{
	label: "이미지1",
	img_url: "image.jpg",
	link:"#none"
},
{
	label: "이미지1",
	img_url: "image.jpg",
	link:"#none"
}];

$(document).ready(function() {
		
	/**
	 * 추후 현재 Model에서 구현된 Observer기능은 별도 클래스로 분리시켜
	 * Model에서 상속받아 사용하는 구조로 만든다.
	 */
	var gnbModel = jsux.adminGnb.Model.create();
	var gnbView   = jsux.adminGnb.Menu.create("#gnb", gnbModel);
	var gnbIconView = jsux.adminGnb.Icon.create("#gnbIcon", gnbModel);

	gnbModel.addObserver( gnbView );
	gnbModel.addObserver( gnbIconView );  
	gnbModel.setData( menuList );
	//gnbModel.activate( 1, 2 );

	var visualView = jsux.adminVisual.View.create();

	// initialization
	jsux.fn.init();
});