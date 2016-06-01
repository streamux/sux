
(function( app, $ ) {

	var IndicatorView;

	function trace( str ) {

		console.log( str );
	}

	IndicatorView = function(p, m, c) {

		var _scope		= this,
			_stage		= $( p ),			
			_m			= m,
			_c 			= c,
			_data		= null,

			_selectId 	= 1,
			_oldId		= -1;

		this.setData = function( value ) {

			_data = value;

			this.setUI();
			this.setEvent();
		};

		this.setUI = function() {

			$( _data ).each(function(index) {
				_stage.append("<li data-target=\"#myVisual\" data-slide-to=\""+(index+1)+"\"></li> ");
			});
		};

		this.setEvent = function() {

			$( _stage ).find("li").on("click",function( e ){
				
				_scope.mouseHandler(e, this);
			});


			$( _stage ).on("mouseover", function( e ) {

				_c.setRolling( false );
				e.preventDefault();
			});
			$( _stage ).on("mouseout", function( e ) {

				_c.setRolling( true );
				e.preventDefault();
			});
		};

		this.mouseHandler = function( e, o ) {

			var id 		= $( o ).data("slide-to"),
				type	= e.type;
			
			switch ( type ) {
				
				case "click":
					_m.activate( id );
					break;

				default:
					break;
			}
		};

		this.indicatorOn = function( id ) {
			
			$( _stage ).find("li:eq(\""+id+"\")").addClass("active");

			if (_oldId > -1 && _oldId != id) {
				this.indicatorOff(_oldId);
			}

			_oldId = _selectId =id;	
		};

		this.indicatorOff = function( id ) {

			$( _stage ).find("li:eq(\""+id+"\")").removeClass("active");
		};

		this.activate = function( id ) {

			var num	= parseInt( id );

			id = (num > 0) ? num - 1 : num;
			this.indicatorOn( id );
		};

		this.tick = function() {

			_selectId += 1;
			_selectId = _selectId%_data.length;

			this.indicatorOn( _selectId );
		};
	};

	app.createIndicatorView = function( path, m, c ) {

		if ($(path).length < 1) {
			$( document.body ).append("<ol id=\"TEMP_Indicator\ class=\"Indicator\"></ol>");
			path = "#TEMP_Indicator";
		}

		return new IndicatorView(path, m, c);
	};
})(jsuxApp, jQuery);