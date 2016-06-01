
(function( app, $){

	var InnerView;

	function trace( str ) {

		console.log( str );
	}

	InnerView = function(p, m, c ) {

		var _scope 		= this,
			_stage 		= $(p),
			_m 			= m,
			_c 			= c,

			_data 		= null,
			_currentId 	= 0,
			_selectId 	= 0,
			_list 		= null,
			_aniList 	= [];


		this.setData = function( value ) {

			_data = value;

			this.setUI();
			this.setEvent();
		};

		this.setUI = function() {

			_aniList = [];

			_list = _stage.find(".item");

			$(_list).each(function(index) {
				_aniList.push(this);
			});
		};

		this.setEvent = function() {

			$( _stage ).on("mouseover", function( e ) {

				_c.setRolling( false );
				e.preventDefault();
			});

			$( _stage ).on("mouseout", function( e ) {

				_c.setRolling( true );
				e.preventDefault();
			});
		};

		this.moveNext = function() {

			var item = _aniList.shift();
			_aniList.push( item );
		};

		this.movePrev = function() {

			var item = _aniList.pop();
			_aniList.unshift( item );
		};

		this.animateItem = function( gab ) {

			var tx = 0;

			if (gab > 0) {
				tx  = -100;
			}
			if (gab < 0) {

				tx  = 100;
			}

			$(_aniList).each(function(index) {

				var key = parseInt($(this).data("key"))-1;

				if (key == _selectId) {
					_scope.tween( _aniList[index], 24, {"left": "0%", ease: Linear.easeInOut, useFrames: true});
				} else if (key == _currentId) {
					_scope.tween( _aniList[index], 24, {"left": tx+"%", ease: Linear.easeInOut, useFrames: true});
				} 				
			});
		};

		this.tween = function( target, time, obj) {

			TweenLite.to( target, time, obj);
		};

		this.nextRolling = function() {

			var gab = 1;

			_selectId += 1;

			_selectId = _selectId%_aniList.length;

			this.swapItem( gab );
			this.animateItem( gab );

			_currentId = _selectId;
		};

		this.activate = function( id ) {

			var gab;

			_selectId = parseInt( id ) - 1;
			gab	 =  _selectId - _currentId;

			this.swapItem( gab );
			this.animateItem( gab );

			_currentId = _selectId;
		};

		this.swapItem = function( gab ) {

			var len = Math.abs( gab );		

			for (i=0; i<len; i++) {

				if (gab > 0) { 	// next
					this.moveNext();
				}

				if (gab < 0) { 	// prev
					this.movePrev();
				}
			}

			$(_aniList).each(function(index) {

				var key = parseInt($(this).data("key"))-1;

				if (key == _selectId) {

					if (gab > 0) { 
						$(this).css({"left": "100%","z-index": "101"});
					} else if (gab < 0) {
						$(this).css({"left": "-100%","z-index": "101"});
					} else {
						$(this).css({"left": "0%","z-index": "101"});
					}		
				} else if (key == _currentId) {
					$(this).css({"left": "0%","z-index": "100"});
				} else {
					$(this).css({"z-index": "0"});
				}
			});
		};

		this.tick = function() {

			this.nextRolling();
		};
	};

	app.createInnerView = function(path, m, c) {

		if ($(path).length > 0) {
			$( document.body ).append("<div id=\"inner\" class=\"inner\"></div>");
			path = "#inner";
		}

		return new InnerView( path, m, c);
	};

})( jsuxApp, jQuery);
