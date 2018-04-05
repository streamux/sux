/** 
 * used class 'jsux.fn.listManager'
 * path 'common/js/app/jsux_list_manager.js'
 * author streamux.com
 * update 2017.10.18
 */

jsux.fn = jsux.fn || {};
jsux.fn.connectSiteList = {

  limit: 5,
  limitGroup: 5,
  pagination: jsux.app.getPagination(),
  listManager: jsux.app.getListManager(),
  listMobileManager: jsux.app.getListManager(),

  setLayout: function() {

    var self = this,
          url = $('input[name=list_json_path').val(),
          params = {
            passover: 0,
            limit: this.limit
          },
          changeHandler = null,
          loadedHandler = null;

    if (!url) {
      trace('input[name=list_json_path] 경로값을 입력하세요');
      return;
    }

    this.listManager.setResource(url);
    this.listMobileManager.setResource(url);

    this.listManager.initialize({
      id: '#dataList',
      tmpl: '#dataListTmpl',
      msg_tmpl: '#warnMsgTmpl'
    });
    this.listMobileManager.initialize({
      id: '#dataMobileList',    
      tmpl: '#dataListMobileTmpl',
      msg_tmpl: '#warnMsgMobileTmpl'
    });

    changeHandler = function( e ) {
      self.listManager.reloadData( e.page, self.limit);
      self.listMobileManager.reloadData( e.page, self.limit);
    };
    loadedHandler = function(e) {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {        
        self.listManager.setData( data.list );
        self.listMobileManager.setData( data.list );
      } else {
        self.listManager.reset();
        self.listManager.setMsg(e.msg);
        self.listMobileManager.reset();
        self.listMobileManager.setMsg(e.msg);
      }      
    };
    this.listManager.addEventListener('loaded', loadedHandler);
    this.pagination.addEventListener('change', changeHandler);
    this.pagination.initialize({
      el: '.sx-pagination-group',
      id: '#paginList',
      tmpl: '#paginationTmpl',
      control: {
        'prev':'.sx-pagination-group .sx-nav-prev',
        'next':'.sx-pagination-group .sx-nav-next'
      }
    });

    jsux.getJSON(url, params, function( e )  {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {
        
        // pagination start
        self.pagination.setData({
          total: data.total_num,
          limit: self.limit,
          limitGroup: self.limitGroup
        });        
        self.pagination.activateControl();
      } else {

        // pagination start
        self.pagination.deactivateControl();
      }

      loadedHandler(e);
    });
  },
  init: function() {
    this.setLayout();
  }
};
jsux.fn.connectSiteAdd = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  checkFormVal: function( f ) {

    var keyword = f.keyword;
    if ( keyword.value.length < 1 ) {
      trace('접속키워드 이름을 입력하세요.');
      f.keyword.focus();
      return false;
    }

    return true;
  },
  sendJson: function( f ) {

    var self = this,
          params = {
            _method:f._method.value,
            keyword: f.keyword.value
          },
          url = f.action;

    if (!url) {
      trace("Action URL Don't Exists");
      return;
    }

    jsux.getJSON(url, params, function( e ) {

      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target ) === true) {
        self.sendJson( e.target );
      }       
    });
    $('#btnCancel').on('click', function() {
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
    jsux.setAutoFocus();
  }
};

