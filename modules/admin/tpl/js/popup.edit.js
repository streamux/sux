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
	chechFormVal: function( f ) {

		
	},
	sendJson: function( f ) {

		var params = "";

		params = { 	id: $("input[name=id]").val(),
					popupname: f.popupname.value,
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


		jsux.getJSON("popup.edit.update.php", params, function( e ) {

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

			self.sendJson( e.target );			
		});

		$("input[name=cancel]").on("click", function() {

			jsux.goURL(menuList[2].sub[0].link);
		});
	},
	setLayout: function() {

		var self = this,
			params = {
				id: $("input[name=id]").val()
			};

		jsux.getJSON("popup.edit.json.php", params, function( e ) {

			var formLists = null,
				checkedVal = "",
				markup = null,
				labelList = null;

			if (e.result == "Y") {

				markup = $("#skinList_tmpl");
				$("#skinList").empty();
				$(markup).tmpl(e.data.skinList).appendTo("#skinList");

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

				
				labelList = $("table tr").find(".view-type-textfield");

				markup = $("#popupLabel_tmpl");
				$(labelList).each(function(index) {

					var label = "",
						data = "";

					label = $(labelList[index]).attr("id");		
					data = {label: e.data[label]};

					$("#"+label).empty();
					$(markup).tmpl( data ).appendTo("#"+label);
				});

				self.setTextAreaVal("pucomment", e.data.pucomment);	
			} else {
				trace( e.msg );
			}
		});
	},
	init: function() {

		this.setLayout();
		this.setEvent();
	}
};