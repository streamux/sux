jsux.fn = {

	setLayout: function() {

		jsux.getJSON("popup.list.json.php", function( e )  {

			var markup = "";
			$("#popupList").empty();

			if (e.result == "Y") {
				markup = $("#popupList_tmpl");

				$(markup).tmpl(e.data.list).appendTo("#popupList");				
			} else {
				markup = $("#popupWarnMsg_tmpl");
				$(markup).tmpl( e ).appendTo("#popupList");
			}
		});
	},
	init: function() {

		this.setLayout();
	}
};