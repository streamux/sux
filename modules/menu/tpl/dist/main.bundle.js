webpackJsonp(["main"],{

/***/ "./src/$$_gendir lazy recursive":
/***/ (function(module, exports) {

function webpackEmptyAsyncContext(req) {
	// Here Promise.resolve().then() is used instead of new Promise() to prevent
	// uncatched exception popping up in devtools
	return Promise.resolve().then(function() {
		throw new Error("Cannot find module '" + req + "'.");
	});
}
webpackEmptyAsyncContext.keys = function() { return []; };
webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
module.exports = webpackEmptyAsyncContext;
webpackEmptyAsyncContext.id = "./src/$$_gendir lazy recursive";

/***/ }),

/***/ "./src/app/app-routing.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppRoutingModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__("./node_modules/@angular/router/@angular/router.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__common_page_not_found_component__ = __webpack_require__("./src/app/common/page-not-found.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__menus_menus_component__ = __webpack_require__("./src/app/menus/menus.component.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};




var routes = [
    { path: '', redirectTo: '/admin-admin', pathMatch: 'full' },
    { path: 'menu-admin', component: __WEBPACK_IMPORTED_MODULE_3__menus_menus_component__["a" /* MenusComponent */] },
    { path: 'menu-admin/list', component: __WEBPACK_IMPORTED_MODULE_3__menus_menus_component__["a" /* MenusComponent */] },
    { path: '**', component: __WEBPACK_IMPORTED_MODULE_2__common_page_not_found_component__["a" /* PageNotFoundComponent */] }
];
var AppRoutingModule = (function () {
    function AppRoutingModule() {
    }
    return AppRoutingModule;
}());
AppRoutingModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["M" /* NgModule */])({
        imports: [__WEBPACK_IMPORTED_MODULE_1__angular_router__["c" /* RouterModule */].forRoot(routes)],
        exports: [__WEBPACK_IMPORTED_MODULE_1__angular_router__["c" /* RouterModule */]]
    })
], AppRoutingModule);


/***/ }),

/***/ "./src/app/app.component.css":
/***/ (function(module, exports) {

module.exports = ""

/***/ }),

/***/ "./src/app/app.component.html":
/***/ (function(module, exports) {

module.exports = "<router-outlet></router-outlet>\n"

/***/ }),

/***/ "./src/app/app.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var AppComponent = (function () {
    function AppComponent() {
    }
    return AppComponent;
}());
AppComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["o" /* Component */])({
        selector: 'app-root',
        template: __webpack_require__("./src/app/app.component.html"),
        styles: [__webpack_require__("./src/app/app.component.css")]
    })
], AppComponent);


/***/ }),

/***/ "./src/app/app.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__ = __webpack_require__("./node_modules/@angular/platform-browser/@angular/platform-browser.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_platform_browser_animations__ = __webpack_require__("./node_modules/@angular/platform-browser/@angular/platform-browser/animations.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_forms__ = __webpack_require__("./node_modules/@angular/forms/@angular/forms.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_http__ = __webpack_require__("./node_modules/@angular/http/@angular/http.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5_nl2br_pipe__ = __webpack_require__("./node_modules/nl2br-pipe/src/nl2br.pipe.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__app_routing_module__ = __webpack_require__("./src/app/app-routing.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__common_page_not_found_component__ = __webpack_require__("./src/app/common/page-not-found.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__app_component__ = __webpack_require__("./src/app/app.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__menus_menus_component__ = __webpack_require__("./src/app/menus/menus.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__libs_directives_drag_listener_directive__ = __webpack_require__("./src/libs/directives/drag-listener.directive.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__menus_menu_service__ = __webpack_require__("./src/app/menus/menu.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__libs_services_http_adapter_service__ = __webpack_require__("./src/libs/services/http-adapter.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__libs_services_alert_service__ = __webpack_require__("./src/libs/services/alert.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__libs_services_string_util_service__ = __webpack_require__("./src/libs/services/string-util.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__libs_pipes_string_compare_pipe__ = __webpack_require__("./src/libs/pipes/string-compare.pipe.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__libs_pipes_string_split_pipe__ = __webpack_require__("./src/libs/pipes/string-split.pipe.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__libs_pipes_string_uppercase_at_pipe__ = __webpack_require__("./src/libs/pipes/string-uppercase-at.pipe.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__libs_pipes_number_comma_add_pipe__ = __webpack_require__("./src/libs/pipes/number-comma-add.pipe.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__libs_pipes_number_comma_remove_pipe__ = __webpack_require__("./src/libs/pipes/number-comma-remove.pipe.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};





















var AppModule = (function () {
    function AppModule() {
    }
    return AppModule;
}());
AppModule = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["M" /* NgModule */])({
        declarations: [
            __WEBPACK_IMPORTED_MODULE_8__app_component__["a" /* AppComponent */],
            __WEBPACK_IMPORTED_MODULE_9__menus_menus_component__["a" /* MenusComponent */],
            /* directives */
            __WEBPACK_IMPORTED_MODULE_10__libs_directives_drag_listener_directive__["a" /* DragListenerDirective */],
            __WEBPACK_IMPORTED_MODULE_15__libs_pipes_string_compare_pipe__["a" /* StringComparePipe */],
            __WEBPACK_IMPORTED_MODULE_16__libs_pipes_string_split_pipe__["a" /* StringSplitPipe */],
            __WEBPACK_IMPORTED_MODULE_17__libs_pipes_string_uppercase_at_pipe__["a" /* StringUppercaseAtPipe */],
            __WEBPACK_IMPORTED_MODULE_18__libs_pipes_number_comma_add_pipe__["a" /* NumberCommaAddPipe */],
            __WEBPACK_IMPORTED_MODULE_19__libs_pipes_number_comma_remove_pipe__["a" /* NumberCommaRemovePipe */],
            __WEBPACK_IMPORTED_MODULE_5_nl2br_pipe__["a" /* Nl2BrPipe */],
            __WEBPACK_IMPORTED_MODULE_7__common_page_not_found_component__["a" /* PageNotFoundComponent */]
        ],
        imports: [
            __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__["a" /* BrowserModule */],
            __WEBPACK_IMPORTED_MODULE_2__angular_platform_browser_animations__["a" /* BrowserAnimationsModule */],
            __WEBPACK_IMPORTED_MODULE_3__angular_forms__["a" /* FormsModule */],
            __WEBPACK_IMPORTED_MODULE_3__angular_forms__["b" /* ReactiveFormsModule */],
            __WEBPACK_IMPORTED_MODULE_4__angular_http__["c" /* HttpModule */],
            __WEBPACK_IMPORTED_MODULE_4__angular_http__["e" /* JsonpModule */],
            __WEBPACK_IMPORTED_MODULE_6__app_routing_module__["a" /* AppRoutingModule */]
        ],
        providers: [
            __WEBPACK_IMPORTED_MODULE_11__menus_menu_service__["a" /* MenuService */],
            __WEBPACK_IMPORTED_MODULE_14__libs_services_string_util_service__["a" /* StringUtilService */],
            __WEBPACK_IMPORTED_MODULE_12__libs_services_http_adapter_service__["a" /* HttpAdapterService */],
            __WEBPACK_IMPORTED_MODULE_13__libs_services_alert_service__["a" /* AlertService */]
        ],
        bootstrap: [__WEBPACK_IMPORTED_MODULE_8__app_component__["a" /* AppComponent */]]
    })
], AppModule);


/***/ }),

/***/ "./src/app/common/page-not-found.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"page-not-found\">\n  <h2>Page Not Found</h2>\n</div>"

/***/ }),

/***/ "./src/app/common/page-not-found.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PageNotFoundComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var PageNotFoundComponent = (function () {
    function PageNotFoundComponent() {
    }
    PageNotFoundComponent.prototype.ngOnInit = function () {
    };
    return PageNotFoundComponent;
}());
PageNotFoundComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["o" /* Component */])({
        selector: 'page-not-found-panel',
        template: __webpack_require__("./src/app/common/page-not-found.component.html")
    })
], PageNotFoundComponent);


/***/ }),

/***/ "./src/app/menus/menu.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MenuService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_http__ = __webpack_require__("./node_modules/@angular/http/@angular/http.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_map__ = __webpack_require__("./node_modules/rxjs/_esm5/add/operator/map.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_operator_catch__ = __webpack_require__("./node_modules/rxjs/_esm5/add/operator/catch.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__libs_services_http_adapter_service__ = __webpack_require__("./src/libs/services/http-adapter.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var MenuService = (function () {
    function MenuService(http) {
        this.http = http;
    }
    MenuService.prototype.getMenusJson = function () {
        var url = "menu-admin/list-json";
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('callback', 'JSON_CALLBACK');
        return this.http.get(url, { params: params })
            .map(function (res) { return res.json(); });
    };
    MenuService.prototype.getMenuJson = function (id) {
        var url = "menu-admin/list-json?id=" + id;
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('callback', 'JSON_CALLBACK');
        return this.http.get(url, { params: params })
            .map(function (res) { return res.json(); });
    };
    MenuService.prototype.getGnbJson = function () {
        // 추후에 json 파일로 변환 
        var url = "menu-admin/gnb-list";
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('callback', 'JSON_CALLBACK');
        return this.http.get(url, { params: params })
            .map(function (res) { return res.json(); });
    };
    MenuService.prototype.addMenu = function (json) {
        var url = "menu-admin/menu";
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('_method', 'insert');
        params.set('callback', 'JSON_CALLBACK');
        return this.http.post(url, json, { params: params })
            .map(function (res) { return res.json(); });
    };
    MenuService.prototype.modifyMenu = function (json) {
        var url = "menu-admin/menu";
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('_method', 'update');
        params.set('callback', 'JSON_CALLBACK');
        return this.http.post(url, json, { params: params })
            .map(function (res) { return res.json(); });
    };
    MenuService.prototype.deleteMenu = function (json) {
        var url = "menu-admin/menu";
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('_method', 'delete');
        params.set('callback', 'JSON_CALLBACK');
        return this.http.post(url, json, { params: params })
            .map(function (res) { return res.json(); });
    };
    MenuService.prototype.saveJson = function (json) {
        var url = "menu-admin/save-json";
        var params = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["g" /* URLSearchParams */]();
        params.set('_method', 'insert');
        params.set('callback', 'JSON_CALLBACK');
        return this.http.post(url, json, { params: params }).
            map(function (res) { return res.json(); });
    };
    return MenuService;
}());
MenuService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_4__libs_services_http_adapter_service__["a" /* HttpAdapterService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_4__libs_services_http_adapter_service__["a" /* HttpAdapterService */]) === "function" && _a || Object])
], MenuService);

