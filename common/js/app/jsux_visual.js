/**
 * Swiper 3.3.1
 */

jsux.visual = jsux.visual || {};
jsux.visual.View = jsux.View.create();
jsux.visual.View.create = function() {

  var mainVisual = new Swiper('.swiper-container-visual',{

    direction: 'horizontal',
    speed: 500,
    effect: 'slide',
    pagination: '.swiper-pagination-visual',
    paginationClickable: true,
    preloadImages: false,
    lazyLoading: true,
    loop:true,
    grabCursor: false
  });

  mainVisual.on('slideChangeStart', function ( e ) {
    //console.log( e.activeIndex + ' : ' +  e.touches.diff );
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