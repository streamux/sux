/** 
 * used class 'jsux.fn.listManager'
 * path 'common/js/app/jsux_list_manager.js'
 * author streamux.com
 * update 2017.10.18
 */

jsux.fn = jsux.fn || {};
jsux.fn.main = {

  convertJsonToObj: function( markup, id, value, func) {

    var label = id,
      data = {label: value};

    if (!func) {
      func = function(){};
    }

    $('#'+label).empty();
    $(markup).tmpl(data, func).appendTo('#'+label);
  },
  setServiceConfig: function(data) {

    var self = this;
    var markup = $('#textfield_tmpl');
    var list = $('.sx-content .sx-service-config .view-type-textfield');

    $(list).each(function( index ) {
      self.convertJsonToObj( markup, this.id, data[this.id], {

        getUnit: function(label) {
          return label;
        }
      });
    });

    list = $('.sx-content .sx-service-config .view-type-icon');
    $(list).each(function( index ) {

      var id = $(this).parent().find('.service_label > .view-type-textfield').attr('id');
      var value = parseInt(data[id]);
      if (value > 0) {
        var $icon = $(this);
        if ($icon.hasClass('sx-label-default')) {
          $icon.removeClass('sx-label-default');
        }
        if (!$icon.hasClass('sx-label-primary')) {
          $icon.addClass('sx-label-info');
          $icon.text('on');
        }
      }        
    });
  },
  setConnectPath: function(data) {

     var url = 'admin-admin/connectsite-json',
          params = {
            category: $('input[name=category]').val(),
          },
          listOption = {
            id: '#connectPathList',
            template: '#hitAnalyticsList_tmpl',
            msg_tmpl: '#warnMsg_tmpl'
          },
          paginOption = {
            el: '.pagin_connect_path',
            id: '#connectPathPaginList',
            tmpl: '#pagination_tmpl',
            control: {
              'prev':'.pagin_connect_path .sx-nav-prev',
              'next':'.pagin_connect_path .sx-nav-next'
            }
          };
    this.displayList(data, url, listOption, paginOption);
  },
  setPageview: function(data) {

    var url = 'admin-admin/pageview-json',
          listOption = {
            id: '#pageviewHitList',
            template: '#hitAnalyticsList_tmpl',
            msg_tmpl: '#warnMsg_tmpl'
          },
          paginOption = {
            el: '.pagin_pageview',
            id: '#pageviewPaginList',
            tmpl: '#pagination_tmpl',
            control: {
              'prev':'.pagin_pageview .sx-nav-prev',
              'next':'.pagin_pageview .sx-nav-next'
            }
          };
    this.displayList(data, url, listOption, paginOption);    
  },  
  setLatestComment: function(data) {

    var url = 'admin-admin/latestcomment-json',
          listOption = {
            id: '#latestCommentList',
            template: '#latestCommentList_tmpl',
            msg_tmpl: '#warnMsg_tmpl'
          },
          paginOption = {
            el: '.pagin_comment',
            id: '#latestCommentPaginList',
            tmpl: '#pagination_tmpl',
            control: {
              'prev':'.pagin_comment .sx-nav-prev',
              'next':'.pagin_comment .sx-nav-next'
            }
          };
    this.displayList(data, url, listOption, paginOption);
  },
  setNewMember: function(data) {

    var url = 'admin-admin/newmember-json',
          listOption = {
            id: '#newMemberList',
            template: '#newMemberList_tmpl',
            msg_tmpl: '#warnMsg_tmpl'
          },
          paginOption = {
            el: '.pagin_member',
            id: '#memberPaginList',
            tmpl: '#pagination_tmpl',
            control: {
              'prev':'.pagin_member .sx-nav-prev',
              'next':'.pagin_member .sx-nav-next'
            }
          };

    this.displayList(data, url, listOption, paginOption);
  },
  setConnectCount: function(data) {

    var addComma = function(num) {

      return jsux.utils.addComma(num);
    };
    var self = this;
    var markup = $('#textfield_tmpl');
    var list = $('.sx-content .connecter .view-type-textfield');

    $(list).each(function( index ) {
      self.convertJsonToObj( markup, this.id, data[this.id], {
        getUnit: function( label ) {
          return addComma(label);
        }
      });
    });
  },
  displayList: function(data, url, list_option, pagin_option, params=null) {

    var self = this,
          limit =5,
          limitGroup = 5,
          originLimitGroup = 5,
          pagination = jsux.app.getPagination(),
          listManager = jsux.app.getListManager(),
          changeHandler = null,
          loadedHandler = null,
          url = jsux.rootPath + url;

    if (params) {
      listManager.setParams(params);
    }

    listManager.setResource(url);
    listManager.initialize(list_option);
    pagination.initialize(pagin_option);

    changeHandler = function( e ) {
      listManager.reloadData( e.page, limit);
    };
    loadedHandler = function(e) {

      var data = e.data;
      if (data && data.list && data.list.length > 0) {       
        listManager.setData( data.list );
      } else {
        listManager.reset();
        listManager.setMsg(data.msg);
      }
    };
    listManager.addEventListener('loaded', loadedHandler);
    pagination.addEventListener('change', changeHandler);

    if (data && data.list && data.list.length > 0) {

      // pagination start     
      pagination.setData({
        total: data.total_num,
        limit: limit,
        limitGroup: limitGroup,
        originLimitGroup: originLimitGroup
      });
      
      pagination.activateControl();
    } else {
      // pagination start
      pagination.deactivateControl();
    }
    loadedHandler({data:data});
  }, 
  setEvent: function() {

  },
  setLayout: function() {

    var self = this,
      params = {
        passover: 0,
        limit: 5
      };

    jsux.getJSON( jsux.rootPath + 'admin-admin/main-json', params,function( e )  {

      self.setConnectCount(e.data.connecter);
      self.setNewMember(e.data.newmember);
      self.setLatestComment(e.data.latestcomment);
      self.setPageview(e.data.pageview);
      self.setConnectPath(e.data.connectersite);
      self.setServiceConfig(e.data.serviceConfig);
    });
  },
  init: function() {

    this.setLayout();
    this.setEvent();
  }
};
jsux.fn.login = {

  checkForm: function( f ) {

    var id = f.user_id.value.length,
      pwd = f.user_pass.value.length;

    if ( id < 1) {
      trace("관리자 아이디를 입력하세요.");
      f.user_id.focus();
      return (false);       
    }

    if ( pwd < 1) {
      trace("관리자 비밀번호를 입력하세요.");
      f.user_pass.focus();
      return (false);       
    }
    return (true);
  },
  init: function() {
    
    $("input[name=user_id]").focus();
  }
};
jsux.fn.member = {

  setLayout: function() {

    jsux.getJSON("member.list.json.php", function( e )  {

      var markup = "";
      $("#memberList").empty();

      if (e.result == "Y") {

        if (e.data.list.length > 0) {
          markup = $("#memberList_tmpl");
          $(markup).tmpl(e.data.list).appendTo("#memberList");
        } else {            
          markup = $("#memberWarnMsg_tmpl");
          $(markup).tmpl( e ).appendTo("#memberList");
        }

        $("#articleMemberDelTitle").empty();
        markup = $("#articleMemberDelTitle_tmpl");
        $(markup).tmpl(e.data).appendTo("#articleMemberDelTitle");            
      } else {
        markup = $("#memberWarnMsg_tmpl");
        $(markup).tmpl( e ).appendTo("#memberList");
      }
    });
  },
  init: function() {

    this.setLayout();
  }
};