/**
 * class jsux
 * ver 1.0.0
 * author streamux.com
 */
window.jsuxApp = window.jsuxApp || {};

(function(app, exports){  

  var Model = null,
    Control = null;

  function trace( str ) {

    console.log("warn : " + str);
  }


  Model = function() {

    var _self = this;

    this.observer = [];
    this.data = null;
    this.sizeList = null;

    this.init = function() {};
    this.addView = function( value ) {

      var len = _self.observer.length,
        i;

      for (i=0; i<len; i++) {
        if (_self.observer[i-1] == value) {
          return false;
        }       
      }
      _self.observer.push(value);

      return true;
    };
    this.removeView = function( value ) {

      var len = _self.observer.length,
        i;
      for (i=len-1; i>=0; i--) {
        if (_self.observer[i-1] == value) {
          _self.observer.slice(i-1,1);
          return true;
        }
      }
      return false;
    };
    this.setData = function( value ) {

      var len = _self.observer.length,
        i;
      _self.data = value;

      for (i=0; i<len; i++) {
        _self.observer[i].setData( value );
      }
    };
    this.clearView = function() {

      _self.observer = [];
    };
    this.activate = function( mid, sid) {

      var len = _self.observer.length,
        i;

      for (i=0; i<len; i++) {
        _self.observer[i].activate( mid, sid );
      }
    };
    this.menuOn = function(m, s) {

      var len = _self.observer.length,
        i;

      for (i=0; i<len; i++) {
        _self.observer[i].menuOn(m, s);
      }
    };
    this.menuOff = function() {

      var len = _self.observer.length,
        i;

      for (i=0; i<len; i++) {
        _self.observer[i].menuOff();
      }
    };
    this.tick = function() {

      var len = _self.observer.length,
        i;

      for (i=0; i<len; i++) {
        _self.observer[i].tick();
      }
    };
    this.getSizeList = function() {

      return this.sizeList;
    };
    this.setSizeList = function( value ) {

      this.sizeList = value;
    };
  };


  Control = function( m ) {

    var _scope  = this,
      _m    = m,

      _timer  = -1;

    this.tick = function() {

      _m.tick();
    };

    this.startTimer = function() {

      if (_timer > -1) {
        return;
      }
      _timer = setInterval(function() {

        _scope.tick();
      }, 4000);
    };

    this.stopTimer = function() {

      if (_timer > -1) {
        clearInterval( _timer );
        _timer = -1;
      }
    };

    this.setRolling = function( bool ) {

      if (bool === true)  {
        this.startTimer();
      } else {
        this.stopTimer();
      } 
    };
  };

  app.getModel = function() {

    return new Model();
  };

  app.getControl = function( m ) {

    return new Control( m );
  };

  app.goURL = function( url, target ) {

    if (!url) {
      trace("링크가 존재하지 않습니다.");
      return;
    }
    exports.location.href = url;

    if (target) {
      exports.location.target = target;
    }
  };
  app.history = {

    back: function() {
      exports.history.back();
    }
  };

  app.getJSON = function(path, data, func) {

    if (typeof(data) == "function") {     
      func = data;
      data = "";
    }

    if (!data) {
      data = "";
    }

    if (jQuery) {
      $.ajax({
        type: "POST",
        url: path,
        data: data,
        dataType: "jsonp",
        success: function( e ) {
          func( e );
        }
      });
    }
  };

})(jsuxApp, window);