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
          changeHandler = null
          loadedHandler = null;

    if (!url) {
      trace('input[name=list_json_path] 경로값을 입력하세요');
      return;
    }
    
    this.listManager.setResource(url);
    this.listMobileManager.setResource(url);
    
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

      self.listManager.reloadData( e.page, self.limit);
      self.listMobileManager.reloadData( e.page, self.limit);
    }; 

    loadedHandler = function(e) {

      var data = e.data;

      if (data && data.list && data.list.length > 0) {
        self.listManager.setData( data.list );
        self.listMobileManager.setData( data.list);
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

  activedTab: null,

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  loadTemplateContent: function( tmpl,  mode) { 

    var self = this,
          templatePath = $('input[name=template_path]').val(),
          url = '';

    if (!tmpl) {
      trace('loadTemplateContent : tmpl 파람값을 입력해주세요.');
      return;
    }

    if (!templatePath) {
      trace('input[name=template_path] 경로값을 입력하세요.');
      return;
    }
    url = templatePath + '?template=' + tmpl + '&template_mode=' + mode;
  
    jsux.getJSON( url, function(e) {

      if (e.data) {
        $.each(e.data, function(key, item) {
          self.setTextAreaVal(key,item)
        });
      }      
    });
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
  setTextAreaVal: function( id, value ) {

    $('textarea[name='+id+']').val( value );
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
      document_name = f.document_name.value.length;

    if ( category < 1 ) {
      trace('카테고리 이름을 입력하세요.');
      f.category.focus();
      return (false);
    }

    if (this.checkLangKor( f.category.value)) {
      trace('카테고리 이름에 한글이 포함되어 있습니다.');
      f.category.focus();
      return (false);
    }

    if ( document_name < 1) {
      trace('페이지 이름을 입력하세요.');
      f.document_name.focus();
      return (false);
    }

    return (true);
  },
  checkCategoryName: function() {

    var params = {  category: $('input[name=category]').val()};

    if (params.category === '') {
      trace('카테고리명을 입력하세요.');
      $('input[name=category]').focus();
      return;
    }

    jsux.getJSON(jsux.rootPath + 'document-admin/check-page', params, function( e ) {

      if (e.msg) {
        trace( e.msg );
      }      
    });
  },
  sendJson:  function( f ) {

    var self = this,
      params = {
        _method: f._method.value
      },
      indexCheckbox = 0;

    $.each(f, function(index, item) {

      var filters = 'select|radio|checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        //console.log(item.name + ' : ' + item.value);
        item.value = self.getSelectVal(item.name);          
        params[item.name] = item.value;
      } else if (type === 'radio' && item.checked) {
        //console.log(item.name + ' : ' + item.value);
        params[item.name] = item.value;       
      } else  if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
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
  setcontentByTab: function(e) {

    var targetName = $(e.target).data('target');
    $content = $('textarea[name^=content]');
    $content.each(function(index) {

      var $this = $(this);
      var itemName = $this.attr('name');
      if (targetName.match(itemName)) {

        var $selectedItem = $('textarea[name='+itemName+']');          
        if ($selectedItem.hasClass('hide')) {
          $selectedItem.removeClass('hide');
        }

        if (!$selectedItem.hasClass('show')) {
          $selectedItem.addClass('show');
        }
      } else {

        if ($this.hasClass('show')) {
          $this.removeClass('show');
        }   

        if (!$this.hasClass('hide')) {
          $this.addClass('hide');
        }          
      }
    });
  },
  setTab: function(e) {

    var target = $(e.target).parent();

    if (this.activedTab.hasClass('active')) {
      this.activedTab.removeClass('active');
    }
    
    if (!target.hasClass('active')) {
      target.addClass('active');
      this.activedTab = target;
    }
  },
  setEvent: function() {

    var self = this;

    $('form[name=f_document_add]').on('submit',function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target )) {
        self.sendJson( e.target );
      }
    });

    $('#templateType').on('change', function(e) {
      jsux.fn.modify.loadTemplateContent(this.value, 'o')
    });

    $('#btnCancel').on('click', function(e) {
      e.preventDefault();
      jsux.goURL(self.returnUrl());
    });

    $('#btnCheckCategory').on('click',function(e) {
      self.checkCategoryName();
    });

    // content tab event
    $('.sx-nav-tabs > li > a').on('click', function(e) {
      e.preventDefault();
      
      self.setTab(e);
      self.setcontentByTab(e);
    });
  },
  setLayout: function() {

    var self = this;
    $('.sx-nav-tabs > li').each(function(index) {
      var target = $(this);
      if(target.hasClass('active')) {
        self.activedTab = target;
      }
    });

    this.loadTemplateContent('default', 'o');    
  },
  init: function() {

    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();
  }
};

jsux.fn.modify = {
  
  activedTab: null,

  returnUrl: function() {

    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  loadTemplateContent: function( tmpl, mode) {

    var self = this,
          templatePath = $('input[name=template_path]').val(),
          mode = mode ? mode : 'p';
          url = '';

    if (!tmpl) {
      trace('loadTemplateContent : tmpl 파람값을 입력해주세요.');
      return;
    }

    if (!templatePath) {
      trace('input[name=template_path] 경로값을 입력하세요.');
      return;
    }
    url = templatePath + '?template=' + tmpl + '&template_mode=' + mode;

    jsux.getJSON( url, function(e) {

      if (e.data) {
        $.each(e.data, function(key, item) {
          self.setTextAreaVal(key,item)
        });
      } else {
        trace(e.msg);
      }    
    });
  },
  getSelectVal: function( id ) {

    return $.trim($('select[name='+id+']').val());
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

    var document_name = f.document_name.value.length;

    if ( document_name < 1) {
      trace('페이지  이름을 입력하세요.');
      f.document_name.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var self = this,
      params = {},
      indexCheckbox = 0;

    $.each(f, function(index, item) {

      var filters = 'select|radio|checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        //console.log(item.name + ' : ' + item.value);
        item.value = self.getSelectVal(item.name);          
        params[item.name] = item.value;
      } else if (type === 'radio' && item.checked === true) {
        //console.log(item.name + ' : ' + item.value, item.checked);
        params[item.name] = item.value;       
      } else if (!type.match(filters)) {
        //console.log(item.name + ' : ' + item.value);          
        params[item.name] = item.value;
      }     
    });

    var url = f.action;
    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON(url, params, function( e ) {

      trace( e.msg );     

      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      }
    });
  },
  setcontentByTab: function(e) {

    var targetName = $(e.target).data('target');
    $content = $('textarea[name^=content]');
    $content.each(function(index) {

      var $this = $(this);
      var itemName = $this.attr('name');
      if (targetName.match(itemName)) {

        var $selectedItem = $('textarea[name='+itemName+']');          
        if ($selectedItem.hasClass('hide')) {
          $selectedItem.removeClass('hide');
        }

        if (!$selectedItem.hasClass('show')) {
          $selectedItem.addClass('show');
        }
      } else {

        if ($this.hasClass('show')) {
          $this.removeClass('show');
        }   

        if (!$this.hasClass('hide')) {
          $this.addClass('hide');
        }          
      }
    });
  },
  setTab: function(e) {

    var target = $(e.target).parent();

    if (this.activedTab.hasClass('active')) {
      this.activedTab.removeClass('active');
    }
    
    if (!target.hasClass('active')) {
      target.addClass('active');
      this.activedTab = target;
    }
  },
  setEvent: function() {

    var self = this,
          category = $('input[name=category]').val(),
          template = $('#templateType').val(),
          templateMode = 'p';

    $('form[name=f_modify]').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target ) === true) {
        self.sendJson( e.target );
      }
    });

    $('#templateType').on('change', function(e) {

      var tmpl = templateMode === 'o' ? this.value : category;
      jsux.fn.modify.loadTemplateContent( tmpl, templateMode);
    });

    $('input[name=template_mode]').on('change', function(e) {

      templateMode = this.value;

      if (templateMode === 'p') {
        $('#templateType').trigger('change');
        $('#templateType').val(template);
        $('#templateType').attr('disabled', true);
      } else {
        $('#templateType').attr('disabled', false);
      }
    });

    $('#btnCancel').on('click', function(e) {
      jsux.goURL(self.returnUrl());
    });

    // content tab event
    $('.sx-nav-tabs > li > a').on('click', function(e) {
      e.preventDefault();
      
      self.setTab(e);
      self.setcontentByTab(e);
    });
  },
  setLayout: function() {

    var self = this,
          params = {
            id: $('input[name=id]').val()
          },
          url = $('input[name=modify_info_path]').val();

    $('.sx-nav-tabs > li').each(function(index) {
      var target = $(this);
      if(target.hasClass('active')) {
        self.activedTab = target;
      }
    });

    if (!url) {
      trace('input[name=modify_info_path] 경로값을 확인해주세요.');
      return;
    }

    jsux.getJSON(url, params, function( e ) {

      var formLists = null,
        checkedVal = '',
        markup = null,
        labelList = null,
        list = null;

      if ( e.result && e.result.toUpperCase() === 'Y') {
        if (e.data && e.data.list) {

          list = e.data.list[0];
          formLists = $('input[type=text]');
          $(formLists).each(function(index) {

            if (list[this.name]) {
              this.value = list[this.name];
            }
            //console.log(this.name, list[this.name]);
          });

          formLists = $('select');
          $(formLists).each(function(index) {

            if (list[this.name]) {
              this.value = list[this.name];
              //console.log(this.name, list[this.name]);
            }           
          });

          formLists = $('input[type=radio]');
          $(formLists).each(function(index) {

            if (this.value === list[this.name]) {
              self.setRadioVal( this.name, list[this.name] );
            }
          });

          self.setTextAreaVal('content_tpl', list.content_tpl);
          self.setTextAreaVal('content_css', list.content_css); 
          self.setTextAreaVal('content_js', list.content_js); 
        } else {
          trace( e.msg );
        }       
      } else {
        trace( e.msg );
      }

      var tmode = self.getRadioVal('template_mode');
      if (tmode === 'o') {
        $('#templateType').attr('disabled', false);
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

    $('#btnCancel').on('click', function( e ) {
      e.preventDefault();
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
  }
};