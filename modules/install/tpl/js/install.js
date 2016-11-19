jsux.fn = jsux.fn || {};
jsux.fn.dbSetup = {

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
				action: 'record-dbsetup',
				db_hostname: f.db_hostname.value,
				db_userid:f.db_userid.value,
				db_password:f.db_password.value,
				db_database:f.db_database.value,
				db_table_prefix:f.db_table_prefix.value
			};

		jsux.getJSON( jsux.rootPath + 'install', params, function( e ) {

			alert(e.msg);
			if (e.result == "Y") {				
				jsux.goURL( jsux.rootPath + "install/admin-setup");
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
	},
	init: function() {
		this.setEvent();
		jsux.setAutoFocus();
	}
};
jsux.fn = jsux.fn || {};
jsux.fn.adminSetup = {

	checkForm: function ( f ) {

		var aname = f.admin_id.value.length,
			apass = f.admin_pwd.value.length;

		if (aname < 1) {
			trace("관리자 아이디를 입력하세요.");
			f.admin_id.focus();
			return (false);
		}

		if ( apass < 1 ) {
			trace("관리자 비밀번호를 입력하세요.");
			f.admin_pwd.focus();
			return (false);
		}
		return (true);
	},
	createTable: function() {

		var interval = null,
			isLoading = false,
			params = {
				action: 'recordCreateTable'
			};

		if (isLoading === true) {
			trace( '데이터 생성 중 입니다. 잠시만 기다려주세요.'  );
		}

		isLoading = true;
		jsux.getJSON( jsux.rootPath + "install", params, function(e) {

			isLoading = false;

			trace( e.msg  );
			if (e.result.toLowerCase() === 'n') {				
				return;
			}
			
			jsux.goURL("../login");
		});
	},
	sendAndLoad: function( f ) {

		var self = this,
			params = {
				action: 'recordAdminSetup',
				admin_id: f.admin_id.value,
				admin_pwd: f.admin_pwd.value,
				admin_email: f.admin_email.value,				
				yourhome: f.yourhome.value
			};

		jsux.getJSON( jsux.rootPath + "install", params, function(e) {

			trace( e.msg );
			if (e.result =="Y") {
				self.createTable();
			}
		});
	},
	setEvent:  function() {

		var self = this;

		$("form").on("submit",function( e ) {
			e.preventDefault();

			var bool = self.checkForm( e.target );
			if ( bool === true) {
				self.sendAndLoad( e.target );
			}
		});

		$("input").each(function(index) {
			$input = $(this);
			if ($input.attr('id') && $input.val() === '') {
				$input.focus();
				return false;
			}
		});
	},
	init: function() {
		this.setEvent();
		jsux.setAutoFocus();
	}
};
