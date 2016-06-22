jsux.fn = {

	checkLang: function( value ) {

		var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

		return reg.test( value );
	},
	checkFormVal: function( f ) {

		var groupName = f.table_name.value.length;

		if ( groupName < 1 ) {
			trace("그룹 이름을 입력 하세요.");
			f.table_name.focus();
			return (false);
		}

		return (true);
	},
	sendAndLoad: function() {

		var param = {
			table_name: $("input[name=table_name]").val()
		};

		jsux.getJSON("member.groupadd.insert.php", param, function( e )  {

			trace( e.msg );

			if (e.result == "Y") {
				jsux.goURL(menuList[0].sub[0].link);
			}
		});
	},
	setEvent: function() {

		var self = this;

		$("form").on("submit", function( e ) {

			e.preventDefault();

			var bool  = self.checkFormVal( e.target );
			
			if (bool === true) {

				if ( self.checkLang( e.target.table_name.value)) {
					trace("회원그룹명에 한글이 포함되어 있습니다.");						
				} else {
					self.sendAndLoad();
				}
			}				
		});			

		$("input[name=cancel]").on("click", function(e) {

			jsux.goURL(menuList[0].sub[0].link);
		});
	},
	init: function() {

		this.setEvent();
	}
};