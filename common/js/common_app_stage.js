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

$(document).ready(function() {
		
	var gnbModel = jsux.gnb.Model.create();
	var gnbView   = jsux.gnb.Menu.create("#gnb", gnbModel);

	gnbModel.addObserver( gnbView );
	gnbModel.setData( menuList );
	//gnbModel.activate( 1, 2 );

	var visualView = jsux.visual.View.create();
});
