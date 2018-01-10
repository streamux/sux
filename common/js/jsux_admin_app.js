$(document).ready(function() {

  var adminMobilePanel = new SXAdminMobilePanel();
  adminMobilePanel.init();

  var adminMenu = new SXAdminMenu();
  adminMenu.init();
});

var SXAdminMobilePanel = function() {

  var self = this;
  var isReadClickMenu = true;
  var oldTarget = null;

  this.removeClass = function(target, id) {

    var $gnbCase = $(target);
    if ($gnbCase.hasClass(id)) {
      $gnbCase.removeClass(id);
    }
  };
  this.addClass = function(target, id) {

    var $gnbCase = $(target);
    if (!$gnbCase.hasClass(id)) {
      $gnbCase.addClass(id);
    }
  };

  this.hideMobileMenu = function() {

    var option = {'margin-top':10,'margin-bottom':-2};
    var duration = 500;
    var easing = 'easeOutExpo';
    $('.sx-menu-btn').animate({'opacity':0}, duration, easing, function() {
      self.showCloseBtn();
    });
    $('.sx-menu-btn .sx-menu > li:first-child').animate(option, duration, easing);

    option = {'margin-top':0,'margin-bottom':0};
    $('.sx-menu-btn .sx-menu > li:nth-child(2)').animate(option, duration, easing);

    option = {'margin-top':-2,'margin-bottom':10};
    $('.sx-menu-btn .sx-menu > li:last-child').animate(option, duration, easing);
  };

  this.showMobileMenu = function() {

    var option = {'margin-top':5,'margin-bottom':5};
    var duration = 300;
    var easing = 'easeOutExpo';

    $('.sx-menu-btn').animate({'opacity':1}, duration, easing);
    $('.sx-menu-btn .sx-menu > li:first-child').animate(option, duration, easing);
    $('.sx-menu-btn .sx-menu > li:nth-child(2)').animate(option, duration, easing);
    $('.sx-menu-btn .sx-menu > li:last-child').animate(option, duration, easing);
  };

  this.hideCloseBtn = function() {    
    this.removeClass('.sx-close-btn', 'sx-close-inactive');
    this.removeClass('.sx-header', 'sx-header-active');
    this.removeClass('.sx-bgcover', 'sx-bgcover-active');
  };

  this.showCloseBtn = function() {
    this.addClass('.sx-close-btn', 'sx-close-active');    
  };

  this.slideInGnbPanel = function() {

    this.addClass('.sx-header', 'sx-header-active');
    this.addClass('.sx-gnb-case', 'sx-slide-in');
    this.addClass('.sx-bgcover', 'sx-bgcover-active');
    this.addClass('html', 'sx-hide-scroll');
    this.hideMobileMenu();
    this.removeTransitionEnd();

    isReadClickMenu = false;
  };

  this.slideOutGnbPanel = function() {

    this.removeClass('.sx-gnb-case', 'sx-slide-in');
    this.removeClass('.sx-close-btn', 'sx-close-active');
    this.removeClass('html', 'sx-hide-scroll');
    this.addClass('.sx-close-btn', 'sx-close-inactive');
    this.addTransitionEnd();
  };

  this.addTransitionEnd = function() {

    var $gnbCase = $('.sx-gnb-case');
    $gnbCase.on('transitionend', function(e){

      self.removeTransitionEnd();
      self.showMobileMenu();
      self.hideNavPanel();
      self.hideCloseBtn();

      isReadClickMenu = true;
    });
  };

  this.removeTransitionEnd = function() {

    var $gnbCase = $('.sx-gnb-case');
    $gnbCase.off('transitionend');
  };

  this.showNavPanel = function() {

    this.addClass('.sx-nav-bar', 'sx-nav-active');
  };

  this.hideNavPanel = function() {

    this.removeClass('.sx-nav-bar', 'sx-nav-active');
  };

  this.setEvent = function() {

    var self = this;

    $('.sx-menu-btn').on('click', function() {

      if (!isReadClickMenu) {
        return;
      }

      self.showNavPanel();
      self.slideInGnbPanel();      
    });

    $('.sx-close-btn').on('click', function() {
      self.slideOutGnbPanel();
    });

    $(window).on('keyup', function(e) {

      var className = $(e.target).attr('class');

      if (className && className.match('sx-menu-btn') && e.key === 'Tab' && e.shiftKey === false) {
        $('.sx-menu-btn').trigger('click');
      }

      if (self.oldTarget && self.oldTarget.match('sx-menu-btn') && e.key === 'Tab' && e.shiftKey === true) {
        $('.sx-close-btn').trigger('click');
      }

      if (self.oldTarget && self.oldTarget.match('sx-close-btn') && e.key === 'Tab' && e.shiftKey === false) {
        $('.sx-close-btn').trigger('click');
      }

      if (className && className.match('sx-close-btn') && e.key === 'Tab' && e.shiftKey === true) {
        $('.sx-menu-btn').trigger('click');
      }

      self.oldTarget = className;
    });
  };

  this.init = function() {
    this.setEvent();
  }; 
};