var _a;

/***/ }),

/***/ "./src/app/menus/menu.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Menu; });
var Menu = (function () {
    function Menu(id, category, menu_name, module_name, url, url_target, is_active, top, posy, height, depth, margin_left, padding_left, isDragging, isChecked, isPanelInfo, disabled, state, sub) {
        if (id === void 0) { id = 0; }
        if (category === void 0) { category = ''; }
        if (menu_name === void 0) { menu_name = ''; }
        if (module_name === void 0) { module_name = ''; }
        if (url === void 0) { url = ''; }
        if (url_target === void 0) { url_target = '_self'; }
        if (is_active === void 0) { is_active = 0; }
        if (top === void 0) { top = 0; }
        if (posy === void 0) { posy = 0; }
        if (height === void 0) { height = 0; }
        if (depth === void 0) { depth = 1; }
        if (margin_left === void 0) { margin_left = 0; }
        if (padding_left === void 0) { padding_left = 5; }
        if (isDragging === void 0) { isDragging = false; }
        if (isChecked === void 0) { isChecked = false; }
        if (isPanelInfo === void 0) { isPanelInfo = false; }
        if (disabled === void 0) { disabled = false; }
        if (state === void 0) { state = 'default'; }
        if (sub === void 0) { sub = null; }
        this.id = id;
        this.category = category;
        this.menu_name = menu_name;
        this.module_name = module_name;
        this.url = url;
        this.url_target = url_target;
        this.is_active = is_active;
        this.top = top;
        this.posy = posy;
        this.height = height;
        this.depth = depth;
        this.margin_left = margin_left;
        this.padding_left = padding_left;
        this.isDragging = isDragging;
        this.isChecked = isChecked;
        this.isPanelInfo = isPanelInfo;
        this.disabled = disabled;
        this.state = state;
        this.sub = sub;
    }
    return Menu;
}());


/***/ }),

/***/ "./src/app/menus/menus.component.css":
/***/ (function(module, exports) {

module.exports = ".sx_menu_admin{\n  word-break: break-all;\n}\n.sx_menu_admin .section .row{\n  margin:0 0;\n  padding: 0 0;\n}\n.sx_menu_admin .list-group{\n  -webkit-box-shadow: none;\n  -o-box-shadow: none;\n  box-shadow: none;\n}\n.sx_menu_admin,\n.sx_menu_admin .row{\n  position: relative;  \n}\n.sx_menu_admin .swiper-slide {\n  width:100%;\n}\n.sx_menu_admin .panel .panel-heading {\n  padding-bottom: 5px;\n}\n.sx_menu_admin .panel .panel-body {\n  padding: 10px 10px;\n}\n.sx_menu_admin .list-group-wrapper {\n  padding:0;\n}\n.sx_menu_admin .list-group-wrapper .glyphicon-new-window{    \n  color:#3e3e3e;\n  border: 0 solid #fff;\n  font-size: 0.875em;\n}\n.sx_menu_admin .list-group .alert {\n  margin-bottom: 0;\n}\n.sx_menu_admin .panel .menue_list_wrapper,\n.sx_menu_admin .panel .page_list_wrapper{\n  position: relative;\n}\n.sx_menu_admin .panel .panel-body > p{\n  position: relative;\n  padding-top: 15px;\n}\n/* page menu list */\n.sx_menu_admin .row {\n  padding-top:15px;\n}\n.sx_menu_admin .menu_list_panel li .list_item_line .icon_show_info,\n.sx_menu_admin .list-group-wrapper .glyphicon-new-window,\n.sx_menu_admin .page_group_panel .panel-heading,\n.sx_menu_admin .page_group_panel .glyphicon{\n  font-size: 0.75em;\n}\n.sx_menu_admin .page_group_panel .panel-heading{\n  position: relative;\n  padding: 0 10px;\n  line-height: 45px;\n  height: 45px;\n  cursor: pointer;\n  vertical-align: middle;\n}\n.sx_menu_admin .page_group_panel .panel-heading .glyphicon{\n  position: absolute;\n  top:50%;\n  right: 15px;\n  -webkit-transform: translateY(-50%);\n          transform: translateY(-50%);\n}\n.sx_menu_admin .page_group_panel li {\n  padding: 10px 15px 2px 15px;\n  border: 0 solid transparent;\n  border-radius: 0;\n  background-color: transparent;\n  word-break: break-all;\n}\n.sx_menu_admin .page_list_panel .custom_checkbox{\n  border: 1px solid #b4b9be;\n  background: #fff;\n  color: #555;\n  clear: none;\n  cursor: pointer;\n  display: inline-block;\n  line-height: 0;\n  height: 16px;\n  margin: -4px 4px 0 0;\n  outline: 0;\n  padding: 0!important;\n  text-align: center;\n  vertical-align: middle;\n  width: 16px;\n  min-width: 16px;\n  -webkit-appearance: none;\n  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);\n          box-shadow: inset 0 1px 2px rgba(0,0,0,.1);\n  -webkit-transition: .05s border-color ease-in-out;\n  transition: .05s border-color ease-in-out;\n}\n.sx_menu_admin .page_list_panel .custom_checkbox:checked{\n  border-color:#5b9dd9;\n  -webkit-box-shadow:0 0 2px rgba(30,140,190,.8);\n          box-shadow:0 0 2px rgba(30,140,190,.8)\n}\n.sx_menu_admin .page_list_panel .custom_checkbox:checked:before{\n  float:left;\n  display:inline-block;\n  vertical-align:middle;\n  width:16px;\n  font:400 14px/1 dashicons;\n  speak:none;\n  -webkit-font-smoothing:antialiased;\n  -moz-osx-font-smoothing:grayscale;\n\n  content:\"\\2714\";\n  color:#1e8cbe\n}\n.sx_menu_admin .page_list_panel .page_list_body{\n  padding: 10px;\n}\n.sx_menu_admin .page_list_panel .page_list_body .page_list_wrapper{\n  overflow:auto;\n  padding-top:5px;\n  height:240px;\n  border:1px solid #ddd;\n  background-color: #fdfdfd;\n}\n.sx_menu_admin .page_list_panel .page_list_body label {\n  font-weight: normal;\n  cursor: pointer;\n}\n.sx_menu_admin .page_list_panel .panel-footer{\n  background-color: #fff;\n}\n.sx_menu_admin .page_list_panel .panel-footer .input-group{\n  margin-top: 5px;\n}\n.sx_menu_admin .page_list_panel .panel-footer .input-group label{\n  margin-left: 0;\n  vertical-align: top;\n  cursor: pointer;\n}\n/* user link panel */\n.sx_menu_admin .user_link_panel .user_link_body{\n  padding-top: 30px;\n}\n.sx_menu_admin .user_link_panel .sx-callout{\n  margin-top:5px;\n}\n/* gnb menu list */\n.sx_menu_admin .menu_list_panel .panel-heading,\n.sx_menu_admin .menu_list_panel .panel-footer{\n  position: relative;\n  padding:0 10px;\n  line-height:55px;\n  height:55px;\n  vertical-align: middle;\n}\n.sx_menu_admin .menu_list_panel .panel-heading .btn,\n.sx_menu_admin .menu_list_panel .panel-footer .btn{\n  padding: 8px 10px;\n}\n.sx_menu_admin .menu_list_panel .btn_group{\n  position: absolute;\n  top: 50%;\n  right:10px;\n  -webkit-transform: translateY(-50%);\n          transform: translateY(-50%);\n}\n.sx_menu_admin .menu_list_panel .btn_group button[name=edit_json_menu]{\n  display: inline-block;\n}\n.sx_menu_admin .menu_list_panel .btn_group button[name=cancel_json_menu],\n.sx_menu_admin .menu_list_panel .btn_group button[name=save_json_menu]{\n  display: none;\n}\n.sx_menu_admin .menu_list_panel .btn_group button[name=edit_json_menu].active_json_menu{\n  display: none;\n}\n.sx_menu_admin .menu_list_panel .btn_group button[name=cancel_json_menu].active_json_menu,\n.sx_menu_admin .menu_list_panel .btn_group button[name=save_json_menu].active_json_menu{\n  display: inline-block;\n}\n.sx_menu_admin .menu_list_panel .panel-body .word_keep_all{\n  padding-left: 5px;\n}\n.sx_menu_admin .menu_list_panel .menu_list_wrapper{\n  position: relative;\n  margin:10px 10px;\n  min-height: 206px;\n}\n.sx_menu_admin .menu_list_panel .menu_list_wrapper .list-group-wrapper{\n  padding:0;\n}\n.sx_menu_admin .menu_list_panel li {\n  position: relative;\n  padding:0;\n  border: 0 solid transparent;\n  border-radius: 0;\n}\n.sx_menu_admin .menu_list_panel li .list_item_dashed {\n  /* padding-left 시작 값은 sx_menu_admin.component.ts 파일에 정의 됨 */\n  padding:5px 5px;\n  background-color: #fff;\n}\n.sx_menu_admin .menu_list_panel li .list_item_line{\n  overflow: hidden;\n  padding: 0 ;\n  font-weight: 600;\n  font-family: \"NanumGoThic\",-apple-system,BlinkMacSystemFont,\"Segoe UI\",Roboto,Oxygen-Sans,Ubuntu,Cantarell,\"Helvetica Neue\",sans-serif;\n  line-height: 38px;\n  border:1px solid #d3d3d3;\n  background-color: #f9f9f9;\n}\n.sx_menu_admin .menu_list_panel li .list_draggable_item{\n  position: relative;\n  height:48px;\n}\n.sx_menu_admin .menu_list_panel li .menu_label,\n.sx_menu_admin .menu_list_panel li .menu_module {\n  position: relative;\n  display: inline-block;\n}\n.sx_menu_admin .menu_list_panel li .menu_label{\n  top:3px;\n  margin-left: 10px;\n}\n.sx_menu_admin .menu_list_panel li .menu_module {\n  position: absolute;\n  display: inline-block;\n  top:3px;\n  right:45px;\n  font-size: 0.938em;\n  font-weight: 300;\n  color: #3e3e3e;\n}\n.sx_menu_admin .menu_list_panel li .list_panel_info {\n  padding: 10px 10px;\n  width:100%;\n  background-color: #fff;\n  font-size: 0.875em;\n}\n.sx_menu_admin .menu_list_panel li .list_panel_info .form-group label{\n  line-height: 20px;\n  vertical-align: bottom;\n}\n.sx_menu_admin .menu_list_panel li .list_panel_info .form-group span{\n  font-weight: 300;\n}\n.sx_menu_admin .menu_list_panel li .list_item_line_active{\n  height: auto;\n}\n.sx_menu_admin .menu_list_panel li .list_item_line_unactive{\n  height: 48px;\n}\n.sx_menu_admin .menu_list_panel li .list_item_line_active .list_panel_info{\n  display: inline-block;\n}\n.sx_menu_admin .menu_list_panel li .list_item_line_unactive .list_panel_info{\n  display: none;\n}\n.sx_menu_admin .menu_list_panel li .list_panel_info input,\n.sx_menu_admin .menu_list_panel li .list_panel_info label{\n  font-weight: normal;\n}\n.sx_menu_admin .menu_list_panel li .btn_show_info{\n  position: absolute;\n  display: inline-block;\n  top:4px;\n  right:0;\n}\n.sx_menu_admin .menu_list_panel li .btn_show_info .icon_show_info{\n  padding:10px 10px;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_draggable_item{\n  cursor: move;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable.active {\n  color: #333;\n  background-color: transparent;\n\n  font-weight: normal;\n  text-shadow: none;\n  background-image: none;\n  background-repeat: repeat-x;  \n  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff337ab7', endColorstr='#ff2b669a', GradientType=0); \n}\n.sx_menu_admin .menu_list_panel li.btn_draggable.active_border_top .list_item_dashed{\n  border-top: 1px dashed #9e9e9e;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable.active .list_item_dashed {\n  border-left: 1px dashed #9e9e9e;\n  border-right: 1px dashed #9e9e9e;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable.active_border_bottom .list_item_dashed{\n  border-bottom: 1px dashed #9e9e9e;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable .btn_drag{\n  margin-top:7px;\n  cursor: move;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable .btn_drag:focus,\n.sx_menu_admin .menu_list_panel li.btn_draggable .btn_drag:active {\n  -webkit-box-shadow: none;\n          -o-box-shadow: none;\n              box-shadow: none;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable .menu_label{\n  margin-left: 0;\n}\n.sx_menu_admin .menu_list_panel li.btn_draggable.active .list_item_line,\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_item_line:focus,\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_item_line:active,\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_item_line:hover{\n  border-color: #939393;\n  background-color: #f3f3f3;\n}\n.sx_menu_admin .menu_list_panel li .list_item_disabled,\n.sx_menu_admin .menu_list_panel li.btn_draggable.active .list_item_disabled,\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_item_disabled:focus,\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_item_disabled:active,\n.sx_menu_admin .menu_list_panel li.btn_draggable .list_item_disabled:hover{\n  background-color: #f72a2d;\n}\n.sx_menu_admin .output-panel .panel-heading {\n  line-height: 30px;\n  padding:5px 5px 5px 12px;\n}\n.sx_menu_admin .output-panel .panel-body {\n  padding:15px;\n}\n@media (min-width: 768px) {\n\n  .sx_menu_admin .sx_plugin_panel{\n    position: relative;\n    display: inline-block;\n    vertical-align: top;\n  }\n  .sx_menu_admin .page_group_panel{    \n    margin-right:-2px;\n    width:40%;\n  }\n  .sx_menu_admin .menu_list_panel{\n    margin-left:-2px;\n    width:60%;\n  }\n  .sx_menu_admin .sx_plugin_panel .page_item_pane{\n    margin-right: 15px;\n  }\n  .sx_menu_admin .sx_plugin_panel .menu_item_pane{\n    margin-left: 15px;\n  }\n}"

/***/ }),

