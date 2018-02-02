/**
 * class gnb
 * update 2017.10.26
 * author streamux.com
 * description 'span 제거' 
 */
jsux.gnb = jsux.gnb || {};
jsux.gnb.Menu = jsux.View.create();
(function( app, $ ){

  var GNB = function( p, m ) {

    var _scope = this,
          _path = p,
          _stage = $(p),     
          _data = null,
          _list = [],
          _m = m,
          _activateIds = '',
          _timer = -1,

          _oldItem$ = null;

    this.addClass = function(target, className ) {

      if (!$(target).hasClass(className)) {
        $(target).addClass(className);
      }
    };

    this.removeClass = function(target, className ) {

      if ($(target).hasClass(className)) {
        $(target).removeClass(className);
      }
    };

    this.update = function( o,  value ) {

      _data = value;
    };
    this.resetUI = function() {

      this.setUI();
      this.setEvent();
    };
    this.setUI = function() {      

      var self = this;
      var ty = 0;
      var markup = $('#gnbMenuItem').html();
      var depth = 0;
      var linkFilter = /^(http(s)?:\/\/(www\.)?)?([a-zA-Z0-9-_]+)\.([a-zA-Z]+)/;

      var stage$ = $(_path);
      if (stage$ && stage$.children().length > 0) {
        return;
      }

      $(_path).empty();
      var menuManager = (function f(target, data) {        

        $(data).each(function(index) {

          var menu$ = $(markup).appendTo(target);
          menu$.attr('data-id', index);
          menu$.attr('data-depth', depth);

          var menu_a$ =  menu$.find('> a');          
          var link = data[index].link;

          if (!linkFilter.test(link)) {
            link = jsux.rootPath + link;
          }

          menu_a$.attr('href', link);
          menu_a$.attr('target', data[index].link_target);
          menu_a$.text(data[index].label);

          data[index].depth = depth;
          data[index].target = target;
        });

        // 1뎁스 메뉴 생성 후 정렬을 먼저 실행 
        if (depth === 0) self.alignUI();

        for (var i=0; i<data.length; i++) {

          if (data[i].menu && data[i].menu.length > 0) {
            depth = data[i].depth + 1;
            target = data[i].target + '> li:eq('+ i + ') > .sub_mask > ul';
            arguments.callee(target, data[i].menu);
          }
        }  // end of for
      });
      menuManager(_path, _data);
      menuManager = null;
    };

    this.alignUI = function() {

      var max_width = _stage.outerWidth(),
            max_txtWidth = 0,
            spaceWidth = 0,
            wdRate = 0,
            wd = 0,
            sizeList = [];

      _list = _stage.find("> .sx-menu");

      $( _list ).each(function(index){
        max_txtWidth += $(this).find("> a").outerWidth();
      });

      spaceWidth = Math.floor((max_width - max_txtWidth)/_data.length);

      $( _list ).each(function(index) {
        wdRate = Math.floor((100-0)/(max_width - 0)*(($(this).find("> a").outerWidth()+spaceWidth) - 0) + 0);

        // 마지막은 항상 나머지 비율로 100%를 채운다.
        if (index == _list.length-1) {
          wdRate = 100-wd;
        }

        wd += wdRate;       
        $( this ).css("width", wdRate+"%");

        sizeList.push(wdRate);  
      });

      _m.setSizeList( sizeList );
    };

    this.getActivatedId = function(el$) {

      var idList = [];
      var idManager = (function f(target) {

         var depth = target.data('depth');
         var id = target.data('id');
         idList.unshift(id);

         if (target && depth && depth >= 0) {
            arguments.callee(target.parent().parent().parent());
         }
      });
      idManager(el$);
      idManager = null;

      return idList;
    };

    this.setEvent = function() {

      _stage.find('.sx-menu > a').on('focus', function(e){

        _scope.stopTimer();

        // ids is same as '1,2,3,...'
        var ids = _scope.getActivatedId($(this).parent()).toString(',');
        _m.menuOn(ids);
      });

      _stage.find('.sx-menu > a').on('mouseover', function(e){

        _scope.stopTimer();

        // ids is same as '1,2,3,...'
        var ids = _scope.getActivatedId($(this).parent()).toString(',');
        _m.menuOn(ids);
      });

      _stage.find('.sx-menu > a').on('blur', function(e){
        
        _scope.startTimer();        
      });

      _stage.find('.sx-menu > a').on('mouseout', function(e){
        
        _scope.startTimer();        
      });

      _stage.find('.sx-menu > a').on('click', function(e){
        e.preventDefault();

        var url = $( this ).attr('href');
        var target = $( this ).attr('target');

        if (url === '#none' || url === '' || url === undefined) {
          return;
        }

        target = target ? target : '_self';
        jsux.goURL(url, target );
      });
    };

    this.menuOn = function(ids) {

      _scope.mouseHandler({type:'mouseover', active_ids: ids});
    };

    this.menuOff = function() {

      _scope.mouseHandler({type:'mouseout'});
    };

    this.mouseHandler = function(e) {
      
      var self = this;
      var type = e.type;
      var activeIds = e.active_ids ? e.active_ids : [];
      var idList = typeof(activeIds) === 'string' ? activeIds.split(',') : activeIds;
      var maxDepth = idList.length;
      var depth = 0;
      var menuStage$ = $('.sx-gnb');

      switch(type) {

        case 'mouseover' :
          
          var activeManager = (function f(el$) {

            var list$ = el$.find('> .sx-menu');
            list$.each(function(index) {

              var that$ = $(this);
              if (that$.data('id') == idList[depth]) {

                self.addClass(that$.find('> a'), 'active');
                self.addClass(that$.find('> .sub_mask'), 'sub_mask_active');

                if (_oldItem$ && that$.data('depth') < _oldItem$.data('depth')) {
                  self.removeClass(_oldItem$.find('> a'), 'active');
                  self.removeClass(_oldItem$.find('.sub_mask'), 'sub_mask_active');
                }
                _oldItem$ = that$;
              } else {

                self.removeClass(that$.find('a'), 'active');
                self.removeClass(that$.find('.sub_mask'), 'sub_mask_active');
              }
            });

            depth++;
            if (depth < maxDepth) {              
              arguments.callee(list$.find('> .sub_mask > ul'));
            }
          });
          activeManager(menuStage$);
          activeManager = null;
          break;

        case 'mouseout':

          self.removeClass(menuStage$.find('a'), 'active');
          self.removeClass(menuStage$.find('.sub_mask'), 'sub_mask_active');
          break;

        default:
          break;
      }

      menuStage$ = null;
    };

    this.activate = function(ids) {

      _activateIds = ids;
      _scope.mouseHandler({type:'mouseover', active_ids: ids});
    };

    this.tween = function( target, time, obj) {

      if (TweenLite) {
        TweenLite.to( target, time, obj);
      }      
    };

    this.startTimer = function() {

      if (_timer == -1) {
        _timer = setInterval(function(){

          if (_activateIds) {
            _m.menuOn(_activateIds);
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

      return str.replace(/[^(0-9)]/gi, '');
    };    
  };

  app.create = function( path, m ) {

    if ($(path).length<1) {
      $( document.body ).append('<div id="TEMP_GNB_CASE" class="sx-gnb"></div>');
      path = '#TEMP_GNB_CASE';
    }
    return new GNB(path, m);
  };
})(jsux.gnb.Menu, jQuery);