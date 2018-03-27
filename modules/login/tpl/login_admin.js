jsux.fn = jsux.fn || {};
jsux.fn.loginAdmin = {

  checkForm: function( f ) {

    var errorMsg = {
        user_id: '아이디를 입력하세요',
        user_pwd: '비밀번호를 입력하세요.'
      };

    for (var key in errorMsg) {
     
      var input = f[key];
      if (input.value === 0 || input.value === '') {
        trace(errorMsg[key]);
        input.focus();
        return false;
      }
    }

    return true;
  },
  setEvent: function() {

    var self = this;
    $('form[name=f_login_admin]').on('submit',function(e) {

      if (!self.checkForm(e.target)) {
        e.preventDefault();
      } 
    });
  },
  init: function() {
    this.setEvent();
    jsux.setAutoFocus();
  }
};