jsux.fn = {

	setLayout: function() {

		jsux.getJSON("member.list.json.php", function( e )  {

			var markup = "";
			$("#memberList").empty();

			if (e.result == "Y") {

				if (e.data.list.length > 0) {
					markup = $("#memberList_tmpl");
					$(markup).tmpl(e.data.list).appendTo("#memberList");
				} else {						
					markup = $("#memberWarnMsg_tmpl");
					$(markup).tmpl( e ).appendTo("#memberList");
				}

				$("#articleMemberDelTitle").empty();
				markup = $("#articleMemberDelTitle_tmpl");
				$(markup).tmpl(e.data).appendTo("#articleMemberDelTitle");						
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