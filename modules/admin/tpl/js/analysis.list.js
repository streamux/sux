jsux.fn = {

	setLayout: function() {

		jsux.getJSON("analysis.list.json.php", function( e )  {

			var markup = "";
			$("#totallogList").empty();

			if (e.result == "Y") {
				markup = $("#totallogList_tmpl");
				$(markup).tmpl(e.data.list).appendTo("#totallogList");
			} else {
				markup = $("#totallogWarnMsg_tmpl");
				$(markup).tmpl( e ).appendTo("#totallogList");
			}
		});
	},
	init: function() {

		this.setLayout();
	}
};