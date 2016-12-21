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
			list = $('input:checkbox[name^='+id+']:checked'),
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

		var labelList = ['아이디','비밀번호','비밀번호 확인','이름','닉네임','e-mail','핸드폰 앞자리','핸드폰 가운데 자리', '핸드폰 뒷자리'];
		var checkList = ['user_id','password','passwordConf','user_name','nick_name','email_address','hp1','hp2','hp3'];
		var email = f.email_address.value.length + this.getEmailVal('email_tail');
		var result = true;

		$.each( checkList, function( index, item) {

			var $input = f[item];
			if ($input.value.length < 1) {
				trace(labelList[index] + '을(를) 입력 하세요.');
				$input.focus();
				result = false;
				return false;
			}
		});

		return result;	
	},
	sendJson: function( f ) {

		var self = this;
		var params = {};
		var datas = $('form')[0];
		var indexCheckbox = 0;
		var url = '';

		$.each(datas, function( index, item ) {

			var filters = 'checkbox|button|submit';
			var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName;
			var glue ='';

			if (item.nodeName.toLowerCase() === 'select') {
				item.value = self.getSelectVal(item.name);
				params[item.name] = item.value;
			} else {

				 if (!type.match(filters)) {
					//console.log(item.name + ' : ' + item.value);					
					params[item.name] = item.value;
				}
			}

			if (type === 'checkbox' && item.checked) {
				if (indexCheckbox === 0) {
					var name = item.name.substr(0, item.name.length-1);
					params[item.name] = self.getCheckboxVal(name);
				} 
				indexCheckbox++;					
			}
		});

		/*$.each(params, function( index, item ) {
			console.log(index + ' : ' + item);
		});*/

		if (!f.action) {
			alert('Not Exists URL');
		}
		url = f.action;

		jsux.getJSON( url, params, function( e ) {

			trace( e.msg );			
			if (e.result == 'Y') {
				jsux.goURL( jsux.rootPath + 'login');
			}
		});
	},
	checkPWD: function() {

		if ($('input[name=passowrd]').val() != $('input[name=passowrdConf]').val()) {

			trace('비밀번호가 일치하지 않습니다.');

			$('input[name=passowrd]').val('');
			$('input[name=passowrdConf]').val('');
			$('input[name=passowrd]').focus();

			return(false);
		}
	},		
	checkID: function() {

		var	params =  {
			_method: 'insert',
			category: this.getSelectVal('category'),
			user_id: $('input[name=user_id]').val()
		};

		if (params.user_id === '') {
			trace('아이디를 입력해주세요');
			$('input[name=memberid]').focus();
			return;
		}

		jsux.getJSON( jsux.rootPath + 'check-id', params, function( e ) {
			trace( e.msg );
		});
	},
	setEvent: function() {

		var self = this;
		$('form').on('submit', function( e ) {
			e.preventDefault();

			var bool  = self.checkFormVal( this);
			if (bool === true) {
				self.sendJson( e.target );
			}
		});
		$('input[name=cancel]').on('click', function(e) {
			jsux.goURL( jsux.rootPath + 'login' );
		});

		$('input[name=passowrdConf]').on('blur', function() {
			self.checkPWD();
		});	
		$('input[name=checkID]').on('click',function(e) {
			self.checkID();
		});
		$('input[name=checkCorpName]').on('click',function(e) {
			self.checkCorpName();
		});
		$('select[name=email_tail1]').on('change', function() {

			if ($(this).val() === '직접입력') {
				$('input[name=email_tail2').show();
			} else {
				$('input[name=email_tail2').val('').hide();
			}			
		});	
	},
	setLayout: function() {

		jsux.setAutoFocus();
	},
	init: function() {

		this.setEvent();
		this.setLayout();
	}
};

jsux.fn = jsux.fn || {};
jsux.fn.modify = {

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
			list = $('input:checkbox[name^='+id+']:checked'),
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
	checkPWD: function() {

		if ($('input[name=password]').val() != $('input[name=passwordConf]').val()) {

			trace('비밀번호가 일치하지 않습니다.');

			$('input[name=password]').val('');
			$('input[name=passwordConf]').val('');
			$('input[name=password]').focus();

			return(false);
		}
	},
	checkFormVal: function( f ) {

		var labelList = ['아이디','비밀번호','비밀번호 확인','이름','닉네임','e-mail','핸드폰 앞자리','핸드폰 가운데 자리', '핸드폰 뒷자리'];
		var checkList = ['user_id','password','passwordConf','user_name','email_address','hp1','hp2','hp3'];
		var email = f.email.value.length + this.getEmailVal('email_tail');
		var result = true;

		$.each( checkList, function( index, item) {

			var $input = f[item];
			if ($input.value.length < 1) {
				trace(labelList[index] + '을(를) 입력 하세요.');
				$input.focus();
				result = false;
				return false;
			}
		});

		return result;	
	},
	sendJson: function( f ) {

		var self = this;
		var params = {};
		var datas = $('form')[0];
		var indexCheckbox = 0;

		$.each(datas, function( index, item ) {

			var filters = 'checkbox|button|submit';
			var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName;
			var glue ='';

			if (item.nodeName.toLowerCase() === 'select') {
				item.value = self.getSelectVal(item.name);
				params[item.name] = item.value;
			} else {

				 if (!type.match(filters)) {
					//console.log(item.name + ' : ' + item.value);					
					params[item.name] = item.value;
				}
			}

			if (type === 'checkbox' && item.checked) {
				if (indexCheckbox === 0) {
					var name = item.name.substr(0, item.name.length-1);
					params[name] = self.getCheckboxVal(name);
				} 
				indexCheckbox++;					
			}
		});

		/*$.each(params, function( index, item ) {
			console.log(index + ' : ' + item);
		});*/

		if (!f.action) {
			alert('Not Exists URL');
		}
		url = f.action;

		var updateLoginHandler = function( url ) {

			var params = {_method:'insert'};
			jsux.getJSON( url, params, function(e) {

				if  (e.result.toLowerCase() == 'y') {
					jsux.goURL( jsux.rootPath + 'login');
				}
			});
		};

		jsux.getJSON( url, params, function( e ) {

			trace( e.msg );
			if (e.result.toLowerCase() == 'y') {
				updateLoginHandler( jsux.rootPath + 'login');
			}
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
			jsux.goURL( jsux.rootPath + 'login' );
		});

		$('input[name=password]').on('blur', function() {
			self.checkPWD();
		});	

		$('select[name=email_tail1]').on('change', function() {

			if ($(this).val() === '직접입력') {
				$('input[name=email_tail2').show();
			} else {
				$('input[name=email_tail2').val('').hide();
			}
		});
	},
	setLayout: function() {

		jsux.setAutoFocus();
	},		
	init: function() {

		this.setLayout();
		this.setEvent();
	}
};
