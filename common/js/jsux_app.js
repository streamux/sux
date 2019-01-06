jsux.gnb = jsux.gnb || {};
jsux.gnb.Model = jsux.Model.create();
(function(app, $){  
  app.include({

    sizeList: [],
    setData: function(infoObj) {

      this.setChanged();
      this.notifyObserver( infoObj );
    },
    activate: function( mid, sid) {

      var len = this.observers.length;
      for (var i=0; i<len; i++) {
        this.observers[i].activate( mid, sid );
      }
    },
    menuOn: function(m, s) {

      var len = this.observers.length;
      for (var i=0; i<len; i++) {
        this.observers[i].menuOn(m, s);
      }
    },
    menuOff: function() {

      var len = this.observers.length;
      for (var i=0; i<len; i++) {
        this.observers[i].menuOff();
      }
    },
    tick: function() {

      var len = this.observers.length;
      for (var i=0; i<len; i++) {
        this.observers[i].tick();
      }
    },
    getSizeList: function() {

      return this.sizeList;
    },
    setSizeList: function( value ) {

      this.sizeList = value;
    },
    resetUI: function() {
      var len = this.observers.length;
      for (var i=0; i<len; i++) {
        this.observers[i].resetUI();
      }
    }
  });


  app.create = function() {

    return new jsux.gnb.Model();
  };
})(jsux.gnb.Model, jQuery);

/**
 * class gnb
 * update 2017.10.26
 * author streamux.com
 * description 'span 제거'
 */
