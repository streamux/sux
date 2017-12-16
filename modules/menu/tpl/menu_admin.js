/** 
 * used class 'jsux.fn.listManager'
 * path 'common/js/app/jsux_list_manager.js'
 * author streamux.com
 * update 2017.10.18
 */

// MenuListManager
(function(app, $) {

  var ListManager = jsux.app.ListManager;
  var MenuListManager = jsux.Model.create(ListManager);
  MenuListManager.include({
    
    createMenu: function() {

      // 서비스 로직에 추가 
    },
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
      this.dispatchEvent({type:'add', target: this, model: item});
    },
    modify: function(menu) {

      // 서비스 로직에서 수정 
      //this.dispatchEvent({type:'modify', target:this, collection: this.model});
    },
    remove: function(menu) {

      // 서비스 로직에서 삭제 
      //this.dispatchEvent({type:'remove', this:this, collection: this.model});
    },
    getLength: function() {
      return this.model.length;
    }
  });

  app.getMenuListManager = function() {
    return new MenuListManager();
  };
})(jsux.app, jQuery);

// MenuTreeManager 
(function(app, $) {

  var ListManager = jsux.app.ListManager;
  var MenuTreeManager = jsux.Model.create(ListManager);
  MenuTreeManager.include({
    
    selectedModels: null, // 기본 값은 model
    selectedId: '',
    elid: '',
    currentItem: null,
    oldItem: null,
    editState: false,

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
    
    getJson: function() {

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
      this.dispatchEvent({type:'add', target: this, model: item});
    },
    cutItem: function(id) {

      if (this.model.length == 0) return;

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

      })(parentModels);

      searchMenu = null;

      this.deactivate(elCutitem);
      this.setData(this.model);
      this.dispatchEvent({type:'add', target: this, model: cutItem});

       return cutItem[0];
    },
    selectMenu: function(id) {

      var self = this;

      this.elId = this.id + ' > li';
      this.selectedId = id;

      var searchMenu = (function f(list) {

        for (var i=0; i<list.length; i++) {

          if (list[i].id == id) {
            if (self.oldItem)  {
              ListManager.removeClass(self.oldItem, 'selected_menu_active');
            }

            self.currentItem = $(self.elId).eq(i);
            ListManager.addClass(self.currentItem, 'selected_menu_active');

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

      })(this.model);

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
    edit: function() {

      var self = this;      
      var editId = this.id + ' > li';
      var editBtn = $('button[name=edit_seleced_menu]');

      this.editState = !this.editState;      
      this.setEdittingMode(editBtn, 'sx-btn-active');

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

      })(this.model);

      searchMenu = null;

      this.setData(this.model);
      this.updateSwiper();
    },
    setEdittingMode: function(item, className) {

      this.editState === true ? ListManager.addClass(item, className) : ListManager.removeClass(item, className);
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
        
      })(list);

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
    startDrag: function(e) {

      var pageY = this.getPageY(e);
      var el = $(e.target);

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

      this.dragItem$.css({'z-index':1000});
      ListManager.addClass(this.dragItem$[0], 'item_drag_true');
    },
    moveDrag: function(e) {

      var self = this;

      if (this.isDragging === false ) return;      

      var pageY = this.getPageY(e);

      // drag 클릭 위치 - drag top 위치의 차이 값
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
            movePosY += prevHeight; 

            // 드래그 아이템 top 오프셋 값 갱신 
            this.dragOffsetY -= prevHeight; 
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
            movePosY -= nextHeight;

            // 드래그 아이템 top 오프셋 값 갱신 
            this.dragOffsetY += nextHeight;
          }
        }
      } // end of if

      this.dragItem$.css({'top': movePosY});
      this.oldOffset = pageY;
    },
    stopDrag: function(e) {
   
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
    initialize: function(data) {
      
      var self = this;

      for (var p in data) {
        this[p] = data[p];
      }
      
      $(document).on('mousedown', function(e) {

        e.preventDefault();        

        var el = e.target;
        var elName = self.getAttr(el, 'name');

        // 이름이 없거나, 'btn_drag' 이름이 아닌 경우 
        var nodeName = el.nodeName.toUpperCase();
        if (!(nodeName === 'I' || nodeName === 'A' || nodeName === 'BUTTON')) {
          self.unselectMenu();
          return;
        }
        if (el.nodeName.toUpperCase().match('BUTTON') && elName !== 'btn_drag') {          
          return;
        }

        self.startDrag(e);        
      }); 

      $(document).on('mousemove', function(e) {

        e.preventDefault();
        self.moveDrag(e);
      });
      
      $(document).on('mouseup', function(e) {        

        e.preventDefault();
        self.stopDrag(e);
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

        $('body').on('touchmove', function(e) {
          e.preventDefault();
        });

        self.startDrag(e);
        self.unselectMenu();
      }); 

      $('#selectedMenuList').on('touchmove', function(e) {

        e.preventDefault();
        self.moveDrag(e);
      });

      $(window).on('touchend', function(e) {

        $('body').off('touchmove', function(e) {
          e.preventDefault();
        });

        e.preventDefault();
        self.stopDrag(e);
      });
    }
  });

  app.getMenuTreeManager = function() {    
    return new MenuTreeManager();
  };
})(jsux.app, jQuery);

