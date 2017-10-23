$(document).ready(function() {

  var adminMobilePanel = new SXAdminMobilePanel();
  adminMobilePanel.init();

  var adminMenu = new SXAdminMenu();
  adminMenu.init();
});

var SXAdminMobilePanel = function() {

  var self = this;
  var isReadClickMenu = true;

  this.init = function() {
    this.setEvent();
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

  this.slideInGnbPanel = function() {

    this.removeClass('.sx-gnb-case', 'sx-slide-out');
    this.addClass('.sx-gnb-case', 'sx-slide-in');
    this.hideMobileMenu();
    this.hideCloseBtn();
    this.removeTransitionEnd();

    isReadClickMenu = false;
  };

  this.slideOutGnbPanel = function() {

    this.removeClass('.sx-gnb-case', 'sx-slide-in');
    this.addClass('.sx-gnb-case', 'sx-slide-out');
    this.addTransitionEnd();
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
    this.removeClass('#sxGnbCase .sx-close-btn', 'active');
  };

  this.showCloseBtn = function() {    
    this.addClass('#sxGnbCase .sx-close-btn', 'active');
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

    this.removeClass('.sx-nav-bar', 'sx-nav-off');
  };

  this.hideNavPanel = function() {

     this.addClass('.sx-nav-bar', 'sx-nav-off');
  };

  this.setEvent = function() {

    $('.sx-menu-btn').on('click', function() {

      if (!isReadClickMenu) {
        return;
      }
      self.showNavPanel();
      self.slideInGnbPanel();      
    });
    $('.sx-close-btn').on('click', function() {
      self.slideOutGnbPanel();
    });
  };
};

var SXAdminMenu = function(){

  var selectedSub = null;
  var self = this;

  this.init = function() {
    this.setEvent();
  };

  this.setEvent = function() {

    var menuList = $('.sx-gnb > li > a'),
          subPanelList = $('.sx-drap-menu');

    menuList.on('click', function(e){

      var mindex = menuList.index(this);
      var sub = subPanelList[mindex];
      self.showSubMenu(sub);

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