jsux.gnb = jsux.gnb || {};
jsux.gnb.Menu = jsux.View.create();
(function( app, $ ){

  var GNB = function( p, m ) {

    var _scope = this,
          _path = p,
          _stage = $(p),
          _data = null,
          _list = [],
          _m = m,
          _activateIds = '',
          _timer = -1,
          _oldItem$ = null;

    this.addClass = function(target, className ) {

      if (!$(target).hasClass(className)) {
        $(target).addClass(className);
      }
    };

    this.removeClass = function(target, className ) {

      if ($(target).hasClass(className)) {
        $(target).removeClass(className);
      }
    };

    this.update = function( o,  value ) {

      _data = value;
    };
    this.resetUI = function() {

      this.setUI();
      this.setEvent();
    };
    this.setUI = function() {

      var self = this;
      var ty = 0;
      var markup = $('#gnbMenuItem').html();
      var depth = 0;
      var linkFilter = /^(http(s)?:\/\/(www\.)?)?([a-zA-Z0-9-_]+)\.([a-zA-Z]+)/;

      var stage$ = $(_path);
      if (stage$ && stage$.children().length > 0) {
        return;
      }

      $(_path).empty();
      var menuManager = (function f(target, data) {

        $(data).each(function(index) {

          var menu$ = $(markup).appendTo(target);
          menu$.attr('data-id', index);
          menu$.attr('data-depth', depth);

          var menu_a$ =  menu$.find('> a');
          var link = data[index].link;

          if (!linkFilter.test(link)) {
            link = jsux.rootPath + link;
          }

          menu_a$.attr('href', link);
          menu_a$.attr('target', data[index].link_target);
          menu_a$.text(data[index].label);

          data[index].depth = depth;
          data[index].target = target;
        });

        // 1뎁스 메뉴 생성 후 정렬을 먼저 실행
        //if (depth === 0) self.alignUI();

        for (var i=0; i<data.length; i++) {

          if (data[i].menu && data[i].menu.length > 0) {
            depth = data[i].depth + 1;
            target = data[i].target + '> li:eq('+ i + ') > .sub_mask > ul';
            arguments.callee(target, data[i].menu);
          }
        }  // end of for
      });
      menuManager(_path, _data);
      menuManager = null;
    };

    this.alignUI = function() {

      var max_width = _stage.outerWidth(),
            max_txtWidth = 0,
            spaceWidth = 0,
            wdRate = 0,
            wd = 0,
            sizeList = [];

      _list = _stage.find("> .sx-menu");

      $( _list ).each(function(index){
        max_txtWidth += $(this).find("> a").outerWidth();
      });

      spaceWidth = Math.floor((max_width - max_txtWidth)/_data.length);

      $( _list ).each(function(index) {
        wdRate = Math.floor((100-0)/(max_width - 0)*(($(this).find("> a").outerWidth()+spaceWidth) - 0) + 0);

        // 마지막은 항상 나머지 비율로 100%를 채운다.
        if (index == _list.length-1) {
          wdRate = 100-wd;
        }

        wd += wdRate;
        $( this ).css("width", wdRate+"%");

        sizeList.push(wdRate);
      });

      _m.setSizeList( sizeList );
    };

    this.getActivatedId = function(el$) {

      var idList = [];
      var idManager = (function f(target) {

         var depth = target.data('depth');
         var id = target.data('id');
         idList.unshift(id);

         if (target && depth && depth >= 0) {
            arguments.callee(target.parent().parent().parent());
         }
      });
      idManager(el$);
      idManager = null;

      return idList;
    };

    this.setEvent = function() {

      _stage.find('.sx-menu > a').on('focus', function(e){

        _scope.stopTimer();

        // ids is same as '1,2,3,...'
        var ids = _scope.getActivatedId($(this).parent()).toString(',');
        _m.menuOn(ids);
      });

      _stage.find('.sx-menu > a').on('mouseover', function(e){

        _scope.stopTimer();

        // ids is same as '1,2,3,...'
        var ids = _scope.getActivatedId($(this).parent()).toString(',');
        _m.menuOn(ids);
      });

      _stage.find('.sx-menu > a').on('blur', function(e){

        _scope.startTimer();
      });

      _stage.find('.sx-menu > a').on('mouseout', function(e){

        _scope.startTimer();
      });

      _stage.find('.sx-menu > a').on('click', function(e){
        e.preventDefault();

        var url = $( this ).attr('href');
        var target = $( this ).attr('target');

        if (url === '#none' || url === '' || url === undefined) {
          return;
        }

        target = target ? target : '_self';
        jsux.goURL(url, target );
      });
    };

    this.menuOn = function(ids) {

      _scope.mouseHandler({type:'mouseover', active_ids: ids});
    };

    this.menuOff = function() {

      _scope.mouseHandler({type:'mouseout'});
    };

    this.mouseHandler = function(e) {

      var self = this;
      var type = e.type;
      var activeIds = e.active_ids ? e.active_ids : [];
      var idList = typeof(activeIds) === 'string' ? activeIds.split(',') : activeIds;
      var maxDepth = idList.length;
      var depth = 0;
      var menuStage$ = $('.sx-gnb');

      switch(type) {

        case 'mouseover' :

          var activeManager = (function f(el$) {

            var list$ = el$.find('> .sx-menu');

            list$.each(function(index) {
              var that$ = $(this);

              if (that$.data('id') == idList[depth]) {
                self.addClass(that$.find('> a'), 'active');

                if (that$.find('> .sub_mask > ul').children().length > 0) {
                  self.addClass(that$.find('> .sub_mask'), 'sub_mask_active');
                }

                if (_oldItem$ && that$.data('depth') < _oldItem$.data('depth')) {
                  self.removeClass(_oldItem$.find('> a'), 'active');
                  self.removeClass(_oldItem$.find('.sub_mask'), 'sub_mask_active');
                }
                _oldItem$ = that$;
              } else {
                self.removeClass(that$.find('a'), 'active');
                self.removeClass(that$.find('.sub_mask'), 'sub_mask_active');
              }
            });

            depth++;
            if (depth < maxDepth) {
              arguments.callee(list$.find('> .sub_mask > ul'));
            }
          });
          activeManager(menuStage$);
          activeManager = null;
          break;

        case 'mouseout':
          self.removeClass(menuStage$.find('a'), 'active');
          self.removeClass(menuStage$.find('.sub_mask'), 'sub_mask_active');
          break;

        default:
          break;
      }

      menuStage$ = null;
    };

    this.activate = function(ids) {

      _activateIds = ids;
      _scope.mouseHandler({type:'mouseover', active_ids: ids});
    };

    this.tween = function( target, time, obj) {

      if (TweenLite) {
        TweenLite.to( target, time, obj);
      }
    };

    this.startTimer = function() {

      if (_timer == -1) {
        _timer = setInterval(function(){

          if (_activateIds) {
            _m.menuOn(_activateIds);
          } else {
            _m.menuOff();
          }
          _scope.stopTimer();

        }, 500);
      }
    };

    this.stopTimer = function() {

      if (_timer) {
        clearInterval(_timer);
        _timer = -1;
      }
    };

    this.replaceNumber = function( str ) {

      return str.replace(/[^(0-9)]/gi, '');
    };
  };

  app.create = function( path, m ) {

    if ($(path).length<1) {
      $( document.body ).append('<div id="TEMP_GNB_CASE" class="sx-gnb"></div>');
      path = '#TEMP_GNB_CASE';
    }
    return new GNB(path, m);
  };
})(jsux.gnb.Menu, jQuery);
jsux.mobileGnb = jsux.mobileGnb || {};
jsux.mobileGnb.Menu = jsux.View.create();
jsux.mobileGnb.Menu.include({

  _path: '',
  _m: '',
  _isClick: false,
  _data: null,
  _startPosX: "100%",
  _targetPosX: 52,
  _isMobile: false,
  _isPc: false,
  _swiper: null,

  addClass: function(parent, target) {

    if (!$(parent).hasClass(target)) {
      $(parent).addClass(target);
    }
  },
  removeClass: function(parent, target) {

    if ($(parent).hasClass(target)) {
      $(parent).removeClass(target);
    }
  },
  update: function(o, value) {

    this._data = value;

    this.defaultSetting();
    this.setUI();
    this.setEvent();
  },
  resizeUI: function(value) {

    var tw = parseInt(value);

    if (isNaN(tw)) {
      throw new Error('not a valid number');
    }

    if (tw < 768 && this._isMobile === false) {
      this._isMobile = true;
      this._isPc = false;

      if (this._isClick === true) {
        this.show();
      }
    } else if (tw >= 768 && this._isPc === false) {
      this._isMobile = false;
      this._isPc = true;

      this.hide();
      this._m.resetUI();
    }

    this._startPosX  = tw;
  },
  resetUI: function() {

     this.setSwiper();
  },
  defaultSetting: function() {

    this._path = jsux.mobileGnb.Menu.path;
    this._m = jsux.mobileGnb.Menu.m;
  },
  setSwiper: function() {

    if (this._swiper === null && this._isMobile === true) {
      this._swiper = new Swiper('.swiper-container-mobilegnb', {
        scrollbar: '.swiper-scrollbar-mobilegnb',
        direction: 'vertical',
        slidesPerView: 'auto',
        mousewheelControl: true,
        freeMode: true
      });

      this._swiper.onResize();
    }
  },
  setUI: function() {

    var self = this,
          linkFilter = /^(http(s)?:\/\/(www\.)?)?([a-zA-Z0-9-_]+)\.([a-zA-Z]+)/,
          markup = '',
          subMenu = null,
          menu_stage = null,
          depth = 0;

    markup = $('#gnbMenuItem').html();
    menu_stage = $(this._path).empty();

    var menuManager = (function f(target, data) {

      $(data).each( function( index ){

        var menu$ = $(markup).appendTo(target);
        menu$.attr('data-id', index);
        menu$.attr('data-depth', depth);

        var menu_a$ =  menu$.find('> a');
        var link = data[index].link;

        if (!linkFilter.test(link)) {
          link = jsux.rootPath + link;
        }

        menu_a$.attr('href', link);
        menu_a$.attr('target', data[index].link_target);
        menu_a$.text(data[index].label);

        data[index].depth = depth;
        data[index].target = target;
      }); // end of each

      for (var i=0; i<data.length; i++) {

        if (data[i].menu && data[i].menu.length > 0) {
          depth = data[i].depth + 1;
          target = data[i].target + '> li:eq('+ i + ') > .sub_mask > ul';
          arguments.callee(target, data[i].menu);
        }
      } //end of for


    });
    menuManager(this._path, this._data);
    menuManager = null;
  },
  jumpFocus: function(id) {

    $(id).focus();
  },
  hideGnbCase: function() {

    this.addClass('.mobile-gnb-case', 'mobile-gnb-case-inactive');
    this.removeClass('.mobile-gnb-case', 'mobile-gnb-case-active');
  },
  showGnbCase: function() {

    this.addClass('.mobile-gnb-case', 'mobile-gnb-case-active');
    this.removeClass('.mobile-gnb-case', 'mobile-gnb-case-inactive');
  },
  setEvent: function() {

    var self = this;

    $('.mobile-menu-btn').on('mouseover', function(e) {
      self.addClass('.mobile-menu-bg', 'menu-bg-activate');
    });

    $('.mobile-menu-btn').on('mouseout', function(e) {
      self.removeClass('.mobile-menu-bg', 'menu-bg-activate');
    });

    $('.mobile-menu-btn').on('click', function(e) {

      self.show();
      self.openSlide();
      self.hideMobileMenu();
      self.jumpFocus('.sx-gnb-login');
      self.setSwiper();

      self._isClick = true;
    });

    $('.mobile-gnb-case').on('click', function(e) {

      e.preventDefault();

      var url = $(e.target).attr('href'),
        target = $(e.target).attr('target');

      if (!url) {
         url = $(e.target).parent().attr('href');
         target = $(e.target).parent().attr('target');
      }

      if (url) {
        self.click(url, target);
      }
    });

    $('.menu-btn-close').on('click', function(e) {

      self.closeSlide();
      self._isClick = false;
    });

    $('.menu-btn-close').on('blur', function(e) {

      if (self._isClick === false) {
        return;
      }

      self.closeSlide();
      self._isClick = false;
    });

    $('.menu-btn-close').on('keydown', function(e) {

      var key = e.key.toUpperCase();
      if (key.match('Enter') === true) {
        self.jumpFocus('.mobile-menu-btn');
      }
    });

    $('.sx-bgcover').on('click', function(e) {

      self.closeSlide();
      self._isClick = false;
    });
  },
  tween: function( target, time, op ) {
    TweenMax.to(target, time, op);
  },
  killTween: function( target ) {
    TweenMax.killTweensOf( target );
  },
  showCloseX: function() {

    this.killTween('.menu-btn-close .sx-h-3stick');
    this.killTween('.menu-btn-close');

    this.tween('.menu-btn-close', 1, {opacity:0, useFrames:true});
    this.tween('.menu-btn-close', 13, {opacity:1, ease: Expo.easeOut, useFrames:true});
    this.tween('.menu-btn-close .sx-h-3stick', 65, {rotation:360, useFrames:true});
  },
  hideCloseX: function() {

    var self = this;
    this.killTween('.menu-btn-close .sx-h-3stick');
    this.killTween('.menu-btn-close');

    this.tween('.menu-btn-close', 13, {opacity:0, useFrames:true, onComplete: $.proxy(self.showMobileMenu, self)});
    this.tween('.menu-btn-close .sx-h-3stick', 65, {rotation:0, useFrames:true});
  },
  showMobileMenu: function() {

    var self = this;

    this.killTween('.mobile-menu-btn .sx-h-3stick');

    $('.mobile-menu-btn .sx-h-3stick').find('> li').each(function(index) {
      self.tween(this, 21, {opacity:1, useFrames:true});
    });

    this.tween('.mobile-menu-btn .sx-h-3stick .sx-hline1', 21, {y:0, useFrames:true});
    this.tween('.mobile-menu-btn .sx-h-3stick .sx-hline3', 21, {y:0, useFrames:true});
  },
  hideMobileMenu: function() {

    var self = this;

    this.killTween('.mobile-menu-btn .sx-h-3stick');

    $('.mobile-menu-btn .sx-h-3stick').find('> li').each(function(index) {
      self.tween(this, 21, {opacity:0, useFrames:true});
    });
  },
  openSlide: function() {

    self = this;

    $('.mobile-gnb-case').css({'transform':'translateX('+this._startPosX+'px)'});

    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline1');
    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline3');
    this.tween('.mobile-gnb-case', 17, {x:this._targetPosX, useFrames:true,onComplete: $.proxy(self.showCloseX, self)});
    this.tween('.mobile-menu-btn .sx-h-3stick .sx-hline1', 12, {y:6, useFrames:true});
    this.tween('.mobile-menu-btn .sx-h-3stick .sx-hline3', 12, {y:-6, useFrames:true});
  },
  closeSlide: function() {

    var self = this;

    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline1');
    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline3');
    this.tween('.mobile-gnb-case', 17, {x:this._startPosX, useFrames:true, onComplete: $.proxy(self.hide, self)});

    this.hideCloseX();
  },
  show: function() {

    this.showGnbCase();
    this.addClass('.sx-bgcover', 'sx-bgcover-active');
    this.addClass('.mobile-gnb-case', 'mobile-gnb-case-active');
    this.addClass('html', 'sx-hide-scroll');
    this.addClass('.wrapper', 'wrapper-reposition');
  },
  hide: function() {

    this.hideGnbCase();
    this.removeClass('.sx-bgcover', 'sx-bgcover-active');
    this.removeClass('.mobile-gnb-case', 'mobile-gnb-case-active');
    this.removeClass('html', 'sx-hide-scroll');
    this.removeClass('.wrapper', 'wrapper-reposition');
  },
  showSitemap: function() {

    $('.mobile-menu-btn').trigger('click');
  },
  click: function( url, target) {

    //console.log( 'url : %s / target : %s', url, target);
    if (url === '#none' || url === '' || url === undefined){
      return;
    }

    jsux.goURL(url, target);
  },
  menuOn: function() {

  },
  menuOff: function() {

  },
  activate: function(id) {

  }
});

jsux.mobileGnb.Menu.extend({

  create: function( path, m) {

    if ($(path).length<1) {

      var markup = '<ul id="mobileGnb" class="sx-menu-panel"></ul>';
      $( document.body ).append( markup );
      this.path = '#mobileGnb';
    } else {
      this.path = path;
    }
    this.m = m;

    return new jsux.mobileGnb.Menu();
  }
});
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