jsux.fn.connectSiteReset = {
  
  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendJson: function(f) {

    var self = this,
          params = {
            _method: 'update',
            id: f.id.value,
            keyword: f.keyword.value
          },
          url = f.action;

    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON(url, params, function( e ) {
      
      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();
      self.sendJson(e.target);
    });

    $('#btnCancel').on('click',function() {

      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {
    this.setEvent();
  }
};

jsux.fn.connectSiteDelete = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendJson: function(f) {

    var self = this,
          params = {
            _method: 'delete',
            id: f.id.value,
            keyword: f.keyword.value
          },
          url = f.action;

    jsux.getJSON(url, params, function( e ) {
      
      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();
      self.sendJson(e.target);
    });

    $('#btnCancel').on('click', function( e ) {
      e.preventDefault();
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
  }
};

jsux.fn.pageviewList = {

  limit: 10,
  limitGroup: 5,
  pagination: jsux.app.getPagination(),
  listManager: jsux.app.getListManager(),
  listMobileManager: jsux.app.getListManager(),

  setLayout: function() {

    var self = this,
          url = $('input[name=list_json_path').val(),
          params = {
            passover: 0,
            limit: this.limit
          },
         changeHandler = null;
   
   if (!url) {
      trace('input[name=list_json_path] 경로값을 입력하세요');
      return;
    }

    self.listManager.setResource(url);
    self.listMobileManager.setResource(url);
    
    self.listManager.initialize({
      id: '#dataList',
      tmpl: '#dataListTmpl',
      msg_tmpl: '#warnMsgTmpl'
    });
    self.listMobileManager.initialize({
      id: '#dataMobileList',    
      tmpl: '#dataListMobileTmpl',
      msg_tmpl: '#warnMsgMobileTmpl'
    });
    
    changeHandler = function( e ) {

      self.listManager.reloadData( e.page, self.limit);
      self.listMobileManager.reloadData( e.page, self.limit);
    };
    self.pagination.addEventListener('change', changeHandler);
    self.pagination.initialize({
      el: '.sx-pagination-group',
      id: '#paginList',
      tmpl: '#paginationTmpl',
      control: {
        'prev':'.sx-pagination-group .sx-nav-prev',
        'next':'.sx-pagination-group .sx-nav-next'
      }
    });

    jsux.getJSON(url, params, function( e )  {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {
                
        self.listManager.setData( data.list );
        self.listMobileManager.setData( data.list );

        // pagination start 
        self.pagination.setData({
          total: data.total_num,
          limit: self.limit,
          limitGroup: self.limitGroup
        });
        
        self.pagination.activateControl();
      } else {

        self.listManager.reset();
        self.listManager.setMsg(e.msg);

        self.listMobileManager.reset();
        self.listMobileManager.setMsg(e.msg);

        // pagination start
        self.pagination.deactivateControl();
      }
    });
  },
  init: function() {
    this.setLayout();
  }
};
jsux.fn.pageviewAdd = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  checkFormVal: function( f ) {

    var keyword = f.keyword;
    if ( keyword.value.length < 1 ) {
      trace('페이지뷰 키워드를 입력하세요.');
      f.keyword.focus();
      return (false);
    }

    return (true);
  },
  sendJson: function( f ) {

    var self = this,
          params = {
            _method: 'insert',
            keyword: f.keyword.value
          },
          url = f.action;

    if (!url) {
      trace("Action URL Don't Exists");
      return;
    }

    jsux.getJSON( url, params, function( e ) {

      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();

      if (self.checkFormVal( e.target ) === true) {
        self.sendJson( e.target );
      }       
    });
    $('#btnCancel').on('click', function() {
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
    $('input[name=keyword]').focus();
  }
};
jsux.fn.pageviewReset = {
  
  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendJson: function(f) {

    var self = this,
          params = {
            _method: 'update',
            id: f.id.value,
            keyword: f.keyword.value
          },
          url = f.action;

    if (!url) {
      trace("Action URL Don't Exists");
      return;
    }

    jsux.getJSON(url, params, function( e ) {
     
      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
         trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();
      self.sendJson(e.target);
    });

    $('#btnCancel').on('click', function(e) {
      e.preventDefault();
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {
    this.setEvent();
  }
};


jsux.fn.pageviewDelete = {

  returnUrl: function() {
    var backUrl = $('input[name=location_back]').val();
    if (!backUrl) {
      trace('input[name=location_back] 경로값을 확인해주세요.');
      return '';
    }
    return backUrl;
  },
  sendJson: function(f) {

    var self = this, 
          params = {
            _method: 'delete',
            id: f.id.value,
            keyword: f.keyword.value
          },
          url = f.action;

    if (!url) {
      trace('Action URL Not Exists');
      return false;
    }

    jsux.getJSON(url, params, function( e ) {

      if (e.result && e.result.toUpperCase() === 'Y') {
        jsux.goURL(self.returnUrl());
      } else {
        trace( e.msg );
      }
    });
  },
  setEvent: function() {

    var self = this;

    $('form').on('submit', function( e ) {
      e.preventDefault();
      self.sendJson(e.target);
    });

    $('#btnCancel').on('click', function(e) {
      e.preventDefault();
      jsux.goURL(self.returnUrl());
    });
  },
  init: function() {

    this.setEvent();
  }
};