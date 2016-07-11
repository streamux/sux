jsux.fn = {

	checkForm: function( f ) {

		var id = f.memberid.value.length,
			pwd = f.pass.value.length;

		if ( id < 1) {
			trace("아이디를 입력하세요.");
			f.memberid.focus();
			return (false);				
		}

		if ( pwd < 1) {
			trace("비밀번호를 입력하세요.");
			f.pass.focus();
			return (false);				
		}
		return (true);
	},
	setEvent: function() {

		$(".panel-btn ul li").on("click",function(e) {

			var form = $("form")[0],
				key = $(this).data("id");

			if (key == "send") {
				$(form).submit();
			} else if (key == "cancel") {
				jsux.goURL("login.php?action=login");
			}
		});
	},
	init: function() {
		this.setEvent();
		$("input[name=memberid]").focus();
	}
};

jsux.fn.init();

