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
				is_usable = list[counter].is_usable,
				period = list[counter].period,
				nowtime = list[counter].nowtime;

			if (is_usable.toLowerCase() == 'y' && period > nowtime) {
				url  = jsux.rootPath + 'popup-event?id='  + id + '&winname=' + winname;		
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

			url = jsux.rootPath + 'opener-json';
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
	
	app.popup = new Popup();
	app.open = function( id ) {
		this.popup.load(id);
	};
	app.sux_path = function( path ) {
		this.popup.sux_path = path;
	};
})(popupManager);
var BoardApp = BoardApp || {};
BoardApp.Pagination = jsux.Model.create();

(function( app, $ ){

	app.include({

		el: null,
		id: "",
		tmpl: null,
		total: 0,
		limit: 0,

		currentPage: 0,
		currentActivate: 0,
		direction: "prev",
		pageGroupNum: 1,
		pageTotalNum: 0,
		limitGroup: 1,
		activateId: 1,
		oldActivate: -1,
		liLists: null,
		markup: null,
		name: null,

		getName: function() {
			return this.name;
		},
		setName: function( str ) {
			this.name = str;
		},		
		setUI: function( data ) {

			for (var p in data) {
				this[p] = data[p];
			}

			this.el = $(this.el);
			this.markup = $(this.tmpl);
			this.setEvent();
		},
		setData : function( data ) {

			for (var p in data) {
				this[p] = data[p];
			}
						
			this.pageTotalNum = this.total%this.limit !== 0 ? Math.ceil(this.total/this.limit) : this.total/this.limit;

			this.remove();
			this.setLayout();

			this.activate( this.activateId );						
		},
		setLayout : function() {

			var numLists = [],
				len = 0,
				startNum = 0,
				remain = 0,
				compareNum = 0;
				
			this.liLists = [];

			startNum = (this.pageGroupNum-1)*this.limitGroup + 1;
			compareNum = startNum + this.limitGroup;

			if (compareNum < this.pageTotalNum) {
				remain = this.limitGroup;
			} else {

				remain = (this.pageTotalNum%this.limitGroup)  !== 0 ? this.pageTotalNum%this.limitGroup : 0;
			}

			len = startNum + remain;

			for( var i=startNum; i<len; i++) {
				numLists.push({no: i});
			}

			$(this.markup).tmpl(numLists).appendTo(this.id);

			if ( this.el.hasClass("ui-navi-hide")) {
				this.el.removeClass("ui-navi-hide");
			}
			this.el.addClass("ui-navi-show");
			this.liLists = this.el.find("li span");

			this.currentPage = { prev: startNum, next: len-1};
			this.currentActivate = {prev: 1, next: remain};			
		},
		setEvent : function() {

			var self = this;

			$(this.el).on("click", function( e ) {

				e.preventDefault();

				var className = e.target.className;

				if (className.indexOf("prev") !== -1) {
					self.prev();
				} else if (className.indexOf("next") !== -1) {
					self.next();
				} else {

					if (e.target.nodeName.toUpperCase() == "SPAN") {
						self.callPage( $.trim($(e.target).text()) );
					}				
				}
			});
		},
		prev : function() {

			this.direction = "prev";
			this.pageGroupNum--;

			if (this.pageGroupNum < 1) {
				this.pageGroupNum = 1;
			}

			this.remove();
			this.setLayout();

			this.activate( this.currentActivate[this.direction] );
			this.dispatchEvent({type:"change", page: this.currentPage[this.direction]});
		},
		next : function() {

			this.direction = "next";
			this.pageGroupNum++;

			if (this.pageGroupNum*this.limitGroup > this.pageTotalNum) {
				this.pageGroupNum = Math.ceil(this.pageTotalNum/this.limitGroup);
			}

			this.remove();
			this.setLayout();

			this.activate( this.currentActivate[this.direction] );
			this.dispatchEvent({type:"change", page: this.currentPage[this.direction]});
		},
		callPage : function( num ) {

			var pageNum = parseInt( num );

			this.activate( pageNum );
			this.dispatchEvent({type:"change", page: pageNum });
		},
		remove : function() {

			$(this.id).empty();
		},
		activate: function( num ) {

			var  id = 0;

			this.activateId = parseInt(num);

			if (isNaN(this.activateId)) {
				throw new Error(typeof num + " '" + num + "' is not a Number");
			}

			if ($(this.liLists[ this.oldActivate ]).hasClass("activate")) {
				$(this.liLists[ this.oldActivate ]).removeClass("activate");
			}

			this.currentNum = id = (this.activateId-1)%this.limit;

			$(this.liLists[ id ]).addClass("activate");

			this.oldActivate = id;
		}
	});

})( BoardApp.Pagination, jQuery );


