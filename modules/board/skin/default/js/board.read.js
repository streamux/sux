jsux.fn = jsux.fn || {};
jsux.fn.boardRead = jsux.fn.boardRead || {};
jsux.fn.boardRead = {

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
