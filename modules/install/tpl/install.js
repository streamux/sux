@@ -1,164 +0,0 @@
jsux.fn = jsux.fn || {};
jsux.fn.setupDb = {

  checkForm: function( f ) {

    var inputs = jsux.forms.getFormElements(f.elements, 'type', 'hidden|text|password');

    for (var i=0; i<inputs.length; i++) {

      if (inputs[i] && inputs[i].value === '') {
        trace('<input name="' + inputs[i].name + '"> 값이 필요합니다."');
        inputs[i].focus();
        return false;
      }
    }
    
    return true;
  },
  sendAndLoad: function( f ) {

    var self = this,
      isLoading = false,
      params = {},
      url = '';

    var inputs = jsux.forms.getFormElements(f.elements, 'type', 'hidden|text|password');

    for (var i=0; i<inputs.length; i++) {
      params[inputs[i].name] = inputs[i].value;
    }

    url =  f.action;
    if (!url) {
      alert('Not Exist URL');
    }

    if (isLoading === true) {
      trace( '데이터 생성 중 입니다. 잠시만 기다려주세요.'  );
    }
    
    isLoading = true;
    jsux.getJSON( url, params, function( e ) {

      isLoading= false;
      alert(e.msg);
      if (e.result == "Y") {
        jsux.goURL( jsux.rootPath + "setup-admin");
      } 
    });
  },
  setEvent: function() {

    var self = this;

    $("form[name=f_setup_db]").on("submit", function( e ) {
      e.preventDefault();

      if ( self.checkForm( e.target ) === true) {
        self.sendAndLoad(e.target);
      }
    });   
  },
  init: function() {
    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn = jsux.fn || {};
jsux.fn.setupAdmin = {

  checkForm: function ( f ) {

    var idList = ['admin_id', 'admin_pwd', 'admin_name', 'admin_nickname','admin_email', 'yourhome'],
          msgList = ['아이디를', '비밀번호를', '이름을', '닉네임을', '이메일을', '사이트 주소를'];

    for(var i=0; i<idList.length; i++) {
      var el = f[idList[i]];      
      if (!el.value) {
        trace(msgList[i] + ' 입력하세요.');
        el.focus();
        return false;
      }
    }

    return true;
  },
  createTable: function() {

    var interval = null,
      isLoading = false,
      params = {
        _method: 'insert'
      };

    if (isLoading === true) {
      trace( '데이터 생성 중 입니다. 잠시만 기다려주세요.'  );
    }

    isLoading = true;
    jsux.getJSON( jsux.rootPath + "create-table", params, function(e) {

      isLoading = false;
      trace(e.msg);
      jsux.goURL( jsux.rootPath);  
    });
  },
  sendAndLoad: function( f ) {

    var self = this,
      isLoading = false,
      params = {
        _method: f._method.value,
        admin_id: f.admin_id.value,
        admin_pwd: f.admin_pwd.value,
        admin_name: f.admin_name.value,
        admin_nickname: f.admin_nickname.value,
        admin_email: f.admin_email.value,       
        yourhome: f.yourhome.value
      },
      url = '';

    url =  f.action;
    if (!url) {
      alert('Not Exist URL');
    }

    if (isLoading === true) {
      trace( '데이터 생성 중 입니다. 잠시만 기다려주세요.'  );
    } 
    isLoading = true;

    jsux.getJSON( url, params, function(e) {

      isLoading = false;
      trace( e.msg );
      if (e.result =='Y') {
        self.createTable();
      }
    });
  },
  setEvent:  function() {

    var self = this;

    $('form[name=f_setup_admin]').on('submit',function( e ) {
      e.preventDefault();

      if (self.checkForm( e.target )) {
        self.sendAndLoad( e.target );
      }
    });
  },
  init: function() {
    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn = jsux.fn || {};
jsux.fn.uninstall = {

  init: function() {
    
  }
}