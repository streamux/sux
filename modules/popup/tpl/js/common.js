function setCookie( name, value, expiredays ) {

	var todayDate = new Date();
	todayDate.setDate( todayDate.getDate() + expiredays );
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"
}

function getCookie( name ) {

	var smxpopCookie = name + "=";
	var i = 0;
	while ( i <= document.cookie.length ) {

		var e = (i+smxpopCookie.length);
		if ( document.cookie.substring( i, e ) == smxpopCookie ) {
			if ( (popendCookie=document.cookie.indexOf( ";", e )) == -1 )
				popendCookie = document.cookie.length;
			return unescape( document.cookie.substring( e, popendCookie ) );
		}

		i = document.cookie.indexOf( " ", i ) + 1;
		if ( i == 0 ) {			
			break;
		}
	}
	return "";
}

function openPopup( url, left, top, width, height ) {

	alert(url);
	if ( getCookie(popwinname) != "___sux_popup" ) {
		smxpopWindow  =  window.open("'"+url+"','"+popwinname+"','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=auto,resizable=no,left="+left+",top="+top+",width="+width+",height="+height+"'");
		smxpopWindow.opener = self;
	}
}