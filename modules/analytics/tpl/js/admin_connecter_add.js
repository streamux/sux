jsux.fn = {

	checkFormVal: function( f ) {

		var keyword = f.keyword.value.length;

		if ( keyword < 1 ) {
			trace("접속키워드를 입력하세요.");
			f.keyword.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = {
			"keyword": f.keyword.value
		};

		jsux.getJSON("analytics.admin.php?action=connecter_insert", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();

			var bool = self.checkFormVal( e.target );
			if (bool === true) {

				self.sendJson( e.target );
			}				
		});
		$("input[name=cancel]").on("click", function() {
			jsux.goURL(menuList[3].sub[0].link);
		});
	},
	init: function() {

		this.setEvent();
		$("input[name=keyword]").focus();
	}
};