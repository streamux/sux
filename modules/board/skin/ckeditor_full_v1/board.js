/**
 * write here  library and plugin
 */

document.write('<script src="' + jsux.rootPath +'libs/ckeditor/full_20171127/ckeditor.js"><\/script>');
///////////////////////////////////////////////

jsux.fn = jsux.fn || {};
jsux.fn.ckeditor = {

  updateElement: function(id) {

     CKEDITOR.instances[id].updateElement();
  },
  replace: function(id) {

    CKEDITOR.replace(id);
  }
};

jsux.fn.list = {

  checkSearchForm: function(f) {

    var search = f.search.value.length;
    if ( search < 1 ) {
      alert("검색어를 입력하세요.");
      f.search.focus();
      return false;
    }
    return true;
  },
  init: function() {
    
  }
};
jsux.fn.read = jsux.fn.read || {};

//-- CommentListManager
(function(app, $) {

  var ListManager = jsux.app.ListManager;
  var CommentManager = jsux.Model.create(ListManager);
  CommentManager.include({
    
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

  app.getCommentManager = function() {
    return new CommentManager();
  };
})(jsux.app, jQuery);

jsux.fn.read = {

  listManager: jsux.app.getCommentManager(),

  getCommentModel: function() {

    return {
      id: '',
      content_id: '',
      nickname: '',
      password: '',
      comment: '',
      voted_count: 0,
      blamed_count: 0,
      date: null
    };
  },
  checkSearchForm: function ( f ) {

    var searcho = f.search.value.length;
    if ( searcho < 1 ) {
      alert("검색어를 입력하세요.");
      f.search.focus();
      return false;
    }
    return true;
  },
  checkTailDocumentForm: function ( f ) {

    var nickname = f.nickname.value.length,
      password = f.password.value.length,
      comment = f.comment.value.length;

    if ( nickname < 1 ) {
      alert("이름을 입력하세요.");
      f.nickname.focus();
      return false;
    }else if ( password < 1 ) {
      alert("비밀번호를 입력하세요.");
      f.password.focus();
      return false;
    }else if ( comment < 1 ) {
      alert("내용을 입력하세요.");
      f.comment.focus();
      return false;
    }

    return true;
  },
  checkOpkeyForm: function ( f ) {

    var msg = "";

    for (var i=0; f.opkey.length; i++) {

      if (f.opkey[i].checked === true) {
        var key = f.opkey[i].value;

        if (key) {
          msg = key;  
        } else {
          msg = '초기화';
        }     
        break;
      }
    }
    msg += '를(을) 선택하였습니다.';
    alert(msg);
  },
  readComment: function() {

    var self = this,
          url = $('input[name=url_comment_json]').val();

    if (!url) {
      alert('Comment\'s url do not exists');
      return;
    }

    jsux.getJSON( url, function( e ) {
      var models = [];

      if (e.result.toUpperCase() === 'Y') {
        if (e.data) {
          var models = [];
          var data = e.data;

          data = data && data.length > 0 ? data : [data];

          for (var i=0, len=data.length; i<len; i++) {
            var model = self.getCommentModel();

            $.each(model, function(key) {

              if (data[i][key]) {
                model[key] = data[i][key];
              }            
            });
            models.push(model);
          }
          self.listManager.setData(models);   
        } //end of if         
      } else {
        trace( e.msg );
      } //end of if
    });
  },
  writeComment: function(f) {

    var self = this,
          params = {
            _method: 'insert'
          };

    $.each(f, function( index, item ) {

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
      var models = [];

      if (e.result.toUpperCase() === 'Y') {
        if (e.data) {
          var data = e.data;
          data = data.length ? data : [data];

          for (var i=0, len=data.length; i<len; i++) {
            var model = self.getCommentModel();

            $.each(model, function(key) {

              if (data[i][key]) {
                model[key] = data[i][key];
              }            
            });

            self.listManager.addItem(model);
          }          
        } //end of if         
      } else {
        trace( e.msg );
      } //end of if
    });
  },
  deleteComment: function(content_id) {

  },
  setEvent: function() {

    var self = this;

    $('form[name=f_comment]').on('submit', function(e) {
      
      e.preventDefault();

      if (self.checkTailDocumentForm(e.target)) {
        self.writeComment(e.target);
      }
    });
  },
  setLayout: function() {
    
    this.listManager.initialize({
      id: '#commentList',
      tmpl: '#boardTailCommentTmpl',
      msg_tmpl: '#warnMsgTmpl'
    });

    this.readComment();
  },
  init: function() {

    this.setLayout();
    this.setEvent();
  }
};
jsux.fn.write = {

  checkDocumentForm: function (f) {

    jsux.fn.ckeditor.updateElement('content');

    var labelList = ['이름을','비밀번호를','제목을','내용을','등록키를'];
    var checkList = ['user_name','password','title','content','wallname'];
    var email = f.email_address.value.length;
    var result = true;

    $.each( checkList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        result = false;
        return false;
      }
    });

    return result;
  },
  setEvent: function() {

    var self = this;
    $('form[name=f_board_write]').on('submit', function(e) {
      
      if (!self.checkDocumentForm(e.target)) {
        e.preventDefault();
      }
    });
  },
  setLayout: function() {

    jsux.fn.ckeditor.replace('content');
  },
  init: function() {

    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();  
  }
};
jsux.fn.reply = {

  checkDocumentForm: function (f) {

    jsux.fn.ckeditor.updateElement('content');

    var labelList = ['이름을','비밀번호를','제목을','내용을','등록키를'];
    var checkList = ['user_name','password','title','content','wallname'];
    var email = f.email_address.value.length;
    var result = true;

    $.each( checkList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        result = false;
        return false;
      }
    });

    return result;
  },
  setEvent: function() {

    var self = this;
    $('form[name=f_board_reply]').on('submit', function(e) {
      
      if (!self.checkDocumentForm(e.target)) {
        e.preventDefault();
      }
    });
  },
  setLayout: function() {

    jsux.fn.ckeditor.replace('content');
  },
  init: function() {

    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();  
  }
};
jsux.fn.modify = {

  checkDocumentForm: function (f) {

    jsux.fn.ckeditor.updateElement('content');

    var labelList = ['이름을','비밀번호를','제목을','내용을','등록키를'];
    var checkList = ['user_name','password','title','content','wallname'];
    var result = true;

    $.each( checkList, function( index, item) {

      var $input = f[item];
      if ($input.value.length < 1) {
        trace(labelList[index] + ' 입력 하세요.');
        $input.focus();
        result = false;
        return false;
      }
    });

    return result;
  },
  setEvent: function() {

    var self = this;
    $('form[name=f_board_modify]').on('submit', function(e) {     

      if (!self.checkDocumentForm(e.target)) {       
         e.preventDefault();
      }
    });
  },
   setLayout: function() {

    jsux.fn.ckeditor.replace('content');
  },
  init: function() {

    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();  
  }
};
jsux.fn.delete = {

  checkDocumentForm: function( f ) {

    var result = true;
    var pass = f.password.value.length;
    if ( pass < 1) {
      trace('비밀번호를 입력하세요.');
      f.password.focus();
      result = false;
      return false;       
    }
    return result;
  },
  setEvent: function (f) {

    var self = this;
    $('form[name=f_board_delpass]').on('submit', function(e) {      

      if (!self.checkDocumentForm(e.target)) {
        e.preventDefault();
      }
    });   
  },
  init: function() {
    this.setEvent();
    jsux.setAutoFocus();
  }
};
