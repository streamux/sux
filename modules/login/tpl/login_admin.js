jsux.fn = jsux.fn || {};
jsux.fn.loginAdmin = {

  checkForm: function( f ) {

    var id = f.user_id,
      pwd = f.user_pwd;

    if ( id.value.length < 1) {
      trace("아이디를 입력하세요.");
      id.focus();
      return false;       
    }

    if ( pwd.value.length < 1) {
      trace("비밀번호를 입력하세요.");
      pwd.focus();
      return false;       
    }
    return true;
  },
  setEvent: function() {

    var self = this;
    $('input[type=submit]').on('click',function(e) {
      e.preventDefault();

      var $form = $('form')[0],
        key = $(this).attr('name');

      if (key === 'btn_confirm' && self.checkForm($form)) {
        $('form').submit();
      } 
    });
  },
  init: function() {
    this.setEvent();
    jsux.setAutoFocus();
  }
};