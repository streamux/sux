jsux.fn = jsux.fn || {};
jsux.fn.connectSiteList = {

  setLayout: function() {

    jsux.getJSON(jsux.rootPath + 'analytics-admin/connect-site-list-json', function( e )  {

      var markup = '';
      $('#totallogList').empty();

      if (e.result == 'Y') {
        markup = $('#totallogList_tmpl');
        $(markup).tmpl(e.data.list).appendTo('#totallogList');
      } else {
        markup = $('#totallogWarnMsg_tmpl');
        $(markup).tmpl( e ).appendTo('#totallogList');
      }
    });
  },
  init: function() {

    this.setLayout();
  }
};
jsux.fn.connectSiteAdd = {

  checkFormVal: function( f ) {

    var keyword = f.keyword.value.length;

    if ( keyword < 1 ) {
      trace('접속키워드 이름을 입력하세요.');
      f.keyword.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var params = {
      '_method':f._method.value,
      'keyword': f.keyword.value
    };

    var url = f.action;
    if (!url) {
      trace("Action URL Don't Exists");
      return;
    }

    jsux.getJSON(url, params, function( e ) {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[0].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();

      var bool = self.checkFormVal( e.target );
      if (bool === true) {

        self.sendJson( e.target );
      }       
    });
    $('input[name=cancel]').on('click', function() {
      jsux.goURL(jsux.rootPath + menuList[4].menu[0].link);
    });
  },
  init: function() {

    this.setEvent();
    jsux.setAutoFocus();
  }
};

jsux.fn.connectSiteReset = {
  
  sendJSON: function() {

    var params = {
      '_method': 'update',
      'id': $('input[name=id]').val(),
      'keyword': $('input[name=keyword]').val()
    };

    jsux.getJSON(jsux.rootPath + 'analytics-admin/connect-site-reset', params, function( e ) {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[0].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('.articles .del .box ul > li > a').on('click', function( e ) {

      var key = $(this).data('key');
      if (key == 'reset') {         
        self.sendJSON();
      } else if (key == 'back') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[0].link);
      }
      e.preventDefault();
    });
  },
  init: function() {

    this.setEvent();
  }
};

jsux.fn.connectSiteDelete = {

  sendJSON: function() {

    var params = {
      '_method': 'delete',
      'id': $('input[name=id]').val(),
      'keyword': $('input[name=keyword]').val()
    };

    jsux.getJSON(jsux.rootPath + 'analytics-admin/connect-site-delete', params, function( e ) {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[0].link);
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

        jsux.goURL(jsux.rootPath + menuList[4].menu[0].link);
      }
      e.preventDefault();
    });
  },
  init: function() {

    this.setEvent();
  }
};

jsux.fn.pageviewList = {

  setLayout: function() {

    jsux.getJSON(jsux.rootPath + 'analytics-admin/pageview-list-json', function( e )  {

      var markup = '';
      $('#totallogList').empty();

      if (e.result == 'Y') {
        markup = $('#totallogList_tmpl');
        $(markup).tmpl(e.data.list).appendTo('#totallogList');
      } else {
        markup = $('#totallogWarnMsg_tmpl');
        $(markup).tmpl( e ).appendTo('#totallogList');
      }
    });
  },
  init: function() {

    this.setLayout();
  }
};
jsux.fn.pageviewAdd = {

  checkFormVal: function( f ) {

    var keyword = f.keyword.value.length;

    if ( keyword < 1 ) {
      trace('페이지뷰 키워드를 입력하세요.');
      f.keyword.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var params = {
      '_method': 'insert',
      'keyword': f.keyword.value
    };

    var url = f.action;
    if (!url) {
      trace("Action URL Don't Exists");
      return;
    }

    jsux.getJSON( url, params, function( e ) {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[2].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {

      e.preventDefault();

      var bool = self.checkFormVal( e.target );

      if (bool === true) {

        self.sendJson( e.target );
      }       
    });
    $('input[name=cancel]').on('click', function() {
      jsux.goURL(jsux.rootPath + menuList[4].menu[2].link);
    });
  },
  init: function() {

    this.setEvent();
    $('input[name=keyword]').focus();
  }
};
jsux.fn.pageviewReset = {
  
  sendJSON: function() {

    var params = {
      '_method': 'update',
      'id': $('input[name=id]').val(),
      'keyword': $('input[name=keyword]').val()
    };

    jsux.getJSON(jsux.rootPath + 'analytics-admin/pageview-reset', params, function( e ) {

      trace( e.msg );
      if (e.result == 'Y') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[2].link);
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('.articles .del .box ul > li > a').on('click', function( e ) {

      var key = $(this).data('key');

      if (key == 'reset') {         
        self.sendJSON();
      } else if (key == 'back') {
        trace('aa', true);
        jsux.goURL(jsux.rootPath + menuList[4].menu[2].link);
      }
      e.preventDefault();
    });
  },
  init: function() {

    this.setEvent();
  }
};


jsux.fn.pageviewDelete = {

  sendJSON: function() {

    var params = {
      '_method': 'delete',
      'id': $('input[name=id]').val(),
      'keyword': $('input[name=keyword]').val()
    };

    jsux.getJSON(jsux.rootPath + 'analytics-admin/pageview-delete', params, function( e ) {

      trace( e.msg );

      if (e.result == 'Y') {
        jsux.goURL(jsux.rootPath + menuList[4].menu[2].link);
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

        jsux.goURL(jsux.rootPath + menuList[4].menu[2].link);
      }
      e.preventDefault();
    });
  },
  init: function() {

    this.setEvent();
  }
};