// ServiceManager
(function(app, $) {

  var ServiceManager = jsux.Model.create();
  ServiceManager.include({

    save_url: '',
    delete_url: '',

    delete: function(data) {

      jsux.getJSON(this.delete_url, data, function(e) {
        console.log(e);
      });
    },
    saveJson: function(data) {

      jsux.getJSON(this.save_url, data, function(e) {
        console.log(e);
      });
    }
  });

  app.getServiceMonager = function() {
    return new ServiceManager();
  };
})(jsux.app, jQuery);

// App Stage
jsux.fn = jsux.fn || {};
jsux.fn.list = {

  limit: 10,
  limitGroup: 5,
  listManager: jsux.app.getMenuListManager(),
  treeManager: jsux.app.getMenuTreeManager(),
  serviceManager: jsux.app.getServiceMonager(),
  listSwiper: null,
  treeSwiper: null,

  getMenuModel: function() {

    var model = {
      badge:0,
      id:'',
      isClicked:false,
      isDragging:false,
      isModified:false,
      name:'',
      posy:0,
      state:'default',
      sub:[],
      top:'0px',
      url:'',
      date:''
    };

    return model;
  },
  addMenu: function(id) {

    if (!this.treeManager.getItem(id)) {
      var menu = this.listManager.cutItem(id);
      this.treeManager.addItem(menu);
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

    if (!this.listManager.getItem(id)) {
      var menu = this.treeManager.cutItem(id);
      this.listManager.addItem(menu);
    }    
  },
  selectMenu: function(id) {

    this.treeManager.selectMenu(id);
  },
  unselectMenu: function() {    

    this.treeManager.unselectMenu();
  },
  editSelectedMenu: function() {

    this.treeManager.edit();
  },
  modifyInfo: function(id) {

    console.log('modify list menu');
  },
  removeMenu: function(id) {

    this.listManager.cutItem(id);

     var params = {
      _method: 'delete',
      id: id
    };

    this.serviceManager.delete(params);
    this.saveJson();
  },
  saveJson: function() {

    var params = {
      _method: 'insert',
      data: JSON.stringify({data: this.treeManager.getJson()})
    };

    this.serviceManager.saveJson(params);
  },
  setSwiper: function(className, option) {

    if (!option) {
      option = {
        scrollbar: '.swiper-scrollbar',
        direction: 'vertical',
        slidesPerView: 'auto',
        mousewheelControl: true,
        freeMode: true
      };
    }

    var swiper = new Swiper(className, option);
    return swiper;
  },
  checkLangKor: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;
    return reg.test( value );
  },
  checkFormVal: function( f ) {

    var labelList = ['메뉴 영문 이름을'];
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
  sendJson: function( f ) {

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

    if (!f.action) {
      alert('Not Exists URL');
    }
    url = f.action;

    jsux.getJSON( url, params, function( e ) {

      trace( e.msg );     
      if (e.result == 'Y') {
        jsux.goURL( jsux.rootPath + 'login');
      }
    });
  },
  setEvent: function() {

    var self = this;
    $('form[name=f_admin_menu_add]').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal(this)) {
        self.sendJson( e.target );
      }
    });
  },
  setLayout: function() {

    var self = this,
          listUrl = $('input[name=list_json_path]').val(),
          menuUrl = $('input[name=tree_json_path]').val(),
          saveUrl = $('input[name=save_tree_url]').val(),
          deleteUrl = $('input[name=delete_tree_url]').val(),
          params = {
            passover: 0,
            limit: this.limit
          };

    if (!listUrl) {
      trace('input[name=list_json_path] 경로값을 입력하세요');
      return;
    }

    var loadedHandler = function(e) {

      console.log('loaded : model.name = ' + e.model.name);
    };
    this.treeManager.addEventListener('loaded', loadedHandler);
    this.treeManager.setResource(menuUrl);
    this.treeManager.initialize({
      id: '#selectedMenuList',
      tmpl: '#treeListTmpl',
      msg_tmpl: '#warnMsgTmpl'
    });

    var changeHandler = function( e ) {
      console.log('type : ', e.type);
      //self.listManager.reloadData( e.page, limit);
    };

    //this.listManager.addEventListener('loaded', loadedHandler);
    this.listManager.addEventListener('modify', changeHandler);
    this.listManager.addEventListener('remove', changeHandler);
    this.listManager.setResource(listUrl);
    this.listManager.initialize({
      id: '#addableMenuList',
      tmpl: '#menuListTmpl',
      msg_tmpl: '#warnMsgTmpl'
    });

    this.serviceManager.save_url = saveUrl;
    this.serviceManager.delete_url = deleteUrl;

    if (!saveUrl) {
      trace('input[name=save_tree_url] 경로값을 입력하세요');
      return;
    }

    jsux.getJSON(listUrl, params, function( e )  {

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
      } else {
        self.listManager.reset();
        e.msg = e.msg ? e.msg : '설정된 메뉴가 존재하지 않습니다.';
        self.listManager.setMsg(e.msg);
      }
    });

    if (!menuUrl) {
      trace('input[name=tree_json_path] 경로값을 입력하세요');
      return;
    }

    jsux.getJSON(menuUrl, params, function( e )  {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {

        var collection = data.list;
        var checkLoadded = setInterval(function() {

          if (self.listManager.getLength() > 0) {

            self.addMenues(collection);
            self.unselectMenu();
            
            clearInterval(checkLoadded);
            checkLoadded = null;
          }
        }, 100);        
      } else {
        self.treeManager.reset();
        e.msg = e.msg ? e.msg : '설정된 메뉴가 존재하지 않습니다.';
        self.treeManager.setMsg(e.msg);
      }
    });   
  },
  init: function() {

    var listSwiper = this.setSwiper('.swiper_container_item_list', {
      scrollbar: '.swiper-scrollbar',
      direction: 'vertical',
      slidesPerView: 'auto',
      mousewheelControl: true,
      freeMode: true
    });

    var treeSwiper = this.setSwiper('.swiper_container_draggable_list', {
      scrollbar: '.swiper-scrollbar',
      direction: 'vertical',
      slidesPerView: 'auto',
      mousewheelControl: true,
      freeMode: true
    });

    this.listManager.setSwiper(listSwiper);
    this.treeManager.setSwiper(treeSwiper);

    this.setEvent();
    this.setLayout();    

    jsux.setAutoFocus();
  }
};

