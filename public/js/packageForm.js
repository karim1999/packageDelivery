/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/packageForm.js":
/*!*************************************!*\
  !*** ./resources/js/packageForm.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module './components/TypeInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());

var stripeForm = new Vue({
  el: '#packageForm',
  components: {
    TypeInput: Object(function webpackMissingModule() { var e = new Error("Cannot find module './components/TypeInput'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())
  },
  data: function data() {
    return {
      value_from: "Manual",
      how_from: "List",
      value_to: "Manual",
      how_to: "List",
      center_from: {
        lat: 10.0,
        lng: 10.0
      },
      center_to: {
        lat: 10.0,
        lng: 10.0
      },
      position_from: {
        lat: 10.0,
        lng: 10.0
      },
      position_to: {
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
      _this.position_from.lat = pos.coords.latitude;
      _this.center_from.lat = pos.coords.latitude;
      _this.position_from.lng = pos.coords.longitude;
      _this.center_from.lng = pos.coords.longitude;
      _this.position_to.lat = pos.coords.latitude;
      _this.center_to.lat = pos.coords.latitude;
      _this.position_to.lng = pos.coords.longitude;
      _this.center_to.lng = pos.coords.longitude;
    }, function (err) {
      console.log('Geolocation is not available.');
    });
  },
  methods: {
    setValue_from: function setValue_from(value) {
      this.value_from = value;
    },
    setHow_from: function setHow_from(value) {
      this.how_from = value;
    },
    gMapFunc_from: function gMapFunc_from(event) {
      this.position_from.lat = event.lat();
      this.position_from.lng = event.lng();
      console.log(event.lat(), event.lng());
    },
    setValue_to: function setValue_to(value) {
      this.value_to = value;
    },
    setHow_to: function setHow_to(value) {
      this.how_to = value;
    },
    gMapFunc_to: function gMapFunc_to(event) {
      this.position_to.lat = event.lat();
      this.position_to.lng = event.lng();
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
/******/ 	__webpack_require__("./resources/js/packageForm.js");
/******/ 	// This entry module used 'exports' so it can't be inlined
/******/ })()
;