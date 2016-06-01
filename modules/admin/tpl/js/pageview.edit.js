jsux.fn = {

	contentc_check: function( f ) {

		var keyword = f.keyword.value.length;

		if ( keyword < 1 ) {
			alert("페이지뷰키워드를 입력하세요.");
			f.keyword.focus();
			return (false);
		}

		return (true);
	},
	init: function() {

	}
};