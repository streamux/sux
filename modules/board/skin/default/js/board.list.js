function musimsl_check(f) {

	var searcho = f.search.value.length;

	if ( searcho < 1 ) {
		alert("검색어를 입력하세요.");
		f.search.focus();
		return (false);
	}
	return (true);
}