/***/ "./src/app/menus/menus.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"sx-content sx_menu_admin\" (dragEventRequest)=\"onDragListener($event)\" dragListener>\n  <section class=\"section\">\n    <header class=\"header\">\n      <h1 class=\"title\">메뉴 관리</h1>\n    </header>\n\n    <div class=\"row\">      \n      <!-- Page Menu List -->\n      <div class=\"page_group_panel sx_plugin_panel\"> \n        <div class=\"page_item_pane panel-group\">        \n        \n          <div class=\"page_list_panel panel panel-default\">       \n            <div class=\"panel-heading clearfix\"\n                (click)=\"togglePagePanel();\">\n\n              <span class=\"panel-title\">페이지</span>\n              <span class=\"glyphicon pull-right\"\n                    [class.glyphicon-triangle-top]=\"activePage === 'page_list' && isActivePage === true\"\n                    [class.glyphicon-triangle-bottom]=\"activePage !== 'page_list' || isActivePage !== true\"></span>\n            </div>\n            <div class=\"page_list_body\"\n                [hidden]=\"activePage !== 'page_list' || isActivePage !== true\">\n              <div class=\"page_list_wrapper\">\n                <img src=\"{{ resourceUrl }}common/images/loadingbar_stick.gif\" class=\"img_loader\" alt=\"로딩 중\"\n                    *ngIf=\"!isPageLoaded\"/>\n                <ul class=\"list-group-wrapper\">\n                  \n                  <li class=\"list-group-item\"\n                      *ngFor=\"let menu of pageMenus; let i=index\">\n                    <label>\n                      <input type=\"checkbox\" name=\"isChecked\" class=\"custom_checkbox\" \n                        [(ngModel)]=\"menu.isChecked\" (change)=\"changeCheck();$event.preventDefault();\"/>\n                      {{ menu.menu_name }}\n                    </label>\n                    <a href=\"{{ resourceUrl }}{{ menu.url }}\" target=\"{{ menu.url_target}}\" title=\"페이지로 이동\">\n                       <span class=\"glyphicon glyphicon-new-window\" alt=\"페이지로 이동\"></span>\n                    </a> \n                  </li>\n                  <li class=\"list-group-item\"\n                      *ngIf=\"isPageLoaded && pageMenus.length == 0\">\n                    등록된 메뉴가 존재하지 않습니다.\n                  </li>\n                </ul>\n              </div>         \n            </div> \n            <div class=\"panel-footer clearfix\" [hidden]=\"activePage !== 'page_list' || isActivePage !== true\">\n              <div class=\"input-group pull-left\">              \n                <label class=\"form-control-label\">\n                  <input type=\"checkbox\" name=\"isCheckedAll\" class=\"custom_checkbox\" \n                    [(ngModel)]=\"isCheckedAll\" (change)=\"changeCheckAll();\"/>\n                    모두 선택\n                </label>\n              </div>            \n              <button type=\"button\" class=\"btn btn-default pull-right\" \n                  (click)=\"addPageToMenu(customModel.link_name, customModel.link_value);\">메뉴에 추가</button>\n            </div>\n          </div> \n\n          <div class=\"user_link_panel panel panel-default\">       \n            <div class=\"panel-heading clearfix\"\n                (click)=\"toggleCustomPagePanel();\">\n               <span class=\"panel-title\">사용자 정의 메뉴</span>\n               <span class=\"glyphicon pull-right\"                \n                  [class.glyphicon-triangle-top]=\"activePage === 'custom_link' &&\n                                                                  isActiveCustomPage === true\"\n                  [class.glyphicon-triangle-bottom]=\"activePage !== 'custom_link' ||\n                                                                        isActiveCustomPage !== true\"></span>\n            </div>\n            <div class=\"user_link_body panel-body\"\n                [class.hide]=\"activePage !== 'custom_link' || isActiveCustomPage !== true\">\n              <div class=\"form-group\">\n                <label for=\"linkMenuName\">링크 메뉴 이름</label>\n                <input type=\"text\" id=\"linkMenuName\" name=\"link_name\" class=\"form-control\" placeholder=\"링크 메뉴 이름\" \n                    [(ngModel)]=\"customModel.link_name\">\n                <div class=\"sx-callout sx-callout-danger alert-danger\" role=\"alert\"\n                    [hidden]=\"linkTextMsg === ''\">{{linkTextMsg}}</div>\n              </div>\n              <div class=\"form-group\">\n                <label for=\"linkInput\">URL 또는 라우트 주소</label>\n                <input type=\"text\" id=\"linkInput\" name=\"link_value\"  class=\"form-control\" placeholder=\"링크 주소\"\n                    [(ngModel)]=\"customModel.link_value\">\n                <div [hidden]=\"linkURLMsg === ''\" class=\"sx-callout sx-callout-danger alert-danger\" role=\"alert\">{{linkURLMsg}}</div>\n              </div>\n              <div class=\"form-group text-right\" role=\"group\">\n                <button type=\"button\" class=\"btn btn-default\" \n                    (click)=\"createCustomPage(customModel.link_name, customModel.link_value);\">메뉴에 추가</button>\n              </div>\n            </div>          \n          </div>\n        </div>     \n      </div>\n      <!-- End of Page Menu List -->\n\n      <!-- Gnb Menu List -->\n      <div class=\"menu_list_panel sx_plugin_panel\">\n        <div class=\"menu_item_pane panel panel-default\">              \n          <div class=\"panel-heading\">\n            <span class=\"panel-title\">메뉴 구조</span>\n            <div class=\"btn_group\">\n              <button type=\"button\" name=\"edit_json_menu\" class=\"btn btn-default btn-sm\" role=\"button\"\n                  (click)=\"editJson()\" [class.active_json_menu]=\"isEditing\">편집하기</button>\n              <button type=\"button\" name=\"cancel_json_menu\" class=\"btn btn-default btn-sm\" role=\"button\"\n                  (click)=\"cancelJson()\" [class.active_json_menu]=\"isEditing\">취소하기</button>\n              <button type=\"button\" name=\"save_json_menu\" class=\"btn btn-info btn-sm\" role=\"button\"\n                  (click)=\"saveJson()\" [class.active_json_menu]=\"isEditing\">저장하기</button>\n            </div>\n          </div>\n\n          <div class=\"panel-body\">\n            <p class=\"word_keep_all\">편집하기 버튼을 클릭한 후 각 메뉴를 원하는 위치로 끌어놓으세요.</p>          \n            <div class=\"sx-callout sx-callout-danger alert-danger\" role=\"alert\"\n                [hidden]=\"menuMsg === ''\">\n              <div [innerHTML]=\"menuMsg | nl2br\"></div>\n            </div>\n          </div>  \n\n          <div class=\"menu_list_wrapper\">\n            <img src=\"{{ resourceUrl }}common/images/loadingbar_stick.gif\" class=\"img_loader\" alt=\"로딩 중\"\n                *ngIf=\"!isMenuLoaded\"/>\n            <ul class=\"list-group list-group-wrapper\">            \n              <li class=\"list-group-item  clearfix\"\n                  *ngFor=\"let menu of gnbMenus; let i=index\"\n                  [@menuState]= \"menu.state\" \n                  [style.padding-left.px]=\"textIndent*(menu.depth-1)\" \n                  [style.top.px]=\"menu.top\"                 \n                  [style.z-index]=\"menu.isDragging === true ? 10 : 0\"\n                  [class.btn_draggable]=\"isEditing\"  \n                  [class.active]=\"menu.isDragging\" \n                  [class.active_border_top]=\"i == dragIndex && menu.isDragging === true\"\n                  [class.active_border_bottom]=\"i == (dragIndex + dragMenuLength) && \n                                                                  menu.isDragging === true\" \n                  #listItems>\n\n                <div class=\"list_item_dashed\"\n                    [style.margin-left.px]=\"menu.margin_left\"\n                    [style.padding-left.px]=\"menu.padding_left\" >\n\n                  <div class=\"list_item_line\"                    \n                      [class.list_item_line_active]=\"menu.isPanelInfo\"\n                      [class.list_item_line_unactive]=\"!menu.isPanelInfo\"\n                      [class.list_item_disabled]=\"menu.disabled\">\n\n                    <div class=\"list_draggable_item\" [attr.data-key]=\"i\" >\n                      <button type=\"button\" class=\"btn_drag btn btn_style_none\" [class.hide]=\"!isEditing\">\n                        <span class=\"glyphicon glyphicon-option-vertical\"></span>\n                      </button>\n                      <span class=\"menu_label\">\n                        {{menu.menu_name}}\n                      </span>\n                      <span class=\"menu_module\">\n                        {{menu.module_name}}\n                      </span>                  \n                      <button type=\"button\" class=\"btn_show_info btn_style_none\"\n                          (click)=\"toggleItemInfoPanel(menu)\">\n                        <span class=\"glyphicon icon_show_info\"\n                            [class.glyphicon-triangle-top]=\"menu.isPanelInfo\"\n                            [class.glyphicon-triangle-bottom]=\"!menu.isPanelInfo\"></span>\n                      </button>\n                    </div>\n                    \n                    <div class=\"list_panel_info\"\n                        [class.list_item_disabled]=\"menu.disabled\">\n\n                      <div class=\"form-group\">\n                        <label for=\"menuName\">메뉴 이름</label>\n                        <input type=\"text\" id=\"menuName\" name=\"menu_name\" class=\"form-control\" placeholder=\"링크 메뉴 이름\" \n                            [(ngModel)]=\"menu.menu_name\">\n                      </div>\n                      <div class=\"form-group\">\n                        <label for=\"urlInput\">URL 또는 라우트 주소</label>\n                        <input type=\"text\" id=\"urlInput\" name=\"url\"  class=\"form-control\" placeholder=\"링크 주소\"\n                            [(ngModel)]=\"menu.url\"\n                            [class.hide]=\"menu.module_name !== 'customize'\">\n                        <span class=\"form-control\"\n                            [class.hide]=\"menu.module_name === 'customize'\">\n                            원본:<a href=\"{{ resourceUrl }}{{ menu.url }}\" target=\"{{ menu.url_target }}\" title=\"페이지 이동\">{{ menu.url | stringUppercaseAt }}</a></span>\n                      </div>\n                      <div class=\"form-group\">\n                        <label for=\"menuNurlTargetNameame\">URL Target</label>\n                        <input type=\"text\" id=\"urlTargetName\" name=\"url_target\" class=\"form-control\" placeholder=\"URL Target\" \n                            [(ngModel)]=\"menu.url_target\">\n                      </div>\n                      <div class=\"form-group text-right\" role=\"group\">\n                        <button type=\"button\" class=\"btn btn-default\"\n                            (click)=\"removeMenu(menu)\">삭제</button>\n                        <button type=\"button\" class=\"btn btn-default\"\n                            (click)=\"toggleItemInfoPanel(menu)\">취소</button>\n                      </div>\n                    </div><!-- end of list_panel_info -->\n                  </div><!-- end of list_item_line -->\n                </div><!-- end of list_item_dashed -->\n              </li>              \n              <li class=\"list-group-item\"\n                  *ngIf=\"isMenuLoaded && gnbMenus.length == 0\">\n                등록된 메뉴가 존재하지 않습니다.\n              </li>\n            </ul>\n          </div>\n          <div class=\"panel-footer\">\n            <div class=\"btn_group\">\n              <button type=\"button\" name=\"edit_json_menu\" class=\"btn btn-default btn-sm\" role=\"button\"\n                  (click)=\"editJson()\" [class.active_json_menu]=\"isEditing\">편집하기</button>\n              <button type=\"button\" name=\"cancel_json_menu\" class=\"btn btn-default btn-sm\" role=\"button\"\n                  (click)=\"cancelJson()\" [class.active_json_menu]=\"isEditing\" >취소하기</button>\n              <button type=\"button\" name=\"save_json_menu\" class=\"btn btn-info btn-sm\" role=\"button\"\n                  (click)=\"saveJson()\" [class.active_json_menu]=\"isEditing\">저장하기</button>\n            </div>\n          </div>\n        </div>\n      </div>\n      <!-- End of Gnb Menu List -->         \n    </div>\n  </section>"

