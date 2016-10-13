/**
 * Swiper 3.3.1
 */

jsux.visual = jsux.visual || {};
jsux.visual.View = jsux.View.create();
(function( app, $) {

	app.create = function() {

		var mainVisual = new Swiper('.swiper-container',{

			/* default */
			//initialSlide: 1,
			//Could be "horizontal" or "vertical"
			direction: 'horizontal',
			speed: 500,
			//setWrapperSize: true,
			//virtualTranslate: true,
			//width: 100,
			//height: 300,
			//autoHeight: true,
			//roundLengths: true,
			//nested: true,

			/* autoplay */
			//autoplay: 5000,
			//autoplayStopOnLast: true,
			//autoplayDisableOnInteraction: false,

			/* progress */
			//watchSlidesProgress: true,
			//watchSlidesVisibility: true,

			/* free mode */
			//freeMode: false,
			//freeModeMomentum: true,
			//freeModeMomentumRatio: 1,
			//freeModeMomentumBounce: true,
			//freeModeMomentumBounceRatio: 1,
			//freeModeMinimumVelocity: 0.02,
			//freeModeSticky: false,

			/* effects */
			//Could be "slide", "fade", "cube", "coverflow" or "flip"
			effect: 'slide',
			/*fade: {
				crossFade: true
			},*/
			/*cube: {
				slideShadows: true,
				shadow: true,
				shadowOffset: 20,
				shadowScale: 0.94
			},*/
			/*coverflow: {
				rotate: 50,
				stretch: 0,
				depth: 100,
				modifier: 1,
				slideShadows : true
			},*/
			/*flip: {
				slideShadows : true,
				limitRotation: true
			},*/

			/* Parallax */
			//parallax: true,

			/* Slides grid */
			//spaceBetween: 10,
			//slidesPerView: 1,
			//slidesPerColumn: 1,
			//slidesPerColumnFill: 'column', //or 'row'
			//slidesPerGroup: 1,
			//centeredSlides: false,
			//slidesOffsetBefore: 10,
			//slidesOffsetAfter: 10,

			/* Grab Cursor */
			//grabCursor: false,
			//shortSwipes: true,
			//longSwipes: true,
			//longSwipesRatio: 0.5,
			//longSwipesMs: 300,
			//followFinger: true,
			//onlyExternal: false,
			//threshold: 0,
			//touchMoveStopPropagation: true,
			//iOSEdgeSwipeDetection: false,
			//iOSEdgeSwipeThreshold: 20,

			/* Touches */
			//touchEventsTarget: 'container',
			//touchRatio: 1,
			//touchAngle: 45,
			//simulateTouch: true,

			/* Touch Resistance */
			//resistance: true,
			//resistanceRatio: 0.85,

			/* Clicks */
			//preventClicks: true,
			//preventClicksPropagation: false,

			/* Swiping / No swiping */
			//allowSwipeToPrev: true,
			//allowSwipeToNext: true,
			//noSwiping: true,
			//noSwipingClass: 'swiper-no-swiping',
			//swipeHandler: null

			/* Navigation Controls */
			//uniqueNavElements: true,

			/* Pagination */
			pagination: '.swiper-pagination',
			//Can be "bullets", "fraction", "progress" or "custom"
			//paginationType: 'bullets',
			//paginationHide: true,
			paginationClickable: true,
			//paginationElement: 'span',
			/*paginationBulletRender: function (index, className) {
				return '<span class="' + className + '">' + (index + 1) + '</span>';
			},*/

			/* Navigation Buttons */
			/* Scollbar */
			/* Keyboard / Mousewheel */
			/* Hash Navigation */
			/* Images */
			preloadImages: false,
			lazyLoading: true,

			/* Loop */
			/* Controller */
			nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',
			/* Observer */
			/* Breakpoints */
			/* Callbacks */
			/* Properties */
			/* Methods */

			loop:true,
			grabCursor: false
		});

		mainVisual.on('slideChangeStart', function ( e ) {
			console.log( e.activeIndex + ' : ' +  e.touches.diff );
		});
		
		/*$('.arrow-left').on('click', function(e){
			e.preventDefault()
			mySwiper.swipePrev()
		});
		$('.arrow-right').on('click', function(e){
			e.preventDefault()
			mySwiper.swipeNext()
		});*/
	};
})(jsux.visual.View, jQuery);