function setCookie( name, value, expiredays ) {

  var todayDate = new Date();
  todayDate.setDate( todayDate.getDate() + expiredays );
  document.cookie = escape(name) + '=' + escape( value ) + '; path=/; expires=' + todayDate.toGMTString() + ';';
}

function getCookie( name ) {

  var suxpopCookie = escape(name) + '=';
  var i = 0;
  while ( i <= document.cookie.length ) {

    var e = i + suxpopCookie.length;
    if ( document.cookie.substring( i, e ) == suxpopCookie ) {
      if ( (popendCookie=document.cookie.indexOf( ';', e )) == -1 ) {
        popendCookie = document.cookie.length;
      }
      return unescape( document.cookie.substring( e, popendCookie ) );
    }

    i = document.cookie.indexOf( ' ', i ) + 1;
    if ( i === 0 ) {      
      break;
    }
  }
  return '';
}

function closePopup( suxpopname ) { 

  if ( document.forms[0].suxpop.checked ) {
    setCookie( suxpopname, '__sux_nopopup' , 1); 
  }
  self.close(); 
}

function openPopup( url, popwinname, pLeft, pTop, pWidth, pHeight ) {

  if ( getCookie(popwinname) != '__sux_nopopup' ) {
    suxpopWindow  =  window.open( url, popwinname,'\'toolbar=no,location=no,status=no,menubar=no,scrollbars=auto,left='+pLeft+'px,top='+pTop+'px,width='+pWidth+'px,height='+pHeight+'px\'');
    suxpopWindow.opener = self;
  }
}
var popupManager = popupManager || {};
(function(app){

  var Popup = function() {

    var self = this,
      interval = [],
      delay = 300,
      list = null,
      counter = 0,
      total = 0;

    this.init = function( data ) {

      counter = 0;
      list = data;
      total = data.length;
    };

    this.open = function() {

      var url = '',
        id = list[counter].id,
        winname = list[counter].popup_name,
        skin = list[counter].skin,
        left = list[counter].popup_left,
        top = list[counter].popup_top,
        width = list[counter].popup_width,
        height = list[counter].popup_height,
        is_usable = list[counter].is_usable,
        period = list[counter].period,
        nowtime = list[counter].nowtime;

      if (is_usable.toLowerCase() == 'y' && period > nowtime) {
        url  = jsux.rootPath + 'popup-event?id='  + id + '&winname=' + winname;   
        openPopup(url, winname, left , top , width , height);
      }

      counter++;
      if (counter == total) {
        self.stopTimer();
      }
    };

    this.startTimer = function() {
      interval.push(setInterval(self.open, delay));
    };

    this.stopTimer = function() {

      for (var i=0; i<interval.length; i++) {
        clearInterval(interval[i]);
      }
    };

    this.load = function( id ) {

      var params = { 'id': id },
        loaded = true,
        url = '';

      if (loaded === false) {
        return;
      }
      loaded = false;

      url = jsux.rootPath + 'opener-json';
      jsux.getJSON( url, params, function(e) {

        var result = $.trim(e.result.toLowerCase());
        if ( result == 'y') {

          self.init(e.data);
          self.startTimer();
        } else {
          trace(e.msg, 1);
        }
        loaded = true;
      });
    };
  };
  
  app.popup = new Popup();
  app.open = function( id ) {
    this.popup.load(id);
  };
  app.sux_path = function( path ) {
    this.popup.sux_path = path;
  };
})(popupManager);
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
    msg: '데이터가 존재하지 않습니다.',
    
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
        
        self.setData(e.data.list);
        self.dispatchEvent({type:'loaded', target: this, data: e.data});
        self.isLoading = false;
      });
    },
    setData: function( list ) {

      var markup = null;

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
        this.setMsg( this.msg );
      }

      this.updateSwiper();
    },
    setMsg: function(msg) {

      var data = typeof(msg) === 'object' ? msg : {msg: msg},
            markup = '';            

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
/**
 * class Pagination
 * ver 1.0.0
 * update 2017.11.17
 * author streamux.com
 * description control 설정 추가 
 **/

jsux.app = jsux.app || {};
(function( app, $ ){

  var Pagination = jsux.Model.create();
  Pagination.extend({
    onResize: function(listener) {
      var self = this;
      $(window).on('resize', function() {
        self[listener]();
      });
    }
  });
  Pagination.include({

    el: null,                           // pagination 범위 그룹 
    id: '',                              // markup 출력 위치 
    tmpl: null,                      // pagination markup
    template: null,
    control: null,                  // control 참조 식별자 
    total: 0,                         // 개시물 총개수 
    limit: 0,                         // 게시물 개수 

    isActivated: false,
    isMobile: true,
    minWidth: 768,

    currentPage: 0,
    currentActivate: 0,
    direction: "prev",
    pageGroupNum: 1,
    pageTotalNum: 0,
    originLimitGroup: 1,
    limitGroup: 1,               // pagination 출력 개수
    activateId: 1,
    oldActivate: -1,
    liLists: null,
    markup: null,
    name: null,

    getName: function() {
      return this.name;
    },
    setName: function( str ) {
      this.name = str;
    },
    reset: function() {
      $(this.id).empty();
    },

    /**
     * method initialize
     * @ param data {  el: string, id: string, tmpl: string, control: array }
     */ 
    initialize: function( data ) {     

      /**
       * data's value { el:string, id:string, tmpl:string, control:array }
       */ 
      for (var p in data) {
        this[p] = data[p];
      }

      this.el = $(this.el);
      this.tmpl = this.tmpl || this.template;
      this.markup = $(this.tmpl);

      if (!this.control) {
        var control = this.el.find('.sx-pagination-control');
        this.control = {'prev':control[0], 'next':control[1]};
      }     

      this.setEvent();
    },
    setData : function( data ) {

      for (var p in data) {
        this[p] = data[p];
      }

      this.originLimitGroup = this.limitGroup;

      var remain = this.total%this.limit;
      var page = this.total/this.limit;
                  
      this.pageTotalNum = (remain) !== 0 ? Math.ceil(page) : page;

      var screenWidth = this.getResizeWidth();
      if (screenWidth < this.minWidth) {
        this.isMobile = false;
        this.changeToMobile();
      } else {
        this.isMobile = true;
        this.changeToPC();
      }

      this.remove();
      this.defaultSetting();
      this.setLayout();
      this.activate( this.activateId );      
    },
    defaultSetting: function() {

      if (!this.id) {
        jsux.logger.error('\'' + this.id + '\' 아이디 식별자를 확인해주세요.', 'jsux_pagination.js', 88);
        return;
      }

      var $id = $(this.id);
      if ($id.length < 1) {
        jsux.logger.error('\'' + this.id + '\' 아이디 DOM 객체가 존재하지 않습니다.', 'jsux_pagination.js', 94);
        return;
      }

      if (!this.tmpl) {
        jsux.logger.error('\'' + this.tmpl + '\' 템플릿 식별자를 입력하세요.', 'jsux_pagination.js', 153);
        return;
      }

     if (this.markup.length < 1) {
      jsux.logger.error('\'' + this.tmpl + '\' 템플릿 DOM 객체가 존재하지 않습니다.', 'jsux_pagination.js', 152);
        return;
      }
    },
    setLayout : function() {

      var numLists = [],
            len = 0,
            startNum = 0,
            remain = 0,
            compareNum = 0;
        
      this.liLists = [];

      startNum = (this.pageGroupNum-1)*this.limitGroup + 1;
      compareNum = (startNum + this.limitGroup) -1 ;

      // 총 페이지가 선택 그룹 수 보다 작으면 
      if (compareNum <= this.pageTotalNum) {
        remain = this.limitGroup;
      } else {

        if (this.limitGroup < 2) {
          remain = 1;
        }  else {
          var remainGroupNum = (this.pageTotalNum%this.limitGroup);
         remain = (remainGroupNum !== 0) ? Math.ceil(remainGroupNum) : 0;
        }        
      }

      len = startNum + remain;
      for( var i=startNum; i<len; i++) {
        numLists.push({no: i});
      }

      $(this.markup).tmpl(numLists).appendTo(this.id);         

      if ( this.el.hasClass("sx-hide")) {
        this.el.removeClass("sx-hide");
      }

      if (!this.el.hasClass("sx-show")) {
        this.el.addClass("sx-show");
      }
      
      this.liLists = this.el.find("a");

      this.currentPage = { prev: startNum, next: len-1};
      this.currentActivate = {prev: 1, next: remain};     
    },
    setEvent : function() {

      var self = this;
      
      $(this.el).on("click", function( e ) {
        e.preventDefault();

        var className = e.target.className;
        if (className === 'sx-pagination') {
          self.callPage( $.trim($(e.target).text()) );  
        }
      });

      Pagination.onResize.apply(this, ['resizeHandler']);
    },
    prev : function() {

      this.direction = "prev";
      this.pageGroupNum--;

      if (this.pageGroupNum <= 1) {
        this.pageGroupNum = 1;
        this.inactivePrev();
      }
       this.activeNext();

      this.remove();
      this.setLayout();

      this.activate( this.currentActivate[this.direction] );
      this.dispatchEvent({type:"change", page: this.currentPage[this.direction]});
    },
    activePrev: function() {

      var self = this,
           $prev = $(this.control.prev);

      if ($prev.hasClass('unactive')) {

        $prev.removeClass('unactive');
        $prev.on('click', function(e) {

           e.preventDefault();         
          self.prev();
        });
      } 
    },
    inactivePrev: function() {

       var $prev = $(this.control.prev);

      if (!$prev.hasClass('unactive')) {

        $prev.addClass('unactive');
        $prev.off('click');
      } 
    },
    next : function() {

      this.direction = "next";
      this.pageGroupNum++;


      if (this.pageGroupNum*this.limitGroup >= this.pageTotalNum) {
        this.pageGroupNum = Math.ceil(this.pageTotalNum/this.limitGroup);
        this.inactiveNext();
      }
      this.activePrev();

      this.remove();
      this.setLayout();

      this.activate( this.currentActivate[this.direction] );
      this.dispatchEvent({type:"change", page: this.currentPage[this.direction]});
    },
    activeNext: function() {

      var self = this,
            $next = $(this.control.next);

      if ($next.hasClass('unactive')) {

        $next.removeClass('unactive');
        $next.on('click', function(e) {

           e.preventDefault();         
          self.next();
        });
      } 
    },
    inactiveNext: function() {

      var $next = $(this.control.next);
      if (!$next.hasClass('unactive')) {

        $next.addClass('unactive');
        $next.off('click');
      } 
    },
    callPage : function( num ) {

      var pageNum = parseInt( num );

      this.activate( pageNum );
      this.dispatchEvent({type:"change", page: pageNum });
    },
    remove : function() {

      $(this.id).empty();
    },
    activate: function( num ) {

      var  id = 0;

      this.activateId = parseInt(num);
      if (isNaN(this.activateId)) {
        throw new Error(typeof num + " '" + num + "' is not a Number");
      }

      if ($(this.liLists[ this.oldActivate ]).hasClass("active")) {
        $(this.liLists[ this.oldActivate ]).removeClass("active");
      }

      this.currentNum = id = Math.ceil(this.activateId%this.limitGroup);
      if (this.currentNum === 0) {
        this.currentNum = id = this.limitGroup;
      }

      if (!$(this.liLists[ id ]).hasClass("active")) {
       $(this.liLists[ id ]).addClass("active");
      }

      this.oldActivate = id;
    },
    activateControl: function() {

      if (this.pageTotalNum < 2) {
        this.deactivateControl();
      } else {
        this.isActivated = true;
        
        var pageTotalGroup = this.pageTotalNum;
        if (this.isMobile === false) {
          pageTotalGroup = Math.ceil(this.pageGroupNum/this.originLimitGroup);
        }

        if (this.pageGroupNum <= 1) {
          this.inactivePrev();
          this.activeNext();
        } else if (this.pageGroupNum >= pageTotalGroup) {
          this.activePrev();
          this.inactiveNext();
        } else {
          this.activePrev();
          this.activeNext();
        } 
      }      
    },
    deactivateControl: function() {

      this.isActivated = false;

      this.inactiveNext();
      this.inactivePrev();
    },
    getResizeWidth: function() {

      return $(window).outerWidth();
    },
    resizeHandler: function() {
      
      if (this.isActivated === false) return;

      this.changeToMobile();
      this.changeToPC();      

      this.remove();
      this.setLayout();      
      this.activate( this.activateId );
      this.activateControl();
    },
    changeToMobile: function() {

      var screenWidth = this.getResizeWidth();
      if (screenWidth < this.minWidth && this.isMobile === false) {

        this.isMobile = true;
        this.limitGroup = 1;
        this.pageGroupNum = (this.pageGroupNum-1)*this.originLimitGroup + this.activateId;
        this.activateId = this.pageGroupNum;
      }
    },
    changeToPC: function() {

      var screenWidth = this.getResizeWidth();
      if (screenWidth >= this.minWidth && this.isMobile === true) {
        this.activateId = this.pageGroupNum%this.originLimitGroup;

        this.isMobile = false;
        this.limitGroup = this.originLimitGroup;
        this.pageGroupNum = Math.ceil(this.pageGroupNum/this.originLimitGroup);
      }
    }
  });

  app.getPagination = function() {

    return new Pagination();
  };

})( jsux.app, jQuery );


