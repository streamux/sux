/** 
 * extend 'jsux.fn.listManager'
 * extend class's path 'common/js/app/jsux_list_manager.js'
 * author streamux.com
 * update 2017.10.18
 */

//-- MenuListManager
(function(app, $) {

  var ListManager = jsux.app.ListManager;
  var MenuListManager = jsux.Model.create(ListManager);
  MenuListManager.include({
    
    addItem: function(item) {

      var self = this;
      var restoreItemManager = (function(item) {

        if (!ListManager.isEqualItem(self.model, item)) {
          self.model.push(item);
        }

        // 아이뎀에 서브 값이 있으면 조회 후 저장 
        if (item && item.sub && item.sub.length > 0) {

          while(item.sub.length > 0) {
            var cutItem = item.sub.splice(0,1);
            arguments.callee(cutItem[0]);
          }
        }

      })(item);
      restoreItemManager = null;

      this.setData(this.model);
      this.slideTo(1);
      this.dispatchEvent({type:'add', target: this, model: item});
    },
    getLength: function() {
      return this.model.length;
    }
  });

  app.getMenuListManager = function() {
    return new MenuListManager();
  };
})(jsux.app, jQuery);

//-- MenuTreeManager 
(function(app, $) {

  var ListManager = jsux.app.ListManager;
  var MenuTreeManager = jsux.Model.create(ListManager);
  MenuTreeManager.include({
    
    selectedModels: null, // 기본 값은 model
    selectedId: '',
    elid: '',
    currentItem: null,
    oldItem: null,
    dragModels: null,
    dragMinY: 0,
    dragItem$: null,
    dragOffsetY: 0,
    moveHeight: 0,
    startOffsetY: 0,
    moveOffsetY: 0,
    oldOffset:0,
    dragGap: 20,
    isDragging: false, 
    
    /*
    @method getModel
    @return this.model : Array
    */
    getModel: function() {

      return this.model;
    },
    addItem: function(item) {

      if (!this.selectedModels) {
        this.selectedModels = this.model;
      }

      if (!ListManager.isEqualItem(this.selectedModels, item)) {
         this.selectedModels.push(item);
       }     
      
      this.setData(this.model);
      this.updateSwiper();
      this.resizeSwiper();
      /*this.slideTo(1);*/

      this.dispatchEvent({type:'add', target: this, model: item});
    },
    cutItem: function(id) {

      if (this.model.length == 0) {
        return;
      }
      this.elId = this.id + ' > li';
      
      var self = this;
      var parentModels = this.model;
      var cutItem;
      var elCutitem;
      var searchMenu = (function f(list) {

        for (var i=0; i<list.length; i++) {
          if (list[i].id == id) {
            self.selectedModels = parentModels;            
            cutItem = list.splice(i, 1);
            elCutitem = $(self.elId).eq(i); // view
            break;
          }

          if (list[i] && list[i].sub && list[i].sub.length > 0 ) {
            self.elId += ' > .sub_mask > ul > li';
            parentModels = list[i].sub;       
            arguments.callee(list[i].sub);
          }
        }

      });
      searchMenu(parentModels);
      searchMenu = null;

      //this.deactivate(elCutitem);
      this.setData(this.model);
      this.resizeSwiper();
      /*this.slideTo(1);*/
      this.dispatchEvent({type:'add', target: this, model: cutItem});

       return cutItem[0];
    },
    updateItem: function(item) {

      var searchMenu = (function f(list) {

        for (var i=0; i<list.length; i++) {
          if (list[i].id == item.id) {        
            list[i] = item;
            break;
          }

          if (list[i] && list[i].sub && list[i].sub.length > 0 ) {   
            arguments.callee(list[i].sub);
          }
        }

      })(this.model);

      this.setData(this.model);
      this.dispatchEvent({type:'add', target: this, model: item});
    },
    selectMenu: function(id) {

      var self = this;
      var reg = /(selected_menu_active)+/g;

      this.elId = this.id + ' > li';
      this.selectedId = id;

      var searchMenu = (function f(list) {

        for (var i=0; i<list.length; i++) {

          if (list[i].id == id) {
            self.currentItem = $(self.elId).eq(i);

            if (self.oldItem)  {
              ListManager.removeClass(self.oldItem, 'selected_menu_active');
            }

            if (!self.currentItem.hasClass('selected_menu_active')) {
              ListManager.addClass(self.currentItem, 'selected_menu_active');
            }
            
            self.oldItem = self.currentItem;
            self.selectedModels = list[i].sub;
            break;
          }          
        } // end of for

        for (var j=0; j<list.length; j++) {
          if (list[j] && list[j].sub && list[j].sub.length > 0) {
            self.elId += ' > .sub_mask > ul > li';
            arguments.callee(list[j].sub);
          }
        } // end of for

      });
      searchMenu(this.model);
      searchMenu = null;
    },
    unselectMenu: function() {

      if (this.oldItem)  {
        ListManager.removeClass(this.oldItem, 'selected_menu_active');        
      }

      this.elId = this.id;
      this.selectedModels = this.model;
      this.selectedId = '';
    },
    editable: function() {

      this.editState = true;
      this.updateEdit();
    },
    uneditable: function() {

      this.editState = false;
      this.updateEdit();
    },
    updateEdit: function() {

      var self = this;      
      var editId = this.id + ' > li';
            
      this.toggleButtonMode();

      var searchMenu = (function f(list) {

        for (var i=0; i<list.length; i++) {          
          var elItem = $(editId).eq(i);
          self.setEdittingMode(elItem, 'selected_editing');
        } // end of for

        for (var j=0; j<list.length; j++) {
          if (list[j] && list[j].sub && list[j].sub.length > 0) {            
            editId += ' > .sub_mask > ul > li';     
            arguments.callee(list[j].sub);
          }
        } // end of for

      });
      searchMenu(this.model);
      searchMenu = null;

      this.setData(this.model);
      this.updateSwiper();
    },
    setEdittingMode: function(item, className) {

      if (this.editState === true) {
        ListManager.addClass(item, className);
      } else {
        ListManager.removeClass(item, className);
      }
    },
    toggleButtonMode: function() {

      var editBtn = $('button[name=edit_menu]');
      var saveBtn = $('button[name=save_json]');
      var className = 'sx-btn-active';

      if (this.editState === true) {
        ListManager.addClass(saveBtn, className);
        ListManager.removeClass(editBtn, className);
      } else {
        ListManager.addClass(editBtn, className);
        ListManager.removeClass(saveBtn, className);
      }
      
    },
    remove: function(id) {

      //this.model.splice(index, 1);
      this.dispatchEvent({type:'remove', this:this, collection: this.model});
    },
    makeMenu: function(list, markup) {

      var self = this;
      var depth = 0;
      var target = this.id;

      var childMenuManager = (function f(list) {

        var elList = $(markup).tmpl(list).appendTo(target);
        $(elList).css({'padding-left':15*depth+'px'});
        depth = 1;

        for (var i=0; i<list.length; i++) {

          var elItem = $(elList[i]);
          self.setEdittingMode(elItem, 'selected_editing');
        }
        
        for (var j=0; j<list.length; j++) {

          // 하위 메뉴가 있으면 
          if ( list[j] && list[j].sub && list[j].sub.length > 0) {

            var elItem = $(elList[j]);
            ListManager.addClass(elItem, 'icon_folder_active');

            target = $(elList[j]).find('> div > ul');     
            arguments.callee(list[j].sub);

            // 서브 메뉴는 1뎁 뎁스 시작 
            depth = 1;
          }
        }
        
      });
      childMenuManager(list);
      childMenuManager = null;

      if (list.length === 0) {
        this.setMsg('메뉴를 추가해주세요.');
      }

      this.updateSwiper();
      this.activate();
    },
    activate: function() {

      if (this.selectedId) {
        this.selectMenu(this.selectedId);
      }
    },
    deactivate: function(el) {

      var self = this;
      var deactivateManager = (function f(el) {
        
        ListManager.removeClass(el, 'selected_menu_active');        

        var subli = $(el).find('> .sub_mask > ul > li');
        if (subli && subli.length > 0) {          
          for (var i=0; i<subli.length; i++) {
            arguments.callee(subli[i]);
          }          
        }        
        
      })(el);

      self.elId = self.id;
      self.selectedModels = self.model;
      self.selectedId = '';
    },    
    getDragModels: function(id) {

      var self = this;
      var dragModels = this.model;

      var searchMenu = (function f(list) {
        var temp;

        for (var i=0; i<list.length; i++) {
          if (list[i].id == id) {
            dragModels = list;
            break;
          }          
        } // end of for

        for (var j=0; j<list.length; j++) {
          if (list[j] && list[j].sub && list[j].sub.length > 0) {            
            arguments.callee(list[j].sub);
          }
        } // end of for

      })(this.model);
      searchMenu = null;

      return dragModels;
    },
    getParentElement: function(el) {
      return $(el).parent();
    },
    getAttr: function(el, prop) {
      return $(el).attr(prop);
    },
    getPageY: function(e) {
      return e.pageY || e.originalEvent.touches[0].pageY
    },
    isDraggable: function(el, value) {
      return $(el).data('type') === value;
    },
    swapArray: function(arr, indexA, indexB) {

      var tempItem = arr[indexA];
      arr[indexA] = arr[indexB];
      arr[indexB] = tempItem;

      return arr;
    },
    animate: function(target$, duration, value, callback) {

      target$.css({'top': value});
      target$.animate({'top': 0}, duration, 'easeOutQuad', callback);
    },
    searchDraggable: function(el, type) {

      while(!this.isDraggable(el, type)) {
        el = this.getParentElement(el)[0];
        if (!(el) || el.nodeName.toUpperCase().match('BUTTON|LI') === null) {
          return null;
        }
      }
      return el;
    },
    startDrag: function(el , y) {

      var pageY = y;
      var el = $(el);

      el = this.searchDraggable(el, 'item_draggable');
      if (!el) {
        return;
      }

      this.lockSwipes();
      this.isDragging = true;

      this.dragItem$ = $(el);
      var id = this.dragItem$.data('id');
      this.dragModels = this.getDragModels(id);
      
      this.dragMinY = this.dragItem$.parent().offset().top;
      this.dragOffsetY = this.dragItem$.offset().top; 
      this.moveHeight = this.dragItem$.outerHeight();  
      this.startOffsetY = pageY - this.dragOffsetY;

      ListManager.addClass(this.dragItem$[0], 'item_drag_true');
    },
    moveDrag: function(y) {

      if (this.isDragging === false ) return; 

      var self = this;
      var gapY = 8;
      var pageY = y;

      // drag 클릭 위치 - drag top 위치 )의 차이 값
      var offsetY = pageY - this.dragOffsetY;
      // drag top 위치 
      var movePosY = offsetY - this.startOffsetY;

      // index 값은 실시간으로 바뀜 
      var index = this.dragItem$.index(); 
      var direction = pageY - this.oldOffset;
      var minTop = this.dragMinY+this.startOffsetY;

      /*if (pageY < minTop) {
        return;
      }*/

      if (direction < 0) {

        // drag up
        var prevItem$ = this.dragItem$.prev();
        if (prevItem$ && prevItem$.data('id')) {

          var prevHeight = prevItem$.outerHeight();
          var prevPosY = prevItem$.offset().top + this.startOffsetY;
          var dragPosY = pageY - this.startOffsetY;

          if (prevPosY > dragPosY) {
            prevItem$.insertAfter(this.dragItem$);
            this.animate(prevItem$, 300, -1*this.moveHeight);
            this.swapArray(this.dragModels, index, index-1);            

            // 드래그 위치 값 갱신 
            movePosY += prevHeight + gapY; 

            // 드래그 아이템 top 오프셋 값 갱신 
            this.dragOffsetY -= prevHeight + gapY; 
          }
        }
      } else if (direction > 0) {
        
        // drag down
        var nextItem$ = this.dragItem$.next();
        if (nextItem$ && nextItem$.data('id')) {

          var nextHeight = nextItem$.outerHeight();
          var nextPosY = nextItem$.offset().top + nextHeight;
          var dragPosY = pageY + this.moveHeight;

          if (nextPosY < dragPosY) {
            nextItem$.insertBefore(this.dragItem$);
            this.animate(nextItem$, 300, this.moveHeight);
            this.swapArray(this.dragModels, index, index+1);
            
            // 드래그 위치 값 갱신  
            movePosY -= nextHeight + gapY;

            // 드래그 아이템 top 오프셋 값 갱신 
            this.dragOffsetY += nextHeight + gapY;
          }
        }
      } // end of if

      this.dragItem$.css({'top': movePosY});
      this.oldOffset = pageY;
    },
    stopDrag: function() {
   
      var self = this;
      if (this.dragItem$) {        
        this.dragItem$.animate({'top': 0}, 300, 'easeOutQuad',function() {
          $(this).css({'z-index':0});
        });
        ListManager.removeClass(this.dragItem$[0], 'item_drag_true');
      }

      this.unlockSwipes();
      this.dragOffsetY = 0;
      this.dragItem$ = null;
      this.isDragging = false;
      //console.log(e.target);      
    },
    getLength: function() {
      return this.model.length;
    },

    searchTargetElement: function(target, loop, search) {

      var parent$ = $(target);
      var count = 0;
      var loop = !loop ? 0 : loop; 
      var search = !search ? search.toUpperCase() : 'DIV';
      var reg = new RegExp(search, 'gi');
      
      do{

        if (parent && (reg.test(parent$.data('type')) || reg.test(parent$[0].className) ||
              reg.test(parent$[0].nodeName))) {
          return true;
        }

        parent = parent$.parent();
        count++;
      }while(count<loop);

      return false;
    },

    //setData's method is defined in parent class
    initialize: function(data) {
      
      var self = this;

      for (var p in data) {
        this[p] = data[p];
      }

      $(document).on('mousedown', function(e) {

        var el = e.target;
        var elName = self.getAttr(el, 'name');
        var nodeName = el.nodeName.toUpperCase();

        if (self.searchTargetElement(e.target, 1, 'DIV|H1|INPUT|HEADER')) {
          self.unselectMenu();
          return;
        }

        if (el.nodeName.toUpperCase().match('BUTTON') && elName !== 'btn_drag') {          
          return;
        }

        self.startDrag(e.target, e.pageY);     

        // register event
        $(document).on('mousemove', function(e) {
          e.preventDefault();
          self.moveDrag(e.pageY);
        });

        $(document).on('mouseup', function(e) { 

          $(document).off('mousemove');
          $(document).off('mouseup');
          self.stopDrag(e);
        });       
      });       

      $(document).on('touchstart', function(e) {

        var el = e.target;
        var elName = self.getAttr(el, 'name');

        // 이름이 없거나, 'btn_drag' 이름이 아닌 경우 
        var nodeName = el.nodeName.toUpperCase();
        if (nodeName !== ( 'I' || 'A' || 'BUTTON')) {
          return;
        }
        if (el.nodeName.toUpperCase().match('BUTTON') && elName !== 'btn_drag') {
          return;
        }

        self.startDrag(e.target, e.originalEvent.touches[0].pageY);
        self.unselectMenu();

        // register event
        if (self.swiper) {
          self.swiper.on('touchMove', function(e) {
            self.moveDrag(e.touches.currentY);
          });
        } else {
          $(document).on('touchmove', function(e) {
            e.preventDefault();
            self.moveDrag(e.originalEvent.touches[0].pageY);
          });
        }        

        $(document).on('touchend', function(e) {
          self.swiper.off('touchMove');
          $(document).off('touchend');

          self.stopDrag();
        });        
      });     
    }
  });

  app.getMenuTreeManager = function() {    
    return new MenuTreeManager();
  };
})(jsux.app, jQuery);

