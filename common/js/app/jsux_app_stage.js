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

$(window).ready(function() {
	
	var gnbModel = jsux.gnb.Model.create(),
		gnbView = jsux.gnb.Menu.create("#gnb", gnbModel),
		mobileGnbView = jsux.mobileGnb.Menu.create("#mobileGnb", gnbModel),
		pageAppHandler = {};

	gnbModel.addObserver( gnbView );
	gnbModel.addObserver( mobileGnbView );
	gnbModel.setData( menuList );
	//gnbModel.activate( 1, 2 );

	jsux.mobileGnbView = mobileGnbView;

	pageAppHandler.home = {

		init: function() {
			var visualView = jsux.visual.View.create();
		}
	};

	pageAppHandler.sub = {

		init: function() {

			var	self = this,
				contentPageSlide,
				startOffset = 0,
				offsetY = 0,
				directionY = 'up',
				scrollState = 'scrollToUp',
				minScrollY = 50,
				maxScrollY = 0,
				sildeMoveHandler = {},
				isReachedEnd = false,
				isReachedBeginning = true,
				timer = null;

			$(window).on('resize', function(e){

				$('.container').css('height','100%');

				var 	headerTh = parseInt($('.header').css('height').replace(/[^0-9]/gi,'')),
					footerTh = parseInt($('.footer').css('height').replace(/[^0-9]/gi,'')),
					containerTh = parseInt($('.container').css('height').replace(/[^0-9]/gi,'')),
					targetTh = containerTh - (headerTh + footerTh);
				
				$('.container').css('height', targetTh);

				maxScrollY = -1*(parseInt($(contentPageSlide.slides[0]).outerHeight()) - parseInt($(contentPageSlide.container[0]).outerHeight()) - (headerTh + footerTh));
			});
			

			contentPageSlide = new Swiper('.swiper-container-contents', {
				scrollbar: '.swiper-scrollbar-contents',
				direction: 'vertical',
				slidesPerView: 'auto',
				mousewheelControl: true,
				freeMode: true
			});

			sildeMoveHandler.update = function( swiper ) {

				var currentY = parseInt($(swiper.wrapper[0]).offset().top),
					diff = parseInt(Math.abs(startOffset - currentY)),
					maxHt = parseInt($(swiper.container[0]).outerHeight()),
					contentHt = parseInt($(swiper.slides[0]).outerHeight());
				
				if (offsetY !== currentY && currentY < offsetY && currentY < minScrollY) {

					if (directionY != 'down') {						
						startOffset = currentY;						
					}
					directionY = 'down';
				} else if (offsetY !== currentY && currentY > offsetY && currentY > maxScrollY){

					if (directionY != 'up') {
						startOffset = currentY;						
					}
					directionY = 'up';			
				}

				//console.log('%s / startOffset : %s / currentY : %s / offsetY : %s / diff : %s', directionY,startOffset, currentY, offsetY, diff);

				if (directionY === 'down' && diff > 0 && contentHt > maxHt) {

					if (scrollState != 'scrollToDown') {
						sildeMoveHandler.hide();
					}
					scrollState = 'scrollToDown';
					
				} else if (directionY === 'up' && currentY >= 0) {

					if (scrollState != 'scrollToUp') {					
						sildeMoveHandler.show();
					}
					scrollState = 'scrollToUp';				
				}

				offsetY = currentY;	
			};

			sildeMoveHandler.hide = function() {

				$('.header').addClass('header-off');
				$('.footer').addClass('footer-off');
				$(window).trigger('resize');
				contentPageSlide.update();
			};
			sildeMoveHandler.show = function() {

				$('.header').removeClass('header-off');
				$('.footer').removeClass('footer-off');
				$(window).trigger('resize');
				contentPageSlide.update();
			};

			contentPageSlide.on('touchStart', function(swiper) {
				startOffset = parseInt(swiper.translate);
			});

			contentPageSlide.on('touchMove', function(swiper) {
				sildeMoveHandler.update( swiper );
			});

			contentPageSlide.on('transitionStart', function(swiper) {
				timer.play();
			});

			contentPageSlide.on('setTransition', function(swiper, transition) {
				sildeMoveHandler.update( swiper );
			});

			contentPageSlide.on('transitionEnd', function(swiper) {
				timer.stop();
			});

			timer = {
				interval: null,
				intervalTime: 1000,
				play: function() {
					var self = this;

					if (this.interval) return;
					this.interval = setInterval(self.listener, 1000/24);
				},
				stop: function() {

					if (!this.interval) return;
					clearInterval(this.interval);
					this.interval = null;
				},
				listener: function() {
					console.log('use override');
				}
			};

			timer.listener = function() {
				sildeMoveHandler.update( contentPageSlide );
			};

			$(window).on('mousewheel', function(e) {
				sildeMoveHandler.update( contentPageSlide );
			});

			$(window).trigger('resize');	
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
			break;			
	}

	pageAppHandler.sub.init();
});
