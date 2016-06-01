var menuList;

	menuList = [{

	label: "회원관리",
	link: "#none",
	//link: "member_01.html",
	sub: [  {label: "회원목록", link:"member.list.php?pageType=member"},
			{label: "그룹추가", link:"member.groupadd.php?pageType=member"},
			{label: "회원추가", link:"member.add.php?pageType=member"}]
	},
	{
	label: "게시판관리",
	link: "#none",
	//link:"board_01.html",
	sub: [  {label: "게시판목록",  link:"board.list.php?pageType=board"},
			{label: "게시판추가",  link:"board.add.php?pageType=board"}]
	},
	{
	label: "팝업관리",
	link: "#none",
	//link: "popup_01.html",
	sub: [  {label: "팝업목록",  link:"popup.list.php?pageType=popup"},
			{label: "팝업추가",  link:"popup.add.php?pageType=popup"}]
			//{label: "팝업스킨", link:"popup.skin.php?pageType=popup"}]
	},
	{
	label: "통계관리",
	link: "#none",
	//link: "totallog_01.html",
	sub: [  {label: "키워드목록",  link:"analysis.list.php?pageType=totallog"},
			{label: "키워드추가",  link:"analysis.add.php?pageType=totallog"},
			{label: "페이지뷰목록", link:"pageview.list.php?pageType=totallog"},
			{label: "페이지뷰추가", link:"pageview.add.php?pageType=totallog"}]
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

	var gModel,
		gView,
		gIconView,    
		vModel,
		vControl,     
		
		vIndicatorView,
		vInnerView;

	/**
	 * 추후 현재 Model에서 구현된 Observer기능은 별도 클래스로 분리시켜
	 * Model에서 상속받아 사용하는 구조로 만든다.
	 */
	gModel  = jsuxApp.getModel();
	gView   = jsuxApp.createGNB("#gnb", gModel);
	gIconView = jsuxApp.createGNB_ICON("#gnb_icon", gModel);

	gModel.addView( gView );
	gModel.addView( gIconView );    
	gModel.setData( menuList );
	// gModel.activate( 1, 2 );

	vModel  = jsuxApp.getModel();
	vControl  = jsuxApp.getControl( vModel );
	vIndicView  = jsuxApp.createIndicatorView("#indicator", vModel, vControl);
	vInnerView = jsuxApp.createInnerView("#inner", vModel, vControl);

	vModel.addView( vIndicView );
	vModel.addView( vInnerView );
	vModel.setData( visualList );
	vModel.activate(1);
	vControl.setRolling( true );

	// initialization
	jsux.fn.init();
});