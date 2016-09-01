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
	setEvent: function (f) {

		$(".panel-btn ul li").on("click",function(e) {

			var form = $("form")[0],
				key = $(this).data("id");

			if (key == "send") {
				$(form).submit();
			} else if (key == "cancel") {
				jsux.history.back();
			}
		});
	},
	init: function() {
		this.setEvent();
		$('input[name=pwd]').focus();
	}
};

jsux.fn.init();

