jsux.fn = jsux.fn || {};
jsux.fn.join = {

	getEmailVal: function( id ) {

		var result = $.trim($('select[name='+id+'1]').val());
		if ( result == '직접입력') {
			result = $('input[name='+id+'2]').val();
		}
		result = result.replace(/@/i, '');

		return result;
	},
	getSelectVal: function( id ) {

		var result = $.trim($('select[name='+id+']').val());
		return result;
	},
	setSelectVal:function( id, value ) {

		$('select[name='+id+']').val( value );
	},
	getCheckboxVal: function( id ) {

		var result= '',
			list = $('input:checkbox[name='+id+']:checked'),
			len = list.length;

		$(list).each(function(index){
			result += list[index].value;

			if (index < len-1) {
				result += ',';
			}
		});
		return result;
	},
	checkLangKor: function( value ) {

		var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
		return reg.test( value );
	},
	checkFormVal: function( f ) {

		var memberid = f.memberid.value.length,
			pwd1 = f.pwd1.value.length,
			pwd2 = f.pwd2.value.length,
			name = f.name.value.length,
			email = f.email.value.length,
			emailTail = this.getEmailVal('email_tail'),
			hp1 = f.hp1.value.length,
			hp2 = f.hp2.value.length,
			hp3 = f.hp3.value.length;

		if ( memberid < 1 ) {
			trace('아이디를 입력 하세요.');
			f.memberid.focus();
			return (false);
		}

		if (this.checkLangKor( f.memberid.value)) {
			trace('아이디에 한글이 포함되어 있습니다.');
			f.memberid.focus();
			return (false);
		}

		if ( pwd1 < 1) {
			trace('비밀번호를 입력 하세요.');
			f.pwd1.focus();
			return (false);
		}

		if ( pwd2 < 1) {
			trace('확인번호를 입력 하세요.');
			f.pwd2.focus();
			return (false);
		}

		if ( name < 1 ) {
			trace('이름을 입력 하세요.');
			f.name.focus();
			return (false);
		}

		if ( email < 1 ) {
			trace('e-mail을 입력하세요.');
			f.email.focus();
			return (false);
		}

		if ( emailTail < 1 ) {
			trace('e-mail서비스 주소를 입력하세요.');

			if (this.getEmailVal('email_tail') === '') {
				f.email_tail2.focus();
			}
			return (false);
		}

		if ( hp1 < 3 ) {
			trace('핸드폰 첫번째 자리 번호를 입력해 주세요.');
			f.hp1.focus();
			return (false);
		}

		if ( hp2 < 3 ) {
			trace('핸드폰 두번째 자리 번호를 입력해 주세요.');
			f.hp2.focus();
			return (false);
		}

		if ( hp3 < 4 ) {
			trace('핸드폰 세번째 자리 번호를 입력해 주세요.');
			f.hp3.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = '';
		params = {	action: 'recordJoin',
					table_name: this.getSelectVal('table_name'),
					memberid: f.memberid.value,
					pwd1: f.pwd1.value,
					pwd2: f.pwd2.value,
					name: f.name.value,
					email: f.email.value+'@'+this.getEmailVal('email_tail'),
					hp1: f.hp1.value,
					hp2: f.hp2.value,
					hp3: f.hp3.value,
					tel1: f.tel1.value,
					tel2: f.tel2.value,
					tel3: f.tel3.value,
					company: f.company.value,
					job: f.job.value,
					hobby: this.getCheckboxVal('hobby'),
					path: f.path.value,
					proposeid: f.proposeid.value };

		jsux.getJSON('member.php', params, function( e ) {

			trace( e.msg );
			
			if (e.result == 'Y') {
				jsux.goURL('../login/login.php?action=login');
			}
		});
	},
	checkPWD: function() {

		if ($('input[name=pwd1]').val() != $('input[name=pwd2]').val()) {

			trace('비밀번호가 일치하지 않습니다.');

			$('input[name=pwd1]').val('');
			$('input[name=pwd2]').val('');
			$('input[name=pwd1]').focus();

			return(false);
		}
	},		
	checkID: function() {

		var	params =  {	table_name: this.getSelectVal('table_name'),
						memberid: $('input[name=memberid]').val()};

		if (params.memberid === '') {
			trace('아이디를 입력해주세요');
			$('input[name=memberid]').focus();
			return;
		}

		jsux.getJSON('member.php?action=searchID', params, function( e ) {
			trace( e.msg );
		});
	},
	checkCorpName: function() {

		var	params = '';
		params = {	action: 'searchcorp',
					table_name: $('select[name=table_name]').val(),
					company: $('input[name=company]').val()};

		jsux.getJSON('member.php', params, function( e ) {
			trace( e.msg );
		});
	},
	setEvent: function() {

		var self = this;
		$('form').on('submit', function( e ) {

			e.preventDefault();
			var bool  = self.checkFormVal( e.target );			
			if (bool === true) {
				self.sendJson( e.target );
			}
		});
		$('input[name=cancel]').on('click', function(e) {

			jsux.goURL( '../login/login.php?action=login' );
		});

		$('input[name=pwd2]').on('blur', function() {

			self.checkPWD();
		});	
		$('input[name=checkID]').on('click',function(e) {

			self.checkID();
		});
		$('input[name=checkCorpName]').on('click',function(e) {

			self.checkCorpName();
		});
		$('select[name=email_tail1]').on('change', function() {

			$('input[name=email_tail2').val('');
		});	
	},
	setLayout: function() {

		var	params = '';
		params = { action: 'groupList' };
		
		jsux.getJSON('member.php', params, function( e )  {
			
			var markup = $('#tableList_tmpl');

			$('#tableList').empty();
			if (e.data.length > 0) {
				$(markup).tmpl(e.data).appendTo('#tableList');
			} else {
				$(markup).tmpl('{name: no data}').appendTo('#tableList');
			}
		});

		$("input[name=memberid]").focus();
	},
	init: function() {

		this.setEvent();
		this.setLayout();
	}
};

jsux.fn = jsux.fn || {};
jsux.fn.modify = {

	getEmailVal: function( id ) {

		var result = $.trim($("select[name="+id+"1]").val());

		if ( result == "직접입력") {
			result = $("input[name="+id+"2]").val();
		}
		result = result.replace(/@/i, '');

		return result;
	},
	getSelectVal: function( id ) {

		var result = $.trim($("select[name="+id+"]").val());

		return result;
	},
	setSelectVal:function( id, value ) {

		$("select[name="+id+"]").val( value );
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
	checkPWD: function() {

		if ($("input[name=pwd1]").val() != $("input[name=pwd2]").val()) {

			trace("비밀번호가 일치하지 않습니다.");

			$("input[name=pwd1]").val("");
			$("input[name=pwd2]").val("");
			$("input[name=pwd1]").focus();

			return(false);
		}
	},		
	checkID: function() {

		var	params = "";
		params = {	table_name: $("select[name=table_name]").val(),
					memberid: $("input[name=memberid]").val()};

		jsux.getJSON("../search_id.php", params, function( e ) {

			trace( e.msg );
		});
	},
	checkCorpName: function() {

		var	params = "";
		params = {	table_name: $("select[name=table_name]").val(),
					company: $("input[name=company]").val()};

		jsux.getJSON("../search_companyname.php", params, function( e ) {

			trace( e.msg );
		});
	},
	checkFormVal: function( f ) {

		var memberid = $("input[name=memberid]").val(),
			pwd1 = f.pwd1.value.length,
			pwd2 = f.pwd2.value.length,
			name = f.name.value.length,
			email = f.email.value.length,
			emailTail = this.getEmailVal("email_tail"),
			hp1 = f.hp1.value.length,
			hp2 = f.hp2.value.length,
			hp3 = f.hp3.value.length;

		if ( memberid < 1 ) {
			trace("아이디를 입력 하세요.");
			f.memberid.focus();
			return (false);
		}

		if ( pwd1 < 1) {
			trace("비밀번호를 입력 하세요.");
			f.pwd1.focus();
			return (false);
		}

		if ( pwd2 < 1) {
			trace("확인번호를 입력 하세요.");
			f.pwd2.focus();
			return (false);
		}

		if ( name < 1 ) {
			trace("이름을 입력 하세요.");
			f.name.focus();
			return (false);
		}

		if ( email < 1 ) {
			trace("e-mail을 입력하세요.");
			f.email.focus();
			return (false);
		}

		if ( emailTail < 1 ) {
			trace("e-mail서비스 주소를 입력하세요.");

			if (this.getEmailVal("email_tail") === "") {
				f.email_tail2.focus();
			}
			return (false);
		}

		if ( hp1 < 3 ) {
			trace("핸드폰 첫번째 자리 번호를 입력해 주세요.");
			f.hp1.focus();
			return (false);
		}

		if ( hp2 < 3 ) {
			trace("핸드폰 두번째 자리 번호를 입력해 주세요.");
			f.hp2.focus();
			return (false);
		}

		if ( hp3 < 4 ) {
			trace("핸드폰 세번째 자리 번호를 입력해 주세요.");
			f.hp3.focus();
			return (false);
		}

		return (true);
	},
	sendJson: function( f ) {

		var params = "";
		params = { action: 'recordModify',
					table_name: f.table_name.value,
					memberid: f.memberid.value,
					pwd1: f.pwd1.value,
					pwd2: f.pwd2.value,
					name: f.name.value,
					email: f.email.value+"@"+this.getEmailVal("email_tail"),
					hp1: f.hp1.value,
					hp2: f.hp2.value,
					hp3: f.hp3.value,
					tel1: f.tel1.value,
					tel2: f.tel2.value,
					tel3: f.tel3.value,
					company: f.company.value,
					job: f.job.value,
					hobby: this.getCheckboxVal("hobby") };

		jsux.getJSON("member.php", params, function( e ) {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL('../login/login.php?action=logpass');
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
			jsux.goURL( '../login/login.php?action=login' );
		});

		$("input[name=pwd2]").on("blur", function() {
			self.checkPWD();
		});	

		$("input[name=checkCorpName]").on("click",function(e) {
			self.checkCorpName();
		});

		$("select[name=email_tail1]").on("change", function() {
			$("input[name=email_tail2").val("");
		});
	},
	setLayout: function() {

		var params = {
			table_name: $("input[name=table_name]").val(),
			memberid:  $("input[name=memberid]").val()
		};

		jsux.getJSON("member.php?action=memberField", params, function( e ) {

			var formLists = null,
				checkedVal = "",
				markup = null,
				labelList = null,
				data = e.data;

			if (data) {

				formLists = $("input[type=text]");
				$(formLists).each(function(index) {

					if (data[this.name]) {
						this.value = data[this.name];
					}
				});

				formLists = $("select");
				$(formLists).each(function(index) {

					if (data[this.name]) {
						this.value = data[this.name];
					}						
				});

				if (data.hobby) {

					formLists = $("input[type=checkbox]");
					checkedVal = data.hobby.split(",");
					$(formLists).each(function(index){

						var self = this;
						$(checkedVal).each(function(sIndex){
							if (checkedVal[sIndex]) {
								if( self.value === checkedVal[sIndex]) {
									self.checked = true;
								}
							}
						});
					});
				}

				labelList = $("table tr").find(".view-type-textfield");

				markup = $("#memberLabel_tmpl");
				$(labelList).each(function(index) {

					var label = "",
						data = "";

					label = $(labelList[index]).attr("id");						
					data = {label: data[label]};

					$("#"+label).empty();
					$(markup).tmpl( data ).appendTo($("#"+label));
				});
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