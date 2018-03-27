jsux.fn = jsux.fn || {};
jsux.fn.list = {

  setLayout: function() {

    var srcList = [];
    srcList.push('<script type="text/javascript" src="' + jsux.rootPath +'modules/menu/tpl/dist/inline.bundle.js"></script>');
    srcList.push('<script type="text/javascript" src="' + jsux.rootPath +'modules/menu/tpl/dist/polyfills.bundle.js"></script>');
    srcList.push('<script type="text/javascript" src="' + jsux.rootPath +'modules/menu/tpl/dist/styles.bundle.js"></script>');
    srcList.push('<script type="text/javascript" src="' + jsux.rootPath +'modules/menu/tpl/dist/vendor.bundle.js"></script>');
    srcList.push('<script type="text/javascript" src="' + jsux.rootPath +'modules/menu/tpl/dist/main.bundle.js"></script>');

    for (var i=0; i<srcList.length; i++) {
      $(srcList[i]).appendTo('body');
    }
  },
  init: function() {
    this.setLayout();
  }
};