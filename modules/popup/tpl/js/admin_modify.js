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
					popup_name: f.popup_name.value,
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

		jsux.getJSON("popup.admin.php?action=record_modify", params, function( e ) {

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

		jsux.getJSON("popup.admin.php?action=modifydata", params, function( e ) {

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

				self.setTextAreaVal("pucomment", e.data.comment);	
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