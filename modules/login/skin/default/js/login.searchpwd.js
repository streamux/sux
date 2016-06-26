jsux.fn = {

	dispSelectMemberList: function() {

		var data = loginObj.memberList,
			markup = $("#ljsMember_tmpl");

		$("#ljsMember").empty();
		$(markup).tmpl(data).appendTo("#ljsMember");
	},
	checkForm: function( f ) {

		var nm = f.check_name.value.length,
			id = f.check_memberid.value.length,
			email = f.check_email.value.length;

		if ( nm < 1) {
			trace("이름을 입력하세요.");
			f.check_name.focus();
			return (false);				
		}

		if ( id < 1) {
			trace("아이디를 입력하세요.");
			f.check_memberid.focus();
			return (false);				
		}

		if ( email < 1) {
			trace("이메일을 입력하세요.");
			f.check_email.focus();
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
		this.dispSelectMemberList();
		this.setEvent();
		$("input[name=memberid]").focus();
	}
};

jsux.fn.init();