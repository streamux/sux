jsux.mobileGnb = jsux.mobileGnb || {};
jsux.mobileGnb.Menu = jsux.View.create();
jsux.mobileGnb.Menu.include({

	_path: '',
	_m: '',
	_isClick: false,
	_data: null,

	update: function(o, value) {

		this._data = value;
		this.setUI();
		this.setEvent();
	},
	setUI: function() {var self = this, markup = '',
			menu = null,
			subMenu = null;

		this._path = jsux.mobileGnb.Menu.path;
		this._m = jsux.mobileGnb.Menu.m;
		markup = $('#suxMobileGnbFirstMenu').html();
		var menu_stage = $(this._path).empty();

		$(this._data).each( function( index ){

			menu_stage.append( markup );
			menu = menu_stage.find('> li:eq('+index+')');
			menu.attr('data-code', index);
			menu.find(' > a').attr('href', self._data[index].link);
			menu.find(' > a').append(self._data[index].label);
			
			if (self._data[index].sub.length > 0) {				
				markup = $('#suxMobileGnbSecondMenuCase').html();
				menu.append( markup );
				menu.find('.second-menu > ul').empty();

				$(self._data[index].sub).each( function( subIndex){			

					if (self._data[index].sub[subIndex].label) {
						markup = $('#suxMobileGnbSecondMenu').html();
						menu.find('.second-menu > ul').append( markup );

						subMenu = menu.find('.second-menu > ul > li:eq('+subIndex+')');
						subMenu.attr('data-code', index);
						subMenu.attr('data-sub-code', subIndex);
						subMenu.find(' > a').attr('href', self._data[index].sub[subIndex].link);
						subMenu.find(' > a').append(self._data[index].sub[subIndex].label);
					}						
				});
			}
			
		});		
	},
	setEvent: function() {

		var self = this,
			mobileGnbHandler = null;

		mobileGnbHandler = {

			show: function() {

				$('.ui-bg-cover').removeClass('ui-bg-cover-off');
				$('.ui-bg-cover').addClass('ui-bg-cover-on');
				$('.mobile-gnb-case').removeClass('mobile-gnb-case-off');	
				$('.mobile-gnb-case').addClass('mobile-gnb-case-on');
			},
			hide: function() {

				$('.ui-bg-cover').removeClass('ui-bg-cover-on');
				$('.ui-bg-cover').addClass('ui-bg-cover-off');
				$('.mobile-gnb-case').removeClass('mobile-gnb-case-on');
				$('.mobile-gnb-case').addClass('mobile-gnb-case-off');
			},
			click: function( url ) {

				if (!(url === '#none' || url === '' || url === undefined)){
					jsux.goURL(url);
				}				
			}
		};

		$('.mobile-menu .mobile-btn').on('click', function(e) {
			e.preventDefault();
			mobileGnbHandler.show();
			self._isClick = true;
		});

		$('.mobile-gnb-case').on('click', function(e) {

			var url = $(e.target).attr('href');
			e.preventDefault();			
			mobileGnbHandler.click(url);
			self._isClick = false;		
		});

		$('.ui-bg-cover').on('click', function(e) {
			e.preventDefault();
			mobileGnbHandler.hide();
			self._isClick = false;	
		});

		$(window).on('resize', function(e){

			//trace( self._isClick, 1);
			var tw = e.target.outerWidth;
			if (tw < 480 && self._isClick === true) {
				mobileGnbHandler.show();
			} else if (tw > 479) {
				mobileGnbHandler.hide();
			}
		});
	},
	menuOn: function() {

	},
	menuOff: function() {

	}
});

jsux.mobileGnb.Menu.extend({

	create: function( path, m) {

		if ($(path).length<1) {

			var markup = '<div id="mobileGnb" class="body-panel"><div class="menu-panel"><ul></ul></div></div>';
			$( document.body ).append( markup );
			this.path = '#mobileGnb';
		} else {
			this.path = path;			
		}
		this.m = m;

		return new jsux.mobileGnb.Menu();
	}
});