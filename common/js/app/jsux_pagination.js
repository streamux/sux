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


