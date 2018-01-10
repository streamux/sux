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

  setLayout: function() {

    var self = this,
          url = $('input[name=list_json_path]').val(),
          params = {
            passover: 0,
            limit: this.limit
          },
          changeHandler = null,
          loadedHandler = null;    

    if (!url) {
      trace('input[name=list_json_path] 경로값을 입력하세요');
      return;
    }

    self.listManager.setResource(url);
    self.listMobileManager.setResource(url);

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

    // pagination start
    changeHandler = function( e ) {
      self.listManager.reloadData( e.page, this.limit);
      self.listMobileManager.reloadData( e.page, this.limit);
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

    jsux.getJSON(url, params, function( e )  {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {        

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

    return $.trim($('select[name='+id+']').val());
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getRadioVal: function( id ) {

    return $('input:radio[name='+id+']:checked').val();
  },
  setRadioVal: function( id, value) {  

    return $('input:radio[name='+id+']:input[value='+value+']').prop('checked', true);
  },
  getCheckboxVal: function( id ) {

    var result= '',
          list = $('input:checkbox[name='+id+']:checked'),
          len = list.length;

    $(list).each(function(index){
      result += list[index].value;

      if (index < len-1) {
        result += ',';
      }
    });
    return result;
  },
  checkLangKor: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

    return reg.test( value );
  },
  checkFormVal: function( f ) {

    var category = f.category.value.length,
         board_name = f.board_name.value.length;

    if ( category < 1 ) {
      trace('게시판 테이블이름을 입력하세요.');
      f.category.focus();
      return (false);
    }

    if (this.checkLangKor( f.category.value)) {
      trace('테이블 이름에 한글이 포함되어 있습니다.');
      f.category.focus();
      return (false);
    }

    if ( board_name < 1) {
      trace('게시판 이름을 입력하세요.');
      f.board_name.focus();
      return (false);
    }

    return (true);
  },
  checkCategory: function() {

    var params = {  category: $('input[name=category]').val()};

    if (params.category === '') {
      trace('카테고리명을 입력해 주세요.');
      $('input[name=category]').focus();
      return;
    }

    jsux.getJSON(jsux.rootPath + 'board-admin/check-board', params, function( e ) {

      if (e.msg) {
        trace( e.msg );
      }      
    });
  },
  sendJson:  function( f ) {

    var self = this,
      params = {
        _method:$('input[name=_method]').val(),
      },
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
      } else if (type === 'text' || type === 'textarea') {
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
      
      trace( e.msg );
      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit',function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target ) === true) {
        self.sendJson( e.target );
      }
    });

    $('#btnCancel').on('click', function(e) {
      e.preventDefault();

      jsux.goURL(self.returnUrl());
    });

    $('#checkCategory').on('click',function(e) {
      self.checkCategory();
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
  getRadioVal: function( id ) {

    var result = $('input:radio[name='+id+']:checked').val();

    return result;
  },
  setRadioVal: function( id, value) {

    var result = $('input:radio[name='+id+'][value='+value+']').attr('checked', true);
    return result;
  },
  getCheckboxVal: function( id ) {

    var result= '',
      list = $('input:checkbox[name='+id+']:checked'),
      len = list.length;

    $(list).each(function(index){
      result += list[index].value;

      if (index < len-1) {
        result += ',';
      }
    });
    return result;
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
  checkFormVal: function( f ) {

    var board_name = f.board_name.value.length;

    if ( board_name < 1) {
      trace('게시판 이름을 입력하세요.');
      f.board_name.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var self = this,
      params = {
        _method:$('input[name=_method]').val(),
      },
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
      } else if (type === 'text' || type === 'textarea' || type === 'hidden') {
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

      if (self.checkFormVal( e.target ) === true) {
        self.sendJson( e.target );
      }
    });

    $('#btnCancel').on('click', function(e) {
      e.preventDefault();

      jsux.goURL(self.returnUrl());
    });
  },
  setLayout: function() {

    var self = this,
          params = {
            id: $('input[name=id]').val()
          },
          url = $('input[name=modify_info_path]').val();

    if (!url) {
      trace('input[name=modify_info_path] 경로값을 입력하세요.');
      return;
    }

    jsux.getJSON(url, params, function( e ) {

      var formLists = null,
        checkedVal = '',
        markup = null,
        labelList = null;

      if (e.result && e.result.toUpperCase() === 'Y') {        

        formLists = $('input[type=text]');
        $(formLists).each(function(index) {

          if (e.data[this.name]) {
            this.value = e.data[this.name];
          }
        });

        formLists = $('select');
        $(formLists).each(function(index) {

          //console.log(this.name, e.data[this.name]);
          if (e.data[this.name]) {
            this.value = e.data[this.name];
          }           
        });

        formLists = $('input[type=radio]');
        $(formLists).each(function(index) {
          var checked = e.data[this.name] ? e.data[this.name] : this.value;
          self.setRadioVal( this.name, checked );
        });

        self.setTextAreaVal('limit_word', e.data.limit_word); 
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
            _method:$('input[name=_method]').val(),
            category:$('input[name=category]').val(),
            id:$('input[name=id]').val()
          },
          $form = $('form'),
          url = $form[0].action;

    if (!url) {
      trace('Form action 호출 경로가 존재하지 않습니다.');
    }

    jsux.getJSON(url,params, function( e )  {

      if (e.result == 'Y') {
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

    $('#btnCancel').on('click', function( e ) {
      e.preventDefault();

      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
  }
};