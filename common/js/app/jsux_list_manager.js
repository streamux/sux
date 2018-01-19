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
        
        //self.setData(e.data.list);
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