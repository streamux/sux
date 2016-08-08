
jsux.fn = {

	contentc_check: function( f ) {

		var keyword = f.keyword.value.length;

		if ( keyword < 1 ) {
			trace("접속키워드를 입력하세요.");
			f.keyword.focus();
			return (false);
		}

		return (true);
	},
	setEvent: function() {

		$("input[name=cancel]").on("click", function() {

			jsux.history.back();
		});
	},
	init: function() {

		this.setEvent();
	}
};