/*
jsux.fn = jsux.fn || {};
jsux.fn.modify = {

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
  }
  checkFormVal: function( f ) {

    var labelList = ['아이디를','비밀번호를','닉네임을','이메일을'];
    var checkList = ['user_id','password','nick_name','email_address'];

    $.each( checkList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        return false;
      }
    });

    if (!this.validateEmail()) {     
      return false;
    }

    if (!this.validatePassword()) {      
       return false;
    }  

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

    var updateLoginHandler = function( url ) {

      var params = {
        _method:'insert'
      };

      jsux.getJSON( url, params, function(e) {

        if  (e.result.toUpperCase() === 'Y') {
          jsux.goURL( jsux.rootPath + 'login');
        }
      });
    };

    jsux.getJSON( url, params, function( e ) {

      trace( e.msg );
      if (e.result.toUpperCase() === 'Y') {
        updateLoginHandler( jsux.rootPath + 'login');
      }
    });
  },
  setEvent: function() {

    var self = this;
    
    $('form[name=f_member_modify]').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target )) {
        self.sendJson( e.target );
      }
    });

    $('input[name=cancel]').on('click', function(e) {     
      jsux.goURL( jsux.rootPath + 'login' );
    });

    $('input[name=new_password_conf]').on('blur', function(e) {      
      self.validatePassword();
    }); 

    $('input[name=check_newpassword]').on('click', function() {
      self.checkPWD();
    });    

    $('input[name=hp]').on('keyup', function(e) {
      self.validateHp(e);
    });

    $('input[name=hp]').on('blur', function(e) {
      $('input[name=hp]').off('keydown');
    });
  },
  setLayout: function() {

    jsux.setAutoFocus();
  },    
  init: function() {
    this.setLayout();
    this.setEvent();
  }
};
*/
