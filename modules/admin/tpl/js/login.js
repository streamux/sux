jsux.fn = {

	checkForm: function( f ) {

		var pwd = f.admin_pass.value.length;

		if( pwd < 1) {
			trace("비밀번호를 입력하세요.");
			f.admin_pass.focus();
			return (false);				
		}
		return (true);
	},
	init: function() {
		
		$("input[name=admin_pass]").focus();
	}
};

jsux.fn.init();

