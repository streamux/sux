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
      _stage = $(p),     
      _data = null,
      _list = [],
      _m = m,
      _mid = -1,
      _sid = -1,
      _oldMid = -1,
      _oldSid = -1,
      _activateMid = -1,
      _activateSid = -1,
      _timer = -1,
      _activate = 'active';

    this.update = function( o,  value ) {

      _data = value;
      this.setUI();       
      this.setEvent();
    };

    this.setActivateClass = function( className) {

      _activate = className;
    };

    this.setUI = function() {

      var ty = 0;
      var markup = $('#gnbFirstMenu').html();
      var subMarkup = $('#gnbSecondMenu').html();

      $( _data ).each(function(mindex) {

        ty = (_data[mindex].menu !== undefined) ? -1*_data[mindex].menu.length * (34+1) : 0;
      
        _stage.append(markup);
        var menu = _stage.find('.sx-mmenu:eq('+mindex+') > li');
        menu.attr('data-mid', mindex);
        menu.attr('data-sid', -1);

        var menu_a =  menu.find('> a');
        menu_a.attr('href', _data[mindex].link);
        menu_a.attr('title', _data[mindex].label);
        menu_a.text(_data[mindex].label);

        var sub_panel = menu.find('.sx-gnb-sub > .panel');
        sub_panel.attr('data-startPosY', ty+'px');
        sub_panel.css('top', ty+'px');
      });

      this.alignUI();

      $( _data ).each(function(mindex) {

        $( _data[mindex].menu ).each(function(sindex) {           
          _stage.find('.sx-mmenu:eq('+mindex+') .sx-gnb-sub > ul').append(subMarkup);

          var subMenu = _stage.find('.sx-mmenu:eq('+mindex+') .sx-gnb-sub > ul > li:eq('+sindex+')');
          subMenu.attr('data-mid', mindex);
          subMenu.attr('data-sid', sindex);
          subMenu.find('> a').attr('href', _data[mindex].menu[sindex].link);
          subMenu.find('> a').attr('title', _data[mindex].menu[sindex].label);
          subMenu.find('> a').text(_data[mindex].menu[sindex].label);
        });
      });
    };

    this.alignUI = function() {

      var max_width = _stage.width(),
            max_txtWidth = 0,
            spaceWidth = 0,
            wdRate = 0,
            wd = 0,
            wd_lastChild = 0,
            sizeList = [];

      _list = _stage.find(".sx-mmenu");

      $( _list ).each(function(mindex){
        max_txtWidth += $(this).find("li > a").width();
      });

      spaceWidth = Math.floor((max_width - max_txtWidth)/_data.length);

      $( _list ).each(function(mindex) {

        wdRate = Math.floor((100-0)/(max_width - 0)*(($(this).find("li > a").width()+spaceWidth) - 0) + 0);  

        // 마지막은 항상 나머지 비율로 100%를 채운다.
        if (mindex == _list.length-1) {
          wdRate = 100-wd;
        }
        wd += wdRate;       
        $( this ).css("width", wdRate+"%");

        sizeList.push(wdRate);  
      });

      _m.setSizeList( sizeList );
    };

    this.setEvent = function() {

      _stage.find('.sx-mmenu > li > a').on('mouseover', function(e){

        e.preventDefault();
        _scope.stopTimer();

        _m.menuOn( $( this ).parent().attr('data-mid'), -1 ); 
      });

      _stage.find('.sx-mmenu > li > a').on('mouseout', function(e){

        e.preventDefault();
        _scope.startTimer();
        
      });

      _stage.find('.sx-mmenu > li > a').on('click', function(e){

        e.preventDefault();

        var url = _data[$( this ).parent().attr('data-mid')].link;
        if (url === '') {
          return;
        }
        jsux.goURL( jsux.rootPath + url, '_self' ); 
      });

      _stage.find('.sx-smenu > a').on('mouseover', function(e){

        e.preventDefault();
        _scope.stopTimer();
        _m.menuOn( $( this ).parent().attr('data-mid'), $( this ).parent().attr('data-sid') );
        
      });

      _stage.find('.sx-smenu > a').on('mouseout', function(e){

        e.preventDefault();
        _scope.startTimer();        
      });

      _stage.find('.sx-smenu > a').on('click', function(e){

        e.preventDefault();

        var url = _data[$( this ).parent().attr('data-mid')].menu[$( this ).parent().attr('data-sid')].link;
        jsux.goURL( jsux.rootPath + url, '_self' );       
      });
    };

    this.mouseHandler = function(e, obj) {
      
      var type = e.type,
            menu  = null,
            menu_a = null,
            oldmenu_a = null,
            submenu = null,
            submenu_a = null,
            old_smenu_a = null,
            mask = null,
            panel = null,
            ty = 0,
            th = 0,
            oldMask = null,
            oldPanel = null,
            oldth = 0,
            oldty = 0;

      _mid  = obj.mid;
      _sid  = obj.sid;

      switch(type) {

        case 'mouseover' :          

          if (_mid > -1) {
            menu   = _list.eq(_mid);
            menu_a = menu.find('> li > a');
            if (!menu_a.hasClass(_activate)) {

              mask = menu.find('.sx-gnb-sub');
              panel = menu.find('.sx-gnb-sub .panel');
              ty = 0;
              th = _list.eq(_mid).find('.sx-gnb-sub .panel').attr('data-startPosY').replace(/[^(0-9)]/gi, '');

              menu_a.addClass(_activate);

              _scope.tween( panel, 10, {'top': ty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {

                var mh = th - panel.css('top').replace(/[^(0-9)]/gi, '');
                mask.css('height', mh);
              }});
            } 
          }
          
          if (_sid > -1) {
            submenu  = _list.eq(_mid).find('.sx-gnb-sub .sx-smenu').eq(_sid);         
            submenu_a = submenu.find('> li > a');

            if (!submenu_a.hasClass(_activate)) {
              submenu_a = submenu.find('> li > a');
            }
            submenu_a.addClass(_activate);
          }

          if (_oldMid != _mid && _oldMid > -1) {

            oldmenu_a = _list.eq(_oldMid).find('> li > a');

            oldMask = _list.eq(_oldMid).find('.sx-gnb-sub');
            oldPanel  = oldMask.find('> .panel');
            oldty = oldPanel.attr('data-startPosY');
            oldth = oldPanel.attr('data-startPosY').replace(/[^(0-9)]/gi, '');

            oldmenu_a.removeClass(_activate);

            _scope.tween( oldPanel, 10, {'top': oldty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {
              
              var mh = oldth - oldPanel.css('top').replace(/[^(0-9)]/gi, '');
              oldMask.css('height', mh);
            }});
          }

          if (_oldSid != _sid && _oldSid > -1) {
            old_smenu_a = _list.eq(_oldMid).find('.sx-gnb-sub .sx-smenu').eq(_oldSid).find('> li > a');
            old_smenu_a.removeClass(_activate);
          }         

          _oldMid = _mid;
          _oldSid   = _sid;
          break;

        case 'mouseout':

          if (_mid > -1) {
            menu = _list.eq(_mid);
            menu_a = menu.find('> li > a');
            if (menu && menu_a.hasClass(_activate)) {

              panel   = menu.find('.sx-gnb-sub .panel');
              ty    = menu.find('.sx-gnb-sub .panel').attr('data-startPosY');
              oldth = _list.eq(_mid).find('.sx-gnb-sub .panel').attr('data-startPosY').replace(/[^(0-9)]/gi, '');

              menu_a.removeClass(_activate);
              _scope.tween( panel, 10, {'top': ty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {
              
                var mh = oldth - $( panel ).css('top').replace(/[^(0-9)]/gi, '');
                menu.find('.sx-gnb-sub').css('height', mh);
              }});
            }
          }

          if (_sid > -1) {
            submenu  = menu.find('.sx-gnb-sub .sx-smenu').eq(_sid);
            submenu_a = submenu.find('> li >a');
            if (submenu && submenu_a.hasClass(_activate)) {
              submenu_a.removeClass(_activate);
            }
          }
          break;

        default:
          break;
      }
    };

    this.activate = function(m, s) {

      _activateMid  = parseInt(m, 10);
      _activateSid  = parseInt(s, 10);

      if (_activateMid <=0 && _activateMid > _data.length) {
        warn('It not a Avaliable Depth1\'s Number!');
        return;
      } 

      if (_activateSid <= 0 && _activateSid > _data[mid].menu.length) {
        warn('It not a Avaliable Depth2\'s Number!');
        return;
      }

      _activateMid  = _activateMid - 1;
      _activateSid    =  _activateSid - 1;

      this.menuOn( _activateMid, _activateSid);
    };

    this.menuOn = function(m, s) {

      _scope.mouseHandler({type:'mouseover'}, {mid: m, sid: s});
    };

    this.menuOff = function() {

      _scope.mouseHandler({type:'mouseout'}, {mid: _mid, sid: _sid});
    };

    this.tween = function( target, time, obj) {

      TweenLite.to( target, time, obj);
    };

    this.startTimer = function() {

      if (_timer == -1) {
        _timer = setInterval(function(){

          if (_activateMid > -1) {
            _m.menuOn(_activateMid, _activateSid);
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
    }
  });

  app.create = function() {

    return new jsux.gnb.Model();
  };
})(jsux.gnb.Model, jQuery);

