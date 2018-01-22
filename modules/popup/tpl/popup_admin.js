/** 
 * used class 'jsux.fn.listManager'
 * path 'common/js/app/jsux_list_manager.js'
 * author streamux.com
 * update 2017.10.18
 */

jsux.fn = jsux.fn || {};
jsux.fn.list = {

  limit: 10,
  limitGroup: 5,
  pagination: jsux.app.getPagination(),
  listManager: jsux.app.getListManager(),
  listMobileManager: jsux.app.getListManager(),

  setEvent: function() {

    //popupManager.open();    
    var self = this;
    $('.popup > a').bind('click', function(e) {
      var id = $(this).data('key');
      popupManager.open( id );
    });
  },
  setLayout: function() {

    var self = this,
          url = $('input[name=list_json_path').val(),
          changeHandler = null,
          loadedHandler = null; 


    this.listManager.initialize({
      id: '#dataList',
      tmpl: '#dataListTmpl',
      msg_tmpl: '#warnMsgTmpl'
    });
    this.listMobileManager.initialize({
      id: '#dataMobileList',    
      tmpl: '#dataListMobileTmpl',
      msg_tmpl: '#warnMsgMobileTmpl'
    });

    changeHandler = function( e ) {

      self.listManager.reloadData( e.page, self.limit);
      self.listMobileManager.reloadData( e.page, self.limit);
    };

    loadedHandler = function(e) {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {
                
        self.listManager.setData( data.list );
        self.listMobileManager.setData( data.list );
      } else {

        self.listManager.reset();
        self.listManager.setMsg(e.msg);
        self.listMobileManager.reset();
        self.listMobileManager.setMsg(e.msg);
      }
    };

    this.listManager.addEventListener('loaded', loadedHandler);
    this.pagination.addEventListener('change', changeHandler);
    this.pagination.initialize({
      el: '.sx-pagination-group',
      id: '#paginList',
      tmpl: '#paginationTmpl',
      control: {
        'prev':'.sx-pagination-group .sx-nav-prev',
        'next':'.sx-pagination-group .sx-nav-next'
      }
    });

    jsux.getJSON(url, function( e )  {
    
      var data = e.data;
      if (data && data.list && data.list.length > 0) {
                
        // pagination start
        self.pagination.setData({
          total: data.total_num,
          limit: self.limit,
          limitGroup: self.limitGroup
        });        
        self.pagination.activateControl();
      } else {

        // pagination start
        self.pagination.deactivateControl();
      }
      loadedHandler(e);

      self.setEvent();
    });
  },
  init: function() {
    this.setLayout();   
  }
};
jsux.fn.add = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  getSelectVal: function( id ) {

    var result = $.trim($('select[name='+id+']').val());
    return result;
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getTextAreaVal: function( id ) {

    var result = $('textarea[name='+id+']').val();
    return result;
  },
  setTextAreaVal: function( id, value ) {

    $('textarea[name='+id+']').val( value );
  },
  checkLangKor: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

    return reg.test( value );
  },    
  chechFormVal: function( f ) {

    var name = f.popup_name.value.length;

    if ( name < 1 ) {
      trace('팝업이름을 입력하세요.');
      f.popup_name.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var self = this,
      params = {},
      indexCheckbox = 0;

    $.each(f, function(index, item) {

      var filters = 'checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        //console.log(item.name + ' : ' + item.value);
        item.value = self.getSelectVal(item.name);          
        params[item.name] = item.value;
      } else if (type === 'radio' && item.checked) {
        //console.log(item.name + ' : ' + item.value);
        params[item.name] = item.value;       
      } else {
         if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }     
    });

    var url = f.action;
    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON( url, params, function( e ) {
     
      if (e.result == 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
         trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();

      if (self.chechFormVal( e.target ) === true) {
        self.sendJson( e.target );
      }     
    });

    $('#btnCancel').on('click', function() {
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn.modify = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  getSelectVal: function( id ) {

    var result = $.trim($('select[name='+id+']').val());

    return result;
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getTextAreaVal: function( id ) {

    var result = $('textarea[name='+id+']').val();

    return result;
  },
  setTextAreaVal: function( id, value ) {

    $('textarea[name='+id+']').val( value );
  },
  chechFormVal: function( f ) {
    
    var pname = f.popup_name;

    if (!pname.value) {
      trace('팝업 이름을 입력하세요.');
      pname.focus();
      return false;
    }
    return true;
  },
  sendJson: function( f ) {

    var self = this,
      params = {},
      indexCheckbox = 0;

    $.each(f, function(index, item) {

      var filters = 'checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        //console.log(item.name + ' : ' + item.value);
        item.value = self.getSelectVal(item.name);          
        params[item.name] = item.value;
      } else if (type === 'radio' && item.checked) {
        //console.log(item.name + ' : ' + item.value);
        params[item.name] = item.value;       
      } else {
         if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }     
    });

    var url = f.action;
    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON(url, params, function( e ) {

      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();

      if (self.chechFormVal(e.target)) {
        self.sendJson( e.target );      
      }
    });

    $('#btnCancel').on('click', function() {

      jsux.goURL(self.returnUrl());
    });
  },
  setLayout: function() {

    var self = this,
          params = {
            id: $('input[name=id]').val()
          },
          url = $('input[name=modify_info_path').val();

    if (!url) {
      trace('input[name=modify_info_path 경로값을 입력하세요.');
      return false;
    }

    jsux.getJSON(url, params, function( e ) {

      var formLists = null,
        checkedVal = '',
        markup = null,
        labelList = null,
        list = null;

      if (e.result == 'Y') {
        list = e.data.list[0]; 

        formLists = $('input[type=text]');
        $(formLists).each(function(index) {
          if (list[this.name]) {
            this.value = list[this.name];
            //trace( this.name + ' = ' +  this.value , 1);         
          }
        });

        formLists = $('select');
        $(formLists).each(function(index) {
          if (list[this.name]) {
            this.value = list[this.name];
            //trace( this.name + ' = ' +  this.value , 1);         
          }           
        });

        markup = $('#popupLabel_tmpl');
        labelList = $('table tr').find('.view-type-textfield');        
        $(labelList).each(function(index) {

          var label = $(labelList[index]).attr('id'),
                data = {label: list[label]};

          $('#'+label).empty();
          $(markup).tmpl( data ).appendTo('#'+label);
        });

        self.setTextAreaVal('content', list.contents); 
      } else {
        trace( e.msg );
      }

      jsux.setAutoFocus();
    });
  },
  init: function() {

    this.setLayout();
    this.setEvent();
  }
};
jsux.fn.delete = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendJson: function() {

    var self = this,
          params = {
            _method: 'delete',
            id : $('input[name=id]').val(),
            popup_name : $('input[name=popup_name]').val()
          },
          $form = $('form'),
          url = $form[0].action;

    jsux.getJSON(url, params, function( e )  {
      
      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('#btnConfirm').on('click', function( e ) {
      e.preventDefault();
      self.sendJson();
    });

    $('#cancelBtn').on('click', function( e ) {
      e.preventDefault();
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {
    this.setEvent();
  }
};