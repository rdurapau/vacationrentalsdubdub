/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
module.exports = __webpack_require__(9);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
    // Vue.component('moderate-spot', require('./components/ModerateSpot'))
    Vue.component('custom-detail-toolbar', __webpack_require__(3));
    Vue.component('submissions-detail-toolbar', __webpack_require__(6));
});

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(5)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/CustomDetailToolbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-cb990944", Component.options)
  } else {
    hotAPI.reload("data-v-cb990944", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['resourceName', 'resourceId'],
    computed: {
        component: function component() {
            return this.resourceName + '-detail-toolbar';
        },
        hasComponent: function hasComponent() {
            return this.component in this.$options.components;
        }
    }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "flex w-full justify-end items-center" },
    [
      _vm.hasComponent
        ? _c(_vm.component, {
            tag: "component",
            attrs: { resourceId: _vm.resourceId }
          })
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-cb990944", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(7)
/* template */
var __vue_template__ = __webpack_require__(8)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/SubmissionsDetailToolbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7afd9c6e", Component.options)
  } else {
    hotAPI.reload("data-v-7afd9c6e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 7 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['resourceId'],
    data: function data() {
        return {
            isWorking: false
        };
    },
    mounted: function mounted() {
        var elements = document.getElementById('nova').querySelectorAll('h4');
        [].forEach.call(elements, function (element) {
            if (element.innerHTML === 'Custom Detail Toolbar') {
                element.parentNode.remove();
            }
        });
    },

    methods: {
        approveSpot: function approveSpot() {
            this.submitRequest('approved');
        },
        rejectSpot: function rejectSpot() {
            this.submitRequest('rejected');
        },
        submitRequest: function submitRequest(status, message) {
            var _this = this;

            this.isWorking = true;
            return Nova.request().put('/api/spots/' + this.resourceId + '/moderate', {
                'status': status,
                'message': message
            }).then(function (response) {
                _this.$toasted.show('Submission was ' + status, { type: 'success' });
                _this.$router.push('/resources/submissions');
            }).catch(function (error) {
                _this.isWorking = false;
            });
        }
    }
});

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("div", { staticClass: "flex w-full justify-end items-center" }, [
      _c(
        "button",
        {
          staticClass: "btn btn-default bg-danger btn-icon btn-white mr-3",
          attrs: { title: "Reject", disabled: _vm.isWorking },
          on: {
            click: function($event) {
              $event.preventDefault()
              return _vm.rejectSpot($event)
            }
          }
        },
        [
          _vm.isWorking
            ? _c(
                "svg",
                {
                  staticClass: "text-20 mx-0 my-1 h-auto block",
                  staticStyle: { width: "24px" },
                  attrs: {
                    viewBox: "0 0 120 30",
                    xmlns: "http://www.w3.org/2000/svg",
                    fill: "currentColor"
                  }
                },
                [
                  _c("circle", { attrs: { cx: "15", cy: "15", r: "15" } }, [
                    _c("animate", {
                      attrs: {
                        attributeName: "r",
                        from: "15",
                        to: "15",
                        begin: "0s",
                        dur: "0.8s",
                        values: "15;9;15",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    }),
                    _c("animate", {
                      attrs: {
                        attributeName: "fill-opacity",
                        from: "1",
                        to: "1",
                        begin: "0s",
                        dur: "0.8s",
                        values: "1;.5;1",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    })
                  ]),
                  _c(
                    "circle",
                    {
                      attrs: {
                        cx: "60",
                        cy: "15",
                        r: "9",
                        "fill-opacity": "0.3"
                      }
                    },
                    [
                      _c("animate", {
                        attrs: {
                          attributeName: "r",
                          from: "9",
                          to: "9",
                          begin: "0s",
                          dur: "0.8s",
                          values: "9;15;9",
                          calcMode: "linear",
                          repeatCount: "indefinite"
                        }
                      }),
                      _c("animate", {
                        attrs: {
                          attributeName: "fill-opacity",
                          from: "0.5",
                          to: "0.5",
                          begin: "0s",
                          dur: "0.8s",
                          values: ".5;1;.5",
                          calcMode: "linear",
                          repeatCount: "indefinite"
                        }
                      })
                    ]
                  ),
                  _c("circle", { attrs: { cx: "105", cy: "15", r: "15" } }, [
                    _c("animate", {
                      attrs: {
                        attributeName: "r",
                        from: "15",
                        to: "15",
                        begin: "0s",
                        dur: "0.8s",
                        values: "15;9;15",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    }),
                    _c("animate", {
                      attrs: {
                        attributeName: "fill-opacity",
                        from: "1",
                        to: "1",
                        begin: "0s",
                        dur: "0.8s",
                        values: "1;.5;1",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    })
                  ])
                ]
              )
            : _c(
                "svg",
                {
                  staticClass: "fill-current text-white text-80",
                  attrs: {
                    xmlns: "http://www.w3.org/2000/svg",
                    viewBox: "0 0 24 24",
                    width: "24",
                    height: "24"
                  }
                },
                [
                  _c("path", {
                    staticClass: "heroicon-ui icon-thumb-down",
                    attrs: {
                      d:
                        "M6.38 14H4a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h11.5c1.2 0 2.3.72 2.74 1.79l3.5 7 .03.06A3 3 0 0 1 19 15h-5v5a2 2 0 0 1-2 2h-1.62l-4-8zM8 12.76L11.62 20H12v-7h7c.13 0 .25-.02.38-.08a1 1 0 0 0 .55-1.28l-3.5-7.02A1 1 0 0 0 15.5 4H8v8.76zM6 12V4H4v8h2z"
                    }
                  })
                ]
              )
        ]
      ),
      _vm._v(" "),
      _c(
        "button",
        {
          staticClass: "btn btn-default bg-success btn-icon btn-white  mr-3",
          attrs: { title: "Approve", disabled: _vm.isWorking },
          on: {
            click: function($event) {
              $event.preventDefault()
              return _vm.approveSpot($event)
            }
          }
        },
        [
          _vm.isWorking
            ? _c(
                "svg",
                {
                  staticClass: "text-20 mx-0 my-1 h-auto block",
                  staticStyle: { width: "24px" },
                  attrs: {
                    viewBox: "0 0 120 30",
                    xmlns: "http://www.w3.org/2000/svg",
                    fill: "currentColor"
                  }
                },
                [
                  _c("circle", { attrs: { cx: "15", cy: "15", r: "15" } }, [
                    _c("animate", {
                      attrs: {
                        attributeName: "r",
                        from: "15",
                        to: "15",
                        begin: "0s",
                        dur: "0.8s",
                        values: "15;9;15",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    }),
                    _c("animate", {
                      attrs: {
                        attributeName: "fill-opacity",
                        from: "1",
                        to: "1",
                        begin: "0s",
                        dur: "0.8s",
                        values: "1;.5;1",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    })
                  ]),
                  _c(
                    "circle",
                    {
                      attrs: {
                        cx: "60",
                        cy: "15",
                        r: "9",
                        "fill-opacity": "0.3"
                      }
                    },
                    [
                      _c("animate", {
                        attrs: {
                          attributeName: "r",
                          from: "9",
                          to: "9",
                          begin: "0s",
                          dur: "0.8s",
                          values: "9;15;9",
                          calcMode: "linear",
                          repeatCount: "indefinite"
                        }
                      }),
                      _c("animate", {
                        attrs: {
                          attributeName: "fill-opacity",
                          from: "0.5",
                          to: "0.5",
                          begin: "0s",
                          dur: "0.8s",
                          values: ".5;1;.5",
                          calcMode: "linear",
                          repeatCount: "indefinite"
                        }
                      })
                    ]
                  ),
                  _c("circle", { attrs: { cx: "105", cy: "15", r: "15" } }, [
                    _c("animate", {
                      attrs: {
                        attributeName: "r",
                        from: "15",
                        to: "15",
                        begin: "0s",
                        dur: "0.8s",
                        values: "15;9;15",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    }),
                    _c("animate", {
                      attrs: {
                        attributeName: "fill-opacity",
                        from: "1",
                        to: "1",
                        begin: "0s",
                        dur: "0.8s",
                        values: "1;.5;1",
                        calcMode: "linear",
                        repeatCount: "indefinite"
                      }
                    })
                  ])
                ]
              )
            : _c(
                "svg",
                {
                  staticClass: "fill-current text-white text-80",
                  attrs: {
                    xmlns: "http://www.w3.org/2000/svg",
                    viewBox: "0 0 24 24",
                    width: "24",
                    height: "24"
                  }
                },
                [
                  _c("path", {
                    staticClass: "heroicon-ui icon-thumb-up",
                    attrs: {
                      d:
                        "M17.62 10H20a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H8.5c-1.2 0-2.3-.72-2.74-1.79l-3.5-7-.03-.06A3 3 0 0 1 5 9h5V4c0-1.1.9-2 2-2h1.62l4 8zM16 11.24L12.38 4H12v7H5a1 1 0 0 0-.93 1.36l3.5 7.02a1 1 0 0 0 .93.62H16v-8.76zm2 .76v8h2v-8h-2z"
                    }
                  })
                ]
              )
        ]
      )
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7afd9c6e", module.exports)
  }
}

/***/ }),
/* 9 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);