$(document).ready(function() {

  var adminMobilePanel = new SXAdminMobilePanel();
  adminMobilePanel.init();

  var adminMenu = new SXAdminMenu();
  adminMenu.init();
});
var SXAdminMenu = function(){

  var selectedSub = null;
  var self = this;

  this.init = function() {
    this.setEvent();
  };

  this.setEvent = function() {

    var menuList = $('.sx-gnb > li > a'),
          subPanelList = $('.sx-drap-menu'),
          oldMenu$ = null;

    menuList.on('click', function(e){
      
      var mindex = menuList.index(this);
      var sub = subPanelList[mindex];

      if($(sub).children().length > 0) {
        self.showSubMenu(sub);
        e.preventDefault();
      } 
      
      if (selectedSub && selectedSub !== sub) {
         self.hideSubMenu(selectedSub);
      }     
 
      selectedSub = sub;   
    });

    menuList.on('touchstart', function(e) {
      e.preventDefault();

      var menu$ = $(this);
      self.addClass(menu$[0], 'active');

      if (oldMenu$) {
        self.removeClass(oldMenu$[0], 'active');
      }

      var url = menu$.attr('href');
      var target = $(this).attr('target');
      target = target ? target : '_self';

      if (url && url.match('#') !== true) {
        jsux.goURL(url, target);
      }

      oldMenu$ = menu$;
    });

    var menuAllList = $('.sx-gnb li a');
    menuAllList.on('focus', function(e) {

      e.preventDefault();

      var el$ = $(e.target).parent().parent().parent();
      var className = el$.attr('class');
      var mindex = $(this).parent().index();
      
      if (className.match(/^sx-sub-case/i)) {        
        mindex = $(el$.parent()).index();
      }

      var sub = subPanelList[mindex];

      if($(sub).children().length > 0) {
        self.showSubMenu(sub);
      }

      if (selectedSub && selectedSub !== sub) {
         self.hideSubMenu(selectedSub);
      }     
 
      selectedSub = sub; 
    });

    $('body').on('click', function(e) {

      if (e.target.nodeName && e.target.nodeName.toUpperCase() === 'A') {
        e.stopImmediatePropagation();
        return;
      }
      self.hideSubMenu(selectedSub);
      selectedSub = null;
    });
  };
  this.removeClass = function(target, id) {

    var $gnbCase = $(target);
    if ($gnbCase.hasClass(id)) {
      $gnbCase.removeClass(id);
    }
  };
  this.addClass = function(target, id) {

    var $gnbCase = $(target);
    if (!$gnbCase.hasClass(id)) {
      $gnbCase.addClass(id);
    }
  };
  this.showSubMenu = function(sub) {

    if (selectedSub === sub) {
      return;
    }
    this.removeClass(sub, 'sx-slide-out');
    this.addClass(sub, 'sx-slide-in');
      
    var $sub = $(sub);
    var subCaseHeight = $sub.css('height').replace('px', '');
    var $subCase = $($sub.parent());
    $subCase.css('height', subCaseHeight);

    this.removeClass($sub.parent(), 'sx-slide-out');
    this.addClass($sub.parent(), 'sx-slide-in');
  };

  this.hideSubMenu = function(sub) {

    if (!sub) {
      return;
    }

    var $sub = $(sub);
    this.hideSubCase($sub);
    this.removeClass(sub, 'sx-slide-in');
    this.addClass(sub, 'sx-slide-out');    
  };

  this.hideSubCase = function(sub) {

    var $subCase = $(sub.parent());
    $subCase.css('height', 0);
    this.removeClass(sub.parent(), 'sx-slide-in');
    this.addClass(sub.parent(), 'sx-slide-out');
  };
};
var SXAdminMobilePanel = function() {

  var self = this;
  var isReadClickMenu = true;
  var oldTarget = null;

  this.removeClass = function(target, id) {

    var $gnbCase = $(target);
    if ($gnbCase.hasClass(id)) {
      $gnbCase.removeClass(id);
    }
  };
  this.addClass = function(target, id) {

    var $gnbCase = $(target);
    if (!$gnbCase.hasClass(id)) {
      $gnbCase.addClass(id);
    }
  };

  this.hideMobileMenu = function() {

    var option = {'margin-top':10,'margin-bottom':-2};
    var duration = 500;
    var easing = 'easeOutExpo';
    $('.sx-menu-btn').animate({'opacity':0}, duration, easing, function() {
      self.showCloseBtn();
    });
    $('.sx-menu-btn .sx-menu > li:first-child').animate(option, duration, easing);

    option = {'margin-top':0,'margin-bottom':0};
    $('.sx-menu-btn .sx-menu > li:nth-child(2)').animate(option, duration, easing);

    option = {'margin-top':-2,'margin-bottom':10};
    $('.sx-menu-btn .sx-menu > li:last-child').animate(option, duration, easing);
  };

  this.showMobileMenu = function() {

    var option = {'margin-top':5,'margin-bottom':5};
    var duration = 300;
    var easing = 'easeOutExpo';

    $('.sx-menu-btn').animate({'opacity':1}, duration, easing);
    $('.sx-menu-btn .sx-menu > li:first-child').animate(option, duration, easing);
    $('.sx-menu-btn .sx-menu > li:nth-child(2)').animate(option, duration, easing);
    $('.sx-menu-btn .sx-menu > li:last-child').animate(option, duration, easing);
  };

  this.hideCloseBtn = function() {    
    this.removeClass('.sx-close-btn', 'sx-close-inactive');
    this.removeClass('.sx-header', 'sx-header-active');
    this.removeClass('.sx-bgcover', 'sx-bgcover-active');
  };

  this.showCloseBtn = function() {
    this.addClass('.sx-close-btn', 'sx-close-active');    
  };

  this.slideInGnbPanel = function() {

    this.addClass('.sx-header', 'sx-header-active');
    this.addClass('.sx-gnb-case', 'sx-slide-in');
    this.addClass('.sx-bgcover', 'sx-bgcover-active');
    this.addClass('html', 'sx-hide-scroll');
    this.hideMobileMenu();
    this.removeTransitionEnd();

    isReadClickMenu = false;
  };

  this.slideOutGnbPanel = function() {

    this.removeClass('.sx-gnb-case', 'sx-slide-in');
    this.removeClass('.sx-close-btn', 'sx-close-active');
    this.removeClass('html', 'sx-hide-scroll');
    this.addClass('.sx-close-btn', 'sx-close-inactive');
    this.addTransitionEnd();
  };

  this.addTransitionEnd = function() {

    var $gnbCase = $('.sx-gnb-case');
    $gnbCase.on('transitionend', function(e){

      self.removeTransitionEnd();
      self.showMobileMenu();
      self.hideNavPanel();
      self.hideCloseBtn();

      isReadClickMenu = true;
    });
  };

  this.removeTransitionEnd = function() {

    var $gnbCase = $('.sx-gnb-case');
    $gnbCase.off('transitionend');
  };

  this.showNavPanel = function() {

    this.addClass('.sx-nav-bar', 'sx-nav-active');
  };

  this.hideNavPanel = function() {

    this.removeClass('.sx-nav-bar', 'sx-nav-active');
  };

  this.setEvent = function() {

    var self = this;

    $('.sx-menu-btn').on('click', function() {

      if (!isReadClickMenu) {
        return;
      }

      self.showNavPanel();
      self.slideInGnbPanel();      
    });

    $('.sx-bgcover').on('click', function() {
      self.slideOutGnbPanel();
    });

    $('.sx-close-btn').on('click', function() {
      self.slideOutGnbPanel();
    });

    $(window).on('keyup', function(e) {

      var className = $(e.target).attr('class');

      if (className && className.match('sx-menu-btn') && e.key === 'Tab' && e.shiftKey === false) {
        $('.sx-menu-btn').trigger('click');
      }

      if (self.oldTarget && self.oldTarget.match('sx-menu-btn') && e.key === 'Tab' && e.shiftKey === true) {
        $('.sx-close-btn').trigger('click');
      }

      if (self.oldTarget && self.oldTarget.match('sx-close-btn') && e.key === 'Tab' && e.shiftKey === false) {
        $('.sx-close-btn').trigger('click');
      }

      if (className && className.match('sx-close-btn') && e.key === 'Tab' && e.shiftKey === true) {
        $('.sx-menu-btn').trigger('click');
      }

      self.oldTarget = className;
    });
  };

  this.init = function() {
    this.setEvent();
  }; 
};