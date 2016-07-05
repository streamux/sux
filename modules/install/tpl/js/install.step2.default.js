jsux.fn = {

	checkForm: function( f ) {

		var mhost = f.db_hostname.value.length,
			muser = f.db_userid.value.length,
			mpwd = f.db_password.value.length,
			mdb = f.db_database.value.length;

		if ( mhost < 1 ) {
			trace("호스트명을 입력하세요.");
			f.db_hostname.focus();
			return (false);
		}
		if ( muser < 1 ) {
			trace("계정아이디을 입력하세요.");
			f.db_userid.focus();
			return (false);
		}
		if ( mpwd < 1 ) {
			trace("계정비밀번호를 입력하세요.");
			f.db_password.focus();
			return (false);
		}
		if ( mdb < 1 ) {
			trace("데이터베이스명을 입력하세요.");
			f.db_database.focus();
			return (false);
		}
		return (true);
	},
	sendAndLoad: function( f ) {

		var self = this,
			params = {
				db_hostname: f.db_hostname.value,
				db_userid:f.db_userid.value,
				db_password:f.db_password.value,
				db_database:f.db_database.value
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

		$("input[name=db_userid]").focus();
	},
	init: function() {
		this.setEvent();		
	}
};

jsux.fn.init();
