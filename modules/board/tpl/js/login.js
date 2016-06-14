jsux.fn = {

	checkForm: function( f ) {

		var pwd = f.pass.value.length;

		if( pwd < 1) {
			trace("비밀번호를 입력하세요.");
			f.pass.focus();
			return (false);				
		}
		return (true);
	},
	init: function() {
		
		$("input[name=pass]").focus();
	}
};

jsux.fn.init();

