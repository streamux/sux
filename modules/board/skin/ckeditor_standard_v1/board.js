/**
 * write in here  library and plugin
 */

document.write('<script src="' + jsux.rootPath +'libs/ckeditor/standard_20171127/ckeditor.js"><\/script>');
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
jsux.fn.read = {

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
  setEvent: function() {

    var self = this;

    $('form[name=f_comment]').on('submit', function(e) {
      
      if (!self.checkTailDocumentForm(e.target)) {
        e.preventDefault();
      }
    });
  },
  setLayout: function() {
    
  },
  init: function() {

    this.setLayout();
    this.setEvent();
  }
};
jsux.fn.write = {

  checkDocumentForm: function (f) {

    jsux.fn.ckeditor.updateElement('contents');

    var labelList = ['이름을','비밀번호를','제목을','내용을','등록키를'];
    var checkList = ['user_name','password','title','contents','wallname'];
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
    
    jsux.fn.ckeditor.replace('contents');
  },
  init: function() {

    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();  
  }
};
jsux.fn.reply = {
  
  checkDocumentForm: function (f) {

    jsux.fn.ckeditor.updateElement('contents');

    var labelList = ['이름을','비밀번호를','제목을','내용을','등록키를'];
    var checkList = ['user_name','password','title','contents','wallname'];
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

    jsux.fn.ckeditor.replace('contents');
  },
  init: function() {

    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();  
  }
};
jsux.fn.modify = {

  checkDocumentForm: function (f) {

    jsux.fn.ckeditor.updateElement('contents');

    var labelList = ['이름을','비밀번호를','제목을','내용을','등록키를'];
    var checkList = ['user_name','password','title','contents','wallname'];
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

    jsux.fn.ckeditor.replace('contents');
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
