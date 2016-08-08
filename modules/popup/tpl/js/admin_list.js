jsux.fn = {

	setLayout: function() {

		jsux.getJSON("popup.admin.php?action=listdata", function( e )  {


			trace( e.data['title'], 1);
			
			var markup = "";
			$("#popupList").empty();

			if (e.result == "Y") {
				markup = $("#popupList_tmpl");

				$(markup).tmpl(e.data).appendTo("#popupList");				
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