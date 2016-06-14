jsux.fn = {

	checkForm: function( f ) {

		var id = f.user_id.value.length,
			pwd = f.user_pass.value.length;

		if ( id < 1) {
			trace("관리자 아이디를 입력하세요.");
			f.user_id.focus();
			return (false);				
		}

		if ( pwd < 1) {
			trace("관리자 비밀번호를 입력하세요.");
			f.user_pass.focus();
			return (false);				
		}
		return (true);
	},
	init: function() {
		
		$("input[name=user_id]").focus();
	}
};

jsux.fn.init();

