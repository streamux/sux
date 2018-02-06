jsux.fn = jsux.fn || {};
jsux.fn.content = {

  title: '',
  MIN_NUM: 0,
  MAX_NUM: 100,
  MIN_POSY: 0,
  MAX_POSY: 0,
  isFixed: false,
  isShow: true,

  resizeTitle: function(currentY) {

    var self = this;
    var percent = (this.MAX_NUM - this.MIN_NUM) / (this.MAX_POSY - this.MIN_POSY) * (currentY - this.MIN_POSY);
   
    if (percent <= 1) {
      percent = 1;
    }

    if (percent >= 100) {
      percent = 100;
    }

    var targetSize = this.MAX_NUM - percent;

    if (targetSize < 20 && this.isFixed === false) {
      this.isFixed = true;
      this.title.addClass('title_fixed');
      TweenMax.to( this.title, 5, {opacity: 1, ease: Quart.easeOut, useFrames: true});
      TweenMax.to( this.title, 17, {scale: 1, ease: Quart.easeOut, useFrames: true});
    } else if ( targetSize > 25 && this.isFixed === true) {
      this.isFixed = false;
      this.title.removeClass('title_fixed');
      TweenMax.to( this.title, 21, {opacity: 0, ease: Quad.easeOut, useFrames: true});
      TweenMax.to( this.title, 17, {scale: targetSize, ease: Quad.easeOut, useFrames: true});
    }

    var maxY = this.MAX_POSY + this.MAX_POSY/5;

    if (targetSize === 0 && currentY > maxY && this.isShow === true) {
      this.isShow = false;
      TweenMax.to( this.title, 21, {scale: 0, ease: Quad.easeOut, useFrames: true}, function() {
         self.title.addClass('sx-hide');
      });
     
    } else if (targetSize === 0 && currentY < maxY && this.isShow === false) {
      this.isShow = true;
      TweenMax.to( this.title, 21, {scale: 1, ease: Quad.easeOut, useFrames: true});
      this.title.removeClass('sx-hide');
    }
  },
  setEvent: function() {

    var self = this;
   
    
    $(window).on('scroll', function(e) {

      self.resizeTitle(e.currentTarget.scrollY);
    });
  },
  setLayout: function() {

    this.title = $('.img_panel .title ');
    this.MIN_POSY = this.title.parent().offset().top - this.title.parent().css('height').replace(/[^\d]+$/, '');
    this.MAX_POSY = this.title.parent().offset().top;
    TweenMax.to( this.title, 0, {opacity: 0});
  },
  init: function() {

   // console.log('document init');
   this.setLayout();
   this.setEvent();
  }
};