//-- MenuInfoView
(function(app, $) {

  var ListManager = jsux.app.ListManager;
  var MenuInfoView = jsux.View.create();
   MenuInfoView.include({

    id: '',
    tmpl: '',
    markup: '',
    model: null,
    swiper:null,
    
    initialize: function(data) {

      for (var p in data) {
        this[p] = data[p];
      }
    },
    validate: function() {

      if (!this.id) {
        jsux.logger.error('\'' + this.id + '\' 아이디 식별자를 입력하세요.', 'menu_manager.js');
        return false;
      }

      if ($(this.id).length < 1) {
        jsux.logger.error('\'' + this.id + '\' 아이디 DOM 객체가 존재하지 않습니다.', 'menu_manager.js');
        return false;
      }

      this.markup = $(this.tmpl);
      if (this.markup.length < 1) {
        jsux.logger.error('\'' + this.id + '\' 템플릿 DOM 객체가 존재하지 않습니다.', 'menu_manager.js');
        return false;
      }

      return true;
    },
    getModel: function() {
      
      return this.model;
    },
    setData: function(data) {

      if (!this.validate()) return;

      this.model = data || {};

      this.setLayout();
      this.setEvent();      
    },
    setLayout: function() {

      $(this.id).find('.sx_menu_info').remove();
      $(this.markup).tmpl(this.model).appendTo(this.id);
     
      this.swiper = jsux.plugin.createSwiper('.swiper_container_draggable_edit');
      this.swiper.update();
    },
    setEvent: function() {

      var self = this;

      $('form[name=f_admin_menu_modify]').on('submit', function(e) {
        e.preventDefault();

        $.each(self.model, function(key, value) {
          if (e.target[key] && e.target[key].value) {
            self.model[key] = e.target[key].value;
          }          
        });

        self.dispatchEvent({type: 'submit', target:self, model: self.model});
      });
    },
    showPanel: function() {

      ListManager.addClass('#SlidingBoxPanel', 'sx_sliding_box_active');
    },
    hidePanel: function() {

      var self = this;

      ListManager.removeClass('#SlidingBoxPanel', 'sx_sliding_box_active');

      $('#SlidingBoxPanel').on('transitionend', function(e) {
        $(this).off('transitionend');
        self.removePanel();        
      });
    },
    removePanel: function() {
      
      $('.sx_menu_info').remove();
    },
    update: function(data) {

      if (!this.validate()) return;

      this.model = data || {};
      this.setLayout();
      this.setEvent();
    }
   });

   app.getMenuInfoView = function() {
    return new MenuInfoView();
   };
})(jsux.app, jQuery);

