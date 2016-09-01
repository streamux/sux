jsux.fn = {
	
	sendJSON: function() {

		var params = {
			"id": $("input[name=id]").val()
		};

		jsux.getJSON("analytics.admin.php?action=pageview_reset", params, function( e ) {

			trace( e.msg );
			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[2].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			var key = $(this).data("key");

			if (key == "reset") {					
				self.sendJSON();
			} else if (key == "back") {
				trace("aa", true);
				jsux.goURL(menuList[3].sub[2].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};