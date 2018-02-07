/*jsux.logger.isConsole = false;*/
/*jsux.logger.logLevel = jsux.LogLevel.WARN;*/

(function(app, $, tweener) {
  var SearchForm = app.View.create();
  SearchForm.include({

    $el: null,
    $inputGroup: null,
    $closeX: null,

    update: function(info) {
      // write code
    },
    tween: function( target, time, op ) {
      tweener.to(target, time, op);
    },
    killTween: function( target ) {
      tweener.killTweensOf( target );
    },
    hideSearchFormPanel: function() {

      if (this.$el.hasClass('active')) {
        this.$el.removeClass('active');
      }
    },
    hideSearchForm: function() {

      this.$el.find('input[name=search]').val('');
      this.killTween(this.$inputGroup);
      this.tween(this.$inputGroup, 21, {x: '0%', opacity:0, ease: Quad.easeOut, useFrames:true});
    },
    showSearchForm: function() {

      if (!this.$el.hasClass('active')) {
        this.$el.addClass('active');
      }
      this.killTween(this.$inputGroup);
      this.tween(this.$inputGroup, 31, {x: '-20%', opacity:1, ease: Quad.easeOut, useFrames:true});
      this.$el.find('input[name=search]').focus();
    },
    hideCloseX: function() {

      var self = this;

      this.killTween(this.$btnClase);
      this.killTween(this.$closeX);
      this.tween(this.$btnClase, 17, {opacity:0, useFrames:true, onComplete: $.proxy(self.hideSearchFormPanel, self)});
      this.tween(this.$closeX, 65, {rotation:0, useFrames:true});

      this.tween(this.$inputGroup, 31, {x: '0', opacity:0, ease: Quad.easeOut, useFrames:true});
    },
    showCloseX: function() {

      this.killTween(this.$btnClase);
      this.killTween(this.$closeX);
      this.tween(this.$btnClase, 13, {opacity:1, ease: Quad.easeOut, useFrames:true});
      this.tween(this.$closeX, 65, {rotation:360, useFrames:true});    
    },
    show: function() {

      this.setEvent();      
      this.showSearchForm();
      this.showCloseX();
    },
    setEvent: function() {

      var self = this;
      var $btnClose = $(this.$el).find('.sx-btn-close');

      $btnClose.on('click', function() {
        self.hideCloseX();
        self.hideSearchForm();
      });
    },
    init: function(id) {

      this.$el = $(id);
      if (!this.$el) {
        jsux.logger.warn(id + ' 마크업을 확인해주세요.', 'jsux_search_form.js', 61);
      }
      this.$inputGroup = $(id).find('.sx-form-inline');
      this.$btnClase = $(id).find('.sx-btn-close');
      this.$closeX = $(id).find('.sx-h-3stick');    
    }
  });

  SearchForm.extend({

    checkValidation: function(f) {

      var itemFilter = {
        search : {
          validate: {
            ignore: true,
            msg: '검색어를 입력해주세요.'  
          },
          pattern: {
            value: '^[a-zA-Z0-9_ㄱ-ㅎㅏ-ㅏ가-힣]+$',
            msg: '검색어는 한글, 영문, 숫자, _(언더라인)만 입력가능합니다.'
          }
        }
      };

      return jsux.utils.validateForm(f, itemFilter, 'input', 'text');
    },
    create: function( id ) {

      var markup = '';

      if ($(id).length<1) {
        markup = '<div id="gnbSearchForm" class="sx-search-form">' + id + ' 마크업을 확인하세요.</div>';
        $( document.body ).append( markup );
        id = '#gnbSearchForm';
      }

      return new SearchForm(id);
    }
  });

  app.searchForm = SearchForm.create('#gnbSearchForm');

  $('#btnShowSearchForm').on('click', function() {
    app.searchForm.show();
  });

  $('form[name=gnb_form_search]').submit(function(e) {

    if (!SearchForm.checkValidation(this)) {
       e.preventDefault();
    }
  });

})(jsux, jQuery, TweenMax);



