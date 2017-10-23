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

  ListManager.include({

    isLoading: false,
    resource_url: '',
    params: null,
    id: '',    
    template: '',
    msg_template: '',
    tmpl:'',
    msg_tmpl: '',

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
        
        self.setData(e.data);
        self.isLoading = false;
      });
    },
    setData: function( json ) {

      var self = this,
            list = json.list,
            markup = null,           
            parseDate = null,
            getRate = null,
            addComma = null,
            msg = null;

      if (!this.id) {
        jsux.logger.error('\'' + this.id + '\' 아이디 식별자를 입력하세요.', 'jsux_list_manager.js', 98);
        return;
      }

      if ($(this.id).length < 1) {
        jsux.logger.error('\'' + this.id + '\' 아이디 DOM 객체가 존재하지 않습니다.', 'jsux_list_manager.js', 103);
        return;
      }

      this.template = this.template || this.tmpl;
      if (!this.template) {
        jsux.logger.error('\'' + this.template + '\' 템플릿 식별자를 입력하세요.', 'jsux_list_manager.js', 109);
        return;
      }

      markup = $(this.template);
      if (markup.length < 1) {
        jsux.logger.error('\'' + this.id + '\' 템플릿 DOM 객체가 존재하지 않습니다.', 'jsux_list_manager.js', 115);
        return;
      }     

      parseDate = function(date) {

        var d = new Date(date);
        if (isNaN(d.getFullYear())) {
          d = '0000-00-00';
        } else {
           d = d.getFullYear() + '-' + self.digit(d.getMonth()+1) + '-' + self.digit(d.getDay());
        }
        return d;
      };
      getRate = function( hit, total) {
        return (hit || total) === 0 ? 0 : (hit/total*100);
      };
      addComma = function(num) {
        jsux.utils.addComma(num);
      };

      this.reset();

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
    },
    setMsg: function(msg) {

      var data = msg,
            markup = '';            

      if (typeof(msg) === 'string') {
        data = {msg: msg};
      }

      this.msg_template = this.msg_template || this.msg_tmpl;
      if (!this.msg_template) {
        jsux.logger.error('\'' + this.msg_template + '\' 메세지 템플릿 식별자를 입력하세요.', 'jsux_list_manager.js', 161);
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

  app.getListManager = function() {
    return new ListManager();
  };
})(jsux.app, jQuery);