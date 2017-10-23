/**
 * class Pagination
 * ver 1.0.0
 * update 2017.10.22
 * author streamux.com
 * description control 설정 추가 
 **/

jsux.app = jsux.app || {};
(function( app, $ ){

  var Pagination = jsux.Model.create();
  Pagination.include({

    el: null,                           // pagination 범위 그룹 
    id: '',                             // markup 출력 위치 
    tmpl: null,                      // pagination markup
    template: null,
    control: null,                  // control 참조 식별자 
    total: 0,                         // 개시물 총개수 
    limit: 0,                         // 게시물 개수 

    currentPage: 0,
    currentActivate: 0,
    direction: "prev",
    pageGroupNum: 1,
    pageTotalNum: 0,
    limitGroup: 1,               // pagination 출력 개수
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
    reset: function() {
      $(this.id).empty();
    },

    /**
     * method initialize
     * @ param data {  el: string, id: string, tmpl: string, control: array }
     */ 
    initialize: function( data ) {     

      /**
       * data's value { el:string, id:string, tmpl:string, control:array }
       */ 
      for (var p in data) {
        this[p] = data[p];
      }

      this.el = $(this.el);
      this.tmpl = this.tmpl || this.template;
      this.markup = $(this.tmpl);

      if (!this.control) {
        var control = this.el.find('.sx-pagination-control');
        this.control = {'prev':control[0], 'next':control[1]};
      }

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

      if (!this.id) {
        jsux.logger.error('\'' + this.id + '\' 아이디 식별자를 확인해주세요.', 'jsux_pagination.js', 88);
        return;
      }

      var $id = $(this.id);
      if ($id.length < 1) {
        jsux.logger.error('\'' + this.id + '\' 아이디 DOM 객체가 존재하지 않습니다.', 'jsux_pagination.js', 94);
        return;
      }

      if (!this.tmpl) {
        jsux.logger.error('\'' + this.tmpl + '\' 템플릿 식별자를 입력하세요.', 'jsux_pagination.js', 153);
        return;
      }

     if (this.markup.length < 1) {
      jsux.logger.error('\'' + this.tmpl + '\' 템플릿 DOM 객체가 존재하지 않습니다.', 'jsux_pagination.js', 152);
        return;
      }
        
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

      if ( this.el.hasClass("sx-hide")) {
        this.el.removeClass("sx-hide");
      }
      this.el.addClass("sx-show");
      this.liLists = this.el.find("a");

      this.currentPage = { prev: startNum, next: len-1};
      this.currentActivate = {prev: 1, next: remain};     
    },
    setEvent : function() {

      var self = this;
      $(this.control.prev).on('click', function(e) {
         e.preventDefault();         
        self.prev();
      });

      $(this.control.next).on('click', function(e) {
        e.preventDefault();
        self.next();
      });
      
      $(this.el).on("click", function( e ) {
        e.preventDefault();

        var className = e.target.className;
        if (className === 'sx-pagination') {
          self.callPage( $.trim($(e.target).text()) );  
        }
      });

      $('window').on('resize', function(e) {

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

      if ($(this.liLists[ this.oldActivate ]).hasClass("active")) {
        $(this.liLists[ this.oldActivate ]).removeClass("active");
      }
      this.currentNum = id = Math.ceil(this.activateId%this.limit);
      if (this.currentNum === 0) {
        this.currentNum = id = this.limit;
      }
      $(this.liLists[ id ]).addClass("active");

      this.oldActivate = id;
    },
    activateControl: function() {

      var $prev = $(this.control.prev),
            $next = $(this.control.next);

      if ($prev.hasClass('unactive')) {
          $prev.removeClass('unactive');
      }
      if ($next.hasClass('unactive')) {
        $next.removeClass('unactive');
      } 
    },
    deactivateControl: function() {

      var $prev = $(this.control.prev),
            $next = $(this.control.next);

      if ($prev.hasClass('active')) {
          $prev.removeClass('active');
      }
      if ($next.hasClass('active')) {
        $next.removeClass('active');
      } 
    }
  });

  app.getPagination = function() {

    return new Pagination();
  };

})( jsux.app, jQuery );


