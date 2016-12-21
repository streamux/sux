jsux.fn = jsux.fn || {};
jsux.fn.list = {

	checkSearchForm: function(f) {

		var search = f.search.value.length;
		if ( search < 1 ) {
			alert("검색어를 입력하세요.");
			f.search.focus();
			return (false);
		}
		return (true);
	},
	init: function() {
		
	}
};
jsux.fn.read = jsux.fn.read || {};
jsux.fn.read = {

	checkSearchForm: function ( f ) {

		var searcho = f.search.value.length;

		if ( searcho < 1 ) {
			alert("검색어를 입력하세요.");
			f.search.focus();
			return (false);
		}
		return (true);
	},
	checkTailDocumentForm: function ( f ) {

		var nickname = f.nickname.value.length,
			pass = f.pass.value.length,
			comment = f.comment.value.length;

		if ( nickname < 1 ) {
			alert("이름을 입력하세요.");
			f.nickname.focus();
			return (false);
		}else if ( pass < 1 ) {
			alert("비밀번호를 입력하세요.");
			f.pass.focus();
			return (false);
		}else if ( comment < 1 ) {
			alert("내용을 입력하세요.");
			f.comment.focus();
			return (false);
		}

		return (true);
	},
	checkOpkeyForm: function ( f ) {

		var msg = "";

		for (var i=0; f.opkey.length; i++) {
			if (f.opkey[i].checked === true) {
				var key = f.opkey[i].value;
				if (key) {
					msg = key;	
				} else {
					msg = '초기화';
				}			
				break;
			}
		}
		msg += '를(을) 선택하였습니다.';
		alert(msg);
	},
	init: function() {

	}
};
jsux.fn.write = {

	checkDocumentForm: function (f) {

		var labelList = ['이름','비밀번호','제목','e-mail','내용','등록키'];
		var checkList = ['user_name','password','title','email_address','contents','wall'];
		var email = f.email_address.value.length + this.getEmailVal('email_tail');
		var result = true;

		$.each( checkList, function( index, item) {

			var $input = f[item];
			if ($input.value.length < 1) {
				trace(labelList[index] + '을(를) 입력 하세요.');
				$input.focus();
				result = false;
				return false;
			}
		});

		return result;
	},
	setEvent: function() {

		
	},
	init: function() {

		this.setEvent();
		jsux.setAutoFocus();	
	}
};
jsux.fn.reply = {

	checkDocumentForm: function (f) {

		var name = f.name.value.length,
		pass = f.pass.value.length,
		title = f.title.value.length,
		comment = f.comment.value.length,
		wall = f.wall.value.length;

		if ( name < 1 ) {
			alert("이름을 입력하세요.");
			f.name.focus();
			return false;
		}		
		if ( pass < 1 ) {
			alert("비밀번호를 입력하세요.");
			f.pass.focus();
			return false;
		}
		if ( title < 1 ) {
			alert("제목을 입력하세요.");
			f.title.focus();
			return false;
		}
		if ( title > 60 ) {
			alert("제목은 최대 60바이트까지 허용합니다.");
			f.title.focus();
			return false;
		}
		if ( comment < 1 ) {
			alert("내용을 입력하세요.");
			f.comment.focus();
			return false;
		}
		if ( wall < 1 ) {
			alert("등록키를 입력하세요.");
			f.wall.focus();
			return false;
		}

		return true;
	},
	init: function() {

		if ($('input[name=name]').val() === '') {
			$('input[name=name]').focus();
		} else if ($('input[name=title]').val() === '') {
			$('input[name=title]').focus();
		}		
	}
};
jsux.fn.modify = {

	checkDocumentForm: function (f) {

		var pass = f.pass.value.length,
			title = f.title.value.length,
			comment = f.comment.value.length;
		
		if ( pass < 1 ) {
			alert("비밀번호를 입력하세요.");
			f.pass.focus();
			return (false);
		}

		if ( title < 1 ) {
			alert("제목을 입력하세요.");
			f.title.focus();
			return (false);
		}

		if ( title > 60 ) {
			alert("제목은 최대 60바이트까지 허용합니다.");
			f.title.focus();
			return (false);
		}

		if ( email < 1 ) {
			alert("이메일 주소를 입력하세요.");
			f.email.focus();
			return (false);
		}

		if ( comment < 1 ) {
			alert("내용을 입력하세요.");
			f.comment.focus();
			return (false);
		}

		return (true);
	},
	init: function() {
		$('input[name=pass]').focus();
	}
};
jsux.fn.delete = {

	checkDocumentForm: function( f ) {

		var pass = f.password.value.length;
		if ( pass < 1) {
			trace('비밀번호를 입력하세요.');
			f.password.focus();
			return false;				
		}
		return true;
	},
	setEvent: function (f) {

		var self = this;
		$('form').on('submit', function(e) {
			e.preventDefault();

			var bool = self.checkDocumentForm(e.target);
			if (bool === false) {
				return;
			}
		});		
	},
	init: function() {
		this.setEvent();
		jsux.setAutoFocus();
	}
};
