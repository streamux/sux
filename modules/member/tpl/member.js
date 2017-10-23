jsux.fn = jsux.fn || {};
jsux.fn.join = {

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
    var inputList = ['user_id','password','password_conf','nick_name','email_address'];
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
      if (e.result == 'Y') {
        jsux.goURL( jsux.rootPath + 'login');
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

    var inputId = $('input[name=user_id]');
    var params =  {
      _method: 'insert',
      category: this.getSelectVal('category'),
      user_id: inputId.val()
    };

    
    if (params.user_id === '') {
      trace('아이디를 입력해주세요');
      inputId.focus();
      return;
    }

    jsux.getJSON( jsux.rootPath + 'check-id', params, function( e ) {
      trace( e.msg );
    });
  },
  setEvent: function() {

    var self = this;
    $('form').on('submit', function( e ) {
      e.preventDefault();

      var bool  = self.checkFormVal( this);
      if (bool === true) {
        self.sendJson( e.target );
      }
    });

    $('input[name=cancel]').on('click', function(e) {
      jsux.goURL( jsux.rootPath + 'login' );
    });

    $('input[name=passowrdConf]').on('blur', function() {
      self.checkPWD();
    }); 

    $('input[name=checkID]').on('click',function(e) {
      self.checkID();
    });

    $('input[name=checkCorpName]').on('click',function(e) {
      self.checkCorpName();
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
    this.setLayout();
  }
};

jsux.fn = jsux.fn || {};
jsux.fn.modify = {

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
  checkPWD: function() {

    var panelPwd = $('#panelNewPassword');
    var btn = $('input[name=check_newpassword]');
    if (panelPwd.css('display') === 'none') {
      btn.val('비밀번호 변경 취소하기');
      panelPwd.css('display','block');

      if (!btn.hasClass('active')) {
        btn.addClass('active');
      }
    } else {
      btn.val('비밀번호 변경하기');
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
    //console.log(panelPwd);
     if (panelPwd.css('display') === 'none') {     
      return true;
     }

    var inputNewPwd = $('input[name=new_password]');
    var inputNewPwdConf = $('input[name=new_password_conf]');

    if (!inputNewPwd.val()) {
       trace('새 비밀번호를 입력하세요.');
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

    var labelList = ['아이디를','비밀번호를','닉네임을','이메일을'];
    var checkList = ['user_id','password','nick_name','email_address'];

    $.each( checkList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        return false;
      }
    });

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

    var updateLoginHandler = function( url ) {

      var params = {_method:'insert'};
      jsux.getJSON( url, params, function(e) {

        if  (e.result.toUpperCase() == 'Y') {
          jsux.goURL( jsux.rootPath + 'login');
        }
      });
    };

    jsux.getJSON( url, params, function( e ) {

      trace( e.msg );
      if (e.result.toUpperCase() == 'Y') {
        updateLoginHandler( jsux.rootPath + 'login');
      }
    });
  },
  setEvent: function() {

    var self = this;
    
    $('form').on('submit', function( e ) {

      e.preventDefault();
      var bool  = self.checkFormVal( e.target );    
      if (bool === true) {
        self.sendJson( e.target );
      }
    });

    $('input[name=cancel]').on('click', function(e) {     
      jsux.goURL( jsux.rootPath + 'login' );
    });

    $('input[name=new_password_conf]').on('blur', function(e) {      
      self.validatePassword();
    }); 

    $('input[name=check_newpassword]').on('click', function() {
      self.checkPWD();
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
    this.setLayout();
    this.setEvent();
  }
};
