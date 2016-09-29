jsux.fn = jsux.fn || {};
jsux.fn.list = {

	setLayout: function() {

		jsux.getJSON("board.admin.php?action=listJson&pagetype=board", function( e )  {

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
jsux.fn.add = {

	getSelectVal: function( id ) {

		var result = $.trim($("select[name="+id+"]").val());

		return result;
	},
	setSelectVal:function( id, value ) {

		$("select[name="+id+"]").val( value );
	},
	getRadioVal: function( id ) {

		var result = $("input:radio[name="+id+"]:checked").val();

		return result;
	},
	setRadioVal: function( id, value) {

		var result = $("input:radio[name="+id+"]:input[value="+value+"]").prop("checked", true);

		return result;
	},
	getCheckboxVal: function( id ) {

		var result= "",
			list = $("input:checkbox[name="+id+"]:checked"),
			len = list.length;

		$(list).each(function(index){
			result += list[index].value;

			if (index < len-1) {
				result += ",";
			}
		});
		return result;
	},
	checkLangKor: function( value ) {

		var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

		return reg.test( value );
	},
	checkFormVal: function( f ) {

		var table_name = f.table_name.value.length,
			board_name = f.board_name.value.length;

		if ( table_name < 1 ) {
			trace("게시판 테이블이름을 입력하세요.");
			f.table_name.focus();
			return (false);
		}

		if (this.checkLangKor( f.table_name.value)) {
			trace("테이블 이름에 한글이 포함되어 있습니다.");
			f.table_name.focus();
			return (false);
		}

		if ( board_name < 1) {
			trace("게시판 이름을 입력하세요.");
			f.board_name.focus();
			return (false);
		}

		return (true);
	},
	checkTableName: function() {

		var	params = {	table_name: $("input[name=table_name]").val()};

		if (params.table_name === "") {
			trace("게시판 테이블 이름을 입력해 주세요.");
			return;
		}

		jsux.getJSON("board.admin.php?action=checkTableName", params, function( e ) {

			trace( e.msg );
		});
	},
	sendJson:  function( f ) {

		var params = "";

		params = {	table_name: f.table_name.value,
					
					width: f.width.value,
					include1: f.include1.value,
					include2: this.getSelectVal("include2"),
					include3: f.include3.value,
					
					w_grade: this.getSelectVal("w_grade"),
					r_grade: this.getSelectVal("r_grade"),
					rw_grade: this.getSelectVal("rw_grade"),
					re_grade: this.getSelectVal("re_grade"),
					
					listnum: f.listnum.value,
					tail: f.tail.value,
					download: f.download.value,
					setup: f.setup.value,

					w_admin: f.w_admin.value,
					r_admin: f.r_admin.value,
					rw_admin: f.rw_admin.value,
					re_admin: f.re_admin.value,

					log_key: f.log_key.value,
					limit_choice: this.getRadioVal("limit_choice"),
					limit_word: f.limit_word.value,
					board_name: f.board_name.value,
					type: this.getRadioVal("type"),
					output: this.getRadioVal("output") };

		jsux.getJSON("board.admin.php?action=recordAdd", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[1].sub[0].link);
			} 
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit",function( e ) {

			e.preventDefault();

			var bool = self.checkFormVal( e.target );

			if (bool === true) {

				self.sendJson( e.target );
			}
		});
		$("input[name=cancel]").on("click", function(e) {

			jsux.goURL(menuList[1].sub[0].link);
		});
		$("input[name=checkID]").on("click",function(e) {				

			self.checkTableName();
		});
	},
	setLayout: function() {

		jsux.getJSON("board.admin.php?action=skinListJson", function( e ) {

			markup = $("#skinList_tmpl");
			$("#skinList").empty();
			$(markup).tmpl(e.data.list).appendTo("#skinList");
		});

		$('input[name=table_name]').focus();
	},
	init: function() {

		this.setLayout();
		this.setEvent();
	}
};
jsux.fn.modify = {
		
	getSelectVal: function( id ) {

		var result = $.trim($("select[name="+id+"]").val());

		return result;
	},
	setSelectVal:function( id, value ) {

		$("select[name="+id+"]").val( value );
	},
	getRadioVal: function( id ) {

		var result = $("input:radio[name="+id+"]:checked").val();

		return result;
	},
	setRadioVal: function( id, value) {

		var result = $("input:radio[name="+id+"][value="+value+"]").attr("checked", true);

		return result;
	},
	getCheckboxVal: function( id ) {

		var result= "",
			list = $("input:checkbox[name="+id+"]:checked"),
			len = list.length;

		$(list).each(function(index){
			result += list[index].value;

			if (index < len-1) {
				result += ",";
			}
		});
		return result;
	},
	getTextAreaVal: function( id ) {

		var result = $("textarea[name="+id+"]").val();

		return result;
	},
	setTextAreaVal: function( id, value ) {

		$("textarea[name="+id+"]").val( value );
	},
	checkLangKor: function( value ) {

		var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

		return reg.test( value );
	},		
	checkCompanyName: function() {

		
	},
	checkFormVal: function( f ) {

		var board_name = f.board_name.value.length;

		if ( board_name < 1) {
			trace("게시판 이름을 입력하세요.");
			f.board_name.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = "";

		params = {	table_name: $("input[name=table_name]").val(),
					id: $("input[name=id]").val(),
					board_name: f.board_name.value,
					width: f.width.value,
					include1: f.include1.value,
					include2: this.getSelectVal("include2"),
					include3: f.include3.value,
					log_key: this.getSelectVal("log_key"),
					w_grade: this.getSelectVal("w_grade"),
					r_grade: this.getSelectVal("r_grade"),
					rw_grade: this.getSelectVal("rw_grade"),
					re_grade: this.getSelectVal("re_grade"),
					w_admin: f.w_admin.value,
					r_admin: f.r_admin.value,
					rw_admin: f.rw_admin.value,
					re_admin: f.re_admin.value,
					listnum: f.listnum.value,
					tail: f.tail.value,
					download: f.download.value,
					setup: f.setup.value,
					output: this.getRadioVal("output"),
					type: this.getRadioVal("type"),
					limit_choice: this.getRadioVal("limit_choice"),
					limit_word: this.getTextAreaVal("limit_word")};


		jsux.getJSON("board.admin.php?action=recordModify", params, function( e ) {

			trace( e.msg );
			
			if (e.result == "Y") {
				jsux.goURL(menuList[1].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();

			var bool  = self.checkFormVal( e.target );
			if (bool === true) {
				self.sendJson( e.target );
			}
		});

		$("input[name=cancel]").on("click", function(e) {

			jsux.goURL(menuList[1].sub[0].link);
		});
	},
	setLayout: function() {

		var self = this,
			params = {
				table_name: $("input[name=table_name]").val()
			};

		jsux.getJSON("board.admin.php?action=modifyJson", params, function( e ) {

			var formLists = null,
				checkedVal = "",
				markup = null,
				labelList = null;

			if (e.result == "Y") {				

				formLists = $("input[type=text]");
				$(formLists).each(function(index) {

					if (e.data[this.name]) {
						this.value = e.data[this.name];
					}
				});

				formLists = $("select");
				$(formLists).each(function(index) {

					if (e.data[this.name]) {
						this.value = e.data[this.name];
						
					}						
				});

				formLists = $("input[type=radio]");
				$(formLists).each(function(index) {
					self.setRadioVal( this.name, e.data[this.name] );
				});

				self.setTextAreaVal("limit_word", e.data.limit_word);	
			} else {
				trace( e.msg );
			}
		});

		jsux.getJSON("board.admin.php?action=skinListJson", function( e ) {

			markup = $("#skinList_tmpl");
			$("#skinList").empty();
			$(markup).tmpl(e.data.list).appendTo("#skinList");
		});
	},
	init: function() {

		this.setLayout();
		this.setEvent();
	}
};
jsux.fn.delete = {

	sendJson: function() {

		var params = {
			table_name: $("input[name=table_name]").val(),
			id:$("input[name=id]").val()
		};

		jsux.getJSON("board.admin.php?action=recordDelete",params, function( e )  {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[1].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$(".articles .del .box ul > li > a").on("click", function( e ) {

			e.preventDefault();

			var key = $(this).data("key");

			if (key == "del") {
				self.sendJson();
			} else if (key == "back") {
				jsux.goURL(menuList[1].sub[0].link);
			}				
		});
	},
	init: function() {

		this.setEvent();
	}
};