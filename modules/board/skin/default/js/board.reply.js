function musimw_check(f) {

	var name = f.name.value.length,
		pass = f.pass.value.length,
		title = f.title.value.length,
		comment = f.comment.value.length,
		wall = f.wall.value.length;

	if ( name < 1 ) {
		alert("이름을 입력하세요.");
		f.name.focus();
		return (false);
	}
	
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

	if ( comment < 1 ) {
		alert("내용을 입력하세요.");
		f.comment.focus();
		return (false);
	}

	if ( wall < 1 ) {
		alert("등록키를 입력하세요.");
		f.wall.focus();
		return (false);
	}

	return (true);
}

if (document.musimw.name.value.length == 0) {
	document.musimw.name.focus();
} else if (document.musimw.title.value.length == 0) {
	document.musimw.title.focus();
}
