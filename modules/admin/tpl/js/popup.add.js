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

		var popupname = f.popupname.value.length,
			popuptitle = f.popuptitle.value.length;

		if ( popupname < 1 ) {
			trace("팝업이름을 입력하세요.");
			f.popupname.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = "";

		params = { 	popupname: f.popupname.value,
					popupchoice: this.getSelectVal("popupchoice"),
					popuptime1: f.popuptime1.value,
					popuptime2: f.popuptime2.value,
					popuptime3: f.popuptime3.value,
					popuptime4: f.popuptime4.value,
					popuptime5: f.popuptime5.value,
					popuptime6: f.popuptime6.value,
					popuptitle: f.popuptitle.value,
					popupwidth: f.popupwidth.value,
					popupheight: f.popupheight.value,
					popuptop: f.popuptop.value,
					popupleft: f.popupleft.value,
					skin: this.getSelectVal("skin"),
					skin_top: f.skin_top.value,
					skin_left: f.skin_left.value,
					skin_right: f.skin_right.value,
					pucomment: this.getTextAreaVal("pucomment")};

		jsux.getJSON("popup.add.insert.php", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[2].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();

			var bool = self.chechFormVal( e.target );

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

		jsux.getJSON("popup.add.json.php", function( e ) {

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