jsux.mobileGnb = jsux.mobileGnb || {};
jsux.mobileGnb.Menu = jsux.View.create();
jsux.mobileGnb.Menu.include({

  _path: '',
  _m: '',
  _isClick: false,
  _data: null,
  _startPosX: "100%",
  _targetPosX: 52,

  update: function(o, value) {

    this._data = value;
    this.setUI();
    this.setEvent();
  },
  tween: function( target, time, op ) {
    TweenMax.to(target, time, op);
  },
  killTween: function( target ) {
    TweenMax.killTweensOf( target );
  },
  showCloseX: function() {

    this.killTween('.menu-btn-close');
    this.killTween('.menu-btn-close .sx-h-3stick');
    this.tween('.menu-btn-close', 1, {opacity:0, useFrames:true});
    this.tween('.menu-btn-close', 13, {opacity:1, ease: Expo.easeOut, useFrames:true});
    this.tween('.menu-btn-close .sx-h-3stick', 65, {rotation:360, useFrames:true});
  },
  hideCloseX: function() {

    var self = this;
    this.killTween('.menu-btn-close');
    this.killTween('.menu-btn-close .sx-h-3stick');
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

    $('#test_startPosX').val(this._startPosX);

    this.killTween('.mobile-gnb-case');
    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline1');
    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline3');
    this.tween('.mobile-gnb-case', 17, {x:this._targetPosX, useFrames:true,onComplete: $.proxy(self.showCloseX, self)});
    this.tween('.mobile-menu-btn .sx-h-3stick .sx-hline1', 12, {y:6, useFrames:true});
    this.tween('.mobile-menu-btn .sx-h-3stick .sx-hline3', 12, {y:-6, useFrames:true});
  },
  closeSlide: function() {

    var self = this;

    this.killTween('.mobile-gnb-case');
    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline1');
    this.killTween('.mobile-menu-btn .sx-h-3stick .sx-hline3');
    this.tween('.mobile-gnb-case', 17, {x:this._startPosX, useFrames:true, onComplete: $.proxy(self.hide, self)});    

    this.hideCloseX();  
  },
  show: function() {

    $('.sx-bgcover').removeClass('sx-bgcover-off');
    $('.sx-bgcover').addClass('sx-bgcover-on');
    $('.mobile-gnb-case').removeClass('mobile-gnb-case-off'); 
    $('.mobile-gnb-case').addClass('mobile-gnb-case-on');
    $('html').addClass('sx-hide-scroll');
    $('.wrapper').addClass('wrapper-reposition');
  },
  hide: function() {  

    $('.sx-bgcover').removeClass('sx-bgcover-on');
    $('.sx-bgcover').addClass('sx-bgcover-off');
    $('.mobile-gnb-case').removeClass('mobile-gnb-case-on');
    $('.mobile-gnb-case').addClass('mobile-gnb-case-off');
    $('html').removeClass('sx-hide-scroll');
    $('.wrapper').removeClass('wrapper-reposition');
  },
  showSitemap: function() {

    $('.mobile-menu-btn').trigger('click');
  },
  click: function( url, target) {

    //console.log( 'url : %s / target : %s', url, target);
    if (!(url === '#none' || url === '' || url === undefined)){
      jsux.goURL(url, target);
    }
  },
  setUI: function() {var self = this, markup = '',
      menu = null,
      subMenu = null;

    this._path = jsux.mobileGnb.Menu.path;
    this._m = jsux.mobileGnb.Menu.m;
    markup = $('#suxMobileGnbFirstMenu').html();
    var menu_stage = $(this._path).empty();

    $(this._data).each( function( index ){

      menu_stage.append( markup );
      menu = menu_stage.find('> li:eq('+index+')');
      menu.attr('data-code', index);
      menu.find(' > a').attr('href', self._data[index].link);
      menu.find(' > a').append(self._data[index].label);
      
      if (self._data[index].menu !== undefined && self._data[index].menu.length > 0) {        
        markup = $('#suxMobileGnbSecondMenuCase').html();
        menu.append( markup );
        menu.find('.sx-second-menu > ul').empty();

        $(self._data[index].menu).each( function( subIndex){      

          if (self._data[index].menu[subIndex].label) {
            markup = $('#suxMobileGnbSecondMenu').html();
            menu.find('.sx-second-menu > ul').append( markup );

            subMenu = menu.find('.sx-second-menu > ul > li:eq('+subIndex+')');
            subMenu.attr('data-code', index);
            subMenu.attr('data-sub-code', subIndex);
            subMenu.find(' > a').attr('href', self._data[index].menu[subIndex].link);
            subMenu.find(' > a').append(self._data[index].menu[subIndex].label);
          }           
        });
      }     
    });   
  },
  setEvent: function() {

    var self = this;
    $('.mobile-menu-btn').on('mouseover', function(e) {
      e.preventDefault();
      if (!$('.mobile-menu-bg').hasClass('menu-bg-activate')) {
        $('.mobile-menu-bg').addClass('menu-bg-activate');
      }      
    });
    $('.mobile-menu-btn').on('mouseout', function(e) {
      e.preventDefault();
      if ($('.mobile-menu-bg').hasClass('menu-bg-activate')) {
        $('.mobile-menu-bg').removeClass('menu-bg-activate');
      }      
    });

    $('.mobile-menu-btn').on('click', function(e) {
      e.preventDefault();
      self.show();
      self.openSlide();
      self.hideMobileMenu();
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

    $('.mobile-gnb-case .menu-btn-close').on('click', function(e) {
      e.preventDefault();
      self.closeSlide();
      self._isClick = false;  
    });
    
    $('.sx-bgcover').on('click', function(e) {
      e.preventDefault();
      self.closeSlide();
      self._isClick = false;  
    });

    $(window).on('resize', function(e){

      //trace( self._isClick, 1);
      var tw = $(window).outerWidth();
      if (tw < 769 && self._isClick === true) {
        self.show();
      } else if (tw > 768) {
        self.hide();
      }
      self._startPosX  = tw;
    });
    $(window).trigger('resize');
    this.tween('.mobile-gnb-case', 1, {x:this._startPosX, useFrames:true});
  },
  menuOn: function() {

  },
  menuOff: function() {

  }
});

jsux.mobileGnb.Menu.extend({

  create: function( path, m) {

    if ($(path).length<1) {

      var markup = '<div id="mobileGnb" class="sx-body-panel"><div class="sx-menu-panel"><ul></ul></div></div>';
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