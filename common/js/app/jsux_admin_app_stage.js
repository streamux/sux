var menuList = null;

menuList = [{
	label: "회원관리",
	link: "#none",
	//link: "member_01.html",
	sub: [	{label: "그룹목록", link:"member-admin"},
			{label: "그룹추가", link:"member-admin/group-add"}]
},
{
	label: "게시판관리",
	link: "#none",
	//link:"board_01.html",
	sub: [	{label: "게시판목록",  link:"board-admin"},
			{label: "게시판추가",  link:"board-admin/add"}]
},
{
	label: "페이지관리",
	link: "#none",
	//link:"board_01.html",
	sub: [	{label: "페이지목록",  link:"document-admin"},
			{label: "페이지추가",  link:"document-admin/add"}]
},

{
	label: "팝업관리",
	link: "#none",
	//link: "popup_01.html",
	sub: [	{label: "팝업목록",  link:"popup-admin"},
			{label: "팝업추가",  link:"popup-admin/add"}]
			//{label: "팝업스킨", link:"popup.skin.php?pagetype=popup"}]
},
{
	label: "통계관리",
	link: "#none",
	//link: "totallog_01.html",
	sub: [	{label: "접속키워드목록",  link:"analytics-admin/connect-site"},
			{label: "접속키워드추가",  link:"analytics-admin/connect-site-add"},
			{label: "페이지뷰목록", link:"analytics-admin/pageview"},
			{label: "페이지뷰추가", link:"analytics-admin/pageview-add"}]
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
});