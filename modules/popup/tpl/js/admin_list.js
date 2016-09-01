jsux.fn = {
		
	setEvent: function() {

		//popupManager.open();

		var self = this;
		$(".popup > a").bind("click", function(e) {

			var id = $(this).data('key');
			popupManager.open( id );	
		});
	},
	setLayout: function() {

		var self = this;
		jsux.getJSON("popup.admin.php?action=listdata", function( e )  {
		
			var markup = "";
			$("#popupList").empty();

			if (e.result == "Y") {
				markup = $("#popupList_tmpl");

				$(markup).tmpl(e.data).appendTo("#popupList");				
			} else {
				markup = $("#popupWarnMsg_tmpl");
				$(markup).tmpl( e ).appendTo("#popupList");
			}

			self.setEvent();
		});
	},
	init: function() {

		this.setLayout();		
	}
};