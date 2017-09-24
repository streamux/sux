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
