jsux.fn = {

	setEvent: function() {

		$(".panel-btn ul li").on("click",function(e) {

			var key = $(this).data("id");

			if (key == "confirm") {
				jsux.goURL("login.php?action=login");
			}
		});
	},
	init: function() {
		this.setEvent();
	}
};

jsux.fn.init();