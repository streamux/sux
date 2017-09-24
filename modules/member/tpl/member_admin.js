jsux.fn = jsux.fn || {};
jsux.fn.groupList = {

  setLayout: function() {

    jsux.getJSON( jsux.rootPath + 'member-admin/group-json', function( e )  {

      var   func = {
          editDate: function( value ) {
            var list = value.split(' ');
            return list[0];
          }
        },
        markup = '';

      $('#memberList').empty();

      if (e.result == 'Y') {

        if (e.data.length > 0) {
          markup = $('#memberList_tmpl');
          $(markup).tmpl(e.data, func).appendTo('#memberList');
        } else {            
          markup = $('#memberWarnMsg_tmpl');
          $(markup).tmpl( e ).appendTo('#memberList');
        }           
      } else {
        markup = $('#memberWarnMsg_tmpl');
        $(markup).tmpl( e ).appendTo('#memberList');
      }
    });
  },
  init: function() {

    this.setLayout();
  }
};
jsux.fn.groupAdd = {

  checkLang: function( value ) {

    var reg = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/;

    return reg.test( value );
  },
  checkFormVal: function( f ) {

    var groupName = f.category.value.length;

    if ( groupName < 1 ) {
      trace('그룹 이름을 입력 하세요.');
      f.category.focus();
      return (false);
    }

    return (true);
  },
  checkGroupID: function(f) {

    var $category = $('input[name=category]'),
      params = {
      _method: 'insert',
      category: $category.val()
    };

    if (params.category === '') {
      trace('카테고리 이름을 입력해주세요.');
      $category.focus();
      return;
    }

    var url = jsux.rootPath + 'member-admin/group-checkid';

    jsux.getJSON( url, params, function(e) {
      trace( e.msg );
    });
  },
  sendAndLoad: function() {

    var params = {};
    var datas = $('form');

    $.each(datas[0], function(index, item) {

      var filters = 'checkbox|button|submit|select';
      var $input = $(item);
      var type = $input.attr('type') ? $input.attr('type') : item.nodeName;
      if (!type.match(filters)) {
        params[$input.attr('name')] = $input.val();
        //console.log( $input.attr('name'), $input.val());
      }
    });

    var url = datas.attr('action');
    if (!url || url == '#') {
      trace('주소를 입력해주세요.');
      return;
    }

    jsux.getJSON( url, params, function( e )  {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL( jsux.rootPath + menuList[0].menu[0].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {

      e.preventDefault();
      var bool  = self.checkFormVal( e.target );      
      if (bool === true) {
        if ( self.checkLang( e.target.category.value)) {
          trace('회원그룹명에 한글이 포함되어 있습니다.');           
        } else {
          self.sendAndLoad();
        }
      }       
    });

    $('input[name=check-member-group]').on('click', function(e) {
      self.checkGroupID();
    });

    $('input[name=cancel]').on('click', function(e) {
      jsux.goURL(jsux.rootPath + menuList[0].menu[0].link);
    });
  },
  init: function() {

    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn.groupDelete = {

  sendJSON: function() {

    var params = {
      _method: 'delete',
      id: $('input[name=id]').val()
    };

    jsux.getJSON( jsux.rootPath + 'member-admin/group-delete', params, function( e )  {

      trace( e.msg );

      if (e.result == 'Y') {
        jsux.goURL( jsux.rootPath + menuList[0].menu[0].link);
      } 
    });
  },
  setEvent: function() {

    var self = this;
    $('.articles .del .box ul > li > a').on('click', function( e ) {

      var key = $(this).data('key');
      if (key == 'del') {
        self.sendJSON();
      } else if (key == 'back') {
        jsux.goURL( jsux.rootPath + menuList[0].menu[0].link);
      }
      e.preventDefault();
    });
  },
  init: function() {

    this.setEvent();
  }
};
jsux.fn.list = {

  setLayout: function() {

    var params = {
      category: $('input[name=category]').val()
    };

    jsux.getJSON( jsux.rootPath + 'member-admin/list-json', params, function( e )  {

      var   func = {
          editDate: function( value ) {
            var list = value.split(' ');
            return list[0];
          }
        },
        markup = '';

      $('#memberList').empty();

      if (e.result == 'Y') {

        if (e.data.list.length > 0) {
          markup = $('#memberList_tmpl');
          $(markup).tmpl(e.data.list, func).appendTo('#memberList');
        } else {            
          markup = $('#memberWarnMsg_tmpl');
          $(markup).tmpl( e ).appendTo('#memberList');
        }     
      } else {
        markup = $('#memberWarnMsg_tmpl');
        $(markup).tmpl( e ).appendTo('#memberList');
      }
    });
  },
  init: function() {

    this.setLayout();
  }
};
jsux.fn.add = {

  getEmailVal: function( id ) {

    var result = $.trim($('select[name='+id+'1]').val());

    if ( result == '직접입력') {
      result = $('input[name='+id+'2]').val();
    }

    return result;
  },
  getSelectVal: function( id ) {

    var result = $.trim($('select[name='+id+']').val());

    return result;
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getCheckboxVal: function( id ) {

    var result= '',
      list = $('input:checkbox[name='+id+']:checked'),
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

    var user_id = f.user_id.value.length,
      password = f.password.value.length,
      passwordConf = f.passwordConf.value.length,
      user_name = f.user_name.value.length,
      email_address = f.email_address.value.length,
      emailTail = this.getEmailVal('email_tail'),
      hp1 = f.hp1.value.length,
      hp2 = f.hp2.value.length,
      hp3 = f.hp3.value.length;

    if ( memberid < 1 ) {
      trace('아이디를 입력 하세요.');
      f.memberid.focus();
      return (false);
    }

    if (this.checkLangKor( f.memberid.value)) {
      trace('아이디에 한글이 포함되어 있습니다.');
      f.memberid.focus();
      return (false);
    }

    if ( password < 1) {
      trace('비밀번호를 입력 하세요.');
      f.password.focus();
      return (false);
    }

    if ( passwordConf < 1) {
      trace('확인번호를 입력 하세요.');
      f.passwordConf.focus();
      return (false);
    }

    if ( user_name < 1 ) {
      trace('이름을 입력 하세요.');
      f.user_name.focus();
      return (false);
    }

    if ( email_address < 1 ) {
      trace('e-mail을 입력하세요.');
      f.email_address.focus();
      return (false);
    }

    if ( emailTail < 1 ) {
      trace('e-mail서비스 주소를 입력하세요.');

      if (this.getEmailVal('email_tail') === '') {
        f.email_tail2.focus();
      }
      return (false);
    }

    if ( hp1 < 3 ) {
      trace('핸드폰 첫번째 자리 번호를 입력해 주세요.');
      f.hp1.focus();
      return (false);
    }

    if ( hp2 < 3 ) {
      trace('핸드폰 두번째 자리 번호를 입력해 주세요.');
      f.hp2.focus();
      return (false);
    }

    if ( hp3 < 4 ) {
      trace('핸드폰 세번째 자리 번호를 입력해 주세요.');
      f.hp3.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var params = '';

    params = {  user_id: f.user_id.value,
          password: f.password.value,
          user_name: f.user_name.value,
          email_address: f.email_address.value+'@'+this.getEmailVal('email_tail'),
          hp1: f.hp1.value,
          hp2: f.hp2.value,
          hp3: f.hp3.value,
          job: f.job.value,
          hobby: this.getCheckboxVal('hobby'),
          join_path: f.join_path.value,
          recommend_id: f.recommend_id.value,
          is_writable: this.getSelectVal('is_writable'),
          is_kickout: this.getSelectVal('is_kickout'),
          point: f.point.value,
          grade: f.grade.value };

    jsux.getJSON('member.add.insert.php', params, function( e ) {

      trace( e.msg );

      if (e.result == 'Y') {
        jsux.goURL(menuList[0].menu[0].link);
      }
    });
  },
  checkPassword: function() {

    if ($('input[name=password]').val() != $('input[name=passwordConf]').val()) {

      trace('비밀번호가 일치하지 않습니다.');

      $('input[name=password]').val('');
      $('input[name=passwordConf]').val('');
      $('input[name=password]').focus();

      return(false);
    }
  },    
  checkID: function() {

    var params =  { category_id: $('input[name=category_id]').val(),
            user_id: $('input[name=user_id]').val()};


    if (params.user_id === '') {
      trace('아이디를 입력해주세요');
      return;
    }

    jsux.getJSON('member.php?action=searchID', params, function( e ) {

      trace( e.msg );
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {

      e.preventDefault();

      var bool  = self.checkFormVal( e.target );
      
      if (bool === true) {
        self.sendJson( e.target );
      }
    });
    $('input[name=cancel]').on('click', function(e) {

      jsux.goURL(menuList[0].menu[0].link);
    });

    $('input[name=passwordConf]').on('blur', function() {

      self.checkPassword();
    }); 
    $('input[name=checkID]').on('click',function(e) {

      self.checkID();
    });
    $('select[name=email_tail1]').on('change', function() {

      $('input[name=email_tail2').val('');
    }); 
  },
  setLayout: function() {

    jsux.getJSON('member.add.json.php', function( e )  {

      var markup = $('#tableList_tmpl');

      if (e.result == 'Y') {
        $('#tableList').empty();

        if (e.data.list.length > 0) {
          $('#tableList_tmpl').tmpl(e.data.list).appendTo('#tableList');
        } else {
          $('#tableList_tmpl').tmpl('{name: no data}').appendTo('#tableList');
        }
      }
    });
  },
  init: function() {

    this.setEvent();
    this.setLayout();
  }
};
jsux.fn.modify = {

  returnToURL: function () {

    var id = $('input[name=category_id]').val(),
      url = jsux.rootPath + 'member-admin/' + id + '/list';
    return url;
  },
  getEmailVal: function( id ) {

    var result = '';

    result = $.trim($('select[name='+id+'1]').val());
    if ( result == '직접입력') {
      result = $('input[name='+id+'2]').val();
    }
    return result;
  },
  getSelectVal: function( id ) {

    var result = $.trim($('select[name='+id+']').val());
    return result;
  },
  setSelectVal:function( id, value ) {

    $('select[name='+id+']').val( value );
  },
  getCheckboxVal: function( id ) {

    var result= '',
      list = $('input:checkbox[name='+id+']:checked'),
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
  checkPassword: function() {

    if ($('input[name=password]').val() != $('input[name=passwordConf]').val()) {

      trace('비밀번호가 일치하지 않습니다.');
      $('input[name=password]').val('');
      $('input[name=passwordConf]').val('');
      $('input[name=password]').focus();
      return(false);
    }
  },
  checkFormVal: function( f ) {

    var id = $('input[name=id]').val(),
      password = f.password.value.length,
      passwordConf = f.passwordConf.value.length,
      user_name = f.user_name.value.length,
      email_address = f.email_address.value.length,
      emailTail = this.getEmailVal('email_tail'),
      hp1 = f.hp1.value.length,
      hp2 = f.hp2.value.length,
      hp3 = f.hp3.value.length;

    if ( password < 1) {
      trace('비밀번호를 입력 하세요.');
      f.password.focus();
      return (false);
    }

    if ( passwordConf < 1) {
      trace('확인번호를 입력 하세요.');
      f.passwordConf.focus();
      return (false);
    }

    if ( user_name < 1 ) {
      trace('이름을 입력 하세요.');
      f.user_name.focus();
      return (false);
    }

    if ( email_address < 1 ) {
      trace('e-mail을 입력하세요.');
      f.email_address.focus();
      return (false);
    }

    if ( emailTail < 1 ) {
      trace('e-mail서비스 주소를 입력하세요.');

      if (this.getEmailVal('email_tail') === '') {
        f.email_tail2.focus();
      }
      return (false);
    }

    if ( hp1 < 3 ) {
      trace('핸드폰 첫번째 자리 번호를 입력해 주세요.');
      f.hp1.focus();
      return (false);
    }

    if ( hp2 < 3 ) {
      trace('핸드폰 두번째 자리 번호를 입력해 주세요.');
      f.hp2.focus();
      return (false);
    }

    if ( hp3 < 4 ) {
      trace('핸드폰 세번째 자리 번호를 입력해 주세요.');
      f.hp3.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var params = '',
      self = this;

    params = {  _method: 'update',
          id: f.id.value,
          password: f.password.value,
          user_name: f.user_name.value,
          email_address: f.email_address.value+'@'+this.getEmailVal('email_tail'),
          hp1: f.hp1.value,
          hp2: f.hp2.value,
          hp3: f.hp3.value,
          job: f.job.value,
          hobby: this.getCheckboxVal('hobby'),
          join_path: f.join_path.value,
          recommend_id: f.recommend_id.value,
          is_writable: this.getSelectVal('is_writable'),
          is_kickout: this.getSelectVal('is_kickout'),
          point: f.point.value,
          grade: f.grade.value };

    jsux.getJSON( jsux.rootPath + 'member-admin/modify', params, function( e ) {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL( self.returnToURL() );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {

      e.preventDefault();

      var bool  = self.checkFormVal( e.target );      
      if (bool === true) {
        self.sendJson( e.target );
      }
    });

    $('input[name=cancel]').on('click', function(e) {
      jsux.goURL( self.returnToURL() );
    });

    $('input[name=passwordConf]').on('blur', function() {
      self.checkPassword();
    });

    $('select[name=email_tail1]').on('change', function() {
      $('input[name=email_tail2').val('');
    });
  },
  setLayout: function() {

    var params = {
      id:  $('input[name=id]').val()
    };

    jsux.getJSON(jsux.rootPath + 'member-admin/modify-json', params, function( e ) {

      var formLists = null,
        checkedVal = '',
        markup = null,
        labelList = null;

      if (e.result == 'Y') {

        formLists = $('input[type=text]');
        $(formLists).each(function(index) {
          if (e.data[this.name]) {
            this.value = e.data[this.name];
          }
        });

        var selectPatern = /^(is_writable|is_kickout)$/;
        formLists = $('select');
        $(formLists).each(function(index) {
          var value = e.data[this.name];
          if (selectPatern.test(this.name)) {
            var label = (value.toLowerCase() === 'y') ? 'yes' : 'no';           
            $(this).val(label);
          } else {
            if (value) {
              $(this).val(value);
            }           
          }           
        });

        formLists = $('input[type=checkbox]');
        if (e.data.hobby) {
          checkedVal = e.data.hobby.split(',');
          $(formLists).each(function(index){

            var self = this;

            $(checkedVal).each(function(sIndex){

              if (checkedVal[sIndex]) {
                if( self.value === checkedVal[sIndex]) {
                  self.checked = true;
                }
              }
            });
          });
        }       

        labelList = $('table tr').find('.view-type-textfield');

        markup = $('#memberLabel_tmpl');
        $(labelList).each(function(index) {

          var label = '',
            data = '';

          label = $(labelList[index]).attr('id');           
          data = {label: e.data[label]};

          $('#'+label).empty();
          $(markup).tmpl( data ).appendTo($('#'+label));
        });
      } else {
        trace( e.msg );
      }
    });
  },    
  init: function() {
    this.setLayout();
    this.setEvent();
    jsux.setAutoFocus();
  }
};
jsux.fn.delete = {

  returnToURL: function () {

    var id = $('input[name=category_id]').val(),
      url = jsux.rootPath + 'member-admin/' + id + '/list';

    return url;
  },

  sendJSON: function() {

    var self = this,
      params = {
        _method:'delete',
        id :$('input[name=id]').val()
      };

    jsux.getJSON(jsux.rootPath + 'member-admin/delete', params, function( e )  {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL( self.returnToURL() );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('.articles .del .box ul > li > a').on('click', function( e ) {

      var key = $(this).data('key');

      if (key == 'del') {
        self.sendJSON();
      } else if (key == 'back') {
        jsux.goURL( self.returnToURL() );
      }
      e.preventDefault();
    });
  },
  init: function() {
    this.setEvent();
  }
};