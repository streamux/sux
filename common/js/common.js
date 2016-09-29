function setCookie( name, value, expiredays ) {

	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = escape(name) + '=' + escape( value ) + '; path=/; expires=' + todayDate.toGMTString() + ';';
}

function getCookie( name ) {

	var suxpopCookie = escape(name) + '=';
	var i = 0;
	while ( i <= document.cookie.length ) {

		var e = i + suxpopCookie.length;
		if ( document.cookie.substring( i, e ) == suxpopCookie ) {
			if ( (popendCookie=document.cookie.indexOf( ';', e )) == -1 ) {
				popendCookie = document.cookie.length;
			}
			return unescape( document.cookie.substring( e, popendCookie ) );
		}

		i = document.cookie.indexOf( ' ', i ) + 1;
		if ( i === 0 ) {			
			break;
		}
	}
	return '';
}

function closePopup( suxpopname ) { 

	if ( document.forms[0].suxpop.checked ) {
 		setCookie( suxpopname, '__sux_nopopup' , 1); 
	}
	self.close(); 
}

function openPopup( url, popwinname, pLeft, pTop, pWidth, pHeight ) {

	if ( getCookie(popwinname) != '__sux_nopopup' ) {
		suxpopWindow  =  window.open( url, popwinname,'\'toolbar=no,location=no,status=no,menubar=no,scrollbars=auto,left='+pLeft+'px,top='+pTop+'px,width='+pWidth+'px,height='+pHeight+'px\'');
		suxpopWindow.opener = self;
	}
}

var popupManager = popupManager || {};
(function(app){

	var Popup = function() {

		var self = this,
			interval = [],
			delay = 300,
			list = null,
			counter = 0,
			total = 0;

		this.init = function( data ) {

			counter = 0;
			list = data;
			total = data.length;
		};

		this.open = function() {

			var url = '',
				id = list[counter].id,
				winname = list[counter].popup_name,
				skin = list[counter].skin,
				left = list[counter].popup_left,
				top = list[counter].popup_top,
				width = list[counter].popup_width,
				height = list[counter].popup_height,
				choice = list[counter].choice,
				period = list[counter].period,
				nowtime = list[counter].nowtime;

			if (choice.toLowerCase() == 'y' && nowtime < period ) {

				url  = self.sux_path + '/sux/modules/popup/popup.php?action=event&id='  + id + '&winname=' + winname + '&skin=' + skin;
				
				openPopup(url, winname, left , top , width , height);
			}

			counter++;
			if (counter == total) {
				self.stopTimer();
			}
		};

		this.startTimer = function() {

			interval.push(setInterval(self.open, delay));
		};

		this.stopTimer = function() {

			for (var i=0; i<interval.length; i++) {
				clearInterval(interval[i]);
			}
		};

		this.load = function( id ) {

			var params = { 'id': id },
				loaded = true,
				url = '';

			if (loaded === false) {
				return;
			}
			loaded = false;

			url = self.sux_path + '/sux/modules/popup/popup.php?action=openerJson';
			jsux.getJSON( url, params, function(e) {

				var result = $.trim(e.result.toLowerCase());
				if ( result == 'y') {

					self.init(e.data);
					self.startTimer();
				} else {
					trace(e.msg, 1);
				}
				loaded = true;
			});
		};
	};

	Popup.prototype.sux_path = '';

	app.popup = new Popup();
	app.open = function( id ) {
		this.popup.load(id);
	};
	app.sux_path = function( path ) {
		this.popup.sux_path = path;
	};
})(popupManager);