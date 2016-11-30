window.jsux = window.jsux || {};
window.jsux.define = function( var_name, value) {

	if (!jsux.hasOwnProperty(var_name)) {
		jsux[var_name] = value;
	} else {
		console.log(var_name + " : This Properties Already Exists");
	}
};

window.trace = function( str, bool ) {

	if (bool) {
		console.log( str );
		return;
	}
	alert( str );	
};


(function( manager, exports ) {

	var Class = null,
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

	manager.getJSON = function(path, data, func) {

		var params = {
			method: func,
			data:data
		};

		if (typeof(params.data) == "function") {			
			params.method = params.data;
			params.data = "";
		}

		if (!params.data) {
			params.data = "";
		}

		if (jQuery) {
			$.ajax({
				type: "POST",
				url: path,
				data: params.data,
				dataType: "jsonp",
				success: function( e ) {
					params.method( e );
				}
			});
		}
	};

	manager.setAutoFocus = function( filters) {

		$filters = filters;
		$filters = !$filters ? "text|password" : $($filters).toLowerCase();
		$("form").each(function(index) {

			$inputs = $(this).find('input');
			$($inputs).each(function(index){
			
				$input = $(this);
				$target = $input.attr('type').toLowerCase();
				if ($target.match($filters)) {
					//console.log($input.val());
					if ($input.val() === '') {
						$input.focus();
						return false;

					}						
				}					
			});
		});
	};
	
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

		if (parent) {
			this.prototype = jsux.Class.extend( parent );
		}		
		return jsux.Class.create(this);
	}
});

jsux.View = jsux.Class.create( jsux.Observer );
jsux.View.extend({

	create: function( parent ) {

		var klass = null;
		if (parent) {
			this.prototype = jsux.Class.extend( parent );
		}	
		
		return  jsux.Class.create(this);
	}
});



