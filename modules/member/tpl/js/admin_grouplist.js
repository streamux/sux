jsux.fn = {

	setLayout: function() {

		jsux.getJSON("member.admin.php?action=grouplistdata", function( e )  {

			var 	func = {
					editDate: function( value ) {
						var list = value.split(" ");
						return list[0];
					}
				},
				markup = "";

			$("#memberList").empty();

			if (e.result == "Y") {

				if (e.data.length > 0) {
					markup = $("#memberList_tmpl");
					$(markup).tmpl(e.data, func).appendTo("#memberList");
				} else {						
					markup = $("#memberWarnMsg_tmpl");
					$(markup).tmpl( e ).appendTo("#memberList");
				}						
			} else {
				markup = $("#memberWarnMsg_tmpl");
				$(markup).tmpl( e ).appendTo("#memberList");
			}
		});
	},
	init: function() {

		this.setLayout();
	}
};