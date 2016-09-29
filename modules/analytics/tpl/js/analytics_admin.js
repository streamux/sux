jsux.fn = jsux.fn || {};
jsux.fn.connecterList = {

	setLayout: function() {

		jsux.getJSON("analytics.admin.php?action=connecterListJson", function( e )  {

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
jsux.fn.connecterAdd = {

	checkFormVal: function( f ) {

		var keyword = f.keyword.value.length;

		if ( keyword < 1 ) {
			trace("접속키워드를 입력하세요.");
			f.keyword.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = {
			"keyword": f.keyword.value
		};

		jsux.getJSON("analytics.admin.php?action=recordConnecterAdd", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();

			var bool = self.checkFormVal( e.target );
			if (bool === true) {

				self.sendJson( e.target );
			}				
		});
		$("input[name=cancel]").on("click", function() {
			jsux.goURL(menuList[3].sub[0].link);
		});
	},
	init: function() {

		this.setEvent();
		$("input[name=keyword]").focus();
	}
};
jsux.fn.connecterDelete = {

	sendJSON: function() {

		var params = {
			"id": $("input[name=id]").val()
		};

		jsux.getJSON("analytics.admin.php?action=recordConnecterDelete", params, function( e ) {

			trace( e.msg );
			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			var key = $(this).data("key");

			if (key == "del") {

				self.sendJSON();
			} else if (key == "back") {

				jsux.goURL(menuList[3].sub[0].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};
jsux.fn.connecterReset = {
	
	sendJSON: function() {

		var params = {
			"id": $("input[name=id]").val()
		};

		jsux.getJSON("analytics.admin.php?action=recordConnecterReset", params, function( e ) {

			trace( e.msg );
			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			var key = $(this).data("key");

			if (key == "reset") {					
				self.sendJSON();
			} else if (key == "back") {
				jsux.goURL(menuList[3].sub[0].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};
jsux.fn.pageviewList = {

	setLayout: function() {

		jsux.getJSON("analytics.admin.php?action=pageviewListJson", function( e )  {

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
jsux.fn.pageviewAdd = {

	checkFormVal: function( f ) {

		var keyword = f.keyword.value.length;

		if ( keyword < 1 ) {
			trace("페이지뷰 키워드를 입력하세요.");
			f.keyword.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = {
			"keyword": f.keyword.value
		};

		jsux.getJSON("analytics.admin.php?action=recordPageviewAdd", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[2].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();

			var bool = self.checkFormVal( e.target );

			if (bool === true) {

				self.sendJson( e.target );
			}				
		});
		$("input[name=cancel]").on("click", function() {
			jsux.goURL(menuList[3].sub[2].link);
		});
	},
	init: function() {

		this.setEvent();
		$("input[name=keyword]").focus();
	}
};
jsux.fn.pageviewDelete = {

	sendJSON: function() {

		var params = {
			"id": $("input[name=id]").val()
		};

		jsux.getJSON("analytics.admin.php?action=recordPageviewDelete", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[2].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			var key = $(this).data("key");

			if (key == "del") {

				self.sendJSON();
			} else if (key == "back") {

				jsux.goURL(menuList[3].sub[2].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};
jsux.fn.pageviewReset = {
	
	sendJSON: function() {

		var params = {
			"id": $("input[name=id]").val()
		};

		jsux.getJSON("analytics.admin.php?action=recordPageviewReset", params, function( e ) {

			trace( e.msg );
			if (e.result == "Y") {
				jsux.goURL(menuList[3].sub[2].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			var key = $(this).data("key");

			if (key == "reset") {					
				self.sendJSON();
			} else if (key == "back") {
				trace("aa", true);
				jsux.goURL(menuList[3].sub[2].link);
			}
			e.preventDefault();
		});
	},
	init: function() {

		this.setEvent();
	}
};