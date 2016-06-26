function musimsearch_check( f ) {

	var searcho = f.search.value.length;

	if ( searcho < 1 ) {
		alert("검색어를 입력하세요.");
		f.search.focus();
		return (false);
	}
	return (true);
}

function musimsl_check( f ) {

	var nameo = f.name.value.length,
		passo = f.pass.value.length,
		commento = f.comment.value.length;

	if ( nameo < 1 ) {
		alert("이름을 입력하세요.");
		f.name.focus();
		return (false);
	}else if ( passo < 1 ) {
		alert("비밀번호를 입력하세요.");
		f.pass.focus();
		return (false);
	}else if ( commento < 1 ) {
		alert("내용을 입력하세요.");
		f.comment.focus();
		return (false);
	}
	return (true);
}

function musimso_check( f ) {

	var msgList = {
		f:"진행완료을 선택하셨습니다.",
		i:"진행중을 선택하셨습니다.",
		c:"입금완료를 선택하셨습니다.",
		n:"입금미완료를 선택하셨습니다.",
		m:"메일발송을 선택하셨습니다.",
		b:"초기화를 선택하셨습니다."
	},
	msg = "";

	for (var i=0; f.opkey.length; i++) {

		if (f.opkey[i].checked === true) {

			var key = f.opkey[i].value;

			if (key) {
				msg = msgList[key];	
			} else {
				msg = msgList.b;
			}			
			break;
		}
	}
	alert(msg);
}