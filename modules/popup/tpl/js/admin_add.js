jsux.fn = {

	getSelectVal: function( id ) {

		var result = $.trim($("select[name="+id+"]").val());
		return result;
	},
	setSelectVal:function( id, value ) {

		$("select[name="+id+"]").val( value );
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
	chechFormVal: function( f ) {

		var name = f.popup_name.value.length;

		if ( name < 1 ) {
			trace("팝업이름을 입력하세요.");
			f.name.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = "";

		params = { 	popup_name: f.popup_name.value,
					choice: this.getSelectVal("choice"),
					time1: f.time1.value,
					time2: f.time2.value,
					time3: f.time3.value,
					time4: f.time4.value,
					time5: f.time5.value,
					time6: f.time6.value,
					popup_title: f.popup_title.value,
					popup_width: f.popup_width.value,
					popup_height: f.popup_height.value,
					popup_top: f.popup_top.value,
					popup_left: f.popup_left.value,
					skin: this.getSelectVal("skin"),
					skin_top: f.skin_top.value,
					skin_left: f.skin_left.value,
					skin_right: f.skin_right.value,
					comment: this.getTextAreaVal("comment")};

		jsux.getJSON("popup.admin.php?action=record_add", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[2].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			var bool;
			e.preventDefault();

			bool = self.chechFormVal( e.target );
			if (bool === true) {
				self.sendJson( e.target );
			}
			
		});

		$("input[name=cancel]").on("click", function() {

			jsux.goURL(menuList[2].sub[0].link);
		});
	},
	setLayout: function() {

		var self = this;

		jsux.getJSON("popup.admin.php?action=adddata", function( e ) {

			markup = $("#skinList_tmpl");
			$("#skinList").empty();
			$(markup).tmpl(e.data.list).appendTo("#skinList");
		});

		$('input[name=popup_name]').focus();
	},
	init: function() {

		this.setLayout();
		this.setEvent();
	}
};