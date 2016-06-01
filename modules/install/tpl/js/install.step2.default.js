jsux.fn = {

	checkForm: function( f ) {

		var mhost = f.mysql_host.value.length,
			muser = f.mysql_user.value.length,
			mpwd = f.mysql_pwd.value.length,
			mdb = f.mysql_db.value.length;

		if ( mhost < 1 ) {
			trace("호스트명을 입력하세요.");
			f.mysql_host.focus();
			return (false);
		}
		if ( muser < 1 ) {
			trace("계정아이디을 입력하세요.");
			f.mysql_user.focus();
			return (false);
		}
		if ( mpwd < 1 ) {
			trace("계정비밀번호를 입력하세요.");
			f.mysql_pwd.focus();
			return (false);
		}
		if ( mdb < 1 ) {
			trace("데이터베이스명을 입력하세요.");
			f.mysql_db.focus();
			return (false);
		}
		return (true);
	},
	sendAndLoad: function( f ) {

		var self = this,
			params = {
				mysql_host: f.mysql_host.value,
				mysql_user:f.mysql_user.value,
				mysql_pwd:f.mysql_pwd.value,
				mysql_db:f.mysql_db.value
			};

		jsux.getJSON("install.step3.php", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {				
				jsux.goURL("install.step4.php");
			} 
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();
			var bool = self.checkForm( e.target );

			if ( bool === true) {
				self.sendAndLoad(e.target);
			}
		});

		$("input[name=mysql_user]").focus();
	},
	init: function() {
		this.setEvent();		
	}
};

jsux.fn.init();
