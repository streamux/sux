jsux.fn = jsux.fn || {};
jsux.fn.login = {

	dispSelectMemberList: function() {

		var data = loginObj.memberList,
			markup = $("#ljsMember_tmpl");

		$("#ljsMember").empty();
		$(markup).tmpl(data).appendTo("#ljsMember");
	},
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
	init: function() {
		this.dispSelectMemberList();
		$("input[name=memberid]").focus();
	}
};
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
		$("input[name=user_id]").focus();
	}
};
jsux.fn.leave = {

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
	sendJson: function( f ) {

		var params = "";
		params = { action: 'recordDelete',
					table_name: f.member.value,
					memberid: f.memberid.value,
					pass: f.pass.value };

		jsux.getJSON("../member/member.php", params, function( e ) {

			trace( e.msg );
			if (e.result == "Y") {
				jsux.goURL('../login/login.php?action=logout');
			}
		});
	},
	setEvent: function() {

		var self = this;
		$(".panel-btn ul li").on("click",function(e) {

			var form = $("form")[0],
				key = $(this).data("id");

			if (key == "send") {

				var bool = self.checkForm(form);
				if (!bool) {
					return;
				}
				self.sendJson(form);
			} else if (key == "cancel") {
				jsux.goURL("login.php?action=login");
			}
		});
	},
	init: function() {
		this.setEvent();
		$("input[name=pass]").focus();
	}
};
jsux.fn.searchresult = {

	setEvent: function() {

		$(".panel-btn ul li").on("click",function(e) {

			var key = $(this).data("id");

			if (key == "confirm") {
				jsux.goURL("login.php?action=login");
			}
		});
	},
	init: function() {
		this.setEvent();
	}
};
jsux.fn.searchID = {

	dispSelectMemberList: function() {

		var data = loginObj.memberList,
			markup = $("#ljsMember_tmpl");

		$("#ljsMember").empty();
		$(markup).tmpl(data).appendTo("#ljsMember");
	},
	checkForm: function( f ) {

		var nm = f.user_name.value.length,
			em = f.user_email.value.length;

		if ( nm < 1) {
			trace("이름을 입력하세요.");
			f.user_name.focus();
			return false;				
		}

		if ( em < 1) {
			trace("이메일 주소를 입력하세요.");
			f.user_email.focus();
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
		$("input[name=user_name]").focus();
	}
};
jsux.fn.searchPassword = {

	dispSelectMemberList: function() {

		var data = loginObj.memberList,
			markup = $("#ljsMember_tmpl");

		$("#ljsMember").empty();
		$(markup).tmpl(data).appendTo("#ljsMember");
	},
	checkForm: function( f ) {

		var nm = f.user_name.value.length,
			id = f.user_id.value.length,
			email = f.user_email.value.length;

		if ( nm < 1) {
			trace("이름을 입력하세요.");
			f.user_name.focus();
			return (false);				
		}

		if ( id < 1) {
			trace("아이디를 입력하세요.");
			f.user_id.focus();
			return (false);				
		}

		if ( email < 1) {
			trace("이메일을 입력하세요.");
			f.user_email.focus();
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
		$("input[name=user_name]").focus();
	}
};
