/**
 * class jsux
 * ver 1.1.4
 * update 2017.12.02
 * author streamux.com
 * description 'logger loglevel 디폴트 값 추가' 
 */
window.jsux = window.jsux || {};
window.jsux.define = function( var_name, value) {

  if (!jsux.hasOwnProperty(var_name)) {
    jsux[var_name] = value;
  } else {
    console.log(var_name + " : This Properties Already Exists");
  }
};

window.trace = function( msg, isConsole ) {

  if (isConsole) {
    console.log( msg );
    return;
  }
  alert( msg );
};

(function( manager, exports ) {

  var Class = null,
        Logger = null,
        LogLevel = null,
        ReadyManager = null;

  Class = function( parent ) {

    var klass = function() {
      this.init.apply(this, arguments);
    };

    klass.prototype.init = function() {};

    // Inheritance
    this.extend = function( parent ) {

      var subclass = function() {};
      subclass.prototype = parent.prototype;
      return new subclass();
    };

    if (parent) {
      klass.prototype =  this.extend( parent );
    }

    klass.proxy = function(func){

      var self = this;
      return(function(){
        return func.apply(self, arguments);
      });
    };
    
    klass.fn = klass.prototype; 
    klass.fn.parent = klass;
    
    // add class's method
    klass.extend = function(obj) {
      
      var extended = obj.extended;
      for (var i in obj) {
        klass[i] = obj[i];
      } 
      if (extended) extended(klass);
    };
    
    klass.include = function(obj) {
      
      var included = obj.included;      
      for (var i in obj) {
        klass.fn[i] = obj[i];
      }

      if (included) included(klass);
    };
    
    return klass;
  };

  ReadyManager = function() {
    
    var self = this,
      callbackes = [];
    
    this.init = function() {
      this.promise();
    };
    
    this.ready = function(o) {
      
      callbackes.push(o);
    };
    
    this.callFunc = function() {

      var len = callbackes.length;
      
      while (len--){
        (callbackes[len])();
        delete callbackes[len];
      }
      callbackes = [];
    };
    
    this.completed = function() {
      
      self.detach();
      self.callFunc();
    };
    
    this.detach = function() {
      
      if (exports.addEventListener) {
        exports.removeEventListener("load", this.completed, false);
      } else {
        exports.detachEvent("onLoad", this.completed);
      }
    };
    
    this.promise = function() {
      
      if (exports.addEventListener) {
        exports.addEventListener("load", this.completed, false);
      } else {
        exports.attachEvent("onLoad", this.completed);
      }
    };
    
    this.init();
  };

  manager.getJSON = function(path, data, func, error) {

    var params = {
      method: func,
      data:data,
      error: error
    };

    if (typeof(data) == "function") {     
      params.method = data;
      params.data = "";
      params.error = func;      
    }

    if (!params.data) {
      params.data = "";
    }

    if (jQuery) {
      $.ajax({
        type: 'POST',
        url: path,
        data: params.data,
        dataType: 'jsonp',
        success: function( e ) {
          params.method( e );
        },
        error: function(e) {
          params.error( e );
        }
      });
    }
  };

  manager.ajax = function(path, data, func, error) {

    var params = {
      method: func,
      data:data,
      error: error
    };

    if (typeof(data) == "function") {     
      params.method = data;
      params.data = "";
      params.error = func;      
    }

    if (!params.data) {
      params.data = "";
    }

    if (jQuery) {
      $.ajax({
        url: path,
        data: params.data,
        success: function( e ) {
          params.method( e );
        },
        error: function(e) {
          params.error( e );
        }
      });
    }
  }

  manager.setAutoFocus = function( filters) {

    $filters = filters;
    $filters = !$filters ? "text|password" : $($filters).toLowerCase();
    $("form").each(function(index) {

      $inputs = $(this).find('input');
      $($inputs).each(function(index){
      
        $input = $(this);
        $target = $($input).attr('type') ? $($input).attr('type') : $input.nodeName.toLowerCase();
        if ($target.match($filters)) {
          //console.log($input.attr('name'), $input.val());
          if ($input.val() === '') {
            $input.focus();
            return false;
          }           
        }         
      });
    });
  };

  manager.isMobile = function() {

    var isMobile = false; //initiate as false

    // device detection
    if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) isMobile = true;
  }
  
  manager.goURL = function( url, target ) {

    if (!url) {
      trace("링크가 존재하지 않습니다.");
      return;
    }

    if (target) {
      exports.open(url,target);
    } else {
      exports.location.href = url;
    }
  };
  
  manager.history = {

    back: function() {
      exports.history.back();
    }
  };

  manager.utils = {

    digit: function(value) {
      var result = (value < 10) ? ('0' + value) : value;
      return result;
    },
    addComma: function(num) {

      return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    removeComma: function(num) {

      return this.replace(/,/g, '');
    },
    validateEmail: function(value) {

      var reg = /^([a-zA-Z0-9_+.-])+@([a-zA-Z0-9_-])+(\.[a-z0-9_-]+){1,2}$/;
      if (!reg.test(value)) {
        return false;
      }
      return true;
    },
    validateHp: function(value) {

      var hpNum = value.replace(/\s-\s/g,''),
            reg = null;

      if (!(hpNum.length > 9 && hpNum.length < 12)) {
        return false;
      }

      if (hpNum.length === 10) {
         reg = /^(\d{3})+(\d{3})+(\d{4})+$/;    
      }
      if (hpNum.length === 11) {
        reg = /^(\d{3})+(\d{4})+(\d{4})+$/;    
      }

      if (!reg.test(hpNum)) {
        return false;
      }

      return hpNum.replace(reg, '$1 - $2 - $3');
    }
  };

  LogLevel = function() {
    this.DEBUG = 0;
    this.INFO = 1;
    this.WARN = 2;
    this.ERROR = 3;
  };
  manager.LogLevel = new LogLevel();

  Logger = function(logLevel) {

    this.isConsole = true;
    this.logLevel = logLevel || manager.LogLevel.DEBUG;
    this.logs = [];
    this.logLabels = ['debug','info','warn','error'];

    if (isNaN(this.logLevel)) {
      trace('Log Label is not a Number', isConsole);
      return;
    }

    this.debug = function(msg, file, nline) {
      this.log(manager.LogLevel.DEBUG, msg);
    };
    this.info = function(msg, file, nline) {
      this.log(manager.LogLevel.INFO, msg);
    };
    this.warn = function(msg, file, nline) {
      this.log(manager.LogLevel.WARN, msg);
    };
    this.error = function(msg, file, nline) {
      this.log(manager.LogLevel.ERROR, msg, file, nline);
    };

    this.log = function(logLevel, msg, file, nline) {

      var output = 'no msg';

      if (this.isProperLogLevel(logLevel)) {

        if (msg) {
          output = '[' + this.getLagLevel(logLevel) + '] - ' + msg;
        }

        if (file) {
          output += ' (' + file;

          if (nline) {
            output +=  ':' + nline + ')';
          } else {
            output += ')';
          }
        }
        
        trace(output, this.isConsole);
      }    
    }

    this.isProperLogLevel = function(logLevel) {

      if (this.logLevel === manager.LogLevel.DEBUG) return true;
      return logLevel >= this.logLevel;
    };
    this.getLagLevel = function(logLevel) {
      return this.logLabels[logLevel];
    };
  };

  manager.logger = new Logger(manager.LogLevel.DEBUG);  

  manager.exports = exports;
  manager.Class = {
    create:function(parent) {
      return new Class(parent);
    }
  };
  
  manager.readyManager = new ReadyManager();
  manager.ready = function( o ) {   
    this.readyManager.ready(o);
  };
  
})( jsux, window);

