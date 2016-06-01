jsux.fn = {

	checkForm: function ( f ) {

		var ap = f.admin_pwd.value.length;

		if ( ap < 1 ) {
			trace("관리자 비밀번호를 입력하세요.");
			f.admin_pwd.focus();
			return (false);
		}
		return (true);
	},
	createTable: function() {

		jsux.getJSON("../schemas/query.create_table.php", function(e) {

			trace( e.msg  );

			if (e.result == "Y") {
				jsux.goURL("../admin/login.php");
			} else {

				var interval = setInterval(function() {

					jsux.goURL("../admin/login.php");
					clearInterval( interval );
				}, 1000);
			}
		});
	},
	sendAndLoad: function( f ) {

		var self = this,
			params = {
				admin_pwd: f.admin_pwd.value,
				admin_email: f.admin_email.value,
				site_name: f.site_name.value,
				yourhome: f.yourhome.value
			};

		jsux.getJSON("install.step5.php", params, function(e) {

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

		$("input[name=admin_pwd]").focus();
	},
	init: function() {
		this.setEvent();
	}
};

jsux.fn.init();