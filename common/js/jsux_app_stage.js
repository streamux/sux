var menuList = null,
	visualList = null;

menuList = [{
	label: "Download",
	link: "/sux/modules/board/board.php?board=sux_download&action=list",
	sub: []
},
{
	label: "User Guide",
	link: "/sux/modules/board/board.php?board=sux_userguide&action=list",
	sub: []
},
{
	label: "Portfolio",
	link: "/sux/modules/board/board.php?board=sux_portfolio&action=list",
	sub: []
},
{
	label: "Support",
	link: "#none",
	sub: [	{label: "공지사항",  link:"/sux/modules/board/board.php?board=sux_notice&action=list"},
			{label: "커뮤니티",  link:"/sux/modules/board/board.php?board=sux_community&action=list"},
			{label: "묻고답하기",  link:"/sux/modules/board/board.php?board=sux_qna&action=list"},
			{label: "버그신고",  link:"/sux/modules/board/board.php?board=sux_bugreporting&action=list"}]
}];

$(document).ready(function() {
		
	var gnbModel = jsux.gnb.Model.create();
	var gnbView   = jsux.gnb.Menu.create("#gnb", gnbModel);

	gnbModel.addObserver( gnbView );
	gnbModel.setData( menuList );
	//gnbModel.activate( 1, 2 );

	is_page = is_page || 'sub';
	switch(is_page) {		
		case 'main':
			var visualView = jsux.visual.View.create();
			break;
		default:
			break;			
	}
});
