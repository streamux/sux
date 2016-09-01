jsux.fn = {

	setLayout: function() {

		var params = {
			table_name: $("input[name=table_name]").val()
		};

		jsux.getJSON("member.admin.php?action=listdata", params, function( e )  {

			var 	func = {
					editDate: function( value ) {
						var list = value.split(" ");
						return list[0];
					}
				},
				markup = "";

			$("#memberList").empty();

			if (e.result == "Y") {

				if (e.data.list.length > 0) {
					markup = $("#memberList_tmpl");
					$(markup).tmpl(e.data.list, func).appendTo("#memberList");
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