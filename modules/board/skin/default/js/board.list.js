jsux.fn = jsux.fn || {};
jsux.fn.boardList = jsux.fn.boardList || {};
jsux.fn.boardList = {

	checkSearchForm: function(f) {

		var search = f.search.value.length;
		if ( search < 1 ) {
			alert("검색어를 입력하세요.");
			f.search.focus();
			return (false);
		}
		return (true);
	},
	init: function() {
		
	}
};
