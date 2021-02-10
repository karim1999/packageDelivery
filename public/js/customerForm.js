/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/customerForm.js":
/*!**************************************!*\
  !*** ./resources/js/customerForm.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module './components/TypeInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());

var stripeForm = new Vue({
  el: '#customerForm',
  components: {
    TypeInput: Object(function webpackMissingModule() { var e = new Error("Cannot find module './components/TypeInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())
  },
  data: function data() {
    return {
      value: "Manual",
      how: "List",
      center: {
        lat: 10.0,
        lng: 10.0
      },
      position: {
        lat: 10.0,
        lng: 10.0
      }
    };
  },
  created: function created() {
    var _this = this;

    //do we support geolocation
    if (!("geolocation" in navigator)) {
      console.log('Geolocation is not available.');
      return;
    } // get position


    navigator.geolocation.getCurrentPosition(function (pos) {
      _this.position.lat = pos.coords.latitude;
      _this.center.lat = pos.coords.latitude;
      _this.position.lng = pos.coords.longitude;
      _this.center.lng = pos.coords.longitude;
    }, function (err) {
      console.log('Geolocation is not available.');
    });
  },
  methods: {
    setValue: function setValue(value) {
      this.value = value;
    },
    setHow: function setHow(value) {
      this.how = value;
    },
    gMapFunc: function gMapFunc(event) {
      this.position.lat = event.lat();
      this.position.lng = event.lng();
      console.log(event.lat(), event.lng());
    }
  }
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		if(__webpack_module_cache__[moduleId]) {
/******/ 			return __webpack_module_cache__[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	// startup
/******/ 	// Load entry module
/******/ 	__webpack_require__("./resources/js/customerForm.js");
/******/ 	// This entry module used 'exports' so it can't be inlined
/******/ })()
;