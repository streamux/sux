jsux.fn = jsux.fn || {};
jsux.fn.list = {

	setLayout: function() {

		jsux.getJSON(jsux.rootPath + "document-admin/list-json", function( e )  {

			var 	func = {
					editDate: function( value ) {
						var list = value.split(" ");
						return list[0];
					}
				},
				markup = "";

			// data에러가 나는 경우 서버 필드에 날자가 등록되어 있는지 확인한다.
			$("#documentList").empty();
			if (e.result == "Y") {
				markup = $("#documentList_tmpl");
				$(markup).tmpl(e.data.list, func).appendTo("#documentList");				
			} else {
				markup = $("#documentWarnMsg_tmpl");
				$(markup).tmpl( e ).appendTo("#documentList");
			}
		}, function(e) {
			console.log('error status : ' , e.status);
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

		var category = f.category.value.length,
			document_name = f.document_name.value.length;

		if ( category < 1 ) {
			trace("카테고리 이름을 입력하세요.");
			f.category.focus();
			return (false);
		}

		if (this.checkLangKor( f.category.value)) {
			trace("카테고리 이름에 한글이 포함되어 있습니다.");
			f.category.focus();
			return (false);
		}

		if ( document_name < 1) {
			trace("페이지 이름을 입력하세요.");
			f.document_name.focus();
			return (false);
		}

		return (true);
	},
	checkTableName: function() {

		var	params = {	category: $("input[name=category]").val()};

		if (params.category === "") {
			trace("카테고리명을 입력하세요.");
			$("input[name=category]").focus();
			return;
		}

		jsux.getJSON(jsux.rootPath + "document-admin/check-page", params, function( e ) {

			trace( e.msg );
		});
	},
	sendJson:  function( f ) {

		var self = this,
			params = {},
			indexCheckbox = 0;

		$.each(f, function(index, item) {

			var filters = 'checkbox|button|submit';
			var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
			var glue ='';

			if (item.nodeName.toLowerCase() === 'select') {
				//console.log(item.name + ' : ' + item.value);
				item.value = self.getSelectVal(item.name);					
				params[item.name] = item.value;
			} else if (type === 'radio' && item.checked) {
				//console.log(item.name + ' : ' + item.value);
				params[item.name] = item.value;				
			} else {
				 if (!type.match(filters)) {
					//console.log(item.name + ' : ' + item.value);					
					params[item.name] = item.value;
				}
			}			
		});

		var url = f.action;
		if (!url) {
			trace('Action URL Not Exists');
			return false;
		}

		jsux.getJSON( url, params, function( e ) {
			
			if (e.result == "Y") {
				jsux.goURL(jsux.rootPath + menuList[2].menu[0].link);
			} else {
				trace( e.msg );
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

			jsux.goURL(jsux.rootPath + menuList[2].menu[0].link);
		});
		$("input[name=checkID]").on("click",function(e) {				

			self.checkTableName();
		});
	},
	init: function() {

		this.setEvent();
		jsux.setAutoFocus();
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
	checkFormVal: function( f ) {

		var document_name = f.document_name.value.length;

		if ( document_name < 1) {
			trace("페이지  이름을 입력하세요.");
			f.document_name.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var self = this,
			params = {},
			indexCheckbox = 0;

		$.each(f, function(index, item) {

			var filters = 'checkbox|button|submit';
			var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
			var glue ='';

			if (item.nodeName.toLowerCase() === 'select') {
				//console.log(item.name + ' : ' + item.value);
				item.value = self.getSelectVal(item.name);					
				params[item.name] = item.value;
			} else if (type === 'radio' && item.checked) {
				//console.log(item.name + ' : ' + item.value);
				params[item.name] = item.value;				
			} else {
				 if (!type.match(filters)) {
					//console.log(item.name + ' : ' + item.value);					
					params[item.name] = item.value;
				}
			}			
		});

		var url = f.action;
		if (!url) {
			trace('Action URL Not Exists');
			return false;
		}

		jsux.getJSON(url, params, function( e ) {
			
			if (e.result == "Y") {
				jsux.goURL(jsux.rootPath + menuList[2].menu[0].link);
			} else {
				trace( e.msg );			
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

			jsux.goURL(jsux.rootPath + menuList[2].menu[0].link);
		});
	},
	setLayout: function() {

		var self = this,
			params = {
				id: $("input[name=id]").val()
			};

		jsux.getJSON(jsux.rootPath + "document-admin/modify-json", params, function( e ) {

			var formLists = null,
				checkedVal = "",
				markup = null,
				labelList = null,
				list = null;

			if (e.result == "Y") {

				list = e.data.list[0];	

				formLists = $("input[type=text]");
				$(formLists).each(function(index) {

					if (list[this.name]) {
						this.value = list[this.name];
					}
					//console.log(this.name, list[this.name]);
				});

				formLists = $("select");
				$(formLists).each(function(index) {

					//console.log(this.name, list[this.name]);
					if (list[this.name]) {
						this.value = list[this.name];
					}						
				});

				formLists = $("input[type=radio]");
				$(formLists).each(function(index) {
					self.setRadioVal( this.name, list[this.name] );
				});

				self.setTextAreaVal("contents", list.contents);	
			} else {
				trace( e.msg );
			}

			jsux.setAutoFocus();
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
			_method:$("input[name=_method]").val(),
			category:$("input[name=category]").val(),
			id:$("input[name=id]").val()
		};

		jsux.getJSON(jsux.rootPath + "document-admin/delete",params, function( e )  {

			trace( e.msg );
			if (e.result == "Y") {
				jsux.goURL(jsux.rootPath + menuList[2].menu[0].link);
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
				jsux.goURL(jsux.rootPath + menuList[2].menu[0].link);
			}				
		});
	},
	init: function() {

		this.setEvent();
	}
};