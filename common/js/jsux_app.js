jsux.gnb = jsux.gnb || {};
jsux.gnb.Menu = jsux.View.create();
(function( app, $ ){

	var GNB = function( p, m ) {

		var _scope	= this,
			_stage	= $(p),			
			_data	= null,
			_list	= [],
			_m 		= m,

			_mid 			= -1,
			_sid 			= -1,
			_oldMid		= -1,
			_oldSid			= -1,
			_activateMid	= -1,
			_activateSid		= -1,
			_timer			= -1;

		this.update = function( o,  value ) {

			_data = value;
			this.setUI();				
			this.setEvent();
		};

		this.setUI = function() {

			var ty = 0;

			$( _data ).each(function(mindex) {

				ty = -1*_data[mindex].sub.length * (34+1);

				_stage.append('<ul class="mmenu">'+
									'<li data-mid="' + mindex + '" data-sid="-1">' +
										'<a href="#none"><span>'+_data[mindex].label+'</span></a>'+
										'<div class="sub">'+
											'<ul class="panel" style="top:'+ ty +'px"data-startPosY="'+ ty +'px"></ul>'+
										'</div>'+
									'</li>'+
								'</ul>');
			});

			this.alignUI();

			$( _data ).each(function(mindex) {

				$( _data[mindex].sub ).each(function(sindex) {

					_stage.find('.mmenu:eq('+mindex+') .sub > ul').append(
						'<li class="smenu" data-mid="' + mindex + '" data-sid="' + sindex + '">'+
							'<a href="#none"><span>'+_data[mindex].sub[sindex].label+'</span></a>'+
						'</li>');
				});
			});
		};

		this.alignUI = function() {

			var max_width 		= _stage.width(),
				max_txtWidth	= 0,
				spaceWidth		= 0,
				wdRate			= 0,
				wd 				= 0,
				wd_lastChild 	= 0,
				sizeList			= [];

			_list = _stage.find(".mmenu");

			$( _list ).each(function(mindex){
				max_txtWidth += $(this).find("li > a > span").width();
			});

			spaceWidth = Math.floor((max_width - max_txtWidth)/_data.length);

			$( _list ).each(function(mindex) {

				wdRate = Math.floor((100-0)/(max_width - 0)*(($(this).find("li > a > span").width()+spaceWidth) - 0) + 0);	

				// 마지막은 항상 나머지 비율로 100%를 채운다.
				if (mindex == _list.length-1) {
					wdRate = 100-wd;
				}
				wd += wdRate;				
				$( this ).css("width", wdRate+"%");

				sizeList.push(wdRate);	
			});

			_m.setSizeList( sizeList );
		};

		this.setEvent = function() {

			_stage.find('.mmenu > li > a').on('mouseover', function(e){

				e.preventDefault();
				_scope.stopTimer();
				_m.menuOn( $( this ).parent().attr('data-mid'), -1 );	
			});

			_stage.find('.mmenu > li > a').on('mouseout', function(e){

				e.preventDefault();
				_scope.startTimer();
				
			});

			_stage.find('.mmenu > li > a').on('click', function(e){

				e.preventDefault();

				var url = _data[$( this ).parent().attr('data-mid')].link;
				if (url === '') {
					return;
				}

				jsux.goURL( url, '_self' );	
			});

			_stage.find('.smenu > a').on('mouseover', function(e){

				e.preventDefault();
				_scope.stopTimer();
				_m.menuOn( $( this ).parent().attr('data-mid'), $( this ).parent().attr('data-sid') );
				
			});

			_stage.find('.smenu > a').on('mouseout', function(e){

				e.preventDefault();
				_scope.startTimer();				
			});

			_stage.find('.smenu > a').on('click', function(e){

				e.preventDefault();

				var url = _data[$( this ).parent().attr('data-mid')].sub[$( this ).parent().attr('data-sid')].link;
				jsux.goURL( url, '_self' );				
			});
		};

		this.mouseHandler = function(e, obj) {
			
			var type 		= e.type,

				menu 		= null,
				submenu	= null,
				mask 		= null,
				panel 		= null,
				ty 			= 0,
				th 			= 0,
				oldMask 	= null,
				oldPanel 	= null,
				oldth 		= 0,
				oldty  		= 0;

			_mid 	= obj.mid;
			_sid 	= obj.sid;

			switch(type) {

				case 'mouseover' :					

					if (_mid > -1) menu 	= _list.eq(_mid);
					if (_sid > -1) submenu 	= menu.find('.sub .smenu').eq(_sid);

					if (menu && !menu.hasClass('activate')) {

						mask 	= menu.find('.sub');
						panel	= menu.find('.sub .panel');
						ty 		= 0;
						th 		= _list.eq(_mid).find('.sub .panel').attr('data-startPosY').replace(/[^(0-9)]/gi, '');

						menu.addClass('activate');
						_scope.tween( panel, 10, {'top': ty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {

							var mh = th - panel.css('top').replace(/[^(0-9)]/gi, '');
							mask.css('height', mh);
						}});
					}
					
					if (submenu && !submenu.hasClass('activate')) {
						submenu.addClass('activate');
					}

					if (_oldMid != _mid && _oldMid > -1) {

						oldMask 	= _list.eq(_oldMid).find('.sub');
						oldPanel	= _list.eq(_oldMid).find('.sub .panel');
						oldty 		= _list.eq(_oldMid).find('.sub .panel').attr('data-startPosY');
						oldth 		= _list.eq(_oldMid).find('.sub .panel').attr('data-startPosY').replace(/[^(0-9)]/gi, '');

						_list.eq(_oldMid).removeClass('activate');
						_scope.tween( oldPanel, 10, {'top': oldty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {
							
							var mh = oldth - oldPanel.css('top').replace(/[^(0-9)]/gi, '');
							oldMask.css('height', mh);
						}});
					}

					if (_oldSid != _sid && _oldSid > -1) {
						_list.eq(_oldMid).find('.sub .smenu').eq(_oldSid).removeClass('activate');
					}					

					_oldMid	= _mid;
					_oldSid		= _sid;
					break;

				case 'mouseout':

					if (_mid > -1) menu 	= _list.eq(_mid);
					if (_sid > -1) submenu 	= menu.find('.sub .smenu').eq(_sid);

					if (menu && menu.hasClass('activate')) {

						panel 	= menu.find('.sub .panel');
						ty 		= menu.find('.sub .panel').attr('data-startPosY');
						oldth	= _list.eq(_mid).find('.sub .panel').attr('data-startPosY').replace(/[^(0-9)]/gi, '');

						menu.removeClass('activate');
						_scope.tween( panel, 10, {'top': ty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {
						
							var mh = oldth - $( panel ).css('top').replace(/[^(0-9)]/gi, '');
							menu.find('.sub').css('height', mh);
						}});
					}

					if (submenu && submenu.hasClass('activate')) {
						submenu.removeClass('activate');
					}
					break;

				default:
					break;
			}
		};

		this.activate = function(m, s) {

			_activateMid 	= parseInt(m, 10);
			_activateSid 	= parseInt(s, 10);

			if (_activateMid <=0 && _activateMid > _data.length) {
				warn('It not a Avaliable Depth1\'s Number!');
				return;
			} 

			if (_activateSid <= 0 && _activateSid > _data[mid].sub.length) {
				warn('It not a Avaliable Depth2\'s Number!');
				return;
			}

			_activateMid	= _activateMid - 1;
			_activateSid		=  _activateSid - 1;

			this.menuOn( _activateMid, _activateSid);
		};

		this.menuOn = function(m, s) {

			_scope.mouseHandler({type:'mouseover'}, {mid: m, sid: s});
		};

		this.menuOff = function() {

			_scope.mouseHandler({type:'mouseout'}, {mid: _mid, sid: _sid});
		};

		this.tween = function( target, time, obj) {

			TweenLite.to( target, time, obj);
		};

		this.startTimer = function() {

			if (_timer == -1) {
				_timer = setInterval(function(){

					if (_activateMid > -1) {
						_m.menuOn(_activateMid, _activateSid);
					} else {
						_m.menuOff();
					}
					_scope.stopTimer();

				}, 500);
			}
		};

		this.stopTimer = function() {

			if (_timer) {
				clearInterval(_timer);
				_timer = -1;
			}
		};

		this.replaceNumber = function( str ) {

			return str.replace(/[^(0-9)]/gi, '');
		};
	};

	app.create = function( path, m ) {

		if ($(path).length<1) {
			$( document.body ).append('<div id="TEMP_GNB_CASE" class="gnb"></div>');
			path = '#TEMP_GNB_CASE';
		}
		return new GNB(path, m);
	};
})(jsux.gnb.Menu, jQuery);
jsux.gnb = jsux.gnb || {};
jsux.gnb.Model = jsux.Model.create();
(function(app, $){	
	app.include({

		sizeList: [],
		setData: function(infoObj) {

			this.setChanged();
			this.notifyObserver( infoObj );
		},
		activate: function( mid, sid) {

			var len = this.observers.length;
			for (var i=0; i<len; i++) {
				this.observers[i].activate( mid, sid );
			}
		},
		menuOn: function(m, s) {

			var len = this.observers.length;
			for (var i=0; i<len; i++) {
				this.observers[i].menuOn(m, s);
			}
		},
		menuOff: function() {

			var len = this.observers.length;
			for (var i=0; i<len; i++) {
				this.observers[i].menuOff();
			}
		},
		tick: function() {

			var len = this.observers.length;
			for (var i=0; i<len; i++) {
				this.observers[i].tick();
			}
		},
		getSizeList: function() {

			return this.sizeList;
		},
		setSizeList: function( value ) {

			this.sizeList = value;
		}
	});

	app.create = function() {

		return new jsux.gnb.Model();
	};
})(jsux.gnb.Model, jQuery);

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

		var self = this;

		$('.mobile-menu .mobile-btn').on('click', function(e) {
			e.preventDefault();
			self.show();
			self._isClick = true;
		});

		$('.mobile-gnb-case').on('click', function(e) {

			var url = $(e.target).attr('href'),
				target = $(e.target).attr('target');

			if (!url) {
				 url = $(e.target).parent().attr('href');
				 target = $(e.target).parent().attr('target');
			}
			e.preventDefault();
			self.click(url, target);
			self._isClick = false;	
		});

		$('.ui-bg-cover').on('click', function(e) {
			e.preventDefault();
			self.hide();
			self._isClick = false;	
		});

		$(window).on('resize', function(e){

			//trace( self._isClick, 1);
			var tw = e.target.outerWidth;
			if (tw < 480 && self._isClick === true) {
				self.show();
			} else if (tw > 479) {
				self.hide();
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
/**
 * Swiper 3.3.1
 */

jsux.visual = jsux.visual || {};
jsux.visual.View = jsux.View.create();
(function( app, $) {

	app.create = function() {

		var mainVisual = new Swiper('.swiper-container-visual',{

			/* default */
			//initialSlide: 1,
			//Could be "horizontal" or "vertical"
			direction: 'horizontal',
			speed: 500,
			//setWrapperSize: true,
			//virtualTranslate: true,
			//width: 100,
			//height: 300,
			//autoHeight: true,
			//roundLengths: true,
			//nested: true,

			/* autoplay */
			//autoplay: 5000,
			//autoplayStopOnLast: true,
			//autoplayDisableOnInteraction: false,

			/* progress */
			//watchSlidesProgress: true,
			//watchSlidesVisibility: true,

			/* free mode */
			//freeMode: false,
			//freeModeMomentum: true,
			//freeModeMomentumRatio: 1,
			//freeModeMomentumBounce: true,
			//freeModeMomentumBounceRatio: 1,
			//freeModeMinimumVelocity: 0.02,
			//freeModeSticky: false,

			/* effects */
			//Could be "slide", "fade", "cube", "coverflow" or "flip"
			effect: 'slide',
			/*fade: {
				crossFade: true
			},*/
			/*cube: {
				slideShadows: true,
				shadow: true,
				shadowOffset: 20,
				shadowScale: 0.94
			},*/
			/*coverflow: {
				rotate: 50,
				stretch: 0,
				depth: 100,
				modifier: 1,
				slideShadows : true
			},*/
			/*flip: {
				slideShadows : true,
				limitRotation: true
			},*/

			/* Parallax */
			//parallax: true,

			/* Slides grid */
			//spaceBetween: 10,
			//slidesPerView: 1,
			//slidesPerColumn: 1,
			//slidesPerColumnFill: 'column', //or 'row'
			//slidesPerGroup: 1,
			//centeredSlides: false,
			//slidesOffsetBefore: 10,
			//slidesOffsetAfter: 10,

			/* Grab Cursor */
			//grabCursor: false,
			//shortSwipes: true,
			//longSwipes: true,
			//longSwipesRatio: 0.5,
			//longSwipesMs: 300,
			//followFinger: true,
			//onlyExternal: false,
			//threshold: 0,
			//touchMoveStopPropagation: true,
			//iOSEdgeSwipeDetection: false,
			//iOSEdgeSwipeThreshold: 20,

			/* Touches */
			//touchEventsTarget: 'container',
			//touchRatio: 1,
			//touchAngle: 45,
			//simulateTouch: true,

			/* Touch Resistance */
			//resistance: true,
			//resistanceRatio: 0.85,

			/* Clicks */
			//preventClicks: true,
			//preventClicksPropagation: false,

			/* Swiping / No swiping */
			//allowSwipeToPrev: true,
			//allowSwipeToNext: true,
			//noSwiping: true,
			//noSwipingClass: 'swiper-no-swiping',
			//swipeHandler: null

			/* Navigation Controls */
			//uniqueNavElements: true,

			/* Pagination */
			pagination: '.swiper-pagination-visual',
			//Can be "bullets", "fraction", "progress" or "custom"
			//paginationType: 'bullets',
			//paginationHide: true,
			paginationClickable: true,
			//paginationElement: 'span',
			/*paginationBulletRender: function (index, className) {
				return '<span class="' + className + '">' + (index + 1) + '</span>';
			},*/

			/* Navigation Buttons */
			/* Scollbar */
			/* Keyboard / Mousewheel */
			/* Hash Navigation */
			/* Images */
			preloadImages: false,
			lazyLoading: true,

			/* Loop */
			/* Controller */
			/*nextButton: '.swiper-button-next',
			prevButton: '.swiper-button-prev',*/
			/* Observer */
			/* Breakpoints */
			/* Callbacks */
			/* Properties */
			/* Methods */

			loop:true,
			grabCursor: false
		});

		mainVisual.on('slideChangeStart', function ( e ) {
			//console.log( e.activeIndex + ' : ' +  e.touches.diff );
		});
		
		/*$('.arrow-left').on('click', function(e){
			e.preventDefault()
			mySwiper.swipePrev()
		});
		$('.arrow-right').on('click', function(e){
			e.preventDefault()
			mySwiper.swipeNext()
		});*/
	};
})(jsux.visual.View, jQuery);