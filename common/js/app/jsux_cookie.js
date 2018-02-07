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