//-- ServiceManager
(function(app, $) {

  var ServiceManagerEvent = jsux.Class.create();
  ServiceManagerEvent.extend({
    UPDATE_COMPLETE: 'updateComplete',
    DELETE_COMPLETE: 'deleteComplete',
    SAVE_COMPLETE: 'saveComplete'
  });
  var ServiceManager = jsux.Model.create();  
  ServiceManager.include({

    save_url: '',
    menu_url: '',

    update: function(data) {

      var self = this;

      if (!data._method) {
        data._method = 'update';
      }

      jsux.getJSON(this.menu_url, data, function(e) {

        if (e.result.toUpperCase() === 'N') {
          trace(e.msg);
          return;
        }        
        self.dispatchEvent({type:ServiceManagerEvent.UPDATE_COMPLETE, target: self, event: e})
      });
    },
    delete: function(data) {

      var self = this;

      if (!data._method) {
        data._method = 'delete';
      }

      jsux.getJSON(this.menu_url, data, function(e) {

         if (e.result.toUpperCase() === 'N') {
          trace(e.msg);
          return;
        }   
        self.dispatchEvent({type:ServiceManagerEvent.DELETE_COMPLETE, target: self, event: e})
      });
    },
    saveJson: function(data) {

      var self = this;

      jsux.getJSON(this.save_url, data, function(e) {

        trace(e.msg);

        self.dispatchEvent({type:ServiceManagerEvent.SAVE_COMPLETE, target: self, event: e})
      });
    }
  });

  app.ServiceManagerEvent = ServiceManagerEvent;
  app.getServiceMonager = function() {
    return new ServiceManager();
  };
})(jsux.app, jQuery);