var SXAdminMenu = function(){

  var selectedSub = null;
  var self = this;

  this.init = function() {
    this.setEvent();
  };

  this.setEvent = function() {

    var menuList = $('.sx-gnb > li > a'),
          subPanelList = $('.sx-drap-menu'),
          oldMenu$ = null;

    menuList.on('mouseover', function(e){

      e.preventDefault();

      
      var mindex = menuList.index(this);
      var sub = subPanelList[mindex];
      self.showSubMenu(sub);

      if (selectedSub && selectedSub !== sub) {
         self.hideSubMenu(selectedSub);
      }     
 
      selectedSub = sub;   
    });

    menuList.on('touchstart', function(e) {
      e.preventDefault();

      var menu$ = $(this);
      self.addClass(menu$[0], 'active');

      if (oldMenu$) {
        self.removeClass(oldMenu$[0], 'active');
      }

      var url = menu$.attr('href');
      var target = $(this).attr('target');
      target = target ? target : '_self';

      if (url && url.match('#') !== true) {
        jsux.goURL(url, target);
      }

      oldMenu$ = menu$;
    });

    var menuAllList = $('.sx-gnb li a');
    menuAllList.on('focus', function(e) {

      e.preventDefault();

      var el$ = $(e.target).parent().parent().parent();
      var className = el$.attr('class');
      var mindex = $(this).parent().index();
      if (className.match(/^sx-sub-case/i)) {        
        mindex = $(el$.parent()).index();
      }

      var sub = subPanelList[mindex];
      self.showSubMenu(sub);

      if (selectedSub && selectedSub !== sub) {
         self.hideSubMenu(selectedSub);
      }     
 
      selectedSub = sub; 
    });

    $('body').on('click', function(e) {

      if (e.target.nodeName && e.target.nodeName.toUpperCase() === 'A') {
        e.stopImmediatePropagation();
        return;
      }
      self.hideSubMenu(selectedSub);
      selectedSub = null;
    });
  };
  this.removeClass = function(target, id) {

    var $gnbCase = $(target);
    if ($gnbCase.hasClass(id)) {
      $gnbCase.removeClass(id);
    }
  };
  this.addClass = function(target, id) {

    var $gnbCase = $(target);
    if (!$gnbCase.hasClass(id)) {
      $gnbCase.addClass(id);
    }
  };
  this.showSubMenu = function(sub) {

    if (selectedSub === sub) {
      return;
    }
    this.removeClass(sub, 'sx-slide-out');
    this.addClass(sub, 'sx-slide-in');
      
    var $sub = $(sub);
    var subCaseHeight = $sub.css('height').replace('px', '');
    var $subCase = $($sub.parent());
    $subCase.css('height', subCaseHeight);

    this.removeClass($sub.parent(), 'sx-slide-out');
    this.addClass($sub.parent(), 'sx-slide-in');
  };

  this.hideSubMenu = function(sub) {

    if (!sub) {
      return;
    }

    var $sub = $(sub);
    this.hideSubCase($sub);
    this.removeClass(sub, 'sx-slide-in');
    this.addClass(sub, 'sx-slide-out');    
  };

  this.hideSubCase = function(sub) {

    var $subCase = $(sub.parent());
    $subCase.css('height', 0);
    this.removeClass(sub.parent(), 'sx-slide-in');
    this.addClass(sub.parent(), 'sx-slide-out');
  };
};
/**
 * class ListManager
 * ver 1.0.0
 * update 2017.10.22
 * author streamux.com
 * description ''
 */

