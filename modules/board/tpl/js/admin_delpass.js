jsux.fn = {

	sendJson: function() {

		var params = {
			table_name: $("input[name=table_name]").val(),
			id:$("input[name=id]").val()
		};

		jsux.getJSON("board.admin.php?action=record_delete",params, function( e )  {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[1].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			e.preventDefault();

			var key = $(this).data("key");

			if (key == "del") {
				self.sendJson();
			} else if (key == "back") {
				jsux.goURL(menuList[1].sub[0].link);
			}				
		});
	},
	init: function() {

		this.setEvent();
	}
};