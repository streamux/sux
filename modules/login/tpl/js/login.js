jsux.fn = jsux.fn || {};
jsux.fn.login = {

	checkForm: function( f ) {

		var id = f.user_id.value.length,
			pwd = f.password.value.length;

		if ( id < 1) {
			trace('아이디를 입력하세요.');
			f.user_id.focus();
			return (false);				
		}

		if ( pwd < 1) {
			trace('비밀번호를 입력하세요.');
			f.password.focus();
			return (false);				
		}
		return (true);
	},
	sendJson: function(f) {

		var params = '',
			url = '';
			
		params = {
			_method: f._method.value,
			category: f.category.value,
			user_id: f.user_id.value,
			password: f.password.value
		};
		
		if (!f.action) {
			alert('Not Exists URL');
		}
		url = f.action;

		jsux.getJSON( url, params, function( e ) {
			
			if (e.result.toLowerCase() == 'y') {
				jsux.goURL(jsux.rootPath + 'login');
			} else {
				trace( e.msg );
				jsux.goURL(jsux.rootPath + 'login-fail');
			}
		});
	},
	event: function() {

		var self = this;
		$('form').submit( function(e) {
			e.preventDefault();
			var bool = self.checkForm(this);
			if (bool) {
				self.sendJson(this);
			}
		});

		$('.panel-btn > a').on('click', function(e) {
			e.preventDefault();

			var url = $(this).attr('href');
			if (!url) {
				alert('Not Exists URL');
			}
			var params = {_method:'insert'};
			jsux.getJSON( url, params, function( e ) {
				
				if (e.result.toLowerCase() === 'y') {
					jsux.goURL(jsux.rootPath + 'login');
				}
			});			
		});
	},
	init: function() {
		this.event();
		jsux.setAutoFocus();
	}
};
jsux.fn.leave = {

	checkForm: function( f ) {

		var id = f.user_id.value.length,
			pwd = f.password.value.length;

		if ( id < 1) {
			trace('아이디를 입력하세요.');
			f.user_id.focus();
			return (false);				
		}

		if ( pwd < 1) {
			trace('비밀번호를 입력하세요.');
			f.password.focus();
			return (false);				
		}
		return (true);
	},
	sendJson: function( f ) {

		var params = '',
			url = '';
		params = {
			_method: f._method.value,
			category: f.category.value,
			user_id: f.user_id.value,
			password: f.password.value
		};

		if (!f.action) {
			alert('Not Exists URL');
		}
		url = f.action;

		var logoutHandler = function( url ) {

			var params = {_method:'insert'};
			jsux.getJSON( url, params, function( e ) {
				
				if (e.result.toLowerCase() === 'y') {
					jsux.goURL(jsux.rootPath + 'login');
				}
			});
		};

		jsux.getJSON( url, params, function( e ) {

			trace( e.msg );
			if (e.result.toUpperCase() == 'Y') {
				logoutHandler(jsux.rootPath + 'logout');
			}
		});		
	},
	setEvent: function() {

		var self = this;
		$('.panel-btn input').on('click',function(e) {
			e.preventDefault();

			var form = $('form')[0],
				key = $(this).attr('name');

			if (key == 'btn_confirm') {
				var bool = self.checkForm(form);
				if (!bool) {
					return;
				}
				self.sendJson(form);
			} 
		});
	},
	init: function() {
		this.setEvent();
		jsux.setAutoFocus();
	}
};
jsux.fn.searchResult = {

	init: function() {}
};
jsux.fn.searchId = {

	checkForm: function( f ) {

		var nm = f.user_name.value.length,
			em = f.email_address.value.length;

		if ( nm < 1) {
			trace('이름을 입력하세요.');
			f.user_name.focus();
			return false;				
		}

		if ( em < 1) {
			trace('이메일 주소를 입력하세요.');
			f.email_address.focus();
			return (false);				
		}
		return (true);
	},
	setEvent: function() {

		var self = this;

		$('.panel-btn input').on('click',function(e) {
			e.preventDefault();

			var form = $('form')[0],
				key = $(this).attr('name');

			if (key == 'btn_confirm') {
				if (self.checkForm(form)) {
					$(form).submit();
				}				
			} 
		});
	},
	init: function() {
		this.setEvent();
		jsux.setAutoFocus();
	}
};
jsux.fn.searchPassword = {

	checkForm: function( f ) {

		var nm = f.user_name.value.length,
			id = f.user_id.value.length,
			email = f.email_address.value.length;

		if ( nm < 1) {
			trace('이름을 입력하세요.');
			f.user_name.focus();
			return (false);				
		}

		if ( id < 1) {
			trace('아이디를 입력하세요.');
			f.user_id.focus();
			return (false);				
		}

		if ( email < 1) {
			trace('이메일을 입력하세요.');
			f.email_address.focus();
			return (false);				
		}
		return (true);
	},
	setEvent: function() {

		var self = this;

		$('.panel-btn input').on('click',function(e) {
			e.preventDefault();

			var form = $('form')[0],
				key = $(this).attr('name');

			if (key == 'btn_confirm') {
				if (self.checkForm(form)) {
					$(form).submit();
				}
			} 
		});
	},
	init: function() {
		this.setEvent();
		jsux.setAutoFocus();
	}
};
