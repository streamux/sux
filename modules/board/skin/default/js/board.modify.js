function musimw_check(f) {

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
}
document.musimw.pass.focus();