function musimw_check(f) {

	var name = f.m_name.value.length,
		pass = f.pass.value.length,
		storytitle = f.storytitle.value.length,
		email = f.email.value.length,
		storycomment = f.storycomment.value.length,
		wall = f.wall.value.length;

	if ( name < 1) {
		alert("이름을 입력하세요.");
		f.m_name.focus();
		return false;
	}

	if ( pass < 1) {
		alert("비밀번호를 입력하세요.");
		f.pass.focus();
		return false;
	}

	if ( storytitle < 1 ) {
		alert("제목을 입력하세요.");
		f.storytitle.focus();
		return false;
	}

	if ( storytitle > 60 ) {
		alert("제목은 최대 60바이트까지 허용합니다.");
		f.storytitle.focus();
		return false;
	}

	if ( storycomment < 1 ) {
		alert("내용을 입력하세요.");
		f.storycomment.focus();
		return false;
	}

	if ( wall < 1 ) {
		alert("붉은색 등록키를 입력하세요.");
		f.wall.focus();
		return false;
	}
	return true;
}

document.musimw.m_name.focus();