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
	setUI: function() {

		var self = this,
			markup = '',
			menu = null,
			subMenu = null;

		this._path = jsux.mobileGnb.Menu.path;
		this._m = jsux.mobileGnb.Menu.m;
		markup = $('#suxMobileGnbFirstMenu').html();
		$('.menu-panel > ul').empty();

		$(this._data).each( function( index ){
			$('.menu-panel > ul').append( markup );
			menu = $('.menu-panel > ul > li:eq('+index+')');
			menu.attr('data-code', index);
			menu.find(' > a').attr('href', self._data[index].link);
			menu.find(' > a > span').append(self._data[index].label);
			
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
						subMenu.find(' > a > span').append(self._data[index].sub[subIndex].label);
					}						
				});
			}
			
		});		
	},
	setEvent: function() {

		var self = this;

		$('.mobile-menu .mobile-btn').on('click', function(e) {			
			e.preventDefault();
			$('.ui-bg-cover').show();
			$('.mobile-gnb-case').show();
			self._isClick = true;
		});

		$('.mobile-gnb-case').on('click', function(e) {
			e.preventDefault();
			var url = $(e.target).parent().attr('href');

			if ($(e.target).attr('class') === 'mobile-gnb-case') {
				$('.ui-bg-cover').hide();
				$('.mobile-gnb-case').hide();
			} else if (!(url === '#none' || url === '' || url === undefined)){				
				jsux.goURL(url);
			}
			self._isClick = false;		
		});

		$(window).on('resize', function(e){

			//trace( self._isClick, 1);
			var tw = e.target.outerWidth;
			if (tw < 480 && self._isClick === true) {
				$('.ui-bg-cover').show();
				$('.mobile-gnb-case').show();
			} else if (tw > 479) {
				$('.ui-bg-cover').hide();
				$('.mobile-gnb-case').hide();				
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