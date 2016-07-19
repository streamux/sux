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
	sendJson: function( f ) {

		var params = "";
		params = { action: 'record_delete',
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
				self.sendJson(form);
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

