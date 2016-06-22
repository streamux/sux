jsux.fn = {

	sendJSON: function() {

		var params = {
			table_name: $("input[name=table_name]").val()
		};

		jsux.getJSON("member.groupdel.delete.php", params, function( e )  {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[0].sub[0].link);
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
				jsux.goURL(menuList[0].sub[0].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};