jsux.visual = jsux.visual || {};
jsux.visual.View = jsux.View.create();
(function( app, $) {

	app.create = function() {

		var mySwiper = new Swiper('.swiper-container',{
			pagination: '.pagination',
			loop:true,
			grabCursor: true,
			paginationClickable: true,
			autoplay: 3000
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