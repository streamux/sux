jsux.adminGnb = jsux.adminGnb || {};
jsux.adminGnb.Icon = jsux.View.create();
(function( app ){

	var GNB_ICON;

	function trace( str ) {

		console.log( str );
	}

	function warn( str ) {

		trace('warn : ' + str);
	}

	GNB_ICON = function( p, m ) {

		var _scope		= this,
			_stage		= $(p),			
			_data		= null,
			_list		= [],
			_sizeList 	= [],
			_m 			= m,
			_mid 			= -1,
			_oldMid		= -1,
			_activateMid	= -1,
			_timer			= -1;

		this.update = function( o, value ) {

			_data = value;
			this.setUI();				
		};

		this.setUI = function() {

			_stage.append('<ul></ul>');

			$( _data ).each(function(mindex) {

				_stage.find('ul').append(	'<li>' +
												'<div class="g-arrow"></div>'+
												'<div class="g-icon"></div>'+
											'</li>');
			});
			
			_sizeList = _m.getSizeList();
			this.alignUI();
		};

		this.alignUI = function() {

			_list = _stage.find('ul > li');

			$( _list ).each(function(mindex) {
				$( this ).css({'width': _sizeList[mindex]+'%'});
				$( this ).find('.g-icon').css({'background-position':'50% '+(-mindex*75)+'px'});
			});
		};	

		this.mouseHandler = function(e, obj) {
			
			var type 		= e.type,

				menu 		= null,
				submenu	= null,
				panel 		= null,
				ty 			= 0;

			_mid 	= obj.mid;		

			switch(type) {

				case 'mouseover' :	

					panel = $(_list[_mid]).find('.g-arrow');
					_scope.tween( panel, 10, {'top': 0, ease: Linear.easeOutQuad, useFrames: true, onComplete: function() {
							//trace( 'hide' );
						}});

					if (_oldMid > -1 && _oldMid != _mid) {
						panel = $(_list[_oldMid]).find('.g-arrow');
						_scope.tween( panel, 10, {'top': -80, ease: Linear.easeOutQuad, useFrames: true, onComplete: function() {
							//trace( 'hide' );
						}});
					}
					break;

				case 'mouseout':

					var id = (_activateMid) ? _activateMid : _mid;

					panel = $(_list[_oldMid]).find('.g-arrow');
					_scope.tween( panel, 10, {'top': -80, ease: Linear.easeOutQuad, useFrames: true, onComplete: function() {
							//trace( 'hide' );
						}});
					break;

				default:
					break;
			}

			_oldMid  = _mid;
		};

		this.activate = function(m, s) {

			_activateMid 	= parseInt(m, 10);

			if (_activateMid <=0 && _activateMid > _data.length) {
				warn('It not a Avaliable Depth1\'s Number!');
				return;
			} 
			_activateMid	= _activateMid - 1;
			this.menuOn(_activateMid);
		};

		this.unactivate = function() {

			this.menuOff();
		};

		this.menuOn = function(m) {

			_scope.mouseHandler({type:'mouseover'}, {mid: m});
		};

		this.menuOff = function() {

			_scope.mouseHandler({type:'mouseout'},{mid:_mid});
		};

		this.tween = function( target, time, obj) {

			TweenLite.to( target, time, obj);
		};
	};

	app.create = function( path, m ) {

		if ($(path).length<1) {
			$( document.body ).append('<div id="TEMP_GNB_ICON" class="gnb-icon"></div>');
			path = '#TEMP_GNB_ICON';
		}
		return new GNB_ICON(path, m);
	};
})(jsux.adminGnb.Icon, jQuery);