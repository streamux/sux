jsux.mobileGnb = jsux.mobileGnb || {};
jsux.mobileGnb.Menu = jsux.View.create();
jsux.mobileGnb.Menu.include({

	_path: '',
	_m: '',
	_isClick: false,
	_data: null,
	_startPosX: 0,

	update: function(o, value) {

		this._data = value;
		this.setUI();
		this.setEvent();
	},
	tween: function( target, time, op ) {
		TweenMax.to(target, time, op);
	},
	killTween: function( target ) {
		TweenMax.killTweensOf( target );
	},
	showCloseX: function() {

		this.killTween('.menu-btn-close .ui-h-3stick');
		this.tween('.menu-btn-close .ui-h-3stick', 13, {opacity:1, ease: Expo.easeOut, useFrames:true});
		this.tween('.menu-btn-close .ui-h-3stick', 82, {rotation:450, useFrames:true});
	},
	hideCloseX: function() {

		var self = this;
		this.killTween('.menu-btn-close .ui-h-3stick');
		this.tween('.menu-btn-close .ui-h-3stick', 17, {opacity:0, rotation:0, useFrames:true, onComplete: $.proxy(self.showMobileMenu, self)});
	},
	showMobileMenu: function() {

		var self = this;

		this.killTween('.mobile-menu-btn .ui-h-3stick');
		$('.mobile-menu-btn .ui-h-3stick').find('> div').each(function(index) {
			self.tween(this, 21, {opacity:1, useFrames:true});
		});

		this.tween('.mobile-menu-btn .ui-h-3stick .hline1', 21, {y:0, useFrames:true});
		this.tween('.mobile-menu-btn .ui-h-3stick .hline3', 21, {y:0, useFrames:true});	
	},
	hideMobileMenu: function() {

		var self = this;

		this.killTween('.mobile-menu-btn .ui-h-3stick');
		$('.mobile-menu-btn .ui-h-3stick').find('> div').each(function(index) {
			self.tween(this, 21, {opacity:0, useFrames:true});
		});
	},	
	openSlide: function() {

		self = this;
		$('.mobile-gnb-case').css({'transform':'translateX('+this._startPosX+'px)'});

		this.killTween('.mobile-gnb-case');
		this.killTween('.mobile-menu-btn .ui-h-3stick .hline1');
		this.killTween('.mobile-menu-btn .ui-h-3stick .hline3');
		this.tween('.mobile-gnb-case', 17, {x:42, useFrames:true,onComplete: $.proxy(self.showCloseX, self)});
		this.tween('.mobile-menu-btn .ui-h-3stick .hline1', 12, {y:6, useFrames:true});
		this.tween('.mobile-menu-btn .ui-h-3stick .hline3', 12, {y:-6, useFrames:true});
	},
	closeSlide: function() {

		var self = this;

		this.killTween('.mobile-gnb-case');
		this.killTween('.mobile-menu-btn .ui-h-3stick .hline1');
		this.killTween('.mobile-menu-btn .ui-h-3stick .hline3');
		this.tween('.mobile-gnb-case', 17, {x:this._startPosX, useFrames:true, onComplete: $.proxy(self.hide, self)});		

		this.hideCloseX();	
	},
	show: function() {

		$('.ui-bg-cover').removeClass('ui-bg-cover-off');
		$('.ui-bg-cover').addClass('ui-bg-cover-on');
		$('.mobile-gnb-case').removeClass('mobile-gnb-case-off');	
		$('.mobile-gnb-case').addClass('mobile-gnb-case-on');
		$('html').addClass('hide-scroll');
		$('.wrapper').addClass('wrapper-reposition');
	},
	hide: function() {	

		$('.ui-bg-cover').removeClass('ui-bg-cover-on');
		$('.ui-bg-cover').addClass('ui-bg-cover-off');
		$('.mobile-gnb-case').removeClass('mobile-gnb-case-on');
		$('.mobile-gnb-case').addClass('mobile-gnb-case-off');
		$('html').removeClass('hide-scroll');
		$('.wrapper').removeClass('wrapper-reposition');
	},
	showSitemap: function() {

		$('.mobile-menu-btn .ui-h-3stick').trigger('click');
	},
	click: function( url, target) {

		//console.log( 'url : %s / target : %s', url, target);
		if (!(url === '#none' || url === '' || url === undefined)){
			jsux.goURL(url, target);
		}
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
			
			if (self._data[index].menu !== undefined && self._data[index].menu.length > 0) {				
				markup = $('#suxMobileGnbSecondMenuCase').html();
				menu.append( markup );
				menu.find('.second-menu > ul').empty();

				$(self._data[index].menu).each( function( subIndex){			

					if (self._data[index].menu[subIndex].label) {
						markup = $('#suxMobileGnbSecondMenu').html();
						menu.find('.second-menu > ul').append( markup );

						subMenu = menu.find('.second-menu > ul > li:eq('+subIndex+')');
						subMenu.attr('data-code', index);
						subMenu.attr('data-sub-code', subIndex);
						subMenu.find(' > a').attr('href', self._data[index].menu[subIndex].link);
						subMenu.find(' > a').append(self._data[index].menu[subIndex].label);
					}						
				});
			}			
		});		
	},
	setEvent: function() {

		var self = this;

		$('.mobile-menu-btn .ui-h-3stick').on('click', function(e) {
			e.preventDefault();
			self.show();
			self.openSlide();
			self.hideMobileMenu();
			self._isClick = true;
		});

		$('.mobile-gnb-case').on('click', function(e) {
			e.preventDefault();

			var url = $(e.target).attr('href'),
				target = $(e.target).attr('target');

			if (!url) {
				 url = $(e.target).parent().attr('href');
				 target = $(e.target).parent().attr('target');
			}

			if (url) {			
				self.click(url, target);
			}			
		});

		$('.mobile-gnb-case .menu-btn-close').on('click', function(e) {
			e.preventDefault();
			self.closeSlide();
			self._isClick = false;	
		});
		
		$('.ui-bg-cover').on('click', function(e) {
			e.preventDefault();
			self.closeSlide();
			self._isClick = false;	
		});

		$(window).on('resize', function(e){

			//trace( self._isClick, 1);
			var tw = e.target.outerWidth;
			if (tw < 769 && self._isClick === true) {
				self.show();
			} else if (tw > 768) {
				self.hide();
			}			
		});
		self._startPosX  = $(window).outerWidth();
		this.tween('.mobile-gnb-case', 1, {x:this._startPosX, useFrames:true});
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