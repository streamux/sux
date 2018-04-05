jsux.fn.content = {

  downloadSUXCMS: function() {

    try {

      var _img = document.getElementById('#imgCountUpdater');

      if (_img === null) {        
        _img = document.createElement('img');
      }
      
      _img.src = jsux.rootPath + 'analytics/download-cms';
      _img.style.position = 'absolute';
      _img.style.top = '-1000px';
      _img.id = 'imgCountUpdater';
      document.getElementById('sxGnbLoginWrap').appendChild(_img);
    } catch(e) {}
    
    window.location.href = "https://github.com/streamux/sux/archive/master.zip" 
  },
  setEvent: function() {

    var self = this;

    $('#btnSuxDownload').on('click', function(e) {

      self.downloadSUXCMS();
    });
  },
  init: function() {

    this.setEvent();
  }
};