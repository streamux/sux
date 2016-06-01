jsux.fn = {

	sendJSON: function() {

		var params = {
			"id": $("input[name=id]").val()
		};

		jsux.getJSON("analysis.del.delete.php", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			var key = $(this).data("key");

			if (key == "del") {

				self.sendJSON();
			} else if (key == "back") {

				jsux.goURL(menuList[3].sub[0].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};