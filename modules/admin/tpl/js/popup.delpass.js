jsux.fn = {


	sendJSON: function() {

		var params = {
			id : "<? echo $id; ?>"
		};
		jsux.getJSON("popup.del.delete.php", params, function( e )  {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[2].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			e.preventDefault();

			var key = $(this).data("key");

			if (key == "del") {
				self.sendJSON();
			} else if (key == "back") {
				jsux.goURL(menuList[2].sub[0].link);
			}
		});			
	},
	init: function() {

		this.setEvent();
	}
};