/***/ }),

/***/ "./src/app/menus/menus.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return MenusComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__("./node_modules/@angular/router/@angular/router.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_animations__ = __webpack_require__("./node_modules/@angular/animations/@angular/animations.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__menu__ = __webpack_require__("./src/app/menus/menu.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__menu_service__ = __webpack_require__("./src/app/menus/menu.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var CustomMovel = (function () {
    function CustomMovel(link_name, link_value) {
        if (link_name === void 0) { link_name = ''; }
        if (link_value === void 0) { link_value = ''; }
        this.link_name = link_name;
        this.link_value = link_value;
    }
    ;
    return CustomMovel;
}());
var MenusComponent = (function () {
    function MenusComponent(elementRef, router, menuService) {
        this.elementRef = elementRef;
        this.router = router;
        this.menuService = menuService;
        this.resourceUrl = window['sux_resource_url'];
        this.isPageLoaded = false;
        this.isMenuLoaded = false;
        this.customModel = new CustomMovel();
        this.gnbMenus = [];
        this.gnbOriginMenus = [];
        this.pageMenus = [];
        this.jsonBuffers = {
            data: null
        };
        // page list
        this.isCheckedAll = false;
        this.isActivePage = true;
        this.isActiveCustomPage = false;
        this.activePage = 'page_list';
        // drag
        this.menuLimit = 5;
        this.textIndent = 30;
        this.dragTimer = null;
        this.dragX = 0;
        this.dragY = 0;
        this.menusHeight = [];
        this.menuGabHeight = 25;
        this.pageCaseHeight = 0;
        this.menuCaseHeight = 0;
        this.isMouseDown = false;
        this.startIndex = -1;
        this.dragIndex = -1;
        this.startOffsetY = 0;
        this.dragDepth = -1;
        this.dragStartY = 0;
        this.dragStartX = 0;
        this.dragStartTop = 0;
        this.dragStartPosy = 0;
        this.dragMenuLength = 0;
        this.dragMenuHeight = 0;
        this.dragOldDepth = 0;
        this.oldPosx = -1;
        this.oldPosy = -1;
        // validation
        this.linkTextMsg = '';
        this.linkURLMsg = '';
        this.menuMsg = '';
        this.isEditing = false;
        this.isFocusInItem = '';
        this.selectedEl = null;
        var reg = new RegExp('/+$');
        if (!reg.test(this.resourceUrl)) {
            this.resourceUrl += '/';
        }
    }
    MenusComponent.prototype.ngAfterViewInit = function () {
        this.loadPages();
        this.loadMenus();
        this.checkLoadedData();
    };
    MenusComponent.prototype.defaultMenuHeight = function () {
        var _this = this;
        this.itemElems.changes.subscribe(function () {
            _this.itemElems.toArray().forEach(function (el) {
                _this.menusHeight.push(el.nativeElement.offsetHeight);
            });
        });
    };
    MenusComponent.prototype.getOffsetTop = function (nativeEl) {
        if (!nativeEl)
            return;
        var topValue = 0;
        var parent = nativeEl;
        do {
            topValue += parent.offsetTop;
            parent = parent.parentElement;
        } while (parent.nodeName !== 'BODY' && parent.nodeName === 'DIV');
        return topValue;
    };
    MenusComponent.prototype.resetMenuHeight = function () {
        var _this = this;
        setTimeout(function () {
            _this.itemElems.toArray().forEach(function (el, i) {
                _this.gnbMenus[i].height = el.nativeElement.offsetHeight;
            });
            _this.displayMenu();
        }, 0);
    };
    MenusComponent.prototype.createMenuClass = function () {
        return new __WEBPACK_IMPORTED_MODULE_3__menu__["a" /* Menu */]();
    };
    MenusComponent.prototype.getLimitLength = function (arr, limit) {
        if (limit === void 0) { limit = 1; }
        var result = 0;
        if (!arr) {
            return result;
        }
        result = arr.length;
        if (arr.length > limit) {
            result = limit;
        }
        return result;
    };
    MenusComponent.prototype.loadPages = function () {
        var _this = this;
        this.menuService.getMenusJson().subscribe(function (json) {
            if (json.result.toUpperCase() === 'Y') {
                var list = json.data.list;
                var m = void 0;
                var menus = [];
                for (var i = 0; i < list.length; i++) {
                    m = _this.createMenuClass();
                    for (var key in m) {
                        if (list[i][key]) {
                            m[key] = list[i][key];
                        }
                    }
                    menus.push(m);
                }
                _this.pageMenus = menus;
                if (_this.pageMenus.length === 0) {
                    return;
                }
            }
            else {
                // 서버에서 URL 리턴 값이 전달됐을 때 세션이 종료 체크
                var reg = /login-admin$/i;
                if (reg.test(json.url) === true) {
                    _this.router.navigate(['/login-admin']);
                }
            }
            _this.isPageLoaded = true;
        });
    };
    MenusComponent.prototype.loadMenus = function () {
        var _this = this;
        this.menuService.getGnbJson().subscribe(function (json) {
            if (json.data && json.data.list && json.data.list.length > 0) {
                _this.setupGnbMenus(json.data.list);
                _this.resetMenuHeight();
            }
            _this.isMenuLoaded = true;
        });
    };
    MenusComponent.prototype.setupGnbMenus = function (list) {
        this.gnbMenus = this.cloneMultyArray(list);
        this.gnbOriginMenus = this.cloneMultyArray(list);
    };
    MenusComponent.prototype.checkLoadedData = function () {
        if (this.isPageLoaded !== true && this.isMenuLoaded !== true) {
            var timer = setTimeout(this.checkLoadedData, 30);
            return;
        }
        this.checkDisabledMenu();
    };
    MenusComponent.prototype.checkDisabledMenu = function () {
        var _this = this;
        var disabledTimer = setTimeout(function () {
            if (_this.gnbMenus.length > 0 && _this.pageMenus.length > 0) {
                for (var i = 0; i < _this.gnbMenus.length; i++) {
                    var isDisabled = true;
                    for (var k = 0; k < _this.pageMenus.length; k++) {
                        if ((_this.gnbMenus[i].category === _this.pageMenus[k].category) &&
                            _this.gnbMenus[i].module_name !== 'customize') {
                            isDisabled = false;
                            break;
                        }
                    }
                    _this.gnbMenus[i].disabled = isDisabled;
                }
                clearTimeout(disabledTimer);
            }
            else {
                _this.checkDisabledMenu();
            }
        }, 30);
    };
    MenusComponent.prototype.cloneMultyArray = function (list, cloneArr) {
        if (cloneArr === void 0) { cloneArr = []; }
        for (var i = 0; i < list.length; i++) {
            var m = this.createMenuClass();
            for (var key in m) {
                if (list[i][key]) {
                    m[key] = list[i][key];
                }
            }
            cloneArr.push(m);
            if (list[i].sub && list[i].sub.length > 0) {
                this.cloneMultyArray(list[i].sub, cloneArr);
            }
        }
        return cloneArr;
    };
    MenusComponent.prototype.cloneSingleArray = function (list, cloneArr) {
        if (cloneArr === void 0) { cloneArr = []; }
        for (var i = 0; i < list.length; i++) {
            var m = this.createMenuClass();
            for (var key in m) {
                m[key] = list[i][key];
            }
            m.sub = null;
            cloneArr.push(m);
        }
        return cloneArr;
    };
    MenusComponent.prototype.addPageToMenu = function () {
        this.menuMsg = '';
        for (var i = 0; i < this.pageMenus.length; i++) {
            if (this.pageMenus[i].isChecked === true) {
                this.addMenu(this.pageMenus[i]);
            }
        }
    };
    MenusComponent.prototype.createCustomPage = function (link_name, link_value) {
        if (!this.validateMenuName(link_name)) {
            return;
        }
        if (!this.validateLinkValue(link_value)) {
            return;
        }
        this.customModel.link_name = '';
        this.customModel.link_value = '';
        var params = {
            menu_name: link_name
        };
        var date = new Date();
        var m = this.createMenuClass();
        m.id = date.getTime();
        m.depth = 1;
        m.menu_name = link_name;
        m.module_name = 'customize';
        m.posy = -1;
        m.url = link_value;
        this.addMenu(m);
    };
    /*deletePage(m: Menu): void {
  
      let params = {
        'id': m.id
      };
  
      this.menuService.deleteMenu(params).subscribe(json=>{
        let index = this.getIndex(this.pageMenus, params.id);
  
        if (index > -1) {
          this.pageMenus.splice(index, 1);
          this.menuCaseHeight = this.getLimitLength(this.pageMenus, this.menuLimit) * this.menuHeight;
          
          if (this.pageMenus.length === 0) {
            return;
          }
  
          this.timer = setTimeout(() => {
            this.resizeSwiperPagelist();
          }, 0);
        }
      });
    }*/
    MenusComponent.prototype.addMenu = function (menu) {
        this.isEditing = true;
        for (var i = this.gnbMenus.length - 1; i >= 0; i--) {
            if (this.gnbMenus[i].menu_name === menu.menu_name) {
                this.menuMsg += "[ " + menu.menu_name + " ] 메뉴는 이미 추가되었습니다.\n";
                return;
            }
        }
        var m = this.createMenuClass();
        for (var key in m) {
            m[key] = menu[key];
        }
        this.gnbMenus.push(m);
        this.resetMenuHeight();
        this.displayMenu();
    };
    MenusComponent.prototype.modifyMenu = function (menu) {
        this.router.navigate(['/menu-modify', menu.id]);
    };
    MenusComponent.prototype.removeMenu = function (menu) {
        var menuName = '';
        for (var i = this.gnbMenus.length - 1; i >= 0; i--) {
            menuName = this.gnbMenus[i].menu_name;
            if (menuName === menu.menu_name) {
                var menuPiece = this.gnbMenus.splice(i, 1);
                menuPiece[0] = null;
            }
        } // end of for
        this.displayMenu();
    };
    MenusComponent.prototype.getValidationElement = function (target) {
        var parentEl = target;
        var reg = /list_draggable_item/gi;
        var checkCount = 0;
        var MAX_COUNT = 3;
        if (parentEl && parentEl.nodeName.toUpperCase() === 'DIV' &&
            parentEl.className && reg.test(parentEl.className)) {
            return parentEl;
        }
        do {
            parentEl = parentEl.parentElement;
            if (parentEl && parentEl.nodeName.toUpperCase() === 'DIV' &&
                parentEl.className && reg.test(parentEl.className)) {
                return parentEl;
            }
            checkCount++;
        } while (checkCount < MAX_COUNT);
        return null;
    };
    MenusComponent.prototype.getTargetElement = function (target, loop, search) {
        if (loop === void 0) { loop = 1; }
        if (search === void 0) { search = ''; }
        var parent = target;
        var reg = null;
        if (search !== '') {
            reg = new RegExp(search, 'gi');
        }
        if (loop > 1) {
            for (var i = 1; i < loop; i++) {
                parent = parent.parentElement;
                if (reg && parent && parent.nodeName &&
                    reg.test(parent.nodeName.toUpperCase()) === true) {
                    return parent.nodeName;
                }
            } // end of for
        } // end of if
        return parent.nodeName;
    };
    MenusComponent.prototype.getClientX = function (e) {
        if (e.clientX) {
            return e.clientX;
        }
        else if (e.targetTouches) {
            return e.targetTouches[0].clientX;
        }
    };
    MenusComponent.prototype.getClientY = function (e) {
        if (e.clientY) {
            return e.clientY;
        }
        else if (e.targetTouches) {
            return e.targetTouches[0].clientY;
        }
    };
    MenusComponent.prototype.startTimer = function () {
        var _this = this;
        this.dragTimer = setInterval(function () {
            _this.moveMenu(_this.dragY, _this.dragX);
        }, 30);
    };
    MenusComponent.prototype.stopTimer = function () {
        clearInterval(this.dragTimer);
    };
    MenusComponent.prototype.onDragListener = function (e) {
        switch (e.type) {
            case "mousedown":
            case "touchstart":
                var isButton = this.getTargetElement(e.target, 2, 'button');
                if (isButton === 'BUTTON') {
                    return;
                }
                this.selectedEl = this.getValidationElement(e.target);
                if (this.selectedEl === null) {
                    return;
                }
                var key = this.selectedEl.getAttribute('data-key');
                key = parseInt(key);
                this.downMenu(e, key);
                break;
            case "mousemove":
            case "touchmove":
                if (this.selectedEl && this.isEditing === true) {
                    e.preventDefault();
                }
                this.dragX = this.getClientX(e);
                this.dragY = this.getClientY(e);
                this.moveMenu(this.dragY, this.dragX);
                break;
            case "mouseup":
            case "touchend":
                if (this.isFocusInItem !== '' && this.isFocusInItem === 'BUTTON') {
                    this.resetValidation();
                }
                this.isFocusInItem = this.getTargetElement(e.target, 1);
                this.upMenu(e);
                break;
            default:
                break;
        }
    };
    MenusComponent.prototype.downMenu = function (e, index) {
        if (this.isEditing === false)
            return;
        var clientX = e.clientX || e.targetTouches[0].clientX;
        if (!this.validateNumber(clientX)) {
            clientX = 0;
        }
        var clientY = e.clientY || e.targetTouches[0].clientY;
        if (!this.validateNumber(clientY)) {
            clientY = 0;
        }
        // 미정 
        this.startOffsetY = e.offsetY;
        this.startIndex = index;
        this.dragIndex = index;
        this.dragStartY = clientY;
        this.dragStartX = clientX;
        this.dragStartTop = 0;
        //this.dragMenuHeight = 0;
        this.isMouseDown = true;
        this.gnbMenus[this.dragIndex].isDragging = true;
        this.dragOldDepth = this.dragDepth = this.gnbMenus[index].depth;
        this.dragStartPosy = this.gnbMenus[index].posy;
        this.dragMenuHeight = this.gnbMenus[index].height;
        var depthIndex = this.gnbMenus[index].depth;
        this.gnbMenus[index].margin_left = 0;
        this.gnbMenus[index].padding_left = 5;
        for (var i = 0; i < this.gnbMenus.length; i++) {
            if (this.dragIndex < i && this.gnbMenus[i].depth > this.gnbMenus[this.dragIndex].depth) {
                var depthGab = this.gnbMenus[i].depth - depthIndex;
                this.dragMenuLength++;
                this.dragMenuHeight += this.gnbMenus[i].height;
                this.gnbMenus[i].isDragging = true;
                this.gnbMenus[i].margin_left = -1 * this.textIndent * depthGab;
                this.gnbMenus[i].padding_left = this.textIndent * depthGab + 5;
            }
            if (this.dragIndex < i && this.gnbMenus[i].depth <= this.gnbMenus[this.dragIndex].depth) {
                break;
            }
        }
        this.resetState(this.gnbMenus);
    };
    MenusComponent.prototype.moveMenu = function (clientY, clientX) {
        if (this.isMouseDown !== true || this.isEditing !== true)
            return;
        if (this.validateNumber(clientY) !== true || this.validateNumber(clientX) !== true)
            return;
        if (this.oldPosy === clientY && this.oldPosx === clientX)
            return;
        var direct = clientY - this.oldPosy;
        var distY = clientY - this.dragStartY;
        var dragGab = 0;
        dragGab = this.getDragGab(direct);
        // for align    
        for (var i = 0; i < this.gnbMenus.length; i++) {
            if (this.gnbMenus[i].isDragging === true) {
                this.gnbMenus[i].posy = this.dragStartPosy + distY + dragGab + i * 1;
            }
        }
        //console.log('startP', this.dragStartPosy, 'prevItem', this.gnbMenus[3].posy, 'distY', distY,  'gab', dragGab);
        this.displayMenu(direct);
        this.changeDraggingIndex(distY, clientX, clientY);
        this.changeDepth(clientX);
        // real top position 
        for (var i = 0; i < this.gnbMenus.length; i++) {
            if (this.gnbMenus[i].isDragging === true) {
                this.gnbMenus[i].top = this.dragStartTop + distY;
                //console.log(this.dragStartTop + distY, this.dragStartTop, distY);
            }
        }
        this.oldPosx = clientX;
        this.oldPosy = clientY;
        this.dragOldDepth = this.dragDepth;
    };
    MenusComponent.prototype.upMenu = function (e) {
        if (this.gnbMenus) {
            for (var i = 0; i < this.gnbMenus.length; i++) {
                this.gnbMenus[i].isDragging = false;
            }
        }
        this.dragMenuLength = 0;
        this.dragIndex = -1;
        this.isMouseDown = false;
        this.oldPosy = -1;
        this.repositionY(this.gnbMenus);
    };
    MenusComponent.prototype.getDragGab = function (direct) {
        var dragGab = 0;
        if (direct > 0) {
            //console.log('down');
            dragGab = this.dragMenuHeight - this.menuGabHeight;
        }
        else if (direct < 0) {
            //console.log('up');
            dragGab = -1 * this.menuGabHeight;
        }
        return dragGab;
    };
    MenusComponent.prototype.changeDepth = function (clientX) {
        var direction = clientX - this.dragStartX;
        for (var i = 0; i < this.gnbMenus.length; i++) {
            if (this.gnbMenus[i].isDragging === true && this.gnbMenus[this.dragIndex - 1]) {
                var currentDepth = this.gnbMenus[this.dragIndex].depth;
                var prevDepth = this.gnbMenus[this.dragIndex - 1].depth;
                var distx = Math.abs(clientX - this.dragStartX);
                if (direction > 0 && distx > this.textIndent && prevDepth >= currentDepth) {
                    var len = this.dragIndex + this.dragMenuLength;
                    for (var k = this.dragIndex; k <= len; k++) {
                        if (this.gnbMenus[k].isDragging === true) {
                            //console.log( this.gnbMenus[k].menu_name );
                            this.gnbMenus[k].depth += 1;
                        }
                    }
                    if (this.dragIndex === i) {
                        //console.log('++1');
                        this.dragDepth += 1;
                        this.dragStartX += this.textIndent;
                    }
                    break;
                }
                else if (direction < 0 && distx > this.textIndent && currentDepth > 1 &&
                    this.dragDepth > 1) {
                    var len = this.dragIndex + this.dragMenuLength;
                    for (var k = this.dragIndex; k <= len; k++) {
                        this.gnbMenus[k].depth -= 1;
                    }
                    if (this.dragIndex === i) {
                        //console.log('--1');
                        this.dragDepth -= 1;
                        this.dragStartX -= this.textIndent;
                    }
                    break;
                }
            } // end of if
        } // end of for
    };
    MenusComponent.prototype.changeDraggingIndex = function (posy, clientX, clientY) {
        var direction = 0;
        var depthGab = 0;
        var frontIndex = 0;
        var behindIndex = 0;
        var itemTop = 0;
        if (this.dragOldDepth !== this.dragDepth) {
            return;
        }
        for (var i = 0; i < this.gnbMenus.length; i++) {
            if (this.gnbMenus[i].isDragging === true && this.dragIndex !== i &&
                this.gnbMenus[i].depth === this.dragDepth) {
                direction = i - this.dragIndex;
                this.dragIndex = i;
                if (direction < 0) {
                    /**
                     * 마우스 드래그 위치 문제
                     * 이슈 : 드래그 속도가 클 경우 index번호를 건너뛰는 문제 발생
                     * 해결 : 드래그 시 선택 아이템 전 index번호 만큼 높이를 반복해서 더해줌
                     */
                    if (this.startIndex < i) {
                        //console.log( 'drag process : top ==> bottom ==> top' );
                        behindIndex = i - 1;
                        for (var k = this.startIndex; k <= behindIndex; k++) {
                            itemTop += -1 * this.gnbMenus[k].height;
                        }
                    }
                    else {
                        //console.log( 'drag process : bottom ==> top ==> bottom' );
                        behindIndex = i + 1 + this.dragMenuLength;
                        for (var k = behindIndex; k <= this.startIndex + this.dragMenuLength; k++) {
                            if (this.gnbMenus[k] && this.gnbMenus[k].height) {
                                itemTop += this.gnbMenus[k].height;
                            }
                        }
                    }
                    this.dragStartTop = itemTop;
                    // x depth
                    for (var k = 0; k < this.gnbMenus.length; k++) {
                        if (this.dragIndex < k && this.gnbMenus[k].isDragging !== true) {
                            if (this.gnbMenus[this.dragIndex - 1]) {
                                depthGab = this.gnbMenus[this.dragIndex].depth - this.gnbMenus[this.dragIndex - 1].depth;
                            }
                            // reset global depth
                            if (depthGab > 1) {
                                this.dragDepth -= 1;
                                this.dragStartX -= this.textIndent;
                            }
                            if (this.dragIndex === 0) {
                                //console.log('up');
                                this.dragDepth = 1;
                                this.dragStartX = clientX - this.textIndent;
                            }
                            this.gnbMenus[k].state = 'up';
                            console.log('up');
                            break;
                        }
                    }
                    if (this.dragIndex !== 0 && depthGab > 1) {
                        for (var k = 0; k < this.gnbMenus.length; k++) {
                            if (this.gnbMenus[k].isDragging === true) {
                                this.gnbMenus[k].depth -= 1;
                            }
                        }
                    }
                    // reset depth
                    if (this.dragIndex === 0 && this.gnbMenus[this.dragIndex].depth > 1) {
                        for (var k = 0; k < this.gnbMenus.length; k++) {
                            if (this.gnbMenus[k].isDragging === true) {
                                this.gnbMenus[k].depth -= 1;
                            }
                        }
                    }
                }
                else if (direction > 0) {
                    /**
                     * 마우스 드래그 위치 문제
                     * 이슈 : 드래그 속도가 클 경우 index번호를 건너뛰는 문제 발생
                     * 해결 : 드래그 시 선택 아이템 전 index번호 만큼 높이를 반복해서 더해줌
                     */
                    frontIndex = i - 1;
                    itemTop = 0;
                    //console.log( 'drag process : top ==> bottom ==> top' );
                    if (this.startIndex < i) {
                        for (var k = this.startIndex; k < i; k++) {
                            itemTop += -1 * this.gnbMenus[k].height;
                        }
                        //console.log( 'drag process : bottom ==> top ==> bottom' );
                    }
                    else {
                        for (var k = i + 1 + this.dragMenuLength; k <= this.startIndex + this.dragMenuLength; k++) {
                            itemTop += this.gnbMenus[k].height;
                        }
                    }
                    this.dragStartTop = itemTop;
                    for (var k = this.gnbMenus.length - 1; k >= 0; k--) {
                        if (this.dragIndex > k && this.gnbMenus[k].isDragging !== true) {
                            this.gnbMenus[k].state = 'down';
                            console.log('down');
                            break;
                        }
                    } // end of for 
                    var nextIndex = this.dragIndex - 1;
                    var prevDepth = 0;
                    if (this.gnbMenus[nextIndex]) {
                        depthGab = this.gnbMenus[this.dragIndex].depth - this.gnbMenus[nextIndex].depth;
                    }
                    prevDepth = depthGab - 1;
                    // reset global depth
                    if (depthGab > 1) {
                        //console.log('down');
                        this.dragDepth -= prevDepth;
                        this.dragStartX -= this.textIndent * prevDepth;
                    }
                    // reset depth
                    for (var k = this.gnbMenus.length - 1; k >= 0; k--) {
                        if (this.gnbMenus[k].isDragging == true && depthGab > 1) {
                            //console.log('depthCount--');
                            this.gnbMenus[k].depth -= prevDepth;
                        }
                    }
                } // end of if     
            } // end of if
        } // end of for
    };
    MenusComponent.prototype.displayMenu = function (direction) {
        if (direction === void 0) { direction = 0; }
        var disty = 0;
        var prevIndex = this.dragIndex - 1;
        var nextIndex = this.dragIndex + this.dragMenuLength + 1;
        var dragLastIndex = this.dragIndex + this.dragMenuLength;
        if (direction < 0 && this.gnbMenus[prevIndex]) {
            disty = this.gnbMenus[this.dragIndex].posy - this.gnbMenus[prevIndex].posy;
            if (disty <= 0) {
                for (var i = 0; i < this.gnbMenus.length; i++) {
                    if (this.gnbMenus[i].isDragging === true) {
                        this.gnbMenus[prevIndex].posy += this.gnbMenus[i].height;
                    }
                }
            }
            //console.log('up');
        }
        else if (direction > 0 && this.gnbMenus[nextIndex]) {
            disty = this.gnbMenus[nextIndex].posy - this.gnbMenus[dragLastIndex].posy;
            if (disty <= 0) {
                for (var i = 0; i < this.gnbMenus.length; i++) {
                    if (this.gnbMenus[i].isDragging === true) {
                        this.gnbMenus[nextIndex].posy -= this.gnbMenus[i].height;
                    }
                }
            }
            //console.log('down');
        }
        this.sortArr(this.gnbMenus);
        this.repositionY(this.gnbMenus);
    };
    MenusComponent.prototype.editJson = function () {
        this.isEditing = !this.isEditing;
        this.resetMenuHeight();
    };
    MenusComponent.prototype.cancelJson = function () {
        this.isEditing = false;
        this.gnbMenus = this.cloneSingleArray(this.gnbOriginMenus);
    };
    MenusComponent.prototype.saveJson = function () {
        var _this = this;
        this.outputJson();
        this.gnbMenus = this.cloneMultyArray(this.jsonBuffers.data);
        this.gnbOriginMenus = this.cloneMultyArray(this.jsonBuffers.data);
        var params = {
            data: JSON.stringify(this.jsonBuffers)
        };
        this.menuService.saveJson(params).subscribe(function (json) {
            alert(json.msg);
            _this.isEditing = !_this.isEditing;
        });
    };
    MenusComponent.prototype.outputJson = function () {
        var copyMenus = this.cloneSingleArray(this.gnbMenus);
        var resultMenus = [];
        var menuHistory = [];
        var prevItem = null;
        var prevDepth = 1;
        this.jsonBuffers.data = null;
        // 실제 출력될 json 파일 구성하기 
        for (var i = 0; i < copyMenus.length; i++) {
            var item = copyMenus[i];
            if (prevDepth < item.depth) {
                prevItem.sub = [];
                prevItem.sub.push(item);
                menuHistory.push(prevItem.sub);
            }
            else if (prevDepth > item.depth) {
                var gabDepth = prevDepth - item.depth;
                for (var i_1 = 0; i_1 < gabDepth; i_1++) {
                    menuHistory.pop();
                }
                menuHistory[menuHistory.length - 1].push(item);
            }
            else if (prevDepth === item.depth) {
                if (menuHistory.length === 0) {
                    resultMenus.push(item);
                    menuHistory.push(resultMenus);
                }
                else {
                    menuHistory[menuHistory.length - 1].push(item);
                }
            }
            prevItem = item;
            prevDepth = item.depth;
        }
        this.jsonBuffers.data = resultMenus;
    };
    // common
    MenusComponent.prototype.sortArr = function (arr) {
        return arr.sort(function (a, b) {
            return a.posy - b.posy;
        });
    };
    MenusComponent.prototype.getIndex = function (list, id) {
        for (var i = 0; i < list.length; i++) {
            if (list[i].id === id) {
                return i;
            }
        }
        return -1;
    };
    MenusComponent.prototype.resetState = function (arr) {
        for (var i = 0; i < arr.length; i++) {
            arr[i].state = 'default';
        }
    };
    MenusComponent.prototype.repositionY = function (arr) {
        var posy = 0;
        for (var i = 0; i < arr.length; i++) {
            arr[i].posy = posy;
            if (arr[i].isDragging === false) {
                arr[i].top = 0;
            }
            posy += arr[i].height;
        }
    };
    MenusComponent.prototype.changeCheck = function () {
        var bool = true;
        for (var i = 0; i < this.pageMenus.length; i++) {
            if (this.pageMenus[i].isChecked === false) {
                bool = false;
                break;
            }
        }
        this.isCheckedAll = bool;
    };
    // page list
    MenusComponent.prototype.changeCheckAll = function () {
        for (var i = 0; i < this.pageMenus.length; i++) {
            this.pageMenus[i].isChecked = this.isCheckedAll;
        }
    };
    MenusComponent.prototype.togglePagePanel = function () {
        this.activePage = 'page_list';
        this.isActivePage = !this.isActivePage;
        if (this.isActiveCustomPage === true) {
            this.isActiveCustomPage = !this.isActiveCustomPage;
        }
    };
    MenusComponent.prototype.toggleCustomPagePanel = function () {
        this.activePage = 'custom_link';
        this.isActiveCustomPage = !this.isActiveCustomPage;
        if (this.isActivePage === true) {
            this.isActivePage = !this.isActivePage;
        }
    };
    MenusComponent.prototype.toggleItemInfoPanel = function (menu) {
        if (this.isEditing === false) {
            this.isEditing = !this.isEditing;
            this.resetMenuHeight();
        }
        menu.isPanelInfo = !menu.isPanelInfo;
    };
    // common
    MenusComponent.prototype.validateMenuName = function (value) {
        if (value === '') {
            this.linkTextMsg = '링크 텍스트가 필요합니다.';
            return false;
        }
        value = value.trim();
        var reg = /^[a-zA-Z가-힣][a-zA-Z가-힣0-9_-\s]{2,13}$/g;
        var result = reg.test(value);
        if (!result) {
            this.linkTextMsg = '링크 텍스트가 올바르지 않습니다.';
            return false;
        }
        return true;
    };
    MenusComponent.prototype.validateLinkValue = function (value) {
        if (value === '') {
            this.linkURLMsg = '링크 주소가 필요합니다.';
            return false;
        }
        return true;
    };
    MenusComponent.prototype.resetValidation = function () {
        this.linkTextMsg = '';
        this.linkURLMsg = '';
        this.menuMsg = '';
        this.isFocusInItem = '';
    };
    MenusComponent.prototype.validateNumber = function (value) {
        return !isNaN(value);
    };
    return MenusComponent;
}());
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["_17" /* ViewChildren */])('listItems'),
    __metadata("design:type", typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_0__angular_core__["Z" /* QueryList */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_0__angular_core__["Z" /* QueryList */]) === "function" && _a || Object)
], MenusComponent.prototype, "itemElems", void 0);
MenusComponent = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["o" /* Component */])({
        selector: 'menus-panel',
        template: __webpack_require__("./src/app/menus/menus.component.html"),
        styles: [__webpack_require__("./src/app/menus/menus.component.css")],
        animations: [
            Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["i" /* trigger */])('menuState', [
                Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["f" /* state */])('default', Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["g" /* style */])({
                    top: '0'
                })),
                Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["f" /* state */])('up', Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["g" /* style */])({
                    top: '0'
                })),
                Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["f" /* state */])('down', Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["g" /* style */])({
                    top: '0'
                })),
                Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["h" /* transition */])('void => *', [
                    Object(__WEBPACK_IMPORTED_MODULE_2__angular_animations__["g" /* style */])({ top: '0' })
                ])
            ])
        ]
    }),
    __metadata("design:paramtypes", [typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_0__angular_core__["v" /* ElementRef */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_0__angular_core__["v" /* ElementRef */]) === "function" && _b || Object, typeof (_c = typeof __WEBPACK_IMPORTED_MODULE_1__angular_router__["b" /* Router */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__angular_router__["b" /* Router */]) === "function" && _c || Object, typeof (_d = typeof __WEBPACK_IMPORTED_MODULE_4__menu_service__["a" /* MenuService */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_4__menu_service__["a" /* MenuService */]) === "function" && _d || Object])
], MenusComponent);

