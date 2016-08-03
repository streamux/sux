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

		jsux.getJSON("../board/board.searchname.json.php", params, function( e ) {

			trace( e.msg );
		});
	},
	sendJson:  function( f ) {

		var params = "";

		params = { table_name: f.table_name.value,
					board_name: f.board_name.value,
					width: f.width.value,
					include1: f.include1.value,
					include2: this.getSelectVal("include2"),
					include3: f.include3.value,
					log_key: f.log_key.value,
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

					limit_word: f.limit_word.value };

		jsux.getJSON("board.admin.php?action=record_add", params, function( e ) {

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