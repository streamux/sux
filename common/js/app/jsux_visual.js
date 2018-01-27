/**
 * Swiper 3.3.1
 */
jsux.app = jsux.app || {};

(function(app, $) {

  app.MainBanner = jsux.View.create();
  app.MainBanner.extend({
    create: function() {

      var swiper = null;

      try{
        swiper = new Swiper('.swiper-container-visual',{
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
      }catch(error) {
        console.log('Swiper do not exists');
      }
      return swiper;
    }
  });
})(jsux.app, jQuery);