var _a, _b, _c, _d;

/***/ }),

/***/ "./src/environments/environment.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return environment; });
// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `.angular-cli.json`.
// The file contents for the current environment will overwrite these during build.
var environment = {
    production: false
};

/***/ }),

/***/ "./src/libs/directives/drag-listener.directive.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return DragListenerDirective; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var DragListenerDirective = (function () {
    function DragListenerDirective() {
        this.dragEventRequest = new __WEBPACK_IMPORTED_MODULE_0__angular_core__["x" /* EventEmitter */]();
    }
    DragListenerDirective.prototype.onMouseDown = function (e) {
        this.onDragListener(e);
    };
    DragListenerDirective.prototype.onMouseMove = function (e) {
        this.onDragListener(e);
    };
    DragListenerDirective.prototype.onMouseUp = function (e) {
        this.onDragListener(e);
    };
    DragListenerDirective.prototype.onTouchStart = function (e) {
        this.onDragListener(e);
    };
    DragListenerDirective.prototype.onTouchMove = function (e) {
        this.onDragListener(e);
    };
    DragListenerDirective.prototype.onTouchEnd = function (e) {
        this.onDragListener(e);
    };
    DragListenerDirective.prototype.onDragListener = function (e) {
        this.dragEventRequest.emit(e);
    };
    return DragListenerDirective;
}());
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["T" /* Output */])(),
    __metadata("design:type", Object)
], DragListenerDirective.prototype, "dragEventRequest", void 0);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["A" /* HostListener */])('mousedown', ['$event']),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [Object]),
    __metadata("design:returntype", void 0)
], DragListenerDirective.prototype, "onMouseDown", null);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["A" /* HostListener */])('window:mousemove', ['$event']),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [Object]),
    __metadata("design:returntype", void 0)
], DragListenerDirective.prototype, "onMouseMove", null);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["A" /* HostListener */])('window:mouseup', ['$event']),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [Object]),
    __metadata("design:returntype", void 0)
], DragListenerDirective.prototype, "onMouseUp", null);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["A" /* HostListener */])('touchstart', ['$event']),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [Object]),
    __metadata("design:returntype", void 0)
], DragListenerDirective.prototype, "onTouchStart", null);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["A" /* HostListener */])('touchmove', ['$event']),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [Object]),
    __metadata("design:returntype", void 0)
], DragListenerDirective.prototype, "onTouchMove", null);
__decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["A" /* HostListener */])('touchend', ['$event']),
    __metadata("design:type", Function),
    __metadata("design:paramtypes", [Object]),
    __metadata("design:returntype", void 0)
], DragListenerDirective.prototype, "onTouchEnd", null);
DragListenerDirective = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["u" /* Directive */])({
        selector: '[dragListener]'
    })
], DragListenerDirective);