// App Stage
(function(app, $) {

  var ServiceManagerEvent = jsux.app.ServiceManagerEvent;

  app.fn = jsux.fn || {};
  app.fn.list = {

    limit: 10,
    limitGroup: 5,
    listManager: jsux.app.getMenuListManager(),
    treeManager: jsux.app.getMenuTreeManager(),
    serviceManager: jsux.app.getServiceMonager(),
    menuInfoView: jsux.app.getMenuInfoView(),
    listSwiper: null,
    treeSwiper: null,

    getMenuModel: function() {

      var model = {        
        id:'',
        sid: '',
        category: '',
        menu_name:'',
        url:'#',
        url_target:'_self',
        depth:1,        
        isClicked:false,        
        isModified:false,
        isDragging:false,
        is_active: 1,
        
        posy:0,
        state:'default',
        badge:0,
        sub:[],
        top: 0,
        
        date:''
      };

      return model;
    },
    addMenu: function(id) {

      if (!this.treeManager.hasItem(id)) {
        var menu = this.listManager.getItem(id);
        this.treeManager.addItem(menu);
        this.editableSelectedMenu();
      }       
    },
    addCustomizeMenu: function(menu) {

      if (!this.treeManager.hasItem(menu.id)) {
        this.treeManager.addItem(menu);
        this.editableSelectedMenu();
      }       
    },
    addMenues: function(models) {

      var self = this;
      var searchManager = (function f(list) {

        for (var i=0; i<list.length; i++) {
          self.addMenu(list[i].id);
        }

        for (var j=0; j<list.length; j++) {
          if (list[j] && list[j].sub && list[j].sub.length > 0) {
            self.selectMenu(list[j].id);
            arguments.callee(list[j].sub);
          }
        }
      })(models);
    }, 
    removeTreeMenu: function(id) {

      if (this.treeManager.hasItem(id)) {
        this.treeManager.cutItem(id);
      }
    },
    selectMenu: function(id) {

      this.treeManager.selectMenu(id);
    },
    unselectMenu: function() {    

      this.treeManager.unselectMenu();
    },
    editableSelectedMenu: function() {

      this.treeManager.editable();
    },
    uneditableSelectedMenu: function() {

      this.treeManager.uneditable();
    },
    modifyMenuInfo: function(id) {

      var item = this.treeManager.getItem(id);
      this.menuInfoView.showPanel();
      this.menuInfoView.update(item);
    },
    canceModifyMenu: function() {

     this.menuInfoView.hidePanel();
    },

    /* business logic */
    updateModifyInfo: function() {

      var params = this.menuInfoView.getModel();

      this.treeManager.updateItem(params);
      this.serviceManager.update(params);      
    },
    saveJson: function() {

      var params = {
        _method: 'insert',
        data: JSON.stringify({data: this.treeManager.getModel()})
      };

      this.serviceManager.saveJson(params);
    },
    checkLangKor: function( value ) {

      var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
      return reg.test( value );
    },
    checkFormVal: function( f ) {

      var labelList = ['메뉴 이름을'];
      var inputList = ['menu_name'];
      var isValidForm = true;

      $.each( inputList, function( index, item) {
        var $input = f[item];

        if ($input.value.length < 1) {
          trace(labelList[index] + ' 입력 하세요.');
          $input.focus();
          isValidForm = false;
          return false;
        }
      });

      if (!isValidForm) {
        return false;
      }

      return true;  
    },
    createCustomizeMenu: function( f ) {

      var self = this,
            params = {},
            datas = f,
            url = '';

      $.each(datas, function( index, item ) {

        var filters = 'checkbox|button|submit',
              type = $(item).attr('type') ? $(item).attr('type') : item.nodeName,
              glue ='';

       if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      });

      /*$.each(params, function( index, item ) {
        console.log(index + ' : ' + item);
      });*/
      var date = new Date();
      var model = self.getMenuModel();
      model.id = date.getTime();
      model.category = 'menu_' + date.getTime();

      $.each(model, function(key) {
       
        if (params[key]) {          
          model[key] = params[key];
        }            
      });

      this.addCustomizeMenu(model); 
      this.editableSelectedMenu();
    },
    setEvent: function() {

      var self = this;

      $('form[name=f_admin_menu_add]').on('submit', function( e ) {
        e.preventDefault();

        if (self.checkFormVal(this)) {
          self.createCustomizeMenu( e.target );
        }
      });

      $('button[name=edit_menu]').on('click', function(e) {
        self.editableSelectedMenu();
      });

      $('button[name=save_json]').on('click', function(e) {
        self.saveJson();
      });
    },
    getConfig: function() {

      return {
        gnbJsonUrl : $('input[name=gnb_json_path]').val(),
        listJsonUrl : $('input[name=list_json_url]').val(),
        saveJsonUrl : $('input[name=save_json_url]').val(),
        menuUrl : $('input[name=menu_url]').val(),
        params : {
          passover: 0,
          limit: this.limit
        }
      };
    },
    setListManger: function() {

      var self = this;
      var config = this.getConfig();
      var listSwiper = jsux.plugin.createSwiper('.swiper_container_item_list');
      
      var changeHandler = function( e ) {
        console.log('type : ', e.type);
        //self.listManager.reloadData( e.page, limit);
      };

      //this.listManager.addEventListener('loaded', loadedHandler);
      this.listManager.addEventListener('modify', changeHandler);
      this.listManager.addEventListener('remove', changeHandler);
      this.listManager.setResource(config.listJsonUrl);
      this.listManager.setSwiper(listSwiper);
      this.listManager.initialize({
        id: '#addableMenuList',
        tmpl: '#menuListTmpl',
        msg_tmpl: '#warnMsgTmpl'
      });      

      if (!config.listJsonUrl) {
        trace('input[name=gnb_json_path] 경로값을 입력하세요');
        return;
      }

      jsux.getJSON(config.listJsonUrl, config.params, function( e )  {

        var data = e.data;
        if (data && data.list && data.list.length > 0) {

          // 서버에서 받은 값을 model 객체 값에 맞게 저장 
          var collection = [];
          $.each(data.list, function(index) {
            
            var model = self.getMenuModel();
            $.each(model, function(key) {
              if (data.list[index][key]) {
                model[key] = data.list[index][key];
              }            
            });

            collection.push(model);
          });
          self.listManager.setData(collection);
          self.listManager.updateSwiper();
        } else {

          e.msg = e.msg ? e.msg : '설정된 메뉴가 존재하지 않습니다.';

          self.listManager.reset();          
          self.listManager.setMsg(e.msg);
        }
      });
    },
    setTreeManager: function() {

      var self = this;
      var config = this.getConfig();
      var swiper = jsux.plugin.createSwiper('.swiper_container_draggable_list');      
      var loadedHandler = function(e) {
        //console.log('loaded : model.name = ' + e.model.name);
      };

      this.treeManager.addEventListener('loaded', loadedHandler);
      this.treeManager.setResource(config.gnbJsonUrl);
      this.treeManager.setSwiper(swiper);
      this.treeManager.initialize({
        id: '#selectedMenuList',
        tmpl: '#treeListTmpl',
        msg_tmpl: '#warnMsgTmpl'
      });      

      if (!config.gnbJsonUrl) {
        trace('input[name=gnb_json_path] 경로값을 입력하세요');
        return;
      }

      jsux.getJSON(config.gnbJsonUrl, config.params, function( e )  {

        var data = e.data;

        if (data && data.list && data.list.length > 0) {
          var collection = [];

          $.each(data.list, function(index) {
            var model = self.getMenuModel();

            $.each(model, function(key) {
              if (data.list[index][key]) {
                model[key] = data.list[index][key];
              }            
            });

            collection.push(model);
          });

          self.treeManager.setData(collection);
          self.treeManager.updateSwiper();
        } else {

          e.msg = e.msg ? e.msg : '설정된 메뉴가 존재하지 않습니다.';

          self.treeManager.reset();          
          self.treeManager.setMsg(e.msg);
        }
      });
    },
    setServiceManger: function() {

      var self = this;
      var config = this.getConfig();
      var serviceUpdateHandler = function(e) {

        //console.log(e.event.data);
        switch(e.type) {
          case ServiceManagerEvent.UPDATE_COMPLETE:
            self.canceModifyMenu();
            break;

          case ServiceManagerEvent.DELETE_COMPLETE:
            break;

          case ServiceManagerEvent.SAVE_COMPLETE:
            self.uneditableSelectedMenu();
            break;

          default:
            break;
        }
      };
      this.serviceManager.save_url = config.saveJsonUrl;
      this.serviceManager.menu_url = config.menuUrl;
      this.serviceManager.addEventListener(ServiceManagerEvent.UPDATE_COMPLETE, serviceUpdateHandler);
      this.serviceManager.addEventListener(ServiceManagerEvent.SAVE_COMPLETE, serviceUpdateHandler);
    },
    setMenuInfoView: function() {

      var self = this;
      var menuInfoSubmit = function(e) {

        //console.log(e.model);
        self.updateModifyInfo();
      };

      this.menuInfoView.initialize({
        id: '#SlidingBoxPanel',
        tmpl: '#menuInfoTmpl'
      });      
      this.menuInfoView.addEventListener('submit', menuInfoSubmit);
    },
    setLayout: function() {

      this.setMenuInfoView();
      this.setTreeManager();
      this.setListManger();
      this.setServiceManger();
    },
    init: function() {
     
      this.setLayout();
      this.setEvent();
    }
  };
})(jsux, jQuery);