/*jsux.logger.isConsole = false;*/
jsux.app = jsux.app || {};
(function( app, $) {

  var ListManager = jsux.Model.create();
  ListManager.extend({

    windowListener: function( event, listener) {

      if (!jQuery) {
        throw new Error('windowListener() : need jQuery plugin');
      }

      $(window).on(event, function(e) {
        listener(e);
      });
    },
    isEqualItem: function(items, compare) {

      if (items.length < 1) return;

      for (var i=0; i<items.length; i++) {
        if (items[i].id == compare.id) {
          return true;
        }
      }

      return false;
    },
    addClass: function(el, className) {

      if (!jQuery) {
        throw new Error('addClass() : need jQuery plugin');
      }

      if ($(el).hasClass(className)) {
        return false;
      }

      $(el).addClass(className);
      return true;
    },
    removeClass: function(el, className) {

      if (!jQuery) {
        throw new Error('removeClass() : need jQuery plugin');
      }
      
      if (!$(el).hasClass(className)) {
        return false;
      }

      $(el).removeClass(className);
      return true;
    },
    searchParentElement: function(target, className) {

      if (!jQuery) {
        throw new Error('searchParentElement() : need jQuery plugin');
      }

      var parent$ = $(target).parent();
      var str = '';

      do {
        
        str += parent$[0].className + "\n";        

        if (parent$.hasClass(className)) {
          return parent$;
        } else {
          parent$ = parent$.parent();
        }        
      } while(parent$ !== null);
      
      return null;      
    },
    hasParentClass: function(target, className) {

      if (!jQuery) {
        throw new Error('hasParentClass() : need jQuery plugin');
      }

      if (this.searchParentElement(target, className)) {
        return true;
      } else {
        return false;
      }
    }
  });

  ListManager.include({

    swiper: null,
    isLoading: false,
    resource_url: '',
    params: null,
    id: '',
    tmpl:'',
    template: '',
    msg_tmpl: '',
    msg_template: '',   
    model: [],
    
    setSwiper: function(swiper) {

      this.swiper = swiper;
    },
    lockSwipes: function() {

      var self = this;

      if (this.swiper) {
        self.swiper.lockSwipes();
      }
    },
    unlockSwipes: function() {

      if (this.swiper) {
        this.swiper.unlockSwipes();    
      }
    },
    updateSwiper: function() {

      if (this.swiper) {
        this.swiper.update();    
      }
    },
    resizeSwiper: function() {

       if (this.swiper) {
        this.swiper.onResize();    
      }
    },
    slideTo: function(num) {

      if (isNaN(num) || num < 0) {
        num = 0;
      }

      if (this.swiper) {
        this.swiper.slideTo(num);    
      }
    },
    hasItem: function(id) {
      
      var result = false;
      var searcher = (function f(list) {

        for (var i=0; i<list.length; i++) {

          if (list[i].id == id) {
            result = true;
            break;
          }

          if (list[i].sub && list[i].sub.length > 0) {
            arguments.callee(list[i].sub);
          }
        }
      });
      searcher(this.model);
      searcher = null;

      return result;
    },
    getItem: function(id) {

      var selected;
      for (var i=0; i<this.model.length; i++) {
        if (this.model[i].id == id) {         
          selected = this.model[i];
          break;
        }
      }

      return selected;
    },
    addItem: function(item) {

      for (var i=0; i<this.model.length; i++) {
        if (this.model[i].id == item.id) {
          return false;
        }
      }

      this.model.push(item);
      this.setData(this.model);
      this.slideTo(1);
      this.dispatchEvent({type:'add', target: this, model: item});
    },
    cutItem: function(id) {

      var selected;
      for (var i=0; i<this.model.length; i++) {
        if (this.model[i].id == id) {         
          selected = this.model.splice(i, 1);
          selected = selected[0];
          break;
        }
      }

      this.setData(this.model);
      this.resizeSwiper();

      return selected;
    },
    updateItem: function(item) {

       for (var i=0; i<this.model.length; i++) {
        if (this.model[i].id == item.id) {
          this.model[i] = item;
        }
      }
      this.setData(this.model);
      this.dispatchEvent({type:'add', target: this, model: item});
    },
    setResource: function(url, params) {

      this.resource_url = url;
      if (params) {
        this.params = params;
      }
    },
    setParams: function(p) {
      this.params = p;
    },

    /**
     * method initialize
     * @ param data {  id: string, template: string, msg: string,
     *                          mobile_id: string, mobile_template: string, mobile_msg: string }
     */ 
    initialize: function(data) {
      
      for (var p in data) {
        this[p] = data[p];
      }
    },
    digit: function(value) {
      return jsux.utils.digit(value);
    },
    reset: function() {
     $(this.id).empty();  
    },
    remove: function() {

       $(this.id).empty();
    },
    reloadData: function( page, limit) { 

      var self = this,
            params = {              
              passover: (page-1) * limit,
              limit: limit
            },
            url = this.resource_url;

      if (!url) {
        trace('resource_url 주소를 확인해주세요.');
        return;
      }

      if (this.params) {
        for(var p in this.params) {
          if (!params[p]) {
             params[p] = this.params[p];
           }    
        }        
      }
      
      if (this.isLoading === true) {
        return;
      }
      this.isLoading = true;
      jsux.getJSON( url, params, function( e )  {
        
        //self.setData(e.data.list);
        self.dispatchEvent({type:'loaded', target: this, data: e.data});
        self.isLoading = false;
      });
    },
    setData: function( list ) {

      var markup = null,      
            msg = null;

      this.model = list;

      if (!this.id) {
        jsux.logger.error('\'' + this.id + '\' 아이디 식별자를 입력하세요.', 'jsux_list_manager.js');
        return;
      }

      if ($(this.id).length < 1) {
        jsux.logger.error('\'' + this.id + '\' 아이디 DOM 객체가 존재하지 않습니다.', 'jsux_list_manager.js');
        return;
      }

      this.template = this.template || this.tmpl;
      if (!this.template) {
        jsux.logger.error('\'' + this.template + '\' 템플릿 식별자를 입력하세요.', 'jsux_list_manager.js');
        return;
      }

      markup = $(this.template);
      if (markup.length < 1) {
        jsux.logger.error('\'' + this.id + '\' 템플릿 DOM 객체가 존재하지 않습니다.', 'jsux_list_manager.js');
        return;
      }     

      this.reset();
      this.makeMenu(list, markup);      
    },
    makeMenu: function(list, markup) {
     
      var self = this;
      var parseDate = null;
      var getRate = null;
      var addComma = null;

      parseDate = function(date) {

        var d = null;
        if (date) {
          d = new Date(date);
          if (isNaN(d.getFullYear())) {
            d = '0000-00-00';
          } else {
             d = d.getFullYear() + '-' + self.digit(d.getMonth()+1) + '-' + self.digit(d.getDate());
          }
        }       
        return d;
      };
      getRate = function( hit, total) {
        return (hit || total) === 0 ? 0 : (hit/total*100);
      };
      addComma = function(num) {
        jsux.utils.addComma(num);
      };

      $(markup).tmpl(list, {
        getRate: function( hit, total) {
          return getRate(hit, total);
        },
        editDate: function( date) {
          return parseDate(date);
        },
        addComma: function( num ) {
          return addComma(num);
        }
      }).appendTo(this.id);

      if (list.length === 0) {
        this.setMsg('등록 가능 메뉴가 존재하지 않습니다.');
      }

      this.updateSwiper();
    },
    setMsg: function(msg) {

      var data = msg ? msg : '데이터가 존재하지 않습니다.',
            markup = '';            

      if (typeof(msg) === 'string') {
        data = {msg: msg};
      }

      this.msg_template = this.msg_template || this.msg_tmpl;
      if (!this.msg_template) {
        jsux.logger.error('\'' + this.msg_template + '\' 메세지 템플릿 식별자를 입력하세요.', 'jsux_list_manager.js');
        return;
      }

      markup = $(this.msg_template);
     if (markup.length < 1) {
      jsux.logger.error('\'' + this.msg_template + '\' 메세지 템플릿 DOM 객체가 존재하지 않습니다.', 'jsux_list_manager.js', 167);
        return;
      }

      $(markup).tmpl(data).appendTo(this.id);
    }
  });
  app.ListManager = ListManager;

  app.getListManager = function() {
    return new ListManager();
  };
})(jsux.app, jQuery);