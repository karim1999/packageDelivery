/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/components/passport/AuthorizedClients.vue":
/*!****************************************************************!*\
  !*** ./resources/js/components/passport/AuthorizedClients.vue ***!
  \****************************************************************/
/***/ (() => {

throw new Error("Module parse failed: Unexpected token (1:0)\nYou may need an appropriate loader to handle this file type, currently no loaders are configured to process this file. See https://webpack.js.org/concepts#loaders\n> <style scoped>\n|     .action-link {\n|         cursor: pointer;");

/***/ }),

/***/ "./resources/js/components/passport/Clients.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/passport/Clients.vue ***!
  \******************************************************/
/***/ (() => {

throw new Error("Module parse failed: Unexpected token (1:0)\nYou may need an appropriate loader to handle this file type, currently no loaders are configured to process this file. See https://webpack.js.org/concepts#loaders\n> <style scoped>\n|     .action-link {\n|         cursor: pointer;");

/***/ }),

/***/ "./resources/js/components/passport/PersonalAccessTokens.vue":
/*!*******************************************************************!*\
  !*** ./resources/js/components/passport/PersonalAccessTokens.vue ***!
  \*******************************************************************/
/***/ (() => {

throw new Error("Module parse failed: Unexpected token (1:0)\nYou may need an appropriate loader to handle this file type, currently no loaders are configured to process this file. See https://webpack.js.org/concepts#loaders\n> <style scoped>\n|     .action-link {\n|         cursor: pointer;");

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
(() => {
/*!******************************!*\
  !*** ./resources/js/auth.js ***!
  \******************************/
Vue.component('passport-clients', __webpack_require__(/*! ./components/passport/Clients.vue */ "./resources/js/components/passport/Clients.vue").default);
Vue.component('passport-authorized-clients', __webpack_require__(/*! ./components/passport/AuthorizedClients.vue */ "./resources/js/components/passport/AuthorizedClients.vue").default);
Vue.component('passport-personal-access-tokens', __webpack_require__(/*! ./components/passport/PersonalAccessTokens.vue */ "./resources/js/components/passport/PersonalAccessTokens.vue").default);
var app = new Vue({
  el: '#auth'
});
})();

/******/ })()
;