jsux.fn = jsux.fn || {};
jsux.fn.modify = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  getSelectVal: function( id ) {

    var result = $.trim($('select[name='+id+']').val());
    return result;
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getCheckboxVal: function( id ) {

    var result = '',
          list = $('input:checkbox[name^='+id+']:checked'),
          len = list.length;

    $(list).each(function(index){
      result += list[index].value;

      if (index < len-1) {
        result += ',';
      }
    });
    return result;
  },
  checkLangKor: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
    return reg.test( value );
  },
  checkFormVal: function( f ) {

    var labelList = ['메뉴이름을','링크주소를'];
    var checkList = ['menu_name','url'];

    $.each( checkList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        return false;
      }
    });

    return true;  
  },
  sendJson: function( f ) {

    var self = this;
    var params = {};
    var datas = f;
    var indexCheckbox = 0;
    var url = '';

    $.each(datas, function( index, item ) {

      var filters = 'checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName;
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        item.value = self.getSelectVal(item.name);
        params[item.name] = item.value;
      } else {

         if (!type.match(filters)) {
         //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }

      if (type === 'checkbox' && item.checked) {
        if (indexCheckbox === 0) {
          var name = item.name.substr(0, item.name.length-1);
          params[name] = self.getCheckboxVal(name);
        } 
        indexCheckbox++;          
      }
    });

    if (!f.action) {
      alert('Not Exists URL');
    }
    url = f.action;

    jsux.getJSON( url, params, function( e ) {
      
      if (e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;
    
    $('form[name=f_admin_menu_modify]').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target )) {
        self.sendJson( e.target );
      }
    });
  },
  setLayout: function() {

    /*jsux.setAutoFocus();*/
  },    
  init: function() {
    this.setLayout();
    this.setEvent();
  }
};

