jsux.fn = {

	dispSelectMemberList: function() {

		var data = loginObj.memberList,
			markup = $("#ljsMember_tmpl");

		$("#ljsMember").empty();
		$(markup).tmpl(data).appendTo("#ljsMember");
	},
	checkForm: function( f ) {

		var id = f.memberid.value.length,
			email = f.email.value.length;

		if ( id < 1) {
			trace("아이디를 입력하세요.");
			f.memberid.focus();
			return (false);				
		}

		if ( email < 1) {
			trace("이메일을 입력하세요.");
			f.email.focus();
			return (false);				
		}
		return (true);
	},
	init: function() {
		this.dispSelectMemberList();
		$("input[name=memberid]").focus();
	}
};

jsux.fn.init();