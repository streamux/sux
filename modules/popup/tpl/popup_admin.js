jsux.fn = jsux.fn || {};
jsux.fn.list = {
    
  setEvent: function() {
    //popupManager.open();
    var self = this;
    $(".popup > a").bind("click", function(e) {
      var id = $(this).data('key');
      popupManager.open( id );
    });
  },
  setLayout: function() {

    var self = this;
    jsux.getJSON(jsux.rootPath + "popup-admin/list-json", function( e )  {
    
      var markup = "";
      $("#popupList").empty();

      if (e.result == "Y") {
        markup = $("#popupList_tmpl");
        $(markup).tmpl(e.data.list).appendTo("#popupList");       
      } else {
        markup = $("#popupWarnMsg_tmpl");
        $(markup).tmpl( e ).appendTo("#popupList");
      }

      self.setEvent();
    });
  },
  init: function() {
    this.setLayout();   
  }
};
jsux.fn.add = {

  getSelectVal: function( id ) {

    var result = $.trim($("select[name="+id+"]").val());
    return result;
  },
  setSelectVal:function( id, value ) {

    $("select[name="+id+"]").val( value );
  },
  getTextAreaVal: function( id ) {

    var result = $("textarea[name="+id+"]").val();
    return result;
  },
  setTextAreaVal: function( id, value ) {

    $("textarea[name="+id+"]").val( value );
  },
  checkLangKor: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

    return reg.test( value );
  },    
  chechFormVal: function( f ) {

    var name = f.popup_name.value.length;

    if ( name < 1 ) {
      trace("팝업이름을 입력하세요.");
      f.popup_name.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var self = this,
      params = {},
      indexCheckbox = 0;

    $.each(f, function(index, item) {

      var filters = 'checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        //console.log(item.name + ' : ' + item.value);
        item.value = self.getSelectVal(item.name);          
        params[item.name] = item.value;
      } else if (type === 'radio' && item.checked) {
        //console.log(item.name + ' : ' + item.value);
        params[item.name] = item.value;       
      } else {
         if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }     
    });

    var url = f.action;
    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON( url, params, function( e ) {

      trace( e.msg );
      if (e.result == "Y") {
        jsux.goURL(jsux.rootPath + menuList[3].menu[0].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $("form").on("submit", function( e ) {

      var bool;
      e.preventDefault();

      bool = self.chechFormVal( e.target );
      if (bool === true) {
        self.sendJson( e.target );
      }     
    });

    $("input[name=cancel]").on("click", function() {
      jsux.goURL(jsux.rootPath + menuList[3].menu[0].link);
    });
  },
  init: function() {

    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn.modify = {

  getSelectVal: function( id ) {

    var result = $.trim($("select[name="+id+"]").val());

    return result;
  },
  setSelectVal:function( id, value ) {

    $("select[name="+id+"]").val( value );
  },
  getTextAreaVal: function( id ) {

    var result = $("textarea[name="+id+"]").val();

    return result;
  },
  setTextAreaVal: function( id, value ) {

    $("textarea[name="+id+"]").val( value );
  },
  chechFormVal: function( f ) {
    
  },
  sendJson: function( f ) {

    var self = this,
      params = {},
      indexCheckbox = 0;

    $.each(f, function(index, item) {

      var filters = 'checkbox|button|submit';
      var type = $(item).attr('type') ? $(item).attr('type') : item.nodeName.toLowerCase();
      var glue ='';

      if (item.nodeName.toLowerCase() === 'select') {
        //console.log(item.name + ' : ' + item.value);
        item.value = self.getSelectVal(item.name);          
        params[item.name] = item.value;
      } else if (type === 'radio' && item.checked) {
        //console.log(item.name + ' : ' + item.value);
        params[item.name] = item.value;       
      } else {
         if (!type.match(filters)) {
          //console.log(item.name + ' : ' + item.value);          
          params[item.name] = item.value;
        }
      }     
    });

    var url = f.action;
    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON(url, params, function( e ) {

      trace( e.msg );

      if (e.result == "Y") {
        jsux.goURL(jsux.rootPath + menuList[3].menu[0].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $("form").on("submit", function( e ) {

      e.preventDefault();

      self.sendJson( e.target );      
    });

    $("input[name=cancel]").on("click", function() {

      jsux.goURL(jsux.rootPath + menuList[3].menu[0].link);
    });
  },
  setLayout: function() {

    var self = this,
      params = {
        id: $("input[name=id]").val()
      };

    jsux.getJSON(jsux.rootPath + "popup-admin/modify-json", params, function( e ) {

      var formLists = null,
        checkedVal = "",
        markup = null,
        labelList = null,
        list = null;

      if (e.result == "Y") {
        list = e.data.list[0]; 

        formLists = $("input[type=text]");
        $(formLists).each(function(index) {
          if (list[this.name]) {
            this.value = list[this.name];
          }
        });

        formLists = $("select");
        $(formLists).each(function(index) {

          if (list[this.name]) {
            this.value = list[this.name];             
          }           
        });

        
        labelList = $("table tr").find(".view-type-textfield");

        markup = $("#popupLabel_tmpl");
        $(labelList).each(function(index) {

          var label = "",
            data = "";

          label = $(labelList[index]).attr("id");   
          data = {label: list[label]};

          $("#"+label).empty();
          $(markup).tmpl( data ).appendTo("#"+label);
        });

        self.setTextAreaVal("contents", list.contents); 
      } else {
        trace( e.msg );
      }

      jsux.setAutoFocus();
    });
  },
  init: function() {

    this.setLayout();
    this.setEvent();
  }
};
jsux.fn.delete = {

  sendJSON: function() {

    var params = {
      _method: 'delete',
      id : $("input[name=id]").val(),
      popup_name : $("input[name=popup_name]").val()
    };
    jsux.getJSON(jsux.rootPath + "popup-admin/delete", params, function( e )  {

      trace( e.msg );
      if (e.result == "Y") {
        jsux.goURL(jsux.rootPath + menuList[3].menu[0].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $(".articles .del .box ul > li > a").on("click", function( e ) {

      e.preventDefault();
      var key = $(this).data("key");

      if (key == "del") {
        self.sendJSON();
      } else if (key == "back") {
        jsux.goURL(jsux.rootPath + menuList[3].menu[0].link);
      }
    });     
  },
  init: function() {
    this.setEvent();
  }
};