/***/ }),

/***/ "./src/libs/pipes/number-comma-add.pipe.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NumberCommaAddPipe; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var NumberCommaAddPipe = (function () {
    function NumberCommaAddPipe() {
    }
    NumberCommaAddPipe.prototype.transform = function (value, cond) {
        if (cond === void 0) { cond = []; }
        if (!value && isNaN(value)) {
            return '';
        }
        var glue = ',';
        var limit = 3;
        if (cond[0]) {
            glue = cond[0];
        }
        if (cond[1]) {
            limit = cond[1];
        }
        var sNum = value.toString().replace(/[\s+]/, '').trim();
        var reg = new RegExp(/(\d)(?=(?:\d{3})+(?!\d))/);
        while (reg.test(sNum)) {
            sNum = sNum.replace(reg, '$1,');
        }
        return sNum;
    };
    return NumberCommaAddPipe;
}());
NumberCommaAddPipe = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["X" /* Pipe */])({ name: 'numberCommaAdd' })
], NumberCommaAddPipe);


/***/ }),

/***/ "./src/libs/pipes/number-comma-remove.pipe.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NumberCommaRemovePipe; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var NumberCommaRemovePipe = (function () {
    function NumberCommaRemovePipe() {
    }
    NumberCommaRemovePipe.prototype.transform = function (value) {
        if (!value) {
            return '';
        }
        var sNum = value.toString().replace(/[\s+]/, '').trim();
        var reg = new RegExp(/[^\d]+/);
        sNum = sNum.replace(reg, '');
        return sNum;
    };
    return NumberCommaRemovePipe;
}());
NumberCommaRemovePipe = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["X" /* Pipe */])({ name: 'numberCommaRemove' })
], NumberCommaRemovePipe);


