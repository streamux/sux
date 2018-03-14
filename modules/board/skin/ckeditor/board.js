jsux.fn = jsux.fn || {};
jsux.fn.ckeditor = {

  updateElement: function(id) {

     CKEDITOR.instances[id].updateElement();
  },
  replace: function(id) {

    var editConfig = {
      height:'350px',
      toolbar: [            
        { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
        { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Superscript', 'Subscript', 'Strike', 'RemoveFormat', 'CopyFormatting' ] },
        { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
        { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },     
        { name: 'insert', items: [ 'Image', '-', 'Youtube', '-', 'Table', '-', 'HorizontalRule' ] },
        { name: 'document', items: [ 'Print' ] },
        '/',        
        { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
        { name: 'links', items: [ 'Link', 'Unlink' ] },
        { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },    
        { name: 'editing', items: [ 'Scayt', '-' , 'Source' ] },
        { name: 'tools', items: [ 'Maximize' ] }
      ]
    };

    CKEDITOR.replace(id, editConfig); 
  }
};

jsux.fn.list = {

  checkSearchForm: function(f) {

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
  setEvent: function() {

    var self = this;

    $('form[name=f_board_list_search]').on('submit', function(e) {

      var bool = self.checkSearchForm(e.target);
      if (!bool) {
        e.preventDefault();
      }
    });
  },
  init: function() {

    this.setEvent();
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
      user_id: '',
      nickname: '',
      password: '',
      comment: '',
      voted_count: 0,
      blamed_count: 0,
      date: null
    };
  },
  checkTailDocumentForm: function ( f ) {

    var comment = f.comment;

    if ( comment.value.length < 1 ) {
      alert("내용을 입력하세요.");
      comment.focus();
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
      alert('Read Comment\'s url do not exists');
      return;
    }

    jsux.getJSON( url, function( e ) {
      
      if (e.result.toUpperCase() === 'Y') {
        if (e.data) {
          var models = [];
          var data = e.data;

          for (var i=0, len=data.length; i<len; i++) {
            var model = self.getCommentModel();

            $.each(model, function(key) {

              if (data[i][key]) {
                model[key] = data[i][key];
              }            
            });
            models.push(model);
          }
          self.listManager.msg = '등록된 댓글이 존재하지 않습니다.';
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

            f.comment.value = '';
          }          
        } //end of if         
      } else {
        trace( e.msg );
      } //end of if
    });
  },
  voteComment: function(id) {

    var self = this,
          params = {
            _method: 'update',
            id: id
          },
          form = $('form[name=f_comment]')[0],
          url = '';

    if (!form.action) {
      alert('Vote Comment\'s url do not exists');
      return;
    }
    url = form.action;

    jsux.getJSON( url, params, function( e ) {

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
            self.listManager.updateItem(model);
          }          
        } //end of if       
      } else {
        trace( e.msg );
      } //end of if  
    });
  },
  deleteComment: function(contentId, id) {

    var self = this,
          params = {
            _method: 'delete',
            content_id: contentId,
            id: id,
            category: $('input[name=category]').val()
          },
          form = $('form[name=f_comment]')[0];

    if (!form.action) {
      alert('Delete Comment\'s url do not exists');
      return;
    }

    url = form.action;
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

            self.listManager.cutItem(model.id);
          }          
        } //end of if       
      } else {
        trace( e.msg );
      } //end of if  
    });
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
    var checkList = ['nickname','password','title','content','wallname'];
    var email = f.email_address;
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

    if (email && email.value && email.value.length > 0) {
      var mailFlag = jsux.utils.validateEmail(email.value);

      if (!mailFlag) {
        trace('이메일 주소가 잘못되었습니다.');
        email.focus();
        result = false;
      }
    }

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
    var checkList = ['nickname','password','title','content','wallname'];
    var email = f.email_address;
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

    if (email && email.value && email.value.length > 0) {
      var mailFlag = jsux.utils.validateEmail(email.value);

      if (!mailFlag) {
        trace('이메일 주소가 잘못되었습니다.');
        email.focus();
        result = false;
      }
    }

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
    var checkList = ['nickname','password','title','content','wallname'];
    var email = f.email_address;
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

    if (email && email.value && email.value.length > 0) {
      var mailFlag = jsux.utils.validateEmail(email.value);

      if (!mailFlag) {
        trace('이메일 주소가 잘못되었습니다.');
        email.focus();
        result = false;
      }
    }

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
