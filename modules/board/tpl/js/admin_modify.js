jsux.fn = {
		
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

		params = { table_name: $("input[name=b_tablename]").val(),
					id: $("input[name=b_id]").val(),
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


		jsux.getJSON("board.admin.php?action=record_modify", params, function( e ) {

			trace( e.msg );
			return;
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
				table_name: $("input[name=b_tablename]").val()
			};

		jsux.getJSON("board.admin.php?action=modifydata", params, function( e ) {

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

				labelList = $("table tr").find(".view-type-textfield");

				markup = $("#boardLabel_tmpl");
				$(labelList).each(function(index) {

					var label = "",
						data = "";

					label = $(labelList[index]).attr("id");		
					data = {label: e.data[label]};

					$("#"+label).empty();
					$(markup).tmpl( data ).appendTo("#"+label);
				});

				self.setTextAreaVal("limit_word", e.data.limit_word);	
			} else {
				trace( e.msg );
			}
		});

		jsux.getJSON("board.admin.php?action=skinlist", function( e ) {

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