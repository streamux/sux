jsux.fn = jsux.fn || {};
jsux.fn.loginAdmin = {

	checkForm: function( f ) {

		var id = f.user_id.value.length,
			pwd = f.user_pwd.value.length;

		if ( id < 1) {
			trace("아이디를 입력하세요.");
			f.user_id.focus();
			return (false);				
		}

		if ( pwd < 1) {
			trace("비밀번호를 입력하세요.");
			f.user_pwd.focus();
			return (false);				
		}
		return (true);
	},
	init: function() {
		jsux.setAutoFocus();
	}
};