/***/ }),

/***/ "./src/libs/pipes/string-compare.pipe.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StringComparePipe; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var StringComparePipe = (function () {
    function StringComparePipe() {
    }
    StringComparePipe.prototype.transform = function (value, compare) {
        value = value.replace(/[\s+]/, '').trim();
        compare = compare.replace(/[\s+]/, '').trim();
        var reg = new RegExp(value, 'gi');
        return reg.test(compare);
    };
    return StringComparePipe;
}());
StringComparePipe = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["X" /* Pipe */])({ name: 'stringCompare' })
], StringComparePipe);


/***/ }),

/***/ "./src/libs/pipes/string-split.pipe.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StringSplitPipe; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var StringSplitPipe = (function () {
    function StringSplitPipe() {
    }
    StringSplitPipe.prototype.transform = function (value, condition) {
        var tempArray = value.split(condition.mark);
        return tempArray[condition.index];
    };
    return StringSplitPipe;
}());
StringSplitPipe = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["X" /* Pipe */])({ name: 'stringSplit' })
], StringSplitPipe);


/***/ }),

/***/ "./src/libs/pipes/string-uppercase-at.pipe.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StringUppercaseAtPipe; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

var StringUppercaseAtPipe = (function () {
    function StringUppercaseAtPipe() {
    }
    StringUppercaseAtPipe.prototype.transform = function (value, index) {
        if (index === void 0) { index = 0; }
        var word = value.charAt(index);
        var reg = new RegExp(word);
        var result = value.replace(word, word.toUpperCase());
        return result;
    };
    return StringUppercaseAtPipe;
}());
StringUppercaseAtPipe = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["X" /* Pipe */])({ name: 'stringUppercaseAt' })
], StringUppercaseAtPipe);


