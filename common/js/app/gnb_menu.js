
(function( app ){

	var GNB;

	function trace( str ) {

		console.log( str );
	}

	function warn( str ) {

		trace("warn : " + str);
	}

	GNB = function( p, m ) {

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

		this.setData = function( value ) {

			_data = value;
			this.setUI();				
			this.setEvent();
		};

		this.setUI = function() {

			var ty = 0;

			$( _data ).each(function(mindex) {

				ty = -1*_data[mindex].sub.length * (34+1);

				_stage.append("<ul class=\"mmenu\">"+
									"<li data-mid=\"" + mindex + "\" data-sid=\"-1\">" +
										"<a href=\"#none\"><span>"+_data[mindex].label+"</span></a>"+
										"<div class=\"sub\">"+
											"<ul class=\"panel\" style=\"top:"+ ty +"px\"data-startPosY=\""+ ty +"px\"></ul>"+
										"</div>"+
									"</li>"+
								"</ul>");
			});

			this.alignUI();

			$( _data ).each(function(mindex) {

				$( _data[mindex].sub ).each(function(sindex) {

					_stage.find(".mmenu:eq("+mindex+") .sub > ul").append(
						"<li class=\"smenu\" data-mid=\"" + mindex + "\" data-sid=\"" + sindex + "\">"+
							"<a href=\"#none\"><span>"+_data[mindex].sub[sindex].label+"</span></a>"+
						"</li>");
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

			_stage.find(".mmenu > li > a").on("mouseover", function(e){

				_scope.stopTimer();
				_m.menuOn( $( this ).parent().attr("data-mid"), -1 );
				e.preventDefault();
			});

			_stage.find(".mmenu > li > a").on("mouseout", function(e){

				_scope.startTimer();
				e.preventDefault();
			});

			_stage.find(".mmenu > li > a").on("click", function(e){

				e.preventDefault();
			});

			_stage.find(".smenu > a").on("mouseover", function(e){

				_scope.stopTimer();
				_m.menuOn( $( this ).parent().attr("data-mid"), $( this ).parent().attr("data-sid") );
				e.preventDefault();
			});

			_stage.find(".smenu > a").on("mouseout", function(e){

				_scope.startTimer();
				e.preventDefault();
			});

			_stage.find(".smenu > a").on("click", function(e){

				var url = _data[$( this ).parent().attr("data-mid")].sub[$( this ).parent().attr("data-sid")].link;
				jsuxApp.goURL( url, "_self" );
				e.preventDefault();
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

				case "mouseover" :					

					if (_mid > -1) menu 	= _list.eq(_mid);
					if (_sid > -1) submenu 	= menu.find(".sub .smenu").eq(_sid);

					if (menu && !menu.hasClass("activate")) {

						mask 	= menu.find(".sub");
						panel	= menu.find(".sub .panel");
						ty 		= 0;
						th 		= _list.eq(_mid).find(".sub .panel").attr("data-startPosY").replace(/[^(0-9)]/gi, "");

						menu.addClass("activate");
						_scope.tween( panel, 10, {"top": ty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {

							var mh = th - panel.css("top").replace(/[^(0-9)]/gi, "");
							mask.css("height", mh);
						}});
					}
					
					if (submenu && !submenu.hasClass("activate")) {
						submenu.addClass("activate");
					}

					if (_oldMid != _mid && _oldMid > -1) {

						oldMask 	= _list.eq(_oldMid).find(".sub");
						oldPanel	= _list.eq(_oldMid).find(".sub .panel");
						oldty 		= _list.eq(_oldMid).find(".sub .panel").attr("data-startPosY");
						oldth 		= _list.eq(_oldMid).find(".sub .panel").attr("data-startPosY").replace(/[^(0-9)]/gi, "");

						_list.eq(_oldMid).removeClass("activate");
						_scope.tween( oldPanel, 10, {"top": oldty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {
							
							var mh = oldth - oldPanel.css("top").replace(/[^(0-9)]/gi, "");
							oldMask.css("height", mh);
						}});
					}

					if (_oldSid != _sid && _oldSid > -1) {
						_list.eq(_oldMid).find(".sub .smenu").eq(_oldSid).removeClass("activate");
					}					

					_oldMid	= _mid;
					_oldSid		= _sid;
					break;

				case "mouseout":

					if (_mid > -1) menu 	= _list.eq(_mid);
					if (_sid > -1) submenu 	= menu.find(".sub .smenu").eq(_sid);

					if (menu && menu.hasClass("activate")) {

						panel 	= menu.find(".sub .panel");
						ty 		= menu.find(".sub .panel").attr("data-startPosY");
						oldth	= _list.eq(_mid).find(".sub .panel").attr("data-startPosY").replace(/[^(0-9)]/gi, "");

						menu.removeClass("activate");
						_scope.tween( panel, 10, {"top": ty, ease: Linear.easeOutQuad, useFrames: true, onUpdate: function() {
						
							var mh = oldth - $( panel ).css("top").replace(/[^(0-9)]/gi, "");
							menu.find(".sub").css("height", mh);
						}});
					}

					if (submenu && submenu.hasClass("activate")) {
						submenu.removeClass("activate");
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
				warn("It not a Avaliable Depth1's Number!");
				return;
			} 

			if (_activateSid <= 0 && _activateSid > _data[mid].sub.length) {
				warn("It not a Avaliable Depth2's Number!");
				return;
			}

			_activateMid	= _activateMid - 1;
			_activateSid		=  _activateSid - 1;

			this.menuOn( _activateMid, _activateSid);
		};

		this.menuOn = function(m, s) {

			_scope.mouseHandler({type:"mouseover"}, {mid: m, sid: s});
		};

		this.menuOff = function() {

			_scope.mouseHandler({type:"mouseout"}, {mid: _mid, sid: _sid});
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

			return str.replace(/[^(0-9)]/gi, "");
		};
	};

	app.createGNB = function( path, m ) {

		if ($(path).length<1) {
			$( document.body ).append("<div id=\"TEMP_GNB_CASE\" class=\"gnb\"></div>");
			path = "#TEMP_GNB_CASE";
		}
		return new GNB(path, m);
	};
})(jsuxApp);