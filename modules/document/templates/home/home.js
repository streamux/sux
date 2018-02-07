jsux.fn = jsux.fn || {};
jsux.fn.content = {

  title: '',
  MIN_NUM: 0,
  MAX_NUM: 100,
  MIN_POSY: 0,
  MAX_POSY: 0,
  isFixed: false,
  isShow: true,

  getRate(value) {

     return (this.MAX_NUM - this.MIN_NUM) / (this.MAX_POSY - this.MIN_POSY) * (value - this.MIN_POSY);
  },
  resizeTitle: function(currentY) {

    var self = this,
          percent = this.getRate(currentY),
          targetSize = 0,
          maxY = 0;
   
    if (percent <= 1) {
      percent = 1;
    }

    if (percent >= 100) {
      percent = 100;
    }

    targetSize = this.MAX_NUM - percent;
    maxY = this.MAX_POSY + this.MIN_POSY/2;

    if (targetSize < 41 && currentY < maxY) {
      TweenMax.to( this.title, 5, {opacity: 1, ease: Quart.easeOut, useFrames: true});
      TweenMax.to( this.title, 13, {scale: 1, ease: Quart.easeOut, useFrames: true});
    } else if ( targetSize > 41 && currentY < maxY) {
      TweenMax.to( this.title, 12, {scale: targetSize, opacity: 0,ease: Quad.easeOut, useFrames: true});
    }

    targetSize = Math.round(targetSize);
    if (targetSize === 0 && currentY > maxY) {
      TweenMax.to( this.title, 21, {scale: 0, ease: Quad.easeOut, useFrames: true});     
    } else if (targetSize === 0 && currentY < maxY) {
      TweenMax.to( this.title, 21, {scale: 1, ease: Quad.easeOut, useFrames: true});      
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
  },
  init: function() {

   // console.log('document init');
   this.setLayout();
   this.setEvent();
  }
};