/***/ }),

/***/ "./src/libs/services/alert.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AlertService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__("./node_modules/@angular/router/@angular/router.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_Subject__ = __webpack_require__("./node_modules/rxjs/_esm5/Subject.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var AlertService = (function () {
    function AlertService(router) {
        var _this = this;
        this.router = router;
        this.subject = new __WEBPACK_IMPORTED_MODULE_2_rxjs_Subject__["a" /* Subject */]();
        this.keepAfterNavigationChange = false;
        router.events.subscribe(function (event) {
            if (event instanceof __WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* NavigationStart */]) {
                _this.keepAfterNavigationChange = false;
            }
            else {
                _this.subject.next();
            }
        });
    }
    AlertService.prototype.success = function (message, keepAfterNavigationChange) {
        if (keepAfterNavigationChange === void 0) { keepAfterNavigationChange = false; }
        this.keepAfterNavigationChange = keepAfterNavigationChange;
        this.subject.next({ type: 'success', text: message });
    };
    AlertService.prototype.error = function (message, keepAfterNavigationChange) {
        if (keepAfterNavigationChange === void 0) { keepAfterNavigationChange = false; }
        this.keepAfterNavigationChange = keepAfterNavigationChange;
        this.subject.next({ type: 'error', text: message });
    };
    AlertService.prototype.getMessage = function () {
        return this.subject.asObservable();
    };
    return AlertService;
}());
AlertService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__angular_router__["b" /* Router */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__angular_router__["b" /* Router */]) === "function" && _a || Object])
], AlertService);

var _a;

/***/ }),

/***/ "./src/libs/services/http-adapter.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return HttpAdapterService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_http__ = __webpack_require__("./node_modules/@angular/http/@angular/http.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_add_operator_map__ = __webpack_require__("./node_modules/rxjs/_esm5/add/operator/map.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_operator_catch__ = __webpack_require__("./node_modules/rxjs/_esm5/add/operator/catch.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var HttpAdapterService = (function () {
    function HttpAdapterService(http, jsonp) {
        this.http = http;
        this.jsonp = jsonp;
        this.domainUrl = window['sux_resource_url'];
        this.isFullDomain = false;
        var reg = new RegExp(/^(http\:\/\/|https\:\/\/)?((\w+[.]\w+)+([.]\w+)?)|(localhost)+/);
        if (reg.test(this.domainUrl) === true) {
            this.isFullDomain = true;
        }
        reg = new RegExp('/+$');
        if (!reg.test(this.domainUrl)) {
            this.domainUrl += '/';
        }
    }
    HttpAdapterService.prototype.getRequestOptions = function () {
        var headers = new __WEBPACK_IMPORTED_MODULE_1__angular_http__["a" /* Headers */]();
        headers.append('Content-Type', 'application/json');
        headers.append('Accept', '*/*');
        headers.append('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE,OPTIONS');
        headers.append('Access-Control-Allow-Origin', '*');
        return new __WEBPACK_IMPORTED_MODULE_1__angular_http__["f" /* RequestOptions */]({ headers: headers });
    };
    HttpAdapterService.prototype.get = function (url, option) {
        if (option === void 0) { option = this.getRequestOptions(); }
        url = this.domainUrl + url;
        if (this.isFullDomain === true) {
            if (option.params.get('callback')) {
                option.params.set('callback', 'JSONP_CALLBACK');
            }
            return this.jsonp.get(url, option);
        }
        else {
            return this.http.get(url, option);
        }
    };
    HttpAdapterService.prototype.post = function (url, body, option) {
        if (body === void 0) { body = null; }
        if (option === void 0) { option = this.getRequestOptions(); }
        url = this.domainUrl + url;
        if (this.isFullDomain === true) {
            if (option.params.get('callback')) {
                option.params.set('callback', 'JSONP_CALLBACK');
            }
            if (body) {
                for (var key in body) {
                    option.params.set(key, body[key]);
                }
            }
            return this.jsonp.get(url, option);
        }
        else {
            return this.http.post(url, body, option);
        }
    };
    HttpAdapterService.prototype.delete = function (url, option) {
        if (option === void 0) { option = this.getRequestOptions(); }
        return this.http.delete(url, option);
    };
    return HttpAdapterService;
}());
HttpAdapterService = __decorate([
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["C" /* Injectable */])(),
    __metadata("design:paramtypes", [typeof (_a = typeof __WEBPACK_IMPORTED_MODULE_1__angular_http__["b" /* Http */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__angular_http__["b" /* Http */]) === "function" && _a || Object, typeof (_b = typeof __WEBPACK_IMPORTED_MODULE_1__angular_http__["d" /* Jsonp */] !== "undefined" && __WEBPACK_IMPORTED_MODULE_1__angular_http__["d" /* Jsonp */]) === "function" && _b || Object])
], HttpAdapterService);

var _a, _b;

/***/ }),

/***/ "./src/libs/services/string-util.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return StringUtilService; });
var StringUtilService = (function () {
    function StringUtilService() {
    }
    StringUtilService.prototype.digit = function (value) {
        return (value < 10) ? '0' + value : '' + value;
    };
    StringUtilService.prototype.getYesterday = function (date) {
        var selectDate = date.split("-");
        var changeDate = new Date();
        changeDate.setFullYear(selectDate[0], selectDate[1] - 1, selectDate[2] - 1);
        var y = changeDate.getFullYear();
        var m = changeDate.getMonth() + 1;
        var d = changeDate.getDate();
        var resultDate = y + "-" + this.digit(m) + "-" + this.digit(d);
        return resultDate;
    };
    StringUtilService.prototype.validateEmail = function (value) {
        var reg = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        return reg.test(value);
    };
    return StringUtilService;
}());


/***/ }),

/***/ "./src/main.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("./node_modules/@angular/core/@angular/core.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__ = __webpack_require__("./node_modules/@angular/platform-browser-dynamic/@angular/platform-browser-dynamic.es5.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__app_app_module__ = __webpack_require__("./src/app/app.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__environments_environment__ = __webpack_require__("./src/environments/environment.ts");




if (__WEBPACK_IMPORTED_MODULE_3__environments_environment__["a" /* environment */].production) {
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["_23" /* enableProdMode */])();
}
Object(__WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__["a" /* platformBrowserDynamic */])().bootstrapModule(__WEBPACK_IMPORTED_MODULE_2__app_app_module__["a" /* AppModule */]);

/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("./src/main.ts");


/***/ })

},[0]);