jsux.EventDispatcher = jsux.Class.create();
jsux.EventDispatcher.include({

  registerList: {},

  dispatchEvent: function( e ) {

    var arr, func, handler, i,target,
      type = typeof e === "string" ? e : e.type;

    if (this.registerList.hasOwnProperty(type)) {
      arr = this.registerList[type];

      for (i=0; i<arr.length; i++) {
        handler = arr[i];
        func = handler.method;
        target = handler.target;

        if (typeof func === "string") {
          func = this[func];
        }

        if (target === this) {
          func.apply( this, handler.parameters || [ e ]);
        }       
      }
    }
  },
  addEventListener: function( type, listener, arg) {

    var handler = {
      target: this,
      method: listener,
      parameters: arg
    };

    if (this.registerList.hasOwnProperty(type)) {
      this.registerList[type].push(handler);          
    } else {
      this.registerList[type] = [handler];
    }

    return this;
  },
  removeEventListener: function( type, listener) {

    var handler, arr, i, item;

    if (this.registerList.hasOwnProperty(type)) {
      arr = this.registerList[type];

      for (i=0; i<arr.length; i++) {
        handler = arr[i].method;

        if (handler === listener) {
          item =  arr.splice(i,1);
          item = null;
        }
      }
      return true;
    }   
    return false;
  }
});

jsux.Observables = jsux.Class.create( jsux.EventDispatcher );
jsux.Observables.include({

  observers:  [],
  changed: false,

  addObserver: function( o ) {

    if (o === null) {
      return;
    }

    for (var i=0; i<this.observers.length; ++i) {
      if (this.observers[i] == o) {
        return false;
      }
    }
    this.observers.unshift(o);
    return true;
  },
  removeObserver: function( o ) {

    var len = this.observers.length;

    for (var i=this.observers.length-1; i>=0; i--) {
      if (this.observers[i] == o) {
        this.observers.splice(i, 1);
        return true;
      }
    }
    return false;
  },
  notifyObserver: function( infoObj ) {

    if (infoObj === false) {
      infoObj = null;
    }

    if (!this.changed) {
      return;
    }
    var observersCopy = this.observers.slice(0);
    this.clearChanged();

    for (var i=observersCopy.length-1; i>=0; i--) {
      observersCopy[i].update( this, infoObj );
    }
  },
  clearObserver: function() {

    this.observers = [];
  },
  setChanged: function() {

    this.changed = true;
  },
  clearChanged: function() {

    this.changed = false;
  },
  hasChanged: function() {

    return this.changed;
  },
  countObserver: function() {

    return this.observers.length;
  }
});


jsux.Observer = jsux.Class.create( jsux.EventDispatcher );
jsux.Observer.include({

  update: function( o, infoObj ) {
    
    // override
    console.log("use View's update method to override Observer's update method");
  }
});

jsux.Model = jsux.Class.create( jsux.Observables );
jsux.Model.extend({

  create: function( parent ) {

    var kass = this;
    if (parent) {
      kass = jsux.Class.create(parent);
    }   
    return kass;
  }
});

jsux.View = jsux.Class.create( jsux.Observer );
jsux.View.extend({

  create: function( parent ) {

    var kass = this;
    if (parent) {
      kass = jsux.Class.create(parent);
    }   
    return kass;
  }
});



