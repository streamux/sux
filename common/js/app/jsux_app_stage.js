$(window).ready(function() {
  
  var gnbModel = jsux.gnb.Model.create(),
        gnbView = jsux.gnb.Menu.create("#sxGnb", gnbModel),
        mobileGnbView = jsux.mobileGnb.Menu.create("#mobileGnb", gnbModel),
        pageAppHandler = {},
        jsonPath = jsux.rootPath + 'files/gnb/gnb.json',
        menuList = null,
        mobileMenuSlide = null;

  gnbModel.addObserver( gnbView );
  gnbModel.addObserver( mobileGnbView );

  jsux.mobileGnbView = mobileGnbView;

  mobileMenuSlide = new Swiper('.swiper-container-mobilegnb', {
      scrollbar: '.swiper-scrollbar-mobilegnb',
      direction: 'vertical',
      slidesPerView: 'auto',
      mousewheelControl: true,
      freeMode: true
    });

  pageAppHandler.home = {

    init: function() {
      var visualView = jsux.visual.View.create();
    }
  };
  pageAppHandler.sub = {

    init: function() {

      $('.ui-bg-cover').on('scroll touchmove mousewheel', function(e) {
        e.preventDefault();
        e.stopPropagation();
        return;
      });

      $(window).on('resize', function(e){

        var tw = $(window).outerWidth();
        mobileGnbView.resizeUI(tw);
        mobileMenuSlide.onResize();        
      });

      $(window).trigger('resize');
      mobileGnbView.hideGnbCase();
    }
  };

  pageAppHandler.jsonLoader = {

    load: function(path) {

      $.ajax({
        url: path,
        dataType: 'json',
        jsonpCallback: 'JSON_CALLBACK',
        success: function(json) {

          var data = json.data;
          menuList = [];

          if (data.length > 0) {

            var dataManager = (function f(list, data){

              for (var i=0; i<data.length; i++) {
                list.push({
                  label: data[i].menu_name,
                  link: data[i].url,
                  menu:[]
                });

                if (data[i].sub && data[i].sub.length > 0) {
                  arguments.callee(list[i].menu, data[i].sub);
                }
              }
            });

            dataManager(menuList, data);
            dataManager = null;

            gnbModel.setData( menuList );
            mobileMenuSlide.update();
          }

          //gnbModel.activate( 1, 2 );
          pageAppHandler.sub.init();          
        }
      });
    }
  };

  switch(is_page) {   
    case 'main':
      pageAppHandler.home.init();
      break;
    default:
      break;      
  }
  pageAppHandler.jsonLoader.load(jsonPath);
});
