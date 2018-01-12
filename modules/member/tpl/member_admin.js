/** 
 * used class 'jsux.fn.listManager'
 * path 'common/js/app/jsux_list_manager.js'
 * author streamux.com
 * update 2017.10.18
 */
 
jsux.fn = jsux.fn || {};
jsux.fn.groupList = {

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
    this.pagination.initialize({
      el: '.sx-pagination-group',
      id: '#paginList',
      tmpl: '#paginationTmpl',
      control: {
        'prev':'.sx-pagination-group .sx-nav-prev',
        'next':'.sx-pagination-group .sx-nav-next'
      }
    });

    changeHandler = function( e ) {

      self.listManager.reloadData( e.page, self.limit);
      self.listMobileManager.reloadData( e.page, self.limit);
    }; 

    loadedHandler = function( e ) {

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

    if (!url) {
      trace('input[name=list_json_path] 경로값을 입력하세요');
      return;
    }

    jsux.getJSON(url, params, function( e )  {

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
    });
  },
  init: function() {

    this.setLayout();
  }
};
jsux.fn.groupAdd = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  checkLang: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

    return reg.test( value );
  },
  checkFormVal: function( f ) {

    var category = f.category.value.length;
    if ( category < 1 ) {
      trace('카테고리 영문 이름을 입력 하세요.');
      f.category.focus();
      return false;
    }

    return true;
  },
  checkGroupID: function(f) {

    var $category = $('input[name=category]'),
          params = {
            _method: 'insert',
            category: $category.val()
          },
          url = $('input[name=groupId_check_url]').val();

    if (params.category === '') {
      trace('카테고리 이름을 입력해주세요.');
      $category.focus();
      return;
    }

    if (!url) {
      trace('input[name=groupId_check_url] 경로를 입력해주세요.');
    }

    jsux.getJSON( url, params, function(e) {

      if (e.msg) {
        trace( e.msg );
      } 
    });
  },
  sendAndLoad: function() {

    var self = this,
          params = {},
          datas = $('form');

    $.each(datas[0], function(index, item) {

      var filters = 'checkbox|button|submit|select';
      var $input = $(item);
      var type = $input.attr('type') ? $input.attr('type') : item.nodeName;
      if (!type.match(filters)) {
        params[$input.attr('name')] = $input.val();
        //console.log( $input.attr('name'), $input.val());
      }
    });

    var url = datas[0].action;
    if (!url) {
      trace('Form action 경로를 입력해주세요.');
      return;
    }

    jsux.getJSON( url, params, function( e )  {
      
      if (e.result && e.result.toUpperCase() === 'Y') {        
        jsux.goURL( self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('input[name=check_member_group]').on('click', function(e) {
      self.checkGroupID();
    });

    $('form').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target ) === true) {
        if (self.checkLang( e.target.category.value)) {
          trace('카테고리 그룹 이름에 한글이 포함되어 있습니다. \n영문으로 입력해주세요.');           
        } else {
          self.sendAndLoad();
        }
      }       
    });

    $('#btnCancel').on('click', function(e) {
       e.preventDefault();

      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn.groupModify = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendAndLoad: function() {

    var params = {};
    var datas = $('form');

    $.each(datas[0], function(index, item) {

      var filters = 'checkbox|button|submit|select';
      var $input = $(item);
      var type = $input.attr('type') ? $input.attr('type') : item.nodeName;
      if (!type.match(filters)) {
        params[$input.attr('name')] = $input.val();
        //console.log( $input.attr('name'), $input.val());
      }
    });

    var url = datas[0].action;
    if (!url) {
      trace('Form action 경로를 입력해주세요.');
      return;
    }

    jsux.getJSON( url, params, function( e )  {
     
      if (e.result && e.result.toUpperCase() == 'Y') {
        jsux.goURL( self.returnUrl() );
      } else {
         trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {

      e.preventDefault();
      self.sendAndLoad();    
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
            markup = '',
            labelList = null;

      if (e.result && e.result.toUpperCase() === 'Y') {
        formLists = $('input[type=text]');

        $(formLists).each(function(key, value) {

          if (e.data[this.name]) {
            this.value = e.data[this.name];
            //console.log(this.name , this.value)
          }
        });
      }
    });
  },
  init: function() {
    this.setLayout();
    this.setEvent();
  }
};
jsux.fn.groupDelete = {

  returnUrl: function() {

    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendJSON: function() {

    var self = this,
          params = {
            _method: $('input[name=_method]').val(),
            id: $('input[name=id]').val()
          },
          $form = $('form'),
          url = $form[0].action;

    jsux.getJSON( url, params, function( e )  {

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
      self.sendJSON();
    });
    $('#btnCancel').on('click', function( e ) {
      e.preventDefault();
      var url = $('input[name=location_back]').val();
      jsux.goURL(url);
    });
  },
  init: function() {

    this.setEvent();
  }
};
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
            category: $('input[name=category]').val(),
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
      msg_tmpl: '#warnMsgTmpl',
    });

    this.listMobileManager.initialize({
      id: '#dataMobileList',    
      tmpl: '#dataListMobileTmpl',
      msg_tmpl: '#warnMsgMobileTmpl'
    });
        
    this.pagination.initialize({
      el: '.sx-pagination-group',
      id: '#paginList',
      tmpl: '#paginationTmpl',
      control: {
        'prev':'.sx-pagination-group .sx-nav-prev',
        'next':'.sx-pagination-group .sx-nav-next'
      }
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

    jsux.getJSON(url, params, function( e )  {

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
    });
  },
  init: function() {
    this.setLayout();
  }
};
jsux.fn.setup = {
  // 멤버 설정 기능 구현
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
  getCheckboxVal: function( id ) {

    var result= '',
      list = $('input:checkbox[name^='+id+']:checked'),
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
  validateEmail: function(id) {

    var value = $('input:text[name='+id+']').val();
    var reg = /^([a-zA-Z0-9_+.-])+@([a-zA-Z0-9_-])+(\.[a-z0-9_-]+){1,2}$/;
    if (reg.test(value)) {
      return true;
    }
    return false;
  },
  validateHp: function(e) {

    var hpNum = e.target.value;
    var reg;

    hpNum = hpNum.replace(/\s-\s/g,'');
    if (!(hpNum.length > 9 && hpNum.length < 12)) {
      return false;
    }

    if (hpNum.length === 10) {
       reg = /^(\d{3})+(\d{3})+(\d{4})+$/;    
    }
    if (hpNum.length === 11) {
      reg = /^(\d{3})+(\d{4})+(\d{4})+$/;    
    }

    if (!reg.test(hpNum)) {
      return false;
    }

    var str = hpNum.replace(reg, '$1 - $2 - $3');
    $('input[name=hp]').val(str);
    return true;
  },
  checkFormVal: function( f ) {

    var labelList = ['아이디를','비밀번호를','비밀번호 확인을','닉네임을','이메일을'];
    var inputList = ['user_id','password','passwordConf','nick_name','email_address'];
    var isValidForm = true;
    $.each( inputList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        isValidForm = false;
        return false;
      }
    });

    if (!isValidForm) {
      return false;
    }

    if (!this.validateEmail('email_address')) {
      trace('이메일이 올바르지 않습니다.');
      return false;
    }

    return true;  
  },
  sendJson: function( f ) {

    var self = this,
          params = {},
          datas = $('form')[0],
          indexCheckbox = 0,
          url = '';

    $.each(datas, function( index, item ) {

      var filters = 'checkbox|button|submit',
            type = $(item).attr('type') ? $(item).attr('type') : item.nodeName,
            glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        item.value = self.getSelectVal(item.name);
        params[item.name] = item.value;
      } else {

         if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }

      if (type === 'checkbox' && item.checked) {
        if (indexCheckbox === 0) {
          var name = item.name.substr(0, item.name.length-1);
          params[item.name] = self.getCheckboxVal(name);
        } 
        indexCheckbox++;          
      }
    });

    /*$.each(params, function( index, item ) {
      console.log(index + ' : ' + item);
    });*/

    if (!f.action) {
      alert('Not Exists URL');
    }
    url = f.action;

    jsux.getJSON( url, params, function( e ) {

      trace( e.msg );     
      if (e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      }
    });
  },
  checkPWD: function() {

    if ($('input[name=passowrd]').val() != $('input[name=passowrdConf]').val()) {

      trace('비밀번호가 일치하지 않습니다.');
      $('input[name=passowrd]').val('');
      $('input[name=passowrdConf]').val('');
      $('input[name=passowrd]').focus();

      return false;
    }
  },    
  checkID: function() {

    var $userId = $('input[name=user_id]'),
          params =  {
            _method: $('input[name=_method]').val(),
            user_id: $userId.val()
          },
          url = $('input[name=id_check_url]').val();
    
    if (!$userId.val()) {
      trace('아이디를 입력해주세요');
      $userId.focus();
      return;
    }

    if (!url) {
      trace('input[id_check_url] 경로값을 입력하세요.');
      return;
    }

    jsux.getJSON( url, params, function( e ) {
      trace( e.msg );
    });
  },
  setEvent: function() {

    var self = this;
    $('form').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( this) === true) {
        self.sendJson( e.target );
      }
    });

    $('#btnCancel').on('click', function(e) {
      jsux.goURL(self.returnUrl());
    });

    $('input[name=passowrdConf]').on('blur', function() {
      self.checkPWD();
    }); 

    $('input[name=checkID]').on('click',function(e) {
      self.checkID();
    });

    $('input[name=hp]').on('keyup', function(e) {
    self.validateHp(e);
    });
    
    $('input[name=hp]').on('blur', function(e) {
      $('input[name=hp]').off('keydown');
    });
  },
  setLayout: function() {
    jsux.setAutoFocus();
  },
  init: function() {

    this.setEvent();
  }
};
jsux.fn.modify = {

  returnUrl: function () {

    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 입력해주세요');
      return '';
    }
    return backUrl;
  },
  getEmailVal: function( id ) {

    var result = '';

    result = $.trim($('select[name='+id+'1]').val());
    if ( result == '직접입력') {
      result = $('input[name='+id+'2]').val();
    }
    return result;
  },
  getSelectVal: function( id ) {

    var result = $.trim($('select[name='+id+']').val());
    return result;
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getCheckboxVal: function( id ) {

    var result = '',
          list = $('input:checkbox[name^='+id+']:checked'),
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
  changePassword: function() {

    var panelPwd = $('#panelNewPassword');
    var btn = $('#btnChangePassword');

    if (panelPwd.css('display') === 'none') {
      btn.val('변경 취소하기');
      panelPwd.css('display','block');

      if (!btn.hasClass('active')) {
        btn.addClass('active');
      }
    } else {
      btn.val('변경하기');
      panelPwd.css('display','none');
      btn.removeClass('active');
      btn.blur();
    }
  },
  validatePassword: function() {

    var inputPwd = $('input[name=password]');
    if (!inputPwd.val()) {
      return false;
    }

     var panelPwd = $('#panelNewPassword');
     if (panelPwd.css('display') === 'none') {     
      return true;
     }

    var inputNewPwd = $('input[name=new_password]');
    var inputNewPwdConf = $('input[name=new_password_conf]');

    if (!inputNewPwd.val()) {
       trace('새 비밀번호를 입력하세요.');
       inputNewPwd.focus();
      return false;
    }

    if (inputNewPwd.val() !== inputNewPwdConf.val()) {
      inputNewPwd.val('');
      inputNewPwdConf.val('');
      inputNewPwd.focus();
      trace('새 비밀번호가 일치하지 않습니다.');
      return false;
    }
    return true;
  },
  validateEmail: function(id) {

    var value = $('input:text[name=email_address]').val();
    var reg = /^([a-zA-Z0-9_+.-])+@([a-zA-Z0-9_-])+(\.[a-z0-9_-]+){1,2}$/;
    if (!reg.test(value)) {
      trace('이메일이 올바르지 않습니다.');
      return false;
    }
    return true;
  },
  validateHp: function(e) {

    var hpNum = e.target.value;
    var reg;

    hpNum = hpNum.replace(/\s-\s/g,'');
    if (!(hpNum.length > 9 && hpNum.length < 12)) {
      return false;
    }

    if (hpNum.length === 10) {
       reg = /^(\d{3})+(\d{3})+(\d{4})+$/;    
    }
    if (hpNum.length === 11) {
      reg = /^(\d{3})+(\d{4})+(\d{4})+$/;    
    }

    if (!reg.test(hpNum)) {
      return false;
    }

    var str = hpNum.replace(reg, '$1 - $2 - $3');
    $('input[name=hp]').val(str);
    return true;
  },
  checkFormVal: function( f ) {

    var labelList = ['비밀번호를','닉네임을','이메일을'];
    var inputList = ['password','nick_name','email_address'];
    var isValidForm = true;
    $.each( inputList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        isValidForm = false;
        return false;
      }
    });

    if (!isValidForm) {
      return false;
    }

    if (!this.validateEmail()) {
      return false;
    }

    if (!this.validatePassword()) {      
       return false;
    } 
    return true;  
  },
  sendJson: function( f ) {

    var self = this;
    var params = {};
    var datas = $('form')[0];
    var indexCheckbox = 0;

    $.each(datas, function( index, item ) {

      var filters = 'checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName;
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        item.value = self.getSelectVal(item.name);
        params[item.name] = item.value;
      } else {

         if (!type.match(filters)) {
         //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }

      if (type === 'checkbox' && item.checked) {
        if (indexCheckbox === 0) {
          var name = item.name.substr(0, item.name.length-1);
          params[name] = self.getCheckboxVal(name);
        } 
        indexCheckbox++;          
      }
    });

    /*$.each(params, function( index, item ) {
      console.log(index + ' : ' + item);
    });*/

    if (!f.action) {
      alert('Not Exists URL');
    }
    url = f.action;

    jsux.getJSON( url, params, function( e ) {
      
      trace( e.msg );

      if (e.result && e.result.toUpperCase() == 'Y') {
        jsux.goURL( self.returnUrl());
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

      var backUrl = self.returnUrl();
      if (backUrl === '') {
        return;
      }
      jsux.goURL( backUrl );
    });

    $('#btnChangePassword').on('click', function() {
      self.changePassword();
    });

    $('input[name=new_password_conf]').on('blur', function(e) {
      self.validatePassword();
    }); 

    $('input[name=hp]').on('keyup', function(e) {
      self.validateHp(e);
    });

    $('input[name=hp]').on('blur', function(e) {
      $('input[name=hp]').off('keydown');
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
            markup = '',
            labelList = null;

      if (e.result == 'Y') {

        formLists = $('input[type=text]');
        $(formLists).each(function(index) {
          if (e.data[this.name]) {
            this.value = e.data[this.name];
            //console.log(this.name , this.value)
          }
        });

        var selectPatern = /^(is_writable|is_kickout)$/;
        formLists = $('select');
        $(formLists).each(function(index) {
          var value = e.data[this.name];
          if (selectPatern.test(this.name)) {
            var label = (value.toLowerCase() === 'y') ? 'yes' : 'no';           
            $(this).val(label);
          } else {
            if (value) {
              $(this).val(value);
            }           
          }           
        });

        formLists = $('input[type=checkbox]');
        if (e.data.hobby) {
          checkedVal = e.data.hobby.split(',');
          $(formLists).each(function(index){

            var self = this;
            $(checkedVal).each(function(sIndex){
              if (checkedVal[sIndex]) {
                if( self.value === checkedVal[sIndex]) {
                  self.checked = true;
                }
              }
            });
          });
        }       
       
        markup = $('#memberLabel_tmpl');
        labelList = $('.view-type-textfield');
        $(labelList).each(function(index) {

          var label = $(labelList[index]).attr('id'),
                data = {label: e.data[label]};

          $('#'+label).empty();
          $(markup).tmpl( data ).appendTo($('#'+label));
        });
      } else {
        trace( e.msg );
      }
    });
  },    
  init: function() {
    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn.delete = {

  returnUrl: function () {

    var id = $('input[name=id]').val(),
         url = jsux.rootPath + 'member-admin/' + id + '/list';

    return url;
  },
  sendJSON: function(f) {

    var self = this,
      params = {
        _method:'delete',
        category :f.category.value,
        id :f.id.value,
        user_id :f.user_id.value
      };

    jsux.getJSON(jsux.rootPath + 'member-admin/delete', params, function( e )  {
      
      trace( e.msg );

      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL( self.returnUrl() );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form[name=f_member_delete]').on('submit', function( e ) {
      e.preventDefault();
      self.sendJSON(e.target);
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