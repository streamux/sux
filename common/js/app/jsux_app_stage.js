$(window).ready(function() {
  
  var gnbModel = jsux.gnb.Model.create(),
        gnbView = jsux.gnb.Menu.create("#sxGnb", gnbModel),
        mobileGnbView = jsux.mobileGnb.Menu.create("#mobileGnb", gnbModel),
        pageManager = {},
        jsonPath = jsux.rootPath + 'files/gnb/gnb.json',
        mobileMenuSlider = null;

  gnbModel.addObserver( gnbView );
  gnbModel.addObserver( mobileGnbView );

  jsux.mobileGnbView = mobileGnbView;

  mobileMenuSlider = new Swiper('.swiper-container-mobilegnb', {
      scrollbar: '.swiper-scrollbar-mobilegnb',
      direction: 'vertical',
      slidesPerView: 'auto',
      mousewheelControl: true,
      freeMode: true
    });

  pageManager.main = {

    init: function() {
      var visualView = jsux.app.MainBanner.create();
    }
  };
  pageManager.common = {

    init: function() {

      $('.ui-bg-cover').on('scroll touchmove mousewheel', function(e) {
        e.preventDefault();
        e.stopPropagation();
        return;
      });

      $(window).on('resize', function(e){

        var tw = $(window).width();
        var winHt = $(window).height();
        var pageHt = $('body').height() + 62;

        if (pageHt > winHt) {
          tw += 15;
        }

        mobileGnbView.resizeUI(tw);
        mobileMenuSlider.onResize();
      });

      $(window).trigger('resize');
      mobileGnbView.hideGnbCase();
    }
  };

  pageManager.jsonLoader = {

    load: function(path) {

      $.ajax({
        url: path,
        dataType: 'json',
        jsonpCallback: 'JSON_CALLBACK',
        success: function(json) {

          var data = json.data,
                menuList = [];

          if (data.length > 0) {

            var dataManager = (function f(list, data){

              for (var i=0; i<data.length; i++) {
                list[i] = {};
                list[i].label = data[i].menu_name;
                list[i].link = data[i].url;
                list[i].link_target = data[i].url_target;
                list[i].menu = [];

                if (data[i].sub && data[i].sub.length > 0) {
                  arguments.callee(list[i].menu, data[i].sub);
                }
              }
            });

            dataManager(menuList, data);
            dataManager = null;

            gnbModel.setData( menuList );
            mobileMenuSlider.update();
          }

          //gnbModel.activate( 1, 2 );
          pageManager.common.init();          
        }
      });
    }
  };

  if (is_page && is_page.toLowerCase() === 'main') {
    pageManager.main.init();
  }

  pageManager.jsonLoader.load(jsonPath);
});
