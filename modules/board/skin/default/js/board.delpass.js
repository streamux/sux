jsux.fn = {

	checkForm: function( f ) {

		var pass = f.pwd.value.length;

		if ( pass < 1) {
			trace('비밀번호를 입력하세요.');
			f.pwd.focus();
			return false;				
		}
		return true;
	},
	init: function() {
		$('input[name=pwd]').focus();
	}
};

jsux.fn.init();

