jsux.fn = {

	setLayout: function() {

		jsux.getJSON("board.admin.php?action=record_list&pagetype=board", function( e )  {

			var 	func = {
					editDate: function( value ) {
						var list = value.split(" ");
						return list[0];
					}
				},
				markup = "";

			$("#boardList").empty();

			if (e.result == "Y") {
				markup = $("#boardList_tmpl");
				$(markup).tmpl(e.data.list, func).appendTo("#boardList");				
			} else {
				markup = $("#boardWarnMsg_tmpl");
				$(markup).tmpl( e ).appendTo("#boardList");
			}
		});
	},
	init: function() {
		
		this.setLayout();
	}
};