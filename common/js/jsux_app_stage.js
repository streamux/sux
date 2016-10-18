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
		
	var gnbModel = jsux.gnb.Model.create(),
		gnbView = jsux.gnb.Menu.create("#gnb", gnbModel),
		mobileGnbView = jsux.mobileGnb.Menu.create("#mobileGnb", gnbModel),
		pageAppHandler = {};

	gnbModel.addObserver( gnbView );
	gnbModel.addObserver( mobileGnbView );
	gnbModel.setData( menuList );
	//gnbModel.activate( 1, 2 );

	pageAppHandler.home = {

		init: function() {
			var visualView = jsux.visual.View.create();
		}
	};

	pageAppHandler.sub = {

		init: function() {		

			$(window).on('resize', function(e){

				$('.container').css('height','100%');

				var 	contentsHeaderTh = parseInt($('.contents-header').css('height').replace(/[^0-9]/gi,'')),
					headerTh = parseInt($('.header').css('height').replace(/[^0-9]/gi,'')),
					footerTh = parseInt($('.footer').css('height').replace(/[^0-9]/gi,'')),
					containerTh = parseInt($('.container').css('height').replace(/[^0-9]/gi,'')),
					targetTh = containerTh - (headerTh + contentsHeaderTh + footerTh);		
				
				$('.container').css('height', targetTh);		
				//console.log(targetTh);
			});

			$(window).trigger('resize');			

			var contentPageSlide = new Swiper('.swiper-container-contents', {
				scrollbar: '.swiper-scrollbar-contents',
				direction: 'vertical',
				slidesPerView: 'auto',
				mousewheelControl: true,
				freeMode: true
			});
		}
	};

	var mobileMenuSlide = new Swiper('.swiper-container-mobilegnb', {
		scrollbar: '.swiper-scrollbar-mobilegnb',
		direction: 'vertical',
		slidesPerView: 'auto',
		mousewheelControl: true,
		freeMode: true
	});

	switch(is_page) {		
		case 'main':
			pageAppHandler.home.init();
			break;
		default:
			pageAppHandler.sub.